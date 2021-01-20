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

         $getBranchSafeId = Safes::where('branch_id',$branch)->value('id');

        //Options
        $branches = Branches::all();

        //Expenses
        $expenses = Out::whereBetween('updated_at', [$from, $to])->where('safe_id',$getBranchSafeId)->sum('amount');
        //Income
        $income = In::whereBetween('updated_at', [$from, $to])->where('safe_id',$getBranchSafeId)->sum('amount');
        //Customers
        $customersCount = Customers::count();
        //Suppliers
        $suppliersCount = Suppliers::count();
        //Safes
        $safesSum = Safes::where('branch_id',$branch)->sum('safe_balance');
        //POS
        $posInvoicesCount = PosSessions::where('branch_id',$branch)->count();
        $posInvoicesSum = PosSessions::Where('status',1)->whereBetween('updated_at', [$from, $to])->where('branch_id',$branch)->sum('total');
        $posInvoicesDone = PosSessions::Where('status',1)->whereBetween('updated_at', [$from, $to])->where('branch_id',$branch)->count();
        //Invoices
        $invoicesCount = Invoices::count();
        $invoicesSum = Invoices::where('already_paid',1)->whereBetween('invoice_date', [$from, $to])->where('safe_id',$getBranchSafeId)->sum('invoice_total');
        $invoicesDone = Invoices::where('already_paid',1)->whereBetween('invoice_date', [$from, $to])->where('safe_id',$getBranchSafeId)->count();
        //Price Quotation
        $invoicesPriceQuotationsCount = InvoicesPriceQuotation::count();
        $invoicesPriceQuotationsSum = InvoicesPriceQuotation::sum('quotation_total');
        //Projects
        $projectsCount = Projects::count();
        $projectsSum = Projects::sum('total');
        //Later Invoices
        //add cond to display only those invoices which are not already paid
        $laterSumInv = InvoicesPayments::where('paid','Yes')->whereBetween('date', [$from, $to])->where('safe_id',$getBranchSafeId)->sum('amount');
        $laterSumPO = PurchasesOrdersPayments::where('paid','Yes')->whereBetween('date', [$from, $to])->where('safe_id',$getBranchSafeId)->sum('amount');
        //Purchases Orders
        $purchasesOrders = PurchasesOrders::where('already_paid',1)->whereBetween('purchase_date', [$from, $to])->where('safe_id',$getBranchSafeId)->sum('purchase_total');


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
