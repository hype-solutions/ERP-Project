<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Branches\BranchesProducts;
use App\Models\Customers\Customers;
use App\Models\Invoices\Invoices;
use App\Models\Invoices\InvoicesPayments;
use App\Models\Invoices\InvoicesPriceQuotation;
use App\Models\Invoices\InvoicesPriceQuotationsProducts;
use App\Models\Invoices\InvoicesProducts;
use App\Models\Products\Products;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesPriceQuotationController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('log')->only('index');

        // $this->middleware('subscribed')->except('store');
    }
    public function invoicesPriceQuotationsList()
    {
        $quotations = InvoicesPriceQuotation::all();
        return view('invoices_price_quotations.list', compact('quotations'));
    }

    public function add()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $customers = Customers::all();
        $products = Products::all();
        return view('invoices_price_quotations.add', compact('user_id', 'customers', 'products'));
    }


    public function view(InvoicesPriceQuotation $invoice)
    {

        $user = Auth::user();
        $user_id = $user->id;
        $customers = Customers::where('id', '!=', $invoice->customer_id)->get();
        $currentProducts = InvoicesPriceQuotationsProducts::where('quotation_id', $invoice->id)->get();
        $products = Products::all();
        return view('invoices_price_quotations.profile', compact('currentProducts', 'invoice', 'user_id', 'customers', 'products'));
    }

    public function edit(InvoicesPriceQuotation $invoice)
    {

        $user = Auth::user();
        $user_id = $user->id;
        $customers = Customers::where('id', '!=', $invoice->customer_id)->get();
        $currentProducts = InvoicesPriceQuotationsProducts::where('quotation_id', $invoice->id)->get();
        $products = Products::all();
        return view('invoices_price_quotations.edit', compact('currentProducts', 'invoice', 'user_id', 'customers', 'products'));
    }

    public function store(Request $request)
    {


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

        $quotation = new InvoicesPriceQuotation();
        $quotation->customer_id = $customerId;
        $quotation->quotation_note = $request->quotation_note;
        $quotation->discount_percentage = $request->discount_percentage;
        $quotation->discount_amount = $request->discount_amount;
        $quotation->quotation_tax = $request->tax;
        $quotation->quotation_date = Carbon::now();
        $quotation->quotation_total = $request->quotation_total;
        $quotation->shipping_fees = $request->shipping_fees;
        $quotation->sold_by = $request->sold_by;
        $quotation->quotation_status = 'Pending Approval';
        $quotation->authorized_by = $request->sold_by;
        $quotation->save();

        $quotationId = $quotation->id;
        $product = $request->product;



        //Save Items
        $listOfProducts = [];
        foreach ($product as $item) {
            $pro = new InvoicesPriceQuotationsProducts();
            $pro->quotation_id = $quotationId;
            $pro->customer_id = $customerId;
            if (ctype_digit($item['id'])) {
                $pro->product_id = $item['id'];
                $pro->product_temp = '';
            } else {
                $pro->product_id = 0;
                $pro->product_temp = $item['id'];
            }

            $pro->product_desc = $item['desc'];
            $pro->product_price = $item['price'];
            $pro->product_qty = $item['qty'];
            $pro->status = 'Pending';
            $pro->save();
            $listOfProducts[] = $pro;
        }


        return redirect('/invoices/price_quotations')->with('success', 'invoice added');
    }


    public function quickadd(Request $request)
    {
        $product = new Products();
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->save();
        $productId = $product->id;

        $quotation = InvoicesPriceQuotationsProducts::find($request->record);
        $quotation->product_temp = '';
        $quotation->product_id = $productId;
        $quotation->save();

        return redirect()->route('invoicespricequotations.toinvoice', $request->quotation_id);
    }



    public function toinvoice(InvoicesPriceQuotation $invoice)
    {
        $currentProducts = InvoicesPriceQuotationsProducts::where('quotation_id', $invoice->id)
            ->with('check')
            ->get();
        $safes = Safes::all();
        // return $currentProducts;
        return view('invoices_price_quotations.check', compact('invoice', 'currentProducts', 'safes'));
    }

    public function converting(Request $request, $invoicex)
    {


        $quotation = InvoicesPriceQuotation::find($invoicex);
        $quotation->quotation_status = 'ToInvoice';
        $quotation->save();
        InvoicesPriceQuotationsProducts::where('quotation_id', $invoicex)
            ->update(['status' => 'ToInvoice']);

        $safe_id = $request->safe_id;
        $invoice = new Invoices();
        $invoice->customer_id = $quotation->customer_id;
        $invoice->branch_id = 1;
        $invoice->invoice_note = $quotation->quotation_note;
        $invoice->discount_percentage = $quotation->discount_percentage;
        $invoice->discount_amount = $quotation->discount_amount;
        $invoice->price_quotation_id = $invoicex;
        $invoice->was_price_quotation = 1;
        $invoice->payment_method = $request->payment_method;
        $invoice->invoice_date = Carbon::now();

        if ($request->payment_method != 'later') {
            $invoice->already_paid = 1;
            $payment = new SafesTransactions();
            $payment->safe_id = $safe_id;
            $payment->transaction_type = 2;
            $payment->transaction_amount = $quotation->quotation_total;
            $payment->transaction_datetime = Carbon::now();
            $payment->done_by = $quotation->sold_by;
            $payment->authorized_by = $quotation->sold_by;
            $payment->save();
            $payment_id = $payment->id;

            $invoice->safe_id = $safe_id;
            $invoice->safe_transaction_id = $payment->id;
        } else {
            $invoice->safe_transaction_id = 0;
            $invoice->safe_id = 0;
            $invoice->already_paid = 0;
        }

        $invoice->invoice_total = $quotation->quotation_total;
        $invoice->shipping_fees = $quotation->shipping_fees;
        $invoice->sold_by = $quotation->sold_by;
        $invoice->authorized_by = $quotation->sold_by;
        $invoice->save();

        $invoiceId = $invoice->id;
        $customerId = $quotation->customer_id;
        $date = $request->later;

        if (isset($updateLater)) {
            if ($updateLater == 1) {
                $edtPayment = SafesTransactions::find($payment_id);
                $edtPayment->transaction_notes = 'فاتورة مبيعات رقم  ' . $invoiceId;
                $edtPayment->save();
            }
        }

        $quotationProducts = InvoicesPriceQuotationsProducts::where('quotation_id', $invoicex)->get();
        foreach ($quotationProducts as $product) {
            //search for products at branches
            $checkIfRecordExsists = BranchesProducts::where('branch_id', 1)
                ->where('product_id', $product->product_id)
                ->first();

            Products::where('id', $product->product_id)->increment('product_total_out', $product->product_qty);
            if (isset($checkIfRecordExsists)) {
                BranchesProducts::where('product_id', $product->product_id)
                    ->where('branch_id', 1)
                    ->decrement('amount', $product->product_qty);
            } else {
                $prox = new BranchesProducts();
                $prox->branch_id = 1;
                $prox->product_id = $product->product_id;
                $prox->amount = $product->product_qty;
                $prox->save();
                $listOfProductsx[] = $prox;
            }

            $pro = new InvoicesProducts();
            $pro->invoice_id = $invoiceId;
            $pro->customer_id = $customerId;
            $pro->product_id = $product->product_id;
            $pro->product_desc = $product->product_desc;
            $pro->product_price = $product->product_price;
            $pro->product_qty = $product->product_qty;
            $pro->status = 'no';
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
                $da->paid = 'No';
                $da->save();
                $listOfDates[] = $da;
            }
        }

        return redirect()->route('invoices.view', $invoiceId);
    }

    public function status($invoice, $status)
    {

        if ($status == 1) {
            $quotation = InvoicesPriceQuotation::find($invoice);
            $quotation->quotation_status = 'Approved';
            $quotation->save();
            InvoicesPriceQuotationsProducts::where('quotation_id', $invoice)
                ->update(['status' => 'Approved']);
        } else if ($status == 2) {
            $quotation = InvoicesPriceQuotation::find($invoice);
            $quotation->quotation_status = 'Declined';
            $quotation->save();
            InvoicesPriceQuotationsProducts::where('quotation_id', $invoice)
                ->update(['status' => 'Declined']);
        }

        return redirect()->route('invoicespricequotations.list');
    }



    public function update(Request $request, $invoice)
    {

        // Get Branch Safe ID
        $quotation = InvoicesPriceQuotation::find($invoice);
        $quotation->customer_id = $request->customer_id;
        $quotation->quotation_note = $request->quotation_note;
        $quotation->discount_percentage = $request->discount_percentage;
        $quotation->discount_amount = $request->discount_amount;
        $quotation->quotation_tax = $request->tax_fees;
        $quotation->quotation_date = Carbon::now();
        $quotation->quotation_total = $request->quotation_total;
        $quotation->shipping_fees = $request->shipping_fees;
        $quotation->sold_by = $request->sold_by;
        $quotation->authorized_by = $request->sold_by;
        $quotation->quotation_status = 'Pending Approval';
        $quotation->save();

        $quotationId = $quotation->id;
        $product = $request->product;
        $customerId = $request->customer_id;


        InvoicesPriceQuotationsProducts::where('quotation_id', $quotationId)->delete();

        //Save Items
        $listOfProducts = [];
        foreach ($product as $item) {
            $pro = new InvoicesPriceQuotationsProducts();
            $pro->quotation_id = $quotationId;
            $pro->customer_id = $customerId;
            if (ctype_digit($item['id'])) {

                $pro->product_id = $item['id'];
                $pro->product_temp = '';
            } else {
                $pro->product_id = 0;
                $pro->product_temp = $item['id'];
            }

            $pro->product_desc = $item['desc'];
            $pro->product_price = $item['price'];
            $pro->product_qty = $item['qty'];
            $pro->status = 'Pending';
            $pro->save();
            $listOfProducts[] = $pro;
        }
        return back();
    }
}
