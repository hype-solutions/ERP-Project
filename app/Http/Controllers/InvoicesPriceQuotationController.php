<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Branches\BranchesProducts;
use App\Models\Customers\Customers;
use App\Models\ERPLog;
use App\Models\User;
use App\Models\Invoices\Invoices;
use App\Models\Invoices\InvoicesPayments;
use App\Models\Invoices\InvoicesPriceQuotation;
use App\Models\Invoices\InvoicesPriceQuotationSignature;
use App\Models\Invoices\InvoicesPriceQuotationsProducts;
use App\Models\Invoices\InvoicesProducts;
use App\Models\Products\Products;
use App\Models\PurchasesOrders\PurchasesOrdersProducts;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use App\Models\Settings\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesPriceQuotationController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }
    public function invoicesPriceQuotationsList()
    {
        $quotations = InvoicesPriceQuotation::all();
        $users = User::where('id', '!=', '1')->get();
        $signature = InvoicesPriceQuotationSignature::with('user')->first();
        $logo = Settings::where('key', 'logo')->value('value');

        return view('invoices_price_quotations.list', compact('logo', 'quotations', 'users', 'signature'));
    }

    public function add()
    {
        $user = Auth::user();
        $userId = $user->id;
        $customers = Customers::all();
        $products = Products::all();

        return view('invoices_price_quotations.add', compact('userId', 'customers', 'products'));
    }


    public function view(InvoicesPriceQuotation $invoice)
    {
        $user = Auth::user();
        $userId = $user->id;
        $customers = Customers::where('id', '!=', $invoice->customer_id)->get();
        $currentProducts = InvoicesPriceQuotationsProducts::where('quotation_id', $invoice->id)->get();
        $products = Products::all();
        ERPLog::create(['type' => 'Price Quotations', 'action' => 'View', 'custom_id' => $invoice->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);
        if (request()->getHttpHost() == 'e1.mygesture.co') {
            $modeer = 4;
        } elseif (request()->getHttpHost() == 'e2.mygesture.co') {
            $modeer = 3;
        } elseif (request()->getHttpHost() == 'e3.mygesture.co') {
            $modeer = 2;
        } else {
            $modeer = 2;
        }
        $userSig = User::find($modeer);
        $logo = Settings::where('key', 'logo')->value('value');
        $company = Settings::where('key', 'company_name')->value('value');
        $signature = InvoicesPriceQuotationSignature::with('user')->first();
        $addressLineOne = Settings::where('key', 'address_1')->value('value');
        $addressLineTwo = Settings::where('key', 'address_2')->value('value');

        return view('invoices_price_quotations.profile', compact('addressLineOne', 'addressLineTwo', 'signature', 'company', 'logo', 'userSig', 'currentProducts', 'invoice', 'userId', 'customers', 'products'));
    }

    public function edit(InvoicesPriceQuotation $invoice)
    {
        if ($invoice->quotation_status == "ToInvoice") {
            return abort(404);
        }
        $user = Auth::user();
        $userId = $user->id;
        $customers = Customers::where('id', '!=', $invoice->customer_id)->get();
        $currentProducts = InvoicesPriceQuotationsProducts::where('quotation_id', $invoice->id)->get();
        $products = Products::all();

        return view('invoices_price_quotations.edit', compact('currentProducts', 'invoice', 'userId', 'customers', 'products'));
    }

    public function store(Request $request)
    {


        // Get Branch Safe ID
        if ($request->new_customer_name != '') {
            $customer = new Customers();
            $customer->customer_name = $request->new_customer_name;
            $customer->customer_type = 'solo';
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
        $quotation->days_valid = $request->days_valid;
        $quotation->authorized_by = 0;
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

        ERPLog::create(['type' => 'Price Quotations', 'action' => 'Add', 'custom_id' => $quotationId, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);

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
        ERPLog::create(['type' => 'Price Quotations', 'action' => 'Add', 'custom_id' => $quotation->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);

        return redirect()->route('invoicespricequotations.toinvoice', $request->quotation_id);
    }



    public function toinvoice(InvoicesPriceQuotation $invoice)
    {
        if ($invoice->quotation_status != "Approved") {
            return abort(404);
        }
        $currentProducts = InvoicesPriceQuotationsProducts::where('quotation_id', $invoice->id)
            ->with('check')
            ->get();
        $safes = Safes::all();

        return view('invoices_price_quotations.check', compact('invoice', 'currentProducts', 'safes'));
    }

    public function converting(Request $request, $invoicex)
    {
        $quotation = InvoicesPriceQuotation::find($invoicex);
        $quotation->quotation_status = 'ToInvoice';
        $quotation->save();
        InvoicesPriceQuotationsProducts::where('quotation_id', $invoicex)
            ->update(['status' => 'ToInvoice']);

        $safeId = $request->safe_id;
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
            $payment->safe_id = $safeId;
            $payment->transaction_type = 2;
            $payment->transaction_amount = $quotation->quotation_total;
            $payment->transaction_datetime = Carbon::now();
            $payment->done_by = $quotation->sold_by;
            $payment->authorized_by = $quotation->sold_by;
            $payment->save();
            $paymentId = $payment->id;

            $invoice->safe_id = $safeId;
            $invoice->safe_transaction_id = $payment->id;
            Safes::where('id', $safeId)->increment('safe_balance', $quotation->quotation_total);
            $updateLater = 1;
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

        if (isset($updateLater) && $updateLater == 1) {
            $edtPayment = SafesTransactions::find($paymentId);
            $edtPayment->transaction_notes = 'فاتورة مبيعات رقم  ' . $invoiceId;
            $edtPayment->save();
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

            $getCost = PurchasesOrdersProducts::where('product_id', $product->product_id)->avg('product_price');

            $pro = new InvoicesProducts();
            $pro->invoice_id = $invoiceId;
            $pro->customer_id = $customerId;
            $pro->product_id = $product->product_id;
            $pro->product_desc = $product->product_desc;
            $pro->product_price = $product->product_price;
            $pro->product_cost = $getCost * $product->product_qty;
            $pro->product_qty = $product->product_qty;
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
                $da->paid = 'No';
                $da->save();
                $listOfDates[] = $da;
            }
        }

        $sumCost = InvoicesProducts::where('invoice_id', $invoiceId)->sum('product_cost');
        $edtInvoice = Invoices::find($invoiceId);
        $edtInvoice->invoice_cost = $sumCost;
        $edtInvoice->save();
        ERPLog::create(['type' => 'Price Quotations', 'action' => 'Convert To Invoice', 'custom_id' => $invoiceId, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);
        return redirect()->route('invoices.view', $invoiceId);
    }

    public function status(InvoicesPriceQuotation $invoice, $status)
    {
        if ($invoice->quotation_status == "Declined") {
            return abort(404);
        }
        if ($status == 1) {
            $invoice->quotation_status = 'Approved';
            $invoice->authorized_by = Auth::id();
            $invoice->save();
            ERPLog::create(['type' => 'Price Quotations', 'action' => 'Accept', 'custom_id' => $invoice->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);

            InvoicesPriceQuotationsProducts::where('quotation_id', $invoice->id)
                ->update(['status' => 'Approved']);
        } elseif ($status == 2) {
            $invoice->quotation_status = 'Declined';
            $invoice->authorized_by = Auth::id();
            $invoice->save();
            ERPLog::create(['type' => 'Price Quotations', 'action' => 'Decline', 'custom_id' => $invoice->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);

            InvoicesPriceQuotationsProducts::where('quotation_id', $invoice->id)
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
        $quotation->quotation_tax = $request->tax;
        $quotation->quotation_date = Carbon::now();
        $quotation->quotation_total = $request->quotation_total;
        $quotation->shipping_fees = $request->shipping_fees;
        $quotation->sold_by = $request->sold_by;
        $quotation->authorized_by = 0;
        $quotation->days_valid = $request->days_valid;
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
        ERPLog::create(['type' => 'Price Quotations', 'action' => 'Edit', 'custom_id' => $quotationId, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);

        return back();
    }


    public function print2(InvoicesPriceQuotation $invoice)
    {
        $customers = Customers::where('id', '!=', $invoice->customer_id)->get();
        $currentProducts = InvoicesPriceQuotationsProducts::where('quotation_id', $invoice->id)->get();
        $products = Products::all();
        $branches = Branches::where('id', '!=', $invoice->branch_id)->get();
        $userId = Auth::id();
        $p = '2';
        if (request()->getHttpHost() == 'e1.mygesture.co') {
            $modeer = 4;
        } elseif (request()->getHttpHost() == 'e2.mygesture.co') {
            $modeer = 3;
        } elseif (request()->getHttpHost() == 'e3.mygesture.co') {
            $modeer = 2;
        } else {
            $modeer = 2;
        }
        $userSig = User::find($modeer);
        ERPLog::create(['type' => 'Price Quotations', 'action' => 'Print', 'custom_id' => $invoice->id, 'user_id' => $userId, 'action_date' => Carbon::now()]);

        $logo = Settings::where('key', 'logo')->value('value');
        $template = 0;
        $alreadyShown = 0;
        $count = $currentProducts->count();
        $signature = InvoicesPriceQuotationSignature::with('user')->first();

        return view('invoices_price_quotations.new', compact('signature', 'template', 'count', 'alreadyShown', 'userSig', 'logo', 'p', 'currentProducts', 'invoice', 'userId', 'customers', 'products', 'branches'));
    }

    public function print3(InvoicesPriceQuotation $invoice, Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $customers = Customers::where('id', '!=', $invoice->customer_id)->get();
        $currentProducts = InvoicesPriceQuotationsProducts::where('quotation_id', $invoice->id)->get();
        $products = Products::all();
        $branches = Branches::where('id', '!=', $invoice->branch_id)->get();
        $p = 3;
        $template = $request->template;
        $count = $currentProducts->count();
        ERPLog::create(['type' => 'Price Quotations', 'action' => 'Print', 'custom_id' => $invoice->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);
        $alreadyShown = 0;
        if (request()->getHttpHost() == 'e1.mygesture.co') {
            $modeer = 4;
        } elseif (request()->getHttpHost() == 'e2.mygesture.co') {
            $modeer = 3;
        } elseif (request()->getHttpHost() == 'e3.mygesture.co') {
            $modeer = 2;
        } else {
            $modeer = 2;
        }
        $userSig = User::find($modeer);

        $logo = Settings::where('key', 'logo')->value('value');
        $signature = InvoicesPriceQuotationSignature::with('user')->first();

        return view('invoices_price_quotations.new', compact('signature', 'logo', 'userSig', 'alreadyShown', 'count', 'template', 'p', 'currentProducts', 'invoice', 'userId', 'customers', 'products', 'branches'));
    }

    public function signature(Request $request)
    {
        InvoicesPriceQuotationSignature::where('id', 1)->update([
            'user_id' => $request->userId,
            'title' => $request->title,
        ]);

        return true;
    }
}
