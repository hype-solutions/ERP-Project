<?php

namespace App\Http\Controllers;

use App\Models\In\In;
use App\Models\Invoices\InvoicesPriceQuotation;
use App\Models\Out\Out;
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

        $priceQuotationsCount = InvoicesPriceQuotation::where('quotation_status', 'Pending Approval')
            ->orWhere('quotation_status', 'Approved')
            ->orderByDesc('id')
            ->count();

        $purchasesOrders = PurchasesOrders::where('purchase_status', 'Created')
            ->orWhere('purchase_status', 'Paid')
            ->orderByDesc('id')
            ->paginate(5);

        $purchasesOrdersCount = PurchasesOrders::where('purchase_status', 'Created')
            ->orWhere('purchase_status', 'Paid')
            ->orderByDesc('id')
            ->count();

        $safesTransfers = SafesTransfers::where('authorized_by', 0)
            ->whereHas('safeTo')
            ->whereHas('safeFrom')
            ->orderByDesc('id')
            ->paginate(5);

        $safesTransfersCount = SafesTransfers::where('authorized_by', 0)
            ->whereHas('safeTo')
            ->whereHas('safeFrom')
            ->orderByDesc('id')
            ->count();

        $outs = Out::where('authorized_by', null)
            ->where('rejected_by', 0)
            ->orderByDesc('id')
            ->paginate(5);

        $outsCount = Out::where('authorized_by', null)
            ->where('rejected_by', 0)
            ->count();

        $ins = In::where('authorized_by', null)
            ->where('rejected_by', 0)
            ->orderByDesc('id')
            ->paginate(5);

        $insCount = In::where('authorized_by', null)
            ->where('rejected_by', 0)
            ->count();

        $productTransfers = ProductsTransfers::where('status', 'Pending')
            ->orderByDesc('id')
            ->paginate(5);

        $productTransfersCount = ProductsTransfers::where('status', 'Pending')
            ->orderByDesc('id')
            ->count();

        return view('home', compact('ins', 'insCount', 'outs', 'outsCount', 'priceQuotationsCount', 'purchasesOrdersCount', 'safesTransfersCount', 'productTransfersCount', 'priceQuotations', 'purchasesOrders', 'safesTransfers', 'productTransfers'));
    }

    public function shit()
    {
        return storage_path('/app/public');
    }
}
