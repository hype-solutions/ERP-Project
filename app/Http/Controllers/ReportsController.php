<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Customers\Customers;
use App\Models\In\In;
use App\Models\Invoices\Invoices;
use App\Models\Invoices\InvoicesPayments;
use App\Models\Invoices\InvoicesPriceQuotation;
use App\Models\Out\Out;
use App\Models\Pos\PosSessions;
use App\Models\Projects\Projects;
use App\Models\PurchasesOrders\PurchasesOrders;
use App\Models\PurchasesOrders\PurchasesOrdersPayments;
use App\Models\Safes\Safes;
use App\Models\Suppliers\Suppliers;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fromto($branch,$from,$to)
    {

    }


    public function landing(Request $request)
    {
         if(isset($request->from)){
            $from = $request->from;
            $to = $request->to;
            $branch = $request->branch;
         }else{
            $from = date('Y-m-d',strtotime("-1 days"));
            $to = date('Y-m-d');
            $branch = '1';
         }

        //Options
        $branches = Branches::all();

        //Expenses
        $expenses = Out::whereBetween('updated_at', [$from, $to])->sum('amount');
        //Income
        $income = In::whereBetween('updated_at', [$from, $to])->sum('amount');
        //Customers
        $customersCount = Customers::count();
        //Suppliers
        $suppliersCount = Suppliers::count();
        //Safes
        $safesSum = Safes::sum('safe_balance');
        //POS
        $posInvoicesCount = PosSessions::count();
        $posInvoicesSum = PosSessions::Where('status',1)->whereBetween('updated_at', [$from, $to])->sum('total');
        $posInvoicesDone = PosSessions::Where('status',1)->whereBetween('updated_at', [$from, $to])->count();
        //Invoices
        $invoicesCount = Invoices::count();
        $invoicesSum = Invoices::where('already_paid',1)->whereBetween('invoice_date', [$from, $to])->sum('invoice_total');
        $invoicesDone = Invoices::where('already_paid',1)->whereBetween('invoice_date', [$from, $to])->count();
        //Price Quotation
        $invoicesPriceQuotationsCount = InvoicesPriceQuotation::count();
        $invoicesPriceQuotationsSum = InvoicesPriceQuotation::sum('quotation_total');
        //Projects
        $projectsCount = Projects::count();
        $projectsSum = Projects::sum('total');
        //Later Invoices
        $laterSumInv = InvoicesPayments::where('paid','Yes')->whereBetween('date', [$from, $to])->sum('amount');
        $laterSumPO = PurchasesOrdersPayments::where('paid','Yes')->whereBetween('date', [$from, $to])->sum('amount');
        //Purchases Orders
        $purchasesOrders = PurchasesOrders::where('already_paid',1)->whereBetween('purchase_date', [$from, $to])->sum('purchase_total');


        return view('reports.landing',compact(
            'branches',
            'expenses',
            'income',
            'customersCount',
            'suppliersCount',
            'safesSum',
            'posInvoicesCount',
            'posInvoicesSum',
            'posInvoicesDone',
            'invoicesCount',
            'invoicesSum',
            'invoicesDone',
            'invoicesPriceQuotationsCount',
            'invoicesPriceQuotationsSum',
            'projectsCount',
            'projectsSum',
            'laterSumInv',
            'laterSumPO',
            'purchasesOrders',
            'from',
            'to',
        ));
    }
}
