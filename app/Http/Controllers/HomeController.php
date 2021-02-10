<?php

namespace App\Http\Controllers;

use App\Models\Invoices\InvoicesPriceQuotation;
use App\Models\Products\ProductsTransfers;
use App\Models\PurchasesOrders\PurchasesOrders;
use App\Models\Safes\SafesTransfers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $priceQuotations = InvoicesPriceQuotation::where('quotation_status','Pending Approval')
        ->orWhere('quotation_status','Approved')
        ->get();
        $purchasesOrders = PurchasesOrders::where('purchase_status','Created')
        ->orWhere('purchase_status','Paid')
        ->get();
        $safesTransfers = SafesTransfers::where('authorized_by', 0)
        ->get();
        $productTransfers = ProductsTransfers::where('status', 'Pending')
        ->get();
        return view('home',compact('priceQuotations','purchasesOrders','safesTransfers','productTransfers'));
    }
}
