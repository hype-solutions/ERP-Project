<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers\Customers;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('log')->only('index');

        // $this->middleware('subscribed')->except('store');
    }

    protected function validatePostRequest()
    {
        return request()->validate([
            'customer_name' => 'required|max:255',
            'customer_title' => '',
            'customer_company' => '',
            'customer_mobile' => 'required|unique:customers',
            'customer_email' => 'unique:customers',
            'customer_phone' => '',
            'customer_address' => '',
            'customer_type' => '',
            'customer_commercial_registry' => '',
            'customer_tax_card' => '',

        ],
        [
            //'customer_email.email' => 'برجاء إدخال بريد الكتروني صحيح',
            'customer_email.unique' => 'برجاء إختيار بريد الكتروني اخر, هذا مستخدم بالفعل',
            'customer_mobile.required' => 'برجاء إدخال رقم موبايل العميل',
            'customer_mobile.unique' => 'هذا الرقم مستخدم بالفعل, برجاء اختيار رقم موبايل اخر',
        ]
    );
    }


    protected function validateUpdateRequest()
    {
        return request()->validate([
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
        Customers::create($this->validatePostRequest());
        return back()->with('success', 'Customer Added');
    }

    public function view(Customers $customer)
    {
        $customer = Customers::find($customer);
        return view('customers.profile',compact('customer'));
    }
    public function edit(Customers $customer){
        $customer = Customers::find($customer);
        return view('customers.edit',compact('customer'));
    }

    public function update(Customers $customer)
    {
        $customer->update($this->validateUpdateRequest());
        return back()->with('success', 'Customer updated');
    }

    public function delete(Customers $customer)
    {
        Customers::destroy($customer->id);
        return redirect('/customers')->with('success', 'Customer deleted');
    }

    public function customersList()
    {
        $customers = Customers::all();
        return view('customers.list',compact('customers'));
    }
}
