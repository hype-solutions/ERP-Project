<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Branches\BranchesProducts;
use App\Models\Products\Products;
use App\Models\PurchasesOrders\PurchasesOrders;
use App\Models\PurchasesOrders\PurchasesOrdersPayments;
use App\Models\PurchasesOrders\PurchasesOrdersProducts;
use App\Models\PurchasesOrders\PurchasesOrdersSignature;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use App\Models\Settings\Settings;
use App\Models\Suppliers\Suppliers;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\purchasesOrders\AddPurchaseOrder;
use App\Http\Requests\purchasesOrders\EditPurchaseOrder;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PurchasesOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    public function view(PurchasesOrders $order)
    {
        $purchaseOrder = PurchasesOrders::find($order->id);
        $user = Auth::user();
        $userId = $user->id;
        $currentProducts = PurchasesOrdersProducts::where('purchase_id', $purchaseOrder->id)->get();
        if ($purchaseOrder->safe_id > 0) {
            $safes = Safes::where('id', '!=', $purchaseOrder->safe_id)->get();
        } else {
            $safes = Safes::all();
        }
        $laterDates = PurchasesOrdersPayments::where('purchase_id', $order->id)->get();
        $logo = Settings::where('key', 'logo')->value('value');
        $company = Settings::where('key', 'company_name')->value('value');
        $addressLineOne = Settings::where('key', 'address_1')->value('value');
        $addressLineTwo = Settings::where('key', 'address_2')->value('value');
        $signature = PurchasesOrdersSignature::with('user')->first();


        return view('purchases_orders.profile', compact('signature', 'company', 'logo', 'addressLineOne', 'addressLineTwo', 'purchaseOrder', 'userId', 'currentProducts', 'safes', 'laterDates'));
    }

    public function add($id=null)
    {

        if (!$id){
            $user = Auth::user();
            $user_id = $user->id;
            $suppliers = Suppliers::all();
            $products = Products::all();
            $safes = Safes::all();
            $branches = Branches::all();
            $safePaymentId = SafesTransactions::where('transaction_type', 1)->get();
            return view('purchases_orders.add', compact('safePaymentId', 'user_id', 'suppliers', 'products', 'safes', 'branches'));
        }else{
            $user = Auth::user();
            $user_id = $user->id;
            $suppliers = Suppliers::all();
            $old_product = Products::find($id);
            // dd($old_product);
            $products = Products::all();
            $safes = Safes::all();
            $branches = Branches::all();
            $safePaymentId = SafesTransactions::where('transaction_type', 1)->get();
            return view('purchases_orders.add', compact('safePaymentId', 'user_id', 'suppliers', 'products','old_product', 'safes', 'branches'));
        }


    }


    // get product orice while adding purchase order

    public function getPrice(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Products::find($productId);
        $priceval = $product->product_price;

        if ($product) {
            return response()->json([
                'status' => true ,
                'product_price' => $priceval ,
                'status' => true ,
            ]);
        }
    }


    public function purchasesordersList()
    {
        $purchases = PurchasesOrders::paginate(5);
        $users = User::where('id', '!=', '1')->paginate(5);
        $signature = PurchasesOrdersSignature::with('user')->first();

        return view('purchases_orders.list', compact('purchases', 'users', 'signature'));
    }

    public function store(AddPurchaseOrder $request)
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
        $purchase->purchase_tax = $request->tax;
        $purchase->payment_method = 'none';
        $purchase->purchase_date = Carbon::now();
        $purchase->safe_payment_id = null;
        $purchase->already_paid = 0;
        $purchase->already_delivered = 0;
        $purchase->delivery_date = null;
        $purchase->branch_id = null;
        $purchase->purchase_total = $request->purchase_total;
        $purchase->shipping_fees = $request->shipping_fees;
        $purchase->added_by = $request->added_by;
        $purchase->autherized_by = 0;
        $purchase->save();

        $purchaseId = $purchase->id;
        $product = $request->product;

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
            $pro->save();
            $listOfProducts[] = $pro;
        }

        return redirect()->route('purchasesorders.list')->with('success', 'purchase added');
    }


    public function status($purchaseOrder, $status)
    {
        if ($status == 1) {
            $currentProducts = PurchasesOrdersProducts::where('purchase_id', $purchaseOrder)->get();
            $purchase = PurchasesOrders::find($purchaseOrder);

            $safes = Safes::where('safe_balance', '>=', $purchase->purchase_total)->get();
            return view('purchases_orders.check', compact('purchase', 'currentProducts', 'safes'));
        } elseif ($status == 2) {
            $purchase = PurchasesOrders::find($purchaseOrder);
            $purchase->purchase_status = 'Declined';
            $purchase->autherized_by = Auth::id();
            $purchase->save();
            PurchasesOrdersProducts::where('purchase_id', $purchaseOrder)
                ->update(['status' => 'Declined']);
            return redirect()->route('purchasesorders.list');
        }
    }
    public function accepting(Request $request, PurchasesOrders $purchaseOrder)
    {
        $purchaseOrder->autherized_by = Auth::id();
        $purchaseOrder->save();

        $currentUser = Auth::id();

        $safeId = $request->safe_id;

        $purchaseOrder->payment_method = $request->payment_method;
        if ($request->payment_method != 'later') {
            $purchaseOrder->already_paid = 1;
            $purchaseOrder->purchase_status = 'Paid';
            $payment = new SafesTransactions();
            $payment->safe_id = $safeId;
            $payment->transaction_type = 1;
            $payment->transaction_amount = $purchaseOrder->purchase_total;
            $payment->transaction_datetime = Carbon::now();
            $payment->done_by = $currentUser;
            $payment->authorized_by = $currentUser;
            $payment->transaction_notes = 'أمر شراء رقم   ' . $purchaseOrder->id;
            $payment->save();

            $purchaseOrder->safe_id = $safeId;
            $purchaseOrder->safe_payment_id = $payment->id;
            Safes::where('id', $safeId)->decrement('safe_balance', $purchaseOrder->purchase_total);
        } else {
            $purchaseOrder->safe_payment_id = 0;
            $purchaseOrder->safe_id = 0;
            $purchaseOrder->already_paid = 0;
        }
        $supplierId = $purchaseOrder->supplier_id;
        $purchaseOrder->save();

        $date = $request->later;
        if ($request->payment_method == 'later') {
            $listOfDates = [];
            foreach ($date as $item) {
                $da = new PurchasesOrdersPayments();
                $da->purchase_id = $purchaseOrder->id;
                $da->supplier_id = $supplierId;
                $da->amount = $item['amount'];
                $da->date = $item['date'];
                $da->notes = $item['notes'];
                $da->paid = 'No';
                $da->save();
                $listOfDates[] = $da;
            }
        }
        return redirect()->route('purchasesorders.list');
    }

    public function toinventory(PurchasesOrders $purchaseOrder)
    {
        $currentProducts = PurchasesOrdersProducts::where('purchase_id', $purchaseOrder->id)
            // ->with('check')
            ->get();
        $branches = Branches::all();
        return view('purchases_orders.toinventory', compact('purchaseOrder', 'currentProducts', 'branches'));
    }

    public function importing(Request $request, PurchasesOrders $purchaseOrder)
    {
        $purchaseOrder->purchase_status = 'Delivered';
        $purchaseOrder->already_delivered = 1;
        $purchaseOrder->branch_id = $request->branch_id;
        $purchaseOrder->delivery_date = $request->delivery_date;
        $purchaseOrder->save();
        PurchasesOrdersProducts::where('purchase_id', $purchaseOrder->id)->update(['status' => 'Delivered']);

        $products = PurchasesOrdersProducts::where('purchase_id', $purchaseOrder->id)->get();
        foreach ($products as $product) {
            $listOfProductsx = [];


            //search for products at branches
            $checkIfRecordExsists = BranchesProducts::where('branch_id', $request->branch_id)
                ->where('product_id', $product->product_id)
                ->first();

            Products::where('id', $product->product_id)->increment('product_total_in', $product->product_qty);

            if (isset($checkIfRecordExsists)) {
                BranchesProducts::where('product_id', $product->product_id)
                    ->where('branch_id', $request->branch_id)
                    ->increment('amount', $product->product_qty);
            } else {
                $prox = new BranchesProducts();
                $prox->branch_id = $request->branch_id;
                $prox->product_id = $product->product_id;
                $prox->amount = $product->product_qty;
                $prox->save();
                $listOfProductsx[] = $prox;
            }
        }

        return redirect()->route('purchasesorders.list');
    }

    public function edit(PurchasesOrders $order)
    {
        $purchaseOrder = PurchasesOrders::find($order->id);
        $user = Auth::user();
        $userId = $user->id;
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
        return view('purchases_orders.edit', compact('purchaseOrder', 'userId', 'suppliers', 'currentProducts', 'products', 'safes', 'safes2', 'laterDates', 'branches'));
    }

    public function update(EditPurchaseOrder $request, $order)
    {
        $purchase = PurchasesOrders::find($order);
        $purchase->supplier_id = $request->supplier_id;
        $purchase->purchase_status = 'Created';
        $purchase->purchase_note = $request->purchase_note;
        $purchase->discount_percentage = $request->discount_percentage;
        $purchase->discount_amount = $request->discount_amount;
        $purchase->purchase_date = Carbon::now();
        $purchase->purchase_total = $request->purchase_total;
        $purchase->shipping_fees = $request->shipping_fees;
        $purchase->purchase_tax = $request->tax;

        $purchase->save();

        $purchaseId = $purchase->id;
        $product = $request->product;
        $supplierId = $purchase->supplier_id;

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
            $pro->save();
            $listOfProducts[] = $pro;
        }


        // Dof3at, will be used later

        // PurchasesOrdersPayments::where('purchase_id', $purchaseId)->delete();
        // if ($request->payment_method == 'later') {
        //     $listOfDates = [];
        //     foreach ($date as $item) {
        //         $da = new PurchasesOrdersPayments();
        //         $da->purchase_id = $purchaseId;
        //         $da->supplier_id = $supplierId;
        //         $da->amount = $item['amount'];
        //         $da->date = $item['date'];
        //         $da->notes = $item['notes'];


        //         if (!empty($item['paynow'])) {
        //             if (!empty($item['safe_payment_id'])) {
        //                 $da->paid = 'Yes';
        //                 $da->safe_payment_id = $item['safe_payment_id'];
        //                 $da->safe_id = $item['safe_id'];
        //             } else {

        //                 $da->paid = 'Yes';
        //                 //pay here
        //                 $payment = new SafesTransactions();
        //                 $payment->safe_id = $item['safe_id'];
        //                 $payment->transaction_type = 1;
        //                 $payment->transaction_amount = $item['amount'];
        //                 $payment->transaction_datetime = Carbon::now();
        //                 $payment->done_by = $request->added_by;
        //                 $payment->autherized_by = $request->added_by;
        //                 $payment->transaction_notes = 'قسط على أمر شراء رقم' . $purchaseId;
        //                 $payment->save();
        //                 $payment_id = $payment->id;
        //                 $da->safe_id = $item['safe_id'];
        //                 $da->safe_payment_id = $payment_id;
        //                 Safes::where('id', $item['safe_id'])->decrement('safe_balance', $item['amount']);
        //             }
        //         } else {
        //             $da->paid = 'No';
        //         }
        //         $da->save();
        //         $listOfDates[] = $da;
        //     }
        //     $checkAllPaid = PurchasesOrdersPayments::where('purchase_id', $purchaseId)
        //         ->where('paid', 'No')
        //         ->count();
        //     if ($checkAllPaid > 0) {
        //         PurchasesOrders::where('id', $purchaseId)
        //             ->update(['already_paid' => 0]);
        //     } else {
        //         PurchasesOrders::where('id', $purchaseId)
        //             ->update(['already_paid' => 1]);
        //     }
        // }




        return redirect()->route('purchasesorders.list');
    }


    public function signature(Request $request)
    {
        PurchasesOrdersSignature::where('id', 1)->update([
            'user_id' => $request->userId,
            'title' => $request->title,
        ]);

        return true;
    }
}
