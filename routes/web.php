<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\SafesController;
use App\Http\Controllers\PurchasesOrdersController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesPriceQuotationController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\InsController;
use App\Http\Controllers\OutsController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/**************************
 ******** Customers *******
 **************************/
Route::get('/customers', [CustomersController::class, 'customersList'])->name('customers.list');
Route::get('/customers/add', [CustomersController::class, 'add'])->name('customers.add');
Route::post('/customers/adding', [CustomersController::class, 'store'])->name('customers.adding');
Route::get('/customers/view/{customer}', [CustomersController::class, 'view'])->name('customers.view');
Route::get('/customers/edit/{customer}', [CustomersController::class, 'edit'])->name('customers.edit');
Route::patch('/customers/update/{customer}', [CustomersController::class, 'update'])->name('customers.update');
Route::delete('/customers/delete/{customer}', [CustomersController::class, 'delete'])->name('customers.delete');
Route::post('/customers/checkcustomer', [CustomersController::class, 'checkcustomer'])->name('customers.checkcustomer');


/**************************
 ******** Suppliers *******
 **************************/
Route::get('/suppliers', [SuppliersController::class, 'suppliersList'])->name('suppliers.list');
Route::get('/suppliers/add', [SuppliersController::class, 'add'])->name('suppliers.add');
Route::post('/suppliers/adding', [SuppliersController::class, 'store'])->name('suppliers.adding');
Route::get('/suppliers/view/{supplier}', [SuppliersController::class, 'view'])->name('suppliers.view');
Route::get('/suppliers/edit/{supplier}', [SuppliersController::class, 'edit'])->name('suppliers.edit');
Route::patch('/suppliers/update/{supplier}', [SuppliersController::class, 'update'])->name('suppliers.update');
Route::delete('/suppliers/delete/{supplier}', [SuppliersController::class, 'delete'])->name('suppliers.delete');
Route::post('/suppliers/checksupplier', [SuppliersController::class, 'checksupplier'])->name('suppliers.checksupplier');


/**************************
 ******** Products ********
 **************************/
Route::get('/products', [ProductsController::class, 'productsList'])->name('products.list');
Route::get('/products/add', [ProductsController::class, 'add'])->name('products.add');
Route::post('/products/adding', [ProductsController::class, 'store'])->name('products.adding');
Route::get('/products/view/{product}', [ProductsController::class, 'view'])->name('products.view');
Route::get('/products/edit/{product}', [ProductsController::class, 'edit'])->name('products.edit');
Route::patch('/products/update/{product}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/delete/{product}', [ProductsController::class, 'delete'])->name('products.delete');
// Qty operations
Route::get('/products/qty/transfer/{product}', [ProductsController::class, 'transfer'])->name('products.transfer');
Route::post('/products/qty/transfering', [ProductsController::class, 'transfering'])->name('products.transfering');
Route::post('/products/qty/fetch', [ProductsController::class, 'fetchQty'])->name('products.fetchQty');
Route::post('/products/qty/fetchprice', [ProductsController::class, 'fetchPrice'])->name('products.fetchPrice');
Route::post('/products/qty/fetchcost', [ProductsController::class, 'fetchCost'])->name('products.fetchCost');
Route::post('/products/qty/fetchotherbranches', [ProductsController::class, 'fetchOtherBranches'])->name('products.fetchOtherBranches');
Route::get('/products/qty/add/{product}', [ProductsController::class, 'addQty'])->name('products.addQty');
Route::post('/products/qty/adding', [ProductsController::class, 'addingQty'])->name('products.addingQty');

Route::get('/products/select', [ProductsController::class, 'productSelect'])->name('products.select');
Route::post('/products/selecting', [ProductsController::class, 'selecting'])->name('products.selecting');

/**************************
 **** Purchases orders ****
 **************************/
Route::get('/purchase_orders', [PurchasesOrdersController::class, 'purchasesordersList'])->name('purchasesorders.list');
Route::get('/purchase_orders/add', [PurchasesOrdersController::class, 'add'])->name('purchasesorders.add');
Route::post('/purchase_orders/adding', [PurchasesOrdersController::class, 'store'])->name('purchasesorders.adding');
Route::get('/purchase_orders/view/{order}', [PurchasesOrdersController::class, 'view'])->name('purchasesorders.view');
Route::get('/purchase_orders/edit/{order}', [PurchasesOrdersController::class, 'edit'])->name('purchasesorders.edit');
Route::patch('/purchase_orders/update/{order}', [PurchasesOrdersController::class, 'update'])->name('purchasesorders.update');


/**************************
 **** Selling Channels ****
 **************************/
//Invoices
Route::get('/invoices', [InvoicesController::class, 'invoicesList'])->name('invoices.list');
Route::get('/invoices/add', [InvoicesController::class, 'add'])->name('invoices.add');
Route::post('/invoices/adding', [InvoicesController::class, 'store'])->name('invoices.adding');
Route::get('/invoices/view/{invoice}', [InvoicesController::class, 'view'])->name('invoices.view');

Route::get('/invoices/print2/{invoice}', [InvoicesController::class, 'print2'])->name('invoices.print2');
Route::get('/invoices/print3/{invoice}', [InvoicesController::class, 'print3'])->name('invoices.print3');


Route::get('/invoices/edit/{invoice}', [InvoicesController::class, 'edit'])->name('invoices.edit');
//Route::post('/invoices/getOtherProducts', [InvoicesController::class, 'getOtherProducts'])->name('invoices.getOtherProducts');
Route::patch('/invoices/update/{invoice}', [InvoicesController::class, 'update'])->name('invoices.update');
Route::post('/invoices/installment/pay', [InvoicesController::class, 'installment'])->name('invoices.installment');


//Price Quotations
Route::get('/invoices/price_quotations', [InvoicesPriceQuotationController::class, 'invoicesPriceQuotationsList'])->name('invoicespricequotations.list');
Route::get('/invoices/price_quotations/add', [InvoicesPriceQuotationController::class, 'add'])->name('invoicespricequotations.add');
Route::post('/invoices/price_quotations/adding', [InvoicesPriceQuotationController::class, 'store'])->name('invoicespricequotations.adding');
Route::get('/invoices/price_quotations/edit/{invoice}', [InvoicesPriceQuotationController::class, 'edit'])->name('invoicespricequotations.edit');
Route::get('/invoices/price_quotations/view/{invoice}', [InvoicesPriceQuotationController::class, 'view'])->name('invoicespricequotations.view');
Route::patch('/invoices/price_quotations/update/{invoice}', [InvoicesPriceQuotationController::class, 'update'])->name('invoicespricequotations.update');
Route::get('/invoices/price_quotations/status/{invoice}/{status}', [InvoicesPriceQuotationController::class, 'status'])->name('invoicespricequotations.status');
Route::get('/invoices/price_quotations/toinvoice/{invoice}', [InvoicesPriceQuotationController::class, 'toinvoice'])->name('invoicespricequotations.toinvoice');
Route::post('/invoices/price_quotations/converting/{invoice}', [InvoicesPriceQuotationController::class, 'converting'])->name('invoicespricequotations.converting');
Route::post('/products/quickadd', [InvoicesPriceQuotationController::class, 'quickadd'])->name('invoicespricequotations.quickadd');

//POS
Route::get('/pos/landing', [PosController::class, 'landing'])->name('pos.landing');
Route::get('/pos/{sessionId}', [PosController::class, 'index'])->name('pos.index');
Route::post('/pos/search', [PosController::class, 'search'])->name('pos.search');
Route::post('/pos/barcode', [PosController::class, 'barcode'])->name('pos.barcode');
Route::post('/pos/start', [PosController::class, 'start'])->name('pos.start');
Route::post('/pos/finish', [PosController::class, 'finish'])->name('pos.finish');
Route::get('/pos/receipt/{sessionId}', [PosController::class, 'receipt'])->name('pos.receipt');
Route::post('/customers/quickadd', [PosController::class, 'quickadd'])->name('pos.quickadd');

/*************************
 ******* Projects ********
 *************************/
Route::get('/projects', [ProjectsController::class, 'projectsList'])->name('projects.list');
Route::get('/projects/add', [ProjectsController::class, 'add'])->name('projects.add');
Route::post('/projects/adding', [ProjectsController::class, 'store'])->name('projects.adding');
Route::get('/projects/edit/{project}', [ProjectsController::class, 'edit'])->name('projects.edit');
Route::patch('/projects/update/{project}', [ProjectsController::class, 'update'])->name('projects.update');



/*************************
 ******* Branches ********
 *************************/
Route::get('/branches', [BranchesController::class, 'branchesList'])->name('branches.list');
Route::get('/branches/add', [BranchesController::class, 'add'])->name('branches.add');
Route::post('/branches/adding', [BranchesController::class, 'store'])->name('branches.adding');
Route::get('/branches/view/{branch}', [BranchesController::class, 'view'])->name('branches.view');
Route::get('/branches/edit/{branch}', [BranchesController::class, 'edit'])->name('branches.edit');
Route::patch('/branches/update/{branch}', [BranchesController::class, 'update'])->name('branches.update');
Route::delete('/branches/delete/{branch}', [BranchesController::class, 'delete'])->name('branches.delete');


/*************************
 ********* Safes *********
 *************************/
Route::get('/safes', [SafesController::class, 'safesList'])->name('safes.list');
Route::get('/safes/transactions', [SafesController::class, 'transactions'])->name('safes.transactions');
Route::post('/safes/adding', [SafesController::class, 'store'])->name('safes.adding');
Route::get('/safes/view/{safe}', [SafesController::class, 'view'])->name('safes.view');
Route::patch('/safes/update/{safe}', [SafesController::class, 'update'])->name('safes.update');
Route::delete('/safes/delete/{safe}', [SafesController::class, 'delete'])->name('safes.delete');
Route::get('/safes/transfer/', [SafesController::class, 'transfer'])->name('safes.transfer');
Route::post('/safes/transfering', [SafesController::class, 'transfering'])->name('safes.transfering');
Route::post('/safes/fetchamount', [SafesController::class, 'fetchAmount'])->name('safes.fetchAmount');
Route::post('/products/fetchothersafes', [SafesController::class, 'fetchOtherSafes'])->name('safes.fetchOtherSafes');
Route::get('/safes/deposit/{safe}', [SafesController::class, 'deposit'])->name('safes.deposit');
Route::get('/safes/withdraw/{safe}', [SafesController::class, 'withdraw'])->name('safes.withdraw');
Route::post('/safes/depositing', [SafesController::class, 'depositing'])->name('safes.depositing');
Route::post('/safes/withdrawing', [SafesController::class, 'withdrawing'])->name('safes.withdrawing');
Route::get('/safes/receipt/{transactionId}', [SafesController::class, 'receipt'])->name('safes.receipt');


/*************************
 ********** Ins **********
 *************************/
Route::get('/ins', [InsController::class, 'insList'])->name('ins.list');
Route::get('/ins/categories', [InsController::class, 'categories'])->name('ins.categories');
Route::get('/ins/add', [InsController::class, 'add'])->name('ins.add');
Route::post('/ins/adding', [InsController::class, 'store'])->name('ins.adding');
Route::get('/ins/view/{in}', [InsController::class, 'view'])->name('ins.view');
Route::get('/ins/edit/{in}', [InsController::class, 'edit'])->name('ins.edit');
Route::patch('/ins/update/{in}', [InsController::class, 'update'])->name('ins.update');
Route::delete('/ins/delete/{in}', [InsController::class, 'delete'])->name('ins.delete');


/*************************
 ********* Outs **********
 *************************/
Route::get('/outs', [OutsController::class, 'outsList'])->name('outs.list');
Route::get('/outs/categories', [OutsController::class, 'categories'])->name('outs.categories');
Route::get('/outs/entities', [OutsController::class, 'entities'])->name('outs.entities');
Route::get('/outs/add', [OutsController::class, 'add'])->name('outs.add');
Route::post('/outs/adding', [OutsController::class, 'store'])->name('outs.adding');
Route::get('/outs/view/{out}', [OutsController::class, 'view'])->name('outs.view');
Route::get('/outs/edit/{out}', [OutsController::class, 'edit'])->name('outs.edit');
Route::patch('/outs/update/{out}', [OutsController::class, 'update'])->name('outs.update');
Route::delete('/outs/delete/{out}', [OutsController::class, 'delete'])->name('outs.delete');


/*************************
 ******** Reports ********
 *************************/
Route::get('/reports', [ReportsController::class, 'landing'])->name('reports.landing');
Route::get('/reports/sales/{from}/{to}/{branch}', [ReportsController::class, 'sales'])->name('reports.sales');
Route::get('/reports/income/{from}/{to}/{branch}', [ReportsController::class, 'income'])->name('reports.income');
Route::get('/reports/expenses/{from}/{to}/{branch}', [ReportsController::class, 'expenses'])->name('reports.expenses');



/*************************
 ********* Users *********
 *************************/
Route::get('/users', [UsersController::class, 'usersList'])->name('users.list');
Route::get('/users/add', [UsersController::class, 'add'])->name('users.add');
Route::post('/users/adding', [UsersController::class, 'store'])->name('users.adding');
Route::get('/users/view/{user}', [UsersController::class, 'view'])->name('users.view');
Route::get('/users/edit/{user}', [UsersController::class, 'edit'])->name('users.edit');
Route::patch('/users/update/{user}', [UsersController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{out}', [UsersController::class, 'delete'])->name('users.delete');

