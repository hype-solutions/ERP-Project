<?php

namespace App\Http\Controllers;

use App\Models\Invoices\InvoicesPayments;
use App\Models\PurchasesOrders\PurchasesOrdersPayments;
use App\Models\Safes\ExternalFund;

class InstallmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    public function installments(){
        $invoicePayments = InvoicesPayments::where('paid','No')->get();
        $purchasesOrdersPayments = PurchasesOrdersPayments::where('paid','No')->get();
        $externalFund = ExternalFund::where('paid','No')->get();

        return view('installments.landing',compact('invoicePayments', 'purchasesOrdersPayments', 'externalFund'));
    }
}
