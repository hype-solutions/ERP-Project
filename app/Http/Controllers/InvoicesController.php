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
        $this->middleware('installed');
        $this->middleware('auth');
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


    public function view(Invoices $invoice)
    {

        $user = Auth::user();
        $user_id = $user->id;
        $customers = Customers::where('id', '!=', $invoice->customer_id)->get();
        $currentProducts = InvoicesProducts::where('invoice_id', $invoice->id)->get();
        $products = Products::all();
        $safes = Safes::all();
        $branches = Branches::where('id', '!=', $invoice->branch_id)->get();
        $laterDates = InvoicesPayments::where('invoice_id', $invoice->id)->get();
        return view('invoices.profile', compact('laterDates', 'currentProducts', 'invoice', 'user_id', 'customers', 'products', 'safes', 'branches'));
    }

    function print2(Invoices $invoice){
        $user = Auth::user();
        $user_id = $user->id;
        $customers = Customers::where('id', '!=', $invoice->customer_id)->get();
        $currentProducts = InvoicesProducts::where('invoice_id', $invoice->id)->get();
        $products = Products::all();
        $safes = Safes::all();
        $branches = Branches::where('id', '!=', $invoice->branch_id)->get();
        $laterDates = InvoicesPayments::where('invoice_id', $invoice->id)->get();
        $p = '2';
        return view('invoices.print', compact('p','laterDates', 'currentProducts', 'invoice', 'user_id', 'customers', 'products', 'safes', 'branches'));
    }

    function print3(Invoices $invoice,Request $request){
        $user = Auth::user();
        $user_id = $user->id;
        $customers = Customers::where('id', '!=', $invoice->customer_id)->get();
        $currentProducts = InvoicesProducts::where('invoice_id', $invoice->id)->get();
        $products = Products::all();
        $safes = Safes::all();
        $branches = Branches::where('id', '!=', $invoice->branch_id)->get();
        $laterDates = InvoicesPayments::where('invoice_id', $invoice->id)->get();
        $p = 3;
        $template = $request->template;
        return view('invoices.print', compact('template','p','laterDates', 'currentProducts', 'invoice', 'user_id', 'customers', 'products', 'safes', 'branches'));
    }

    public function edit(Invoices $invoice)
    {

        $user = Auth::user();
        $user_id = $user->id;
        $customers = Customers::where('id', '!=', $invoice->customer_id)->get();
        $currentProducts = InvoicesProducts::where('invoice_id', $invoice->id)->get();
        $products = Products::all();
        $safes = Safes::all();
        $safes2 = Safes::all();
        $branches = Branches::where('id', '!=', $invoice->branch_id)->get();
        $laterDates = InvoicesPayments::where('invoice_id', $invoice->id)->get();
        return view('invoices.edit', compact('safes2', 'laterDates', 'currentProducts', 'invoice', 'user_id', 'customers', 'products', 'safes', 'branches'));
    }




    public function store(Request $request)
    {
        // Get Branch Safe ID
        $safe_id = Safes::where('branch_id', $request->branch_id)->value('id');
        $invoice = new Invoices;

        // Get Branch Safe ID
        if ($request->new_customer_name != '') {
            $customer = new Customers();
            $customer->customer_name = $request->new_customer_name;
            $customer->customer_mobile = $request->new_customer_mobile;
            $customer->save();
            $customerId = $customer->id;
        } else {
            $customerId = $request->customer_id;
        }


        $invoice->customer_id = $customerId;
        $invoice->invoice_paper_num = $request->invoice_paper_num;
        $invoice->branch_id = $request->branch_id;
        $invoice->invoice_note = $request->invoice_note;
        $invoice->discount_percentage = $request->discount_percentage;
        $invoice->discount_amount = $request->discount_amount;
        $invoice->invoice_tax = $request->tax;
        $invoice->payment_method = $request->payment_method;
        $invoice->invoice_date = Carbon::now();
        $invoice->invoice_total = $request->invoice_total;
        $invoice->shipping_fees = $request->shipping_fees;
        $invoice->sold_by = $request->sold_by;
        $invoice->authorized_by = $request->sold_by;

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
            Safes::where('id', $safe_id)->increment('safe_balance', $request->invoice_total);
        } else {
            $invoice->safe_transaction_id = 0;
            $invoice->safe_id = 0;
            $invoice->already_paid = 0;
        }

        $invoice->save();

        $invoiceId = $invoice->id;
        $product = $request->product;
        $date = $request->later;

        //Save Items
        foreach ($product as $item) {
            Products::where('id', $item['id'])->increment('product_total_out', $item['qty']);
            BranchesProducts::where('product_id', $item['id'])
                ->where('branch_id', $request->branch_id)
                ->decrement('amount', $item['qty']);
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
            $pro->product_cost = $item['cost']*$item['qty'];
            $pro->product_qty = $item['qty'];
            $pro->status = 'shipped';
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
                if (!empty($item['paynow'])) {
                    $da->paid = 'Yes';
                    //pay here
                    $payment = new SafesTransactions();
                    $payment->safe_id = $safe_id;
                    $payment->transaction_type = 2;
                    $payment->transaction_amount = $item['amount'];
                    $payment->transaction_datetime = Carbon::now();
                    $payment->done_by = $request->sold_by;
                    $payment->authorized_by = $request->sold_by;
                    $payment->transaction_notes = 'قسط على فاتورة رقم' . $invoiceId;
                    $payment->save();
                    $payment_id = $payment->id;
                    $da->safe_id = $safe_id;
                    $da->safe_payment_id = $payment_id;
                    Safes::where('id', $safe_id)->increment('safe_balance', $item['amount']);
                    Invoices::where('id',$invoiceId)->increment('amount_collected', $item['amount']);
                } else {
                    $da->paid = 'No';
                }
                $da->save();
                $listOfDates[] = $da;
            }
        }
        $sumCost = InvoicesProducts::where('invoice_id', $invoiceId)->sum('product_cost');
        $edtInvoice = Invoices::find($invoiceId);
                $edtInvoice->invoice_cost = $sumCost;
                $edtInvoice->save();
        return redirect('/invoices')->with('success', 'invoice added');
    }


    public function invoicesList()
    {
        $invoices = Invoices::all();
        return view('invoices.list', compact('invoices'));
    }



    public function update(Request $request, $invoice)
    {
        // Get Branch Safe ID
        $safe_id = Safes::where('branch_id', $request->branch_id)->value('id');
        //Get invoice data and update it
        $invoice = Invoices::find($invoice);
        $invoice->customer_id = $request->customer_id;
        $invoice->branch_id = $request->branch_id;
        $invoice->invoice_note = $request->invoice_note;
        $invoice->discount_percentage = $request->discount_percentage;
        $invoice->invoice_tax = $request->tax;
        $invoice->discount_amount = $request->discount_amount;
        $invoice->payment_method = $request->payment_method;
        $invoice->invoice_date = Carbon::now();
        $invoice->invoice_total = $request->invoice_total;
        $invoice->shipping_fees = $request->shipping_fees;
        $invoice->sold_by = $request->sold_by;
        $invoice->authorized_by = $request->sold_by;

        //If already paid is checked
        if ($request->already_paid == 'on') {
            //If the invoice is paid before
            if ($invoice->already_paid > 0) {
                //Do nothing
            } else {
                $invoice->safe_id = $request->safe_id_not_paid;
                $payment = new SafesTransactions();
                $payment->safe_id = $request->safe_id_not_paid;
                $payment->transaction_type = 2;
                $payment->transaction_amount = $request->invoice_total;
                $payment->transaction_notes = 'فاتورة مبيعات رقم  ' . $invoice;
                $payment->transaction_datetime = Carbon::now();
                $payment->done_by = 1;
                $payment->authorized_by    = 1;
                $payment->save();
                $payment_id = $payment->id;
                $invoice->safe_transaction_id = $payment_id;
                $invoice->already_paid = 1;
                Safes::where('id', $safe_id)->increment('safe_balance', $request->invoice_total);
            }
        } else {
            $invoice->safe_transaction_id = NULL;
            $invoice->safe_id = NULL;
            $invoice->already_paid = 0;
        }
        $invoice->save();

        //Assigning variable to use
        $invoiceId = $invoice->id;
        $product = $request->product;
        $date = $request->later;
        $customerId = $request->customer_id;

        //Save Items
        foreach ($product as $item) {
            //Updating stock
            Products::where('id', $item['id'])
                ->increment('product_total_out', $item['qty']);
            BranchesProducts::where('product_id', $item['id'])
                ->where('branch_id', $request->branch_id)
                ->decrement('amount', $item['qty']);
        }
        //Delete old records
        InvoicesProducts::where('invoice_id', $invoiceId)->delete();
        //Save new records
        $listOfProducts = [];
        foreach ($product as $item) {
            $pro = new InvoicesProducts();
            $pro->invoice_id = $invoiceId;
            $pro->customer_id = $customerId;
            $pro->product_id = $item['id'];
            $pro->product_desc = $item['desc'];
            $pro->product_price = $item['price'];
            $pro->product_cost = $item['cost']*$item['qty'];
            $pro->product_qty = $item['qty'];
            $pro->status = 'shipped';
            $pro->save();
            $listOfProducts[] = $pro;
        }


        if ($invoice->payment_method == 'later') {
            //Delete old payment records
            InvoicesPayments::where('invoice_id', $invoiceId)->delete();
            //Save new payment records
            $listOfDates = [];
            foreach ($date as $item) {
                $da = new InvoicesPayments();
                $da->invoice_id = $invoiceId;
                $da->customer_id = $customerId;
                $da->amount = $item['amount'];
                $da->date = $item['date'];
                $da->notes = $item['notes'];
                //If paynow is checked
                if (!empty($item['paynow'])) {
                    //If the user has paid before and transaction id is saved
                    if (!empty($item['safe_payment_id'])) {
                        $da->paid = 'Yes';
                        $da->safe_payment_id = $item['safe_payment_id'];
                        $da->safe_id = $safe_id;
                    } else {
                        $da->paid = 'Yes';
                        $payment = new SafesTransactions();
                        $payment->safe_id = $safe_id;
                        $payment->transaction_type = 1;
                        $payment->transaction_amount = $item['amount'];
                        $payment->transaction_datetime = Carbon::now();
                        $payment->done_by = $request->sold_by;
                        $payment->authorized_by = $request->sold_by;
                        $payment->transaction_notes = 'قسط على فاتورة رقم' . $invoiceId;
                        $payment->save();
                        $payment_id = $payment->id;
                        $da->safe_id = $safe_id;
                        $da->safe_payment_id = $payment_id;
                        Safes::where('id', $safe_id)->decrement('safe_balance', $item['amount']);
                        Invoices::where('id',$invoiceId)->increment('amount_collected', $item['amount']);
                    }
                } else {
                    $da->paid = 'No';
                }
                $da->save();
                $listOfDates[] = $da;
            }
            $checkAllPaid = InvoicesPayments::where('invoice_id', $invoiceId)
                ->where('paid', 'No')
                ->count();
            if ($checkAllPaid > 0) {
                Invoices::where('id', $invoiceId)->update(['already_paid' => 0]);
            } else {
                Invoices::where('id', $invoiceId)->update(['already_paid' => 1]);
            }
        }
        $sumCost = InvoicesProducts::where('invoice_id', $invoiceId)->sum('product_cost');
        $edtInvoice = Invoices::find($invoiceId);
                $edtInvoice->invoice_cost = $sumCost;
                $edtInvoice->save();
        return back();
    }

    public function installment(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $payment = new SafesTransactions();
        $payment->safe_id = $request->safe_id;
        $payment->transaction_type = 2;
        $payment->transaction_amount = $request->amount;
        $payment->transaction_datetime = Carbon::now();
        $payment->done_by = $user_id;
        $payment->authorized_by = $user_id;
        $payment->transaction_notes = $request->notes;
        $payment->save();

        InvoicesPayments::where('id', $request->installment_invoice)->update(['paid' => 'Yes']);
        return back()->with('success', 'deposited');
    }

}
