<?php

namespace App\Http\Controllers;

use App\Models\PurchasesOrders\PurchasesOrders;
use App\Models\PurchasesOrders\PurchasesOrdersPayments;
use App\Models\PurchasesOrders\PurchasesOrdersProducts;
use Illuminate\Http\Request;
use App\Models\Suppliers\Suppliers;

class SuppliersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validatePostRequest()
    {
        return request()->validate([
            'supplier_name' => 'required|max:255',
            'supplier_mobile' => 'required|unique:suppliers',
            'supplier_phone' => '',
            'supplier_company' => '',
            'supplier_email' => 'unique:suppliers',
            'supplier_address' => '',
            'supplier_notes' => '',
            'supplier_commercial_registry' => '',
            'supplier_tax_card' => '',
        ],
        [
            //'supplier_email.email' => 'برجاء إدخال بريد الكتروني صحيح',
            'supplier_email.unique' => 'برجاء إختيار بريد الكتروني اخر, هذا مستخدم بالفعل',
            'supplier_mobile.required' => 'برجاء إدخال رقم موبايل المورد',
            'supplier_mobile.unique' => 'هذا الرقم مستخدم بالفعل, برجاء اختيار رقم موبايل اخر',
        ]
    );
    }


    protected function validateUpdateRequest()
    {
        return request()->validate([
            'supplier_name' => 'required',
            'supplier_mobile' => 'required',
            'supplier_phone' => '',
            'supplier_company' => '',
            'supplier_email' => '',
            'supplier_address' => '',
            'supplier_notes' => '',
            'supplier_commercial_registry' => '',
            'supplier_tax_card' => '',
        ],
        [
            //'supplier_email.email' => 'برجاء إدخال بريد الكتروني صحيح',
            'supplier_mobile.required' => 'برجاء إدخال رقم موبايل المورد',
        ]
    );
    }
    public function add()
    {
        return view('suppliers.add');
    }

    public function store()
    {
        Suppliers::create($this->validatePostRequest());
        return back()->with('success', 'Supplier Added');
    }

    public function view(Suppliers $supplier)
    {
        $purchases = PurchasesOrders::where('supplier_id',$supplier->id)->get();
        $countPurchases = PurchasesOrders::where('supplier_id',$supplier->id)->count();
        //$supplier = Suppliers::find($supplier);

        $productSuppliers = PurchasesOrdersProducts::where('supplier_id',$supplier->id)
        ->where('status','delivered')
        ->get();

        $supplierInstallments  = PurchasesOrdersPayments::where('supplier_id',$supplier->id)->get();
        return view('suppliers.profile',compact('supplier','purchases','countPurchases','productSuppliers','supplierInstallments'));
    }
    public function edit(Suppliers $supplier){
        $supplier = Suppliers::find($supplier);
        return view('suppliers.edit',compact('supplier'));
    }

    public function update(Suppliers $supplier)
    {
        $supplier->update($this->validateUpdateRequest());
        return back()->with('success', 'Supplier updated');
    }

    public function delete(Suppliers $supplier)
    {
        Suppliers::destroy($supplier->id);
        return redirect('/suppliers')->with('success', 'Supplier deleted');
    }

    public function suppliersList()
    {
        $suppliers = Suppliers::all();
        return view('suppliers.list',compact('suppliers'));
    }
}
