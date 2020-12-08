<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Branches\BranchesProducts;
use App\Models\Customers\Customers;
use App\Models\Invoices\Invoices;
use App\Models\Invoices\InvoicesPayments;
use App\Models\Invoices\InvoicesProducts;
use App\Models\Products\Products;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('log')->only('index');

        // $this->middleware('subscribed')->except('store');
    }
    public function add()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $customers = Customers::all();
        $products = Products::all();
        $safes = Safes::all();
        $branches = Branches::all();
        return view('invoices.add', compact('user_id', 'customers', 'products', 'safes', 'branches'));
    }
    public function store(Request $request)
    {
        // Get Branch Safe ID
        $safe_id = Safes::where('branch_id', $request->branch_id)->value('id');
        $invoice = new Invoices;
        $invoice->customer_id = $request->customer_id;
        $invoice->branch_id = $request->branch_id;
        $invoice->invoice_note = $request->invoice_note;
        $invoice->discount_percentage = $request->discount_percentage;
        $invoice->discount_amount = $request->discount_amount;
        $invoice->payment_method = $request->payment_method;
        $invoice->invoice_date = Carbon::now();
        if ($request->already_paid == 'on') {
            $invoice->already_paid = 1;

            $payment = new SafesTransactions();
            $payment->safe_id = $safe_id;
            $payment->transaction_type = 2;
            $payment->transaction_amount = $request->invoice_total;
            $payment->transaction_datetime = Carbon::now();
            $payment->done_by = $request->sold_by;
            $payment->authorized_by = $request->sold_by;
            $payment->save();
            $payment_id = $payment->id;

            $invoice->safe_id = $safe_id;
            $invoice->safe_transaction_id = $payment->id;
            $updateLater = 1;
        } else {
            $invoice->safe_transaction_id = 0;
            $invoice->safe_id = 0;
            $invoice->already_paid = 0;
        }

        // if ($request->already_delivered == 'on') {
        //     if (!empty($purchase->delivery_date)) {
        //         $updateStock = 0;
        //     } else {
        //         $updateStock = 1;
        //         $purchase->already_delivered = 1;
        //         $purchase->delivery_date = $request->delivery_date;
        //         $purchase->branch_id = $request->branch_id;
        //     }
        // } else {
        //     $purchase->already_delivered = 0;
        //     $purchase->delivery_date = NULL;
        //     $purchase->branch_id = NULL;
        // }
        $invoice->invoice_total = $request->invoice_total;
        $invoice->shipping_fees = $request->shipping_fees;
        $invoice->sold_by = $request->sold_by;
        $invoice->authorized_by = $request->sold_by;
        $invoice->save();

        $invoiceId = $invoice->id;
        $product = $request->product;
        $date = $request->later;
        $customerId = $request->customer_id;

        $updateStock = 1;

        if (isset($updateStock)) {
            if ($updateStock == 1) {

                //Save Items
                $listOfProductsx = [];
                foreach ($product as $item) {

                    //search for products at branches
                    $checkIfRecordExsists = BranchesProducts::where('branch_id', $request->branch_id)
                        ->where('product_id', $item['id'])
                        ->first();

                    Products::where('id', $item['id'])->increment('product_total_out', $item['qty']);


                    if (isset($checkIfRecordExsists)) {
                        BranchesProducts::where('product_id', $item['id'])
                            ->where('branch_id', $request->branch_id)
                            ->decrement('amount', $item['qty']);
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
                $edtPayment->transaction_notes = 'فاتورة مبيعات رقم  ' . $invoiceId;
                $edtPayment->save();
            }
        }
        //Save Items
        $listOfProducts = [];
        foreach ($product as $item) {
            $pro = new InvoicesProducts();
            $pro->invoice_id = $invoiceId;
            $pro->customer_id = $customerId;
            $pro->product_id = $item['id'];
            $pro->product_desc = $item['desc'];
            $pro->product_price = $item['price'];
            $pro->product_qty = $item['qty'];
            if (isset($updateStock)) {
                if ($updateStock == 1) {
                    $pro->status = 'shipped';
                }
            }
            $pro->save();
            $listOfProducts[] = $pro;
        }

        if ($request->payment_method == 'later') {
            $listOfDates = [];
            foreach ($date as $item) {
                $da = new InvoicesPayments();
                $da->invoice_id = $invoiceId;
                $da->customer_id = $customerId;
                $da->amount = $item['amount'];
                $da->date = $item['date'];
                $da->notes = $item['notes'];
                if (!empty($item['paid'])) {
                    $da->paid = 'Yes';
                    $da->safe_id = $item['safe_id'];
                    $da->safe_payment_id = $item['safe_payment_id'];
                } else {
                    $da->paid = 'No';
                }
                $da->save();
                $listOfDates[] = $da;
            }
        }
        return redirect('/invoices')->with('success', 'invoice added');
    }


    public function invoicesList()
    {
        $invoices = Invoices::all();
        return view('invoices.list', compact('invoices'));
    }

    public function edit(Invoices $invoice)
    {

    }


    public function getOtherProducts(Request $request)
    {
        $other_ids = $request->other_ids;
        $otherProducts = Products::whereNotIn('id', $other_ids)->get();
        return $otherProducts;


        // $result = DB::table('products')->whereNotIn('id', function($q){
        //     $q->select('examId')->from('testresults');
        // })->get();
    }
}
