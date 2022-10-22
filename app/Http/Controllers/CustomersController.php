<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers\Customers;
use App\Models\Customers\LinkedCustomers;
use App\Models\ERPLog;
use App\Models\Invoices\Invoices;
use App\Models\Invoices\InvoicesPayments;
use App\Models\Invoices\InvoicesPriceQuotation;
use App\Models\Invoices\InvoicesProducts;
use App\Models\Pos\PosSessions;
use App\Models\Safes\Safes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    protected function validatePostRequest()
    {
        return request()->validate(
            [
                'customer_name' => 'required|max:255',
                'customer_title' => '',
                'customer_company' => '',
                'customer_mobile' => 'required|unique:customers',
                'customer_email' => '',
                'customer_phone' => '',
                'customer_address' => '',
                'customer_type' => '',
                'customer_commercial_registry' => '',
                'customer_tax_card' => '',

            ],
            [
                //'customer_email.email' => 'برجاء إدخال بريد الكتروني صحيح',
                // 'customer_email.unique' => 'برجاء إختيار بريد الكتروني اخر, هذا مستخدم بالفعل',
                'customer_mobile.required' => 'برجاء إدخال رقم موبايل العميل',
                'customer_mobile.unique' => 'هذا الرقم مستخدم بالفعل, برجاء اختيار رقم موبايل اخر',
            ]
        );
    }


    protected function validateUpdateRequest()
    {
        return request()->validate(
            [
                'customer_name' => 'required|max:255',
                'customer_title' => '',
                'customer_company' => '',
                'customer_mobile' => 'required',
                'customer_email' => '',
                'customer_phone' => '',
                'customer_address' => '',
                'customer_type' => '',
                'customer_commercial_registry' => '',
                'customer_tax_card' => '',
            ],
            [
                //'customer_email.email' => 'برجاء إدخال بريد الكتروني صحيح',
                'customer_mobile.required' => 'برجاء إدخال رقم موبايل العميل',
            ]
        );
    }

    public function add()
    {
        return view('customers.add');
    }

    public function store()
    {
        $customer = Customers::create($this->validatePostRequest());
        ERPLog::create(['type' => 'Customers', 'action' => 'Add', 'custom_id' => $customer->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);

        return back()->with('success', 'Customer Added');
    }

    public function addLinked(Customers $customer, Request $request)
    {
        $linked = new Customers();
        $linked->customer_parent = $customer->id;
        $linked->customer_name = $request->linked_name;
        $linked->customer_title = $request->linked_title;
        $linked->customer_mobile = $request->linked_mobile;
        $customer->customer_type = 'linked';
        $linked->save();

        ERPLog::create(['type' => 'Linked Customers', 'action' => 'Add', 'custom_id' => $customer->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);

        return back()->with('success', 'Customer Added');
    }

    public function view(Customers $customer)
    {
        $customerInvoices = Invoices::where('customer_id', $customer->id)->get();
        $customerInvoicesCount = Invoices::where('customer_id', $customer->id)->count();
        $customerPosSales = PosSessions::where('status', '!=', 0)->where('customer_id', $customer->id)->get();
        $customerPosSalesCount = PosSessions::where('status', '!=', 0)->where('customer_id', $customer->id)->count();
        $customerInvoicesSum = Invoices::where('customer_id', $customer->id)->sum('invoice_total');
        $customerPriceQuotation = InvoicesPriceQuotation::where('customer_id', $customer->id)->get();
        $customerPriceQuotationCount = InvoicesPriceQuotation::where('customer_id', $customer->id)->count();
        $customerInvoicesPayments = InvoicesPayments::where('customer_id', $customer->id)->get();
        $safes = Safes::all();
        $mostOrdered = InvoicesProducts::with('product')
            ->where('customer_id', $customer->id)
            ->select('product_id', DB::raw('COUNT(product_id) as count'))
            ->groupBy('product_id')
            ->orderBy('count', 'desc')
            ->get();

        $linkedCustomers = Customers::where('customer_parent', $customer->id)->get();
        ERPLog::create(['type' => 'Customers', 'action' => 'View', 'custom_id' => $customer->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);


        return view('customers.profile', compact('customerPosSalesCount', 'customerPosSales', 'safes', 'linkedCustomers', 'customerPriceQuotationCount', 'customerInvoicesCount', 'customerInvoicesSum', 'customer', 'customerInvoices', 'customerPriceQuotation', 'customerInvoicesPayments', 'mostOrdered'));
    }
    public function edit(Customers $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Customers $customer)
    {
        $customer->update($this->validateUpdateRequest());
        ERPLog::create(['type' => 'Customers', 'action' => 'Edit', 'custom_id' => $customer->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);

        return back()->with('success', 'Customer updated');
    }

    public function delete(Customers $customer)
    {
        Customers::destroy($customer->id);
        ERPLog::create(['type' => 'Customers', 'action' => 'Delete', 'custom_id' => $customer->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);

        return redirect('/customers')->with('success', 'Customer deleted');
    }

    public function checkcustomer(Request $request)
    {
        $checkMobile = Customers::where('customer_mobile', $request->customer_mobile)->first();
        if ($checkMobile) {
            return response()->json(array('data' => 1), 200);
        } else {
            return response()->json(array('data' => 0), 200);
        }
    }


    public function customersList()
    {
        $customers = Customers::where('customer_parent', null)->get();
        return view('customers.list', compact('customers'));
    }
}
