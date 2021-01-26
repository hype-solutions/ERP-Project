<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Branches\BranchesProducts;
use App\Models\Products\Products;
use App\Models\PurchasesOrders\PurchasesOrders;
use App\Models\PurchasesOrders\PurchasesOrdersPayments;
use App\Models\PurchasesOrders\PurchasesOrdersProducts;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use App\Models\Suppliers\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasesOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('log')->only('index');

        // $this->middleware('subscribed')->except('store');
    }

    public function view(PurchasesOrders $order)
    {
        $purchaseOrder = PurchasesOrders::find($order->id);
        $user = Auth::user();
        $user_id = $user->id;
        $currentProducts = PurchasesOrdersProducts::where('purchase_id', $purchaseOrder->id)->get();
        if ($purchaseOrder->safe_id > 0) {
            $safes = Safes::where('id', '!=', $purchaseOrder->safe_id)->get();
        } else {
            $safes = Safes::all();
        }
        $laterDates = PurchasesOrdersPayments::where('purchase_id', $order->id)->get();
        return view('purchases_orders.profile', compact('purchaseOrder', 'user_id', 'currentProducts', 'safes', 'laterDates'));

    }

    public function add()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $suppliers = Suppliers::all();
        $products = Products::all();
        $safes = Safes::all();
        $branches = Branches::all();
        $safe_payment_id = SafesTransactions::where('transaction_type',1)->get();
        return view('purchases_orders.add', compact('safe_payment_id','user_id', 'suppliers', 'products', 'safes', 'branches'));
    }

    public function purchasesordersList()
    {
        $purchases = PurchasesOrders::all();
        return view('purchases_orders.list', compact('purchases'));
    }

    public function store(Request $request)
    {
        $purchase = new PurchasesOrders;
         // Get Branch Safe ID
         if ($request->new_supplier_name != '') {
            $supplier = new Suppliers();
            $supplier->supplier_name = $request->new_supplier_name;
            $supplier->supplier_mobile = $request->new_supplier_mobile;
            $supplier->save();
            $supplierId = $supplier->id;
        } else {
            $supplierId = $request->supplier_id;
        }

        $purchase->supplier_id = $supplierId;
        $purchase->purchase_note = $request->purchase_note;
        $purchase->discount_percentage = $request->discount_percentage;
        $purchase->discount_amount = $request->discount_amount;
        if(!isset($request->payment_method)){
            $purchase->payment_method = 'none';
        }else{
            $purchase->payment_method = $request->payment_method;
        }
        $purchase->purchase_date = Carbon::now();
        if ($request->already_paid == 'on') {
            $purchase->safe_id = $request->safe_id_if_paid;
            $purchase->safe_payment_id = $request->safe_payment_id;
            $purchase->already_paid = 1;
        } else {
            $purchase->safe_payment_id = NULL;
            $purchase->already_paid = 0;
            if ($request->safe_id_not_paid > 0) {
                $purchase->safe_id = $request->safe_id_not_paid;
                $payment = new SafesTransactions();
                $payment->safe_id = $request->safe_id_not_paid;
                $payment->transaction_type = 1;
                $payment->transaction_amount = $request->purchase_total;
                $payment->transaction_datetime = Carbon::now();
                $payment->done_by = $request->added_by;
                $payment->authorized_by = $request->added_by;
                $payment->save();
                $updateLater = 1;
                $payment_id = $payment->id;
                $purchase->safe_payment_id = $payment_id;
                $purchase->already_paid = 1;


                Safes::where('id', $request->safe_id_not_paid)
                            ->decrement('safe_balance', $request->purchase_total);
            }
        }
         if ($request->already_delivered == 'on') {
            if (!empty($purchase->delivery_date)) {
                $updateStock = 0;
            } else {
                $updateStock = 1;
                $purchase->already_delivered = 1;
                $purchase->delivery_date = $request->delivery_date;
                $purchase->branch_id = $request->branch_id;
            }
        } else {
            $purchase->already_delivered = 0;
            $purchase->delivery_date = NULL;
            $purchase->branch_id = NULL;
        }
        $purchase->purchase_total = $request->purchase_total;
        $purchase->shipping_fees = $request->shipping_fees;
        $purchase->added_by = $request->added_by;
        $purchase->autherized_by = $request->added_by;
        $purchase->save();

        $purchaseId = $purchase->id;
        $product = $request->product;
        $date = $request->later;



        if (isset($updateStock)) {
            if ($updateStock == 1) {

                //Save Items
                $listOfProductsx = [];
                foreach ($product as $item) {

                    //search for products at branches
                    $checkIfRecordExsists = BranchesProducts::where('branch_id', $request->branch_id)
                        ->where('product_id', $item['id'])
                        ->first();

                    Products::where('id', $item['id'])->increment('product_total_in', $item['qty']);


                    if (isset($checkIfRecordExsists)) {
                        BranchesProducts::where('product_id', $item['id'])
                            ->where('branch_id', $request->branch_id)
                            ->increment('amount', $item['qty']);
                        //->update(['amount' => ]);

                    } else {
                        $prox = new BranchesProducts();
                        $prox->branch_id = $request->branch_id;
                        $prox->product_id = $item['id'];
                        $prox->amount = $item['qty'];
                        $prox->save();
                        $listOfProductsx[] = $prox;
                    }
                }
            }
        }


        if (isset($updateLater)) {
            if ($updateLater == 1) {
                $edtPayment = SafesTransactions::find($payment_id);
                $edtPayment->transaction_notes = 'أمر شراء رقم ' . $purchaseId;
                $edtPayment->save();
            }
        }
        //Save Items
        $listOfProducts = [];
        foreach ($product as $item) {
            $pro = new PurchasesOrdersProducts();
            $pro->purchase_id = $purchaseId;
            $pro->supplier_id = $supplierId;
            $pro->product_id = $item['id'];
            $pro->product_desc = $item['desc'];
            $pro->product_price = $item['price'];
            $pro->product_qty = $item['qty'];
            if (isset($updateStock)) {
                if ($updateStock == 1) {
                    $pro->status = 'delivered';
                }
            }
            $pro->save();
            $listOfProducts[] = $pro;
        }

        if ($request->payment_method == 'later') {
            $listOfDates = [];
            foreach ($date as $item) {
                $da = new PurchasesOrdersPayments();
                $da->purchase_id = $purchaseId;
                $da->supplier_id = $supplierId;
                $da->amount = $item['amount'];
                $da->date = $item['date'];
                $da->notes = $item['notes'];
                if (!empty($item['paynow'])) {
                    $da->paid = 'Yes';
                    //pay here
                        $payment = new SafesTransactions();
                        $payment->safe_id = $item['safe_id'];
                        $payment->transaction_type = 1;
                        $payment->transaction_amount = $item['amount'];
                        $payment->transaction_datetime = Carbon::now();
                        $payment->done_by = $request->added_by;
                        $payment->authorized_by = $request->added_by;
                        $payment->transaction_notes = 'قسط على أمر شراء رقم' . $purchaseId;
                        $payment->save();
                        $payment_id = $payment->id;
                    $da->safe_id = $item['safe_id'];
                    $da->safe_payment_id = $payment_id;
                    Safes::where('id', $item['safe_id'])->decrement('safe_balance', $item['amount']);
                } else {
                    $da->paid = 'No';
                }
                $da->save();
                $listOfDates[] = $da;
            }
        }
        return redirect()->route('purchasesorders.edit',$purchaseId);
        //return redirect('/purchase_orders')->with('success', 'purchase added');
    }


    public function edit(PurchasesOrders $order)
    {
        $purchaseOrder = PurchasesOrders::find($order->id);
        $user = Auth::user();
        $user_id = $user->id;
        $suppliers = Suppliers::where('id', '!=', $purchaseOrder->supplier_id)->get();
        $currentProducts = PurchasesOrdersProducts::where('purchase_id', $purchaseOrder->id)->get();
        $products = Products::all();
        if ($purchaseOrder->safe_id > 0) {
            $safes = Safes::where('id', '!=', $purchaseOrder->safe_id)->get();
        } else {
            $safes = Safes::all();
        }
        $safes2 = Safes::all();
        $laterDates = PurchasesOrdersPayments::where('purchase_id', $order->id)->get();
        $branches = Branches::all();
        return view('purchases_orders.edit', compact('purchaseOrder', 'user_id', 'suppliers', 'currentProducts', 'products', 'safes', 'safes2', 'laterDates', 'branches'));
    }

    public function update(Request $request, $order)
    {
        $purchase = PurchasesOrders::find($order);
        $purchase->supplier_id = $request->supplier_id;
        $purchase->purchase_note = $request->purchase_note;
        $purchase->discount_percentage = $request->discount_percentage;
        $purchase->discount_amount = $request->discount_amount;
        $purchase->payment_method = $request->payment_method;
        $purchase->purchase_date = Carbon::now();
        if ($request->already_paid == 'on') {
            //$purchase->safe_id = $request->safe_id_if_paid;
            //$purchase->safe_payment_id = $request->safe_payment_id;
            //$purchase->already_paid = 1;
        } else {
            $purchase->safe_payment_id = NULL;
            $purchase->safe_id = NULL;
            $purchase->already_paid = 0;

            if ($request->safe_id_not_paid > 0) {
                $purchase->safe_id = $request->safe_id_not_paid;
                $payment = new SafesTransactions();
                $payment->safe_id = $request->safe_id_not_paid;
                $payment->transaction_type = 1;
                $payment->transaction_amount = $request->purchase_total;
                $payment->transaction_notes = 'أمر شراء رقم ' . $order;
                $payment->transaction_datetime = Carbon::now();
                $payment->done_by = 1;
                $payment->authorized_by    = 1;
                $payment->save();
                $payment_id = $payment->id;
                $purchase->safe_payment_id = $payment_id;
                $purchase->already_paid = 1;
            }
        }
        $purchase->payment_method = $request->payment_method;
        if ($request->already_delivered == 'on') {
            if (!empty($purchase->delivery_date)) {
                $updateStock = 0;
            } else {
                $updateStock = 1;
                $purchase->already_delivered = 1;
                $purchase->delivery_date = $request->delivery_date;
                $purchase->branch_id = $request->branch_id;
            }
        } else {
            $purchase->already_delivered = 0;
            $purchase->delivery_date = NULL;
            $purchase->branch_id = NULL;
        }
        $purchase->purchase_total = $request->purchase_total;
        $purchase->shipping_fees = $request->shipping_fees;
        $purchase->save();




        $purchaseId = $purchase->id;
        $product = $request->product;
        $date = $request->later;
        $supplierId = $purchase->supplier_id;

        if (isset($updateStock)) {
            if ($updateStock == 1) {

                //Save Items
                $listOfProductsx = [];
                foreach ($product as $item) {

                    //search for products at branches
                    $checkIfRecordExsists = BranchesProducts::where('branch_id', $request->branch_id)
                        ->where('product_id', $item['id'])
                        ->first();
                    Products::where('id', $item['id'])->increment('product_total_in', $item['qty']);

                    if (isset($checkIfRecordExsists)) {
                        BranchesProducts::where('product_id', $item['id'])
                            ->where('branch_id', $request->branch_id)
                            ->increment('amount', $item['qty']);
                        //->update(['amount' => ]);

                    } else {
                        $prox = new BranchesProducts();
                        $prox->branch_id = $request->branch_id;
                        $prox->product_id = $item['id'];
                        $prox->amount = $item['qty'];
                        $prox->save();
                        $listOfProductsx[] = $prox;
                    }
                }
            }
        }






        //DELETE OLD RECORES
        PurchasesOrdersProducts::where('purchase_id', $purchaseId)->delete();

        //Save Items
        $listOfProducts = [];
        foreach ($product as $item) {
            $pro = new PurchasesOrdersProducts();
            $pro->purchase_id = $purchaseId;
            $pro->supplier_id = $supplierId;
            $pro->product_id = $item['id'];
            $pro->product_desc = $item['desc'];
            $pro->product_price = $item['price'];
            $pro->product_qty = $item['qty'];
            if (isset($updateStock)) {
                if ($updateStock == 1) {
                    $pro->status = 'delivered';
                }
            }
            $pro->save();
            $listOfProducts[] = $pro;
        }


        PurchasesOrdersPayments::where('purchase_id', $purchaseId)->delete();
        if ($request->payment_method == 'later') {
            $listOfDates = [];
            foreach ($date as $item) {
                $da = new PurchasesOrdersPayments();
                $da->purchase_id = $purchaseId;
                $da->supplier_id = $supplierId;
                $da->amount = $item['amount'];
                $da->date = $item['date'];
                $da->notes = $item['notes'];


                if (!empty($item['paynow'])) {
                    if (!empty($item['safe_payment_id'])) {
                        $da->paid = 'Yes';
                        $da->safe_payment_id = $item['safe_payment_id'];
                        $da->safe_id = $item['safe_id'];
                    }
                    else{

                    $da->paid = 'Yes';
                    //pay here
                        $payment = new SafesTransactions();
                        $payment->safe_id = $item['safe_id'];
                        $payment->transaction_type = 1;
                        $payment->transaction_amount = $item['amount'];
                        $payment->transaction_datetime = Carbon::now();
                        $payment->done_by = $request->added_by;
                        $payment->authorized_by = $request->added_by;
                        $payment->transaction_notes = 'قسط على أمر شراء رقم' . $purchaseId;
                        $payment->save();
                        $payment_id = $payment->id;
                    $da->safe_id = $item['safe_id'];
                    $da->safe_payment_id = $payment_id;
                    Safes::where('id', $item['safe_id'])->decrement('safe_balance', $item['amount']);
                }
            } else {
                    $da->paid = 'No';
                }
                $da->save();
                $listOfDates[] = $da;
            }
            $checkAllPaid = PurchasesOrdersPayments::where('purchase_id',$purchaseId)
                                   ->where('paid','No')
                                   ->count();
                                   if($checkAllPaid > 0){
                                    PurchasesOrders::where('id', $purchaseId)
                                                   ->update(['already_paid' => 0]);
                                   }else{
                                    PurchasesOrders::where('id', $purchaseId)
                                    ->update(['already_paid' => 1]);
                                   }

        }




        return redirect()->route('purchasesorders.list');
    }
}
