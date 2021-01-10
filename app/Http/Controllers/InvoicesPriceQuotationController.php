<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Customers\Customers;
use App\Models\Invoices\InvoicesPriceQuotation;
use App\Models\Invoices\InvoicesPriceQuotationsProducts;
use App\Models\Products\Products;
use App\Models\Safes\Safes;
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
        return view('invoices_price_quotations.profile', compact('currentProducts','invoice','user_id', 'customers', 'products'));
    }

    public function edit(InvoicesPriceQuotation $invoice)
    {

        $user = Auth::user();
        $user_id = $user->id;
        $customers = Customers::where('id', '!=', $invoice->customer_id)->get();
        $currentProducts = InvoicesPriceQuotationsProducts::where('quotation_id', $invoice->id)->get();
        $products = Products::all();
        return view('invoices_price_quotations.edit', compact('currentProducts','invoice','user_id', 'customers', 'products'));
    }

    public function store(Request $request)
    {


        // Get Branch Safe ID
        if($request->new_customer_name != ''){
            $customer = new Customers();
            $customer->customer_name = $request->new_customer_name;
            $customer->customer_mobile = $request->new_customer_mobile;
            $customer->save();
            $customerId = $customer->id;
        }else{
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
            if(ctype_digit($item['id'])){
                $pro->product_id = $item['id'];
                $pro->product_temp = '';
            }else{
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

    public function update(Request $request, $invoice)
    {

        // Get Branch Safe ID
        $quotation = InvoicesPriceQuotation::find($invoice);
        $quotation->customer_id = $request->customer_id;
        $quotation->quotation_note = $request->quotation_note;
        $quotation->discount_percentage = $request->discount_percentage;
        $quotation->discount_amount = $request->discount_amount;
        $quotation->quotation_date = Carbon::now();
        $quotation->quotation_total = $request->quotation_total;
        $quotation->shipping_fees = $request->shipping_fees;
        $quotation->sold_by = $request->sold_by;
        $quotation->authorized_by = $request->sold_by;
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
            if(ctype_digit($item['id'])){

                $pro->product_id = $item['id'];
                $pro->product_temp = '';

            }else{
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
