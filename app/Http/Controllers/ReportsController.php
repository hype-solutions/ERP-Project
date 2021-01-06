<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Customers\Customers;
use App\Models\Invoices\Invoices;
use App\Models\Invoices\InvoicesPriceQuotation;
use App\Models\Pos\PosSessions;
use App\Models\Projects\Projects;
use App\Models\Safes\Safes;
use App\Models\Suppliers\Suppliers;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function landing()
    {
        //Options
        $branches = Branches::all();

        //Customers
        $customersCount = Customers::count();
        //Suppliers
        $suppliersCount = Suppliers::count();
        //Safes
        $safesSum = Safes::sum('safe_balance');
        //POS
        $posInvoicesCount = PosSessions::count();
        $posInvoicesSum = PosSessions::sum('total');
        $posInvoicesDone = PosSessions::Where('status',1)->count();
        //Invoices
        $invoicesCount = Invoices::count();
        $invoicesSum = Invoices::sum('invoice_total');
        $invoicesDone = Invoices::where('already_paid',1)->count();
        //Price Quotation
        $invoicesPriceQuotationsCount = InvoicesPriceQuotation::count();
        $invoicesPriceQuotationsSum = InvoicesPriceQuotation::sum('quotation_total');
        //Projects
        $projectsCount = Projects::count();
        $projectsSum = Projects::sum('total');

        return view('reports.landing',compact(
            'branches',
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
        ));
    }
}
