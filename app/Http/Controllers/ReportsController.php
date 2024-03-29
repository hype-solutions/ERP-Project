<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Customers\Customers;
use App\Models\ERPLog;
use App\Models\In\In;
use App\Models\Invoices\Invoices;
use App\Models\Invoices\InvoicesPayments;
use App\Models\Invoices\InvoicesPriceQuotation;
use App\Models\Out\Out;
use App\Models\Pos\PosSessions;
use App\Models\Projects\Projects;
use App\Models\PurchasesOrders\PurchasesOrders;
use App\Models\PurchasesOrders\PurchasesOrdersPayments;
use App\Models\Safes\ExternalFund;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use App\Models\Suppliers\Suppliers;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }




    public function landing(Request $request)
    {
        if (isset($request->from)) {
            $from = $request->from;
            $to = $request->to;
            $branch = $request->branch;
        } else {
            $from = date('Y-m-d', strtotime("-1 days"));
            $to = date('Y-m-d');
            $branch = '1';
        }


        $fromX = $from;
        $toX = $to;
        //Insure covering whole days
        $from    = Carbon::parse($from)
            ->startOfDay()        // date 00:00:00.000000
            ->toDateTimeString(); // date 00:00:00

        $to      = Carbon::parse($to)
            ->endOfDay()          // date 23:59:59.000000
            ->toDateTimeString(); // date 23:59:59

        $branches = Branches::all();
        $getBranchSafeId = Safes::where('branch_id', $branch)->value('id');

        /*******SALES*********/
        //Sales Gross
        $posInvoicesSum = PosSessions::Where('status', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->where('branch_id', $branch)
            ->sum('total');

        $invoicesSum = Invoices::where('already_paid', 1)
            ->whereBetween('invoice_date', [$from, $to])
            ->where('branch_id', $branch)
            ->sum('invoice_total');

        $invoicesSumLater = Invoices::where('already_paid', 0)
            ->whereBetween('invoice_date', [$from, $to])
            ->where('branch_id', $branch)
            ->where('payment_method', 'later')
            ->sum('amount_collected');
        //Sales Cost
        $posInvoicesCost = PosSessions::Where('status', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->where('branch_id', $branch)
            ->sum('cost');

        $invoicesCost = Invoices::where('already_paid', 1)
            ->whereBetween('invoice_date', [$from, $to])
            ->where('branch_id', $branch)
            ->sum('invoice_cost');

        $invoicesLaterCost = Invoices::where('already_paid', 0)
            ->whereBetween('invoice_date', [$from, $to])
            ->where('branch_id', $branch)
            ->where('payment_method', 'later')
            ->sum('invoice_cost');
        //Sales Net
        $posInvoicesNet = $posInvoicesSum - $posInvoicesCost;
        $invoicesNet = $invoicesSum - $invoicesCost;

        $invoicesNetLater = $invoicesSumLater - $invoicesLaterCost;
        /*******PROJECTS*********/
        $projectsCount = Projects::count();
        //Projetcs Gross
        $projectsSum = Projects::where(function ($query) use ($from, $to) {
            $query->whereBetween('project_start_date', [$from, $to])
                ->orWhereBetween('project_end_date', [$from, $to]);
        })
            ->sum('total');
        //Projects Net
        $projectsNet = 0;

        /*******OTHER INCOME*********/
        //Later Invoices
        //add cond to display only those invoices which are not already paid
        $laterSumInv = InvoicesPayments::where('paid', 'Yes')
            ->whereBetween('date_collected', [$from, $to])
            ->where('safe_id', $getBranchSafeId)
            ->sum('amount');

        //Income
        $income = In::whereBetween('updated_at', [$from, $to])->where('safe_id', $getBranchSafeId)->sum('amount');

        //External Fund
        $externalFund = ExternalFund::whereBetween('funding_date', [$from, $to])->where('safe_id', $getBranchSafeId)->sum('amount');

        //Safe Deposit
        $deposit = SafesTransactions::whereBetween('transaction_datetime', [$from, $to])
            ->where('transaction_type', 2)
            ->where('direct', 1)
            ->where('safe_id', $getBranchSafeId)
            ->sum('transaction_amount');


        /*******OTHER Expenses*********/
        //Expenses
        $expenses = Out::whereBetween('updated_at', [$from, $to])->where('safe_id', $getBranchSafeId)->sum('amount');

        //Safe Withdrawal
        $withdrawal = SafesTransactions::whereBetween('transaction_datetime', [$from, $to])
            ->where('transaction_type', 1)
            ->where('direct', 1)
            ->where('safe_id', $getBranchSafeId)
            ->sum('transaction_amount');

        //Purchases Orders
        $purchasesOrders = PurchasesOrders::where('already_paid', 1)
            ->whereBetween('purchase_date', [$from, $to])
            ->where('safe_id', $getBranchSafeId)
            ->sum('purchase_total');

        //Paid purchases orders installment
        $laterSumPO = PurchasesOrdersPayments::where('paid', 'Yes')
            ->whereBetween('date', [$from, $to])
            ->where('safe_id', $getBranchSafeId)
            ->sum('amount');






        // $paidLaterInvCost = InvoicesPayments::where('paid','Yes')
        // ->whereBetween('date_collected', [$from, $to])
        // ->where('safe_id',$getBranchSafeId)
        // ->with('invoiceSumCost')
        // ->get();
        // ->pluck('invoiceSumCost:invoice_cost')->flatten();
        // ->with(['invoice' => function($query){
        //     $query->sum('invoice_cost');
        //  }])->get();

        // ->get();
        // ->withSum('invoice','invoice_cost')->get();

        // $allPaidLaterCost = $paidLaterInvCost->invoice_sum_invoice_cost;

        //Customers
        $customersCount = Customers::count();
        //Suppliers
        $suppliersCount = Suppliers::count();
        //Safes
        $safeSumx = Safes::where('branch_id', $branch)->sum('safe_balance');
        $safeSumx = Safes::where('branch_id', $branch)->first();
        $safesSum = $safeSumx->safeBalance($safeSumx->id);
        //POS
        $posInvoicesCount = PosSessions::where('branch_id', $branch)->count();
        $posInvoicesDone = PosSessions::Where('status', 1)->whereBetween('updated_at', [$from, $to])->where('branch_id', $branch)->count();
        //Invoices
        $invoicesCount = Invoices::count();
        $invoicesDone = Invoices::where('already_paid', 1)->whereBetween('invoice_date', [$from, $to])->where('safe_id', $getBranchSafeId)->count();
        //Price Quotation
        $invoicesPriceQuotationsCount = InvoicesPriceQuotation::count();
        $invoicesPriceQuotationsSum = InvoicesPriceQuotation::sum('quotation_total');
        //Projects

        // return $invoicesSumLater;

        return view('reports.landing', compact(
            'invoicesNetLater',
            'invoicesSumLater',
            'projectsNet',
            'withdrawal',
            'deposit',
            'posInvoicesNet',
            'invoicesNet',
            'branches',
            'branch',
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
            'externalFund',
            'fromX',
            'toX',
        ));
    }

    public function searchsales(Request $request)
    {
        return redirect()->route('reports.sales', [$request->from, $request->to, $request->branch]);
    }

    public function searchprojects(Request $request)
    {
        return redirect()->route('reports.projects', [$request->from, $request->to, $request->branch]);
    }

    public function searchincome(Request $request)
    {
        return redirect()->route('reports.income', [$request->from, $request->to, $request->branch]);
    }

    public function searchexpenses(Request $request)
    {
        return redirect()->route('reports.expenses', [$request->from, $request->to, $request->branch]);
    }

    public function searchinvoicespayments(Request $request)
    {
        return redirect()->route('reports.invoicespayments', [$request->from, $request->to, $request->branch]);
    }

    public function searchexpensespurchasesorderspayments(Request $request)
    {
        return redirect()->route('reports.purchasesorderspayments', [$request->from, $request->to, $request->branch]);
    }
    public function searchtransactions(Request $request)
    {
        return redirect()->route('reports.transactions', [$request->from, $request->to, $request->branch]);
    }
    public function searchlog(Request $request)
    {
        return redirect()->route('reports.log', [$request->from, $request->to, $request->branch]);
    }



    public function projects($from, $to, $branch, Request $request)
    {
        if (isset($from)) {
            $from = $from;
            $to = $to;
            $branch = $branch;
        } else if ($request->$from) {
            $from = $request->from;
            $to = $request->to;
            $branch = $request->branch;
        } else {
            $from = date('Y-m-d', strtotime("-1 days"));
            $to = date('Y-m-d');
            $branch = '1';
        }

        $fromX = $from;
        $toX = $to;
        //Insure covering whole days
        $from    = Carbon::parse($from)
            ->startOfDay()        // date 00:00:00.000000
            ->toDateTimeString(); // date 00:00:00

        $to      = Carbon::parse($to)
            ->endOfDay()          // date 23:59:59.000000
            ->toDateTimeString(); // date 23:59:59
        $branches = Branches::all();

        $projectsSum = Projects::where(function ($query) use ($from, $to) {
            $query->whereBetween('project_start_date', [$from, $to])
                ->orWhereBetween('project_end_date', [$from, $to]);
        })
            ->sum('total');

        $projects = Projects::where(function ($query) use ($from, $to) {
            $query->whereBetween('project_start_date', [$from, $to])
                ->orWhereBetween('project_end_date', [$from, $to]);
        })->get();

        return view('reports.projects', compact('projects', 'projectsSum', 'branch', 'branches', 'fromX', 'toX'));
    }

    public function invoicespayments($from, $to, $branch, Request $request)
    {
        if (isset($from)) {
            $from = $from;
            $to = $to;
            $branch = $branch;
        } else if ($request->$from) {
            $from = $request->from;
            $to = $request->to;
            $branch = $request->branch;
        } else {
            $from = date('Y-m-d', strtotime("-1 days"));
            $to = date('Y-m-d');
            $branch = '1';
        }

        $fromX = $from;
        $toX = $to;
        //Insure covering whole days
        $from    = Carbon::parse($from)
            ->startOfDay()        // date 00:00:00.000000
            ->toDateTimeString(); // date 00:00:00

        $to      = Carbon::parse($to)
            ->endOfDay()          // date 23:59:59.000000
            ->toDateTimeString(); // date 23:59:59
        $branches = Branches::all();
        $getBranchSafeId = Safes::where('branch_id', $branch)->value('id');
        $laterSumInv = InvoicesPayments::where('paid', 'Yes')
            ->whereBetween('date_collected', [$from, $to])
            ->where('safe_id', $getBranchSafeId)
            ->sum('amount');

        $laterInv = InvoicesPayments::where('paid', 'Yes')
            ->whereBetween('date_collected', [$from, $to])
            ->where('safe_id', $getBranchSafeId)
            ->get();

        return view('reports.invoicesPayments', compact('laterInv', 'laterSumInv', 'branch', 'branches', 'fromX', 'toX'));
    }

    public function purchasesorderspayments($from, $to, $branch, Request $request)
    {
        if (isset($from)) {
            $from = $from;
            $to = $to;
            $branch = $branch;
        } else if ($request->$from) {
            $from = $request->from;
            $to = $request->to;
            $branch = $request->branch;
        } else {
            $from = date('Y-m-d', strtotime("-1 days"));
            $to = date('Y-m-d');
            $branch = '1';
        }

        $fromX = $from;
        $toX = $to;
        //Insure covering whole days
        $from    = Carbon::parse($from)
            ->startOfDay()        // date 00:00:00.000000
            ->toDateTimeString(); // date 00:00:00

        $to      = Carbon::parse($to)
            ->endOfDay()          // date 23:59:59.000000
            ->toDateTimeString(); // date 23:59:59
        $branches = Branches::all();
        $getBranchSafeId = Safes::where('branch_id', $branch)->value('id');

        $laterSumPO = PurchasesOrdersPayments::where('paid', 'Yes')
            ->whereBetween('date', [$from, $to])
            ->where('safe_id', $getBranchSafeId)
            ->sum('amount');

        $laterPO = PurchasesOrdersPayments::where('paid', 'Yes')
            ->whereBetween('date', [$from, $to])
            ->where('safe_id', $getBranchSafeId)
            ->get();
        return view('reports.purchasesOrdersPayments', compact('branch', 'laterPO', 'laterSumPO', 'branches', 'fromX', 'toX'));
    }




    public function sales($from, $to, $branch, Request $request)
    {
        if (isset($from)) {
            $from = $from;
            $to = $to;
            $branch = $branch;
        } else if ($request->$from) {
            $from = $request->from;
            $to = $request->to;
            $branch = $request->branch;
        } else {
            $from = date('Y-m-d', strtotime("-1 days"));
            $to = date('Y-m-d');
            $branch = '1';
        }

        $fromX = $from;
        $toX = $to;
        //Insure covering whole days
        $from    = Carbon::parse($from)
            ->startOfDay()        // date 00:00:00.000000
            ->toDateTimeString(); // date 00:00:00

        $to      = Carbon::parse($to)
            ->endOfDay()          // date 23:59:59.000000
            ->toDateTimeString(); // date 23:59:59


        $invoices = Invoices::whereBetween('invoice_date', [$from, $to])
            ->where('branch_id', $branch)
            ->get();

        $sessions = PosSessions::Where('status', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->where('branch_id', $branch)
            ->get();


        /*******SALES*********/
        //Sales Gross
        $posInvoicesSum = PosSessions::Where('status', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->where('branch_id', $branch)
            ->sum('total');

        $invoicesSum = Invoices::where('already_paid', 1)
            ->whereBetween('invoice_date', [$from, $to])
            ->where('branch_id', $branch)
            ->sum('invoice_total');

        $invoicesSumLater = Invoices::where('already_paid', 0)
            ->whereBetween('invoice_date', [$from, $to])
            ->where('branch_id', $branch)
            ->where('payment_method', 'later')
            ->sum('amount_collected');


        //Sales Cost
        $posInvoicesCost = PosSessions::Where('status', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->where('branch_id', $branch)
            ->sum('cost');

        $invoicesCost = Invoices::where('already_paid', 1)
            ->whereBetween('invoice_date', [$from, $to])
            ->where('branch_id', $branch)
            ->sum('invoice_cost');

        $invoicesLaterCost = Invoices::where('already_paid', 0)
            ->whereBetween('invoice_date', [$from, $to])
            ->where('branch_id', $branch)
            ->where('payment_method', 'later')
            ->sum('invoice_cost');
        //Sales Net
        $posInvoicesNet = $posInvoicesSum - $posInvoicesCost;
        $invoicesNet = $invoicesSum - $invoicesCost;

        $invoicesNetLater = $invoicesSumLater - $invoicesLaterCost;

        $posSumCash = PosSessions::where('status', 1)
            ->whereBetween('updated_at', [$from, $to])
            ->where('branch_id', $branch)
            ->sum('total');

        $invoicesSumCash = Invoices::where('already_paid', 1)
            ->whereBetween('invoice_date', [$from, $to])
            ->where('branch_id', $branch)
            ->where('payment_method', 'cash')
            ->sum('invoice_total');


        $invoicesSumVisa = Invoices::where('already_paid', 1)
            ->whereBetween('invoice_date', [$from, $to])
            ->where('branch_id', $branch)
            ->where('payment_method', 'cash')
            ->sum('invoice_total');
        $branches = Branches::all();


        return view('reports.sales', compact('branch', 'posSumCash', 'branches', 'fromX', 'toX', 'invoicesSumVisa', 'invoicesSumCash', 'invoicesNetLater', 'invoicesNet', 'posInvoicesNet', 'invoices', 'sessions', 'posInvoicesSum', 'invoicesSum', 'invoicesSumLater'));
    }



    public function income($from, $to, $branch, Request $request)
    {
        if (isset($from)) {
            $from = $from;
            $to = $to;
            $branch = $branch;
        } else if ($request->$from) {
            $from = $request->from;
            $to = $request->to;
            $branch = $request->branch;
        } else {
            $from = date('Y-m-d', strtotime("-1 days"));
            $to = date('Y-m-d');
            $branch = '1';
        }

        $fromX = $from;
        $toX = $to;
        //Insure covering whole days
        $from    = Carbon::parse($from)
            ->startOfDay()        // date 00:00:00.000000
            ->toDateTimeString(); // date 00:00:00

        $to      = Carbon::parse($to)
            ->endOfDay()          // date 23:59:59.000000
            ->toDateTimeString(); // date 23:59:59
        $branches = Branches::all();

        $getBranchSafeId = Safes::where('branch_id', $branch)->value('id');

        //Safe Deposit
        $deposits = SafesTransactions::whereBetween('transaction_datetime', [$from, $to])
            ->where('transaction_type', 2)
            ->where('direct', 1)
            ->where('safe_id', $getBranchSafeId)
            ->get();

        //Safe Deposit
        $deposit = SafesTransactions::whereBetween('transaction_datetime', [$from, $to])
            ->where('transaction_type', 2)
            ->where('direct', 1)
            ->where('safe_id', $getBranchSafeId)
            ->sum('transaction_amount');

        //Income
        $income = In::whereBetween('updated_at', [$from, $to])
            ->where('safe_id', $getBranchSafeId)->get();

        $externalFund = ExternalFund::whereBetween('funding_date', [$from, $to])
            ->where('safe_id', $getBranchSafeId)->get();

        $incomeSum = In::whereBetween('updated_at', [$from, $to])
            ->where('safe_id', $getBranchSafeId)->sum('amount');



        $incomeBndSum = In::whereBetween('updated_at', [$from, $to])
            ->whereNotNull('category')
            ->where('safe_id', $getBranchSafeId)
            ->groupBy('category')
            ->selectRaw("*,SUM(amount) as total_amount")
            ->get();



        return view('reports.income', compact('externalFund', 'incomeSum', 'incomeBndSum', 'deposits', 'branch', 'branches', 'fromX', 'toX', 'income', 'deposit'));
    }



    public function expenses($from, $to, $branch, Request $request)
    {
        if (isset($from)) {
            $from = $from;
            $to = $to;
            $branch = $branch;
        } else if ($request->$from) {
            $from = $request->from;
            $to = $request->to;
            $branch = $request->branch;
        } else {
            $from = date('Y-m-d', strtotime("-1 days"));
            $to = date('Y-m-d');
            $branch = '1';
        }

        $fromX = $from;
        $toX = $to;
        //Insure covering whole days
        $from    = Carbon::parse($from)
            ->startOfDay()        // date 00:00:00.000000
            ->toDateTimeString(); // date 00:00:00

        $to      = Carbon::parse($to)
            ->endOfDay()          // date 23:59:59.000000
            ->toDateTimeString(); // date 23:59:59
        $branches = Branches::all();

        $getBranchSafeId = Safes::where('branch_id', $branch)->value('id');

        //Safe Deposit
        $withdrawals = SafesTransactions::whereBetween('transaction_datetime', [$from, $to])
            ->where('transaction_type', 1)
            ->where('direct', 1)
            ->where('safe_id', $getBranchSafeId)
            ->get();

        //Safe Deposit
        $withdrawal = SafesTransactions::whereBetween('transaction_datetime', [$from, $to])
            ->where('transaction_type', 1)
            ->where('direct', 1)
            ->where('safe_id', $getBranchSafeId)
            ->sum('transaction_amount');

        //Income
        $expenses = Out::whereBetween('updated_at', [$from, $to])
            ->where('safe_id', $getBranchSafeId)->get();

        $expensesSum = Out::whereBetween('updated_at', [$from, $to])
            ->where('safe_id', $getBranchSafeId)->sum('amount');



        $expensesBndSum = Out::whereBetween('updated_at', [$from, $to])
            ->whereNotNull('category')
            ->where('safe_id', $getBranchSafeId)
            ->groupBy('category')
            ->selectRaw("*,SUM(amount) as total_amount")
            ->get();

        $expensesGehaSum = Out::whereBetween('updated_at', [$from, $to])
            ->where('entity', '>=', 1)
            ->where('safe_id', $getBranchSafeId)
            ->groupBy('entity')
            ->selectRaw("*,SUM(amount) as total_amount")
            ->get();

        return view('reports.expenses', compact('expensesSum', 'expensesGehaSum', 'expensesBndSum', 'withdrawals', 'branch', 'branches', 'fromX', 'toX', 'expenses', 'withdrawal'));
    }


    public function transactions($from, $to, $branch, Request $request)
    {
        if (isset($from)) {
            $from = $from;
            $to = $to;
            $branch = $branch;
        } else if ($request->$from) {
            $from = $request->from;
            $to = $request->to;
            $branch = $request->branch;
        } else {
            $from = date('Y-m-d', strtotime("-1 days"));
            $to = date('Y-m-d');
            $branch = '1';
        }

        $fromX = $from;
        $toX = $to;
        //Insure covering whole days
        $from    = Carbon::parse($from)
            ->startOfDay()        // date 00:00:00.000000
            ->toDateTimeString(); // date 00:00:00

        $to      = Carbon::parse($to)
            ->endOfDay()          // date 23:59:59.000000
            ->toDateTimeString(); // date 23:59:59
        $branches = Branches::all();

        $getBranchSafeId = Safes::where('branch_id', $branch)->value('id');

        $safeTransactionsSum = SafesTransactions::whereBetween('transaction_datetime', [$from, $to])
            ->where('safe_id', $getBranchSafeId)
            ->sum('transaction_amount');

        $safeTransactionsInSum = SafesTransactions::whereBetween('transaction_datetime', [$from, $to])
            ->where('transaction_type', '2')
            ->where('safe_id', $getBranchSafeId)
            ->sum('transaction_amount');

        $safeTransactionsOutSum = SafesTransactions::whereBetween('transaction_datetime', [$from, $to])
            ->where('transaction_type', '1')
            ->where('safe_id', $getBranchSafeId)
            ->sum('transaction_amount');

        $safeTransactions = SafesTransactions::whereBetween('transaction_datetime', [$from, $to])
            ->where('safe_id', $getBranchSafeId)
            ->get();

        return view('reports.transactions', compact('safeTransactionsOutSum', 'safeTransactionsInSum', 'safeTransactions', 'safeTransactionsSum', 'branch', 'branches', 'fromX', 'toX'));
    }


    public function log($from, $to, $branch, Request $request)
    {
        if (isset($from)) {
            $from = $from;
            $to = $to;
            $branch = $branch;
        } else if ($request->$from) {
            $from = $request->from;
            $to = $request->to;
            $branch = $request->branch;
        } else {
            $from = date('Y-m-d', strtotime("-1 days"));
            $to = date('Y-m-d');
            $branch = '1';
        }

        $fromX = $from;
        $toX = $to;

        setlocale(LC_TIME, 'ar_EG.UTF-8');
        Carbon::setlocale("ar");
        //Insure covering whole days
        $from    = Carbon::parse($from)
            ->startOfDay()        // date 00:00:00.000000
            ->toDateTimeString(); // date 00:00:00

        $to      = Carbon::parse($to)
            ->endOfDay()          // date 23:59:59.000000
            ->toDateTimeString(); // date 23:59:59
        $logs = ERPLog::whereBetween('action_date', [$from, $to])
            ->where('user_id', '!=', 1)
            ->orderBy('action_date', 'DESC')->get();
        $branches = Branches::all();

        // setLocale(LC_TIME, 'Arbaic');
        $period = CarbonPeriod::create($from, $to);

        // // Iterate over the period
        // foreach ($period as $date) {
        //     // echo $date->format('F');
        //     echo $date->formatLocalized('%d %B %Y');
        // }

        // die();

        // Convert the period to an array of dates
        $dates = $period->toArray();










        return view('reports.log', compact('dates', 'branches', 'branch', 'logs', 'fromX', 'toX'));
    }
}
