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
        $priceQuotations = InvoicesPriceQuotation::where('quotation_status', 'Pending Approval')
            ->orWhere('quotation_status', 'Approved')
            ->orderByDesc('id')
            ->paginate(5);
        $purchasesOrders = PurchasesOrders::where('purchase_status', 'Created')
            ->orWhere('purchase_status', 'Paid')
            ->orderByDesc('id')
            ->paginate(5);
        $safesTransfers = SafesTransfers::where('authorized_by', 0)
            ->whereHas('safeTo')
            ->whereHas('safeFrom')
            ->orderByDesc('id')
            ->paginate(5);
        $productTransfers = ProductsTransfers::where('status', 'Pending')
            ->orderByDesc('id')
            ->paginate(5);
        return view('home', compact('priceQuotations', 'purchasesOrders', 'safesTransfers', 'productTransfers'));
    }

    public function shit()
    {
        return storage_path('/app/public');
        // return __DIR__;
    }
}
