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


/*************************
 ******** Customers *******
 **************************/
Route::get('/customers', [CustomersController::class, 'customersList'])->name('customers.list');
Route::get('/customers/add', [CustomersController::class, 'add'])->name('customers.add');
Route::post('/customers/adding', [CustomersController::class, 'store'])->name('customers.adding');
Route::get('/customers/view/{customer}', [CustomersController::class, 'view'])->name('customers.view');
Route::get('/customers/edit/{customer}', [CustomersController::class, 'edit'])->name('customers.edit');
Route::patch('/customers/update/{customer}', [CustomersController::class, 'update'])->name('customers.update');
Route::delete('/customers/delete/{customer}', [CustomersController::class, 'delete'])->name('customers.delete');


/*************************
 ******** Suppliers *******
 **************************/
Route::get('/suppliers', [SuppliersController::class, 'suppliersList'])->name('suppliers.list');
Route::get('/suppliers/add', [SuppliersController::class, 'add'])->name('suppliers.add');
Route::post('/suppliers/adding', [SuppliersController::class, 'store'])->name('suppliers.adding');
Route::get('/suppliers/view/{supplier}', [SuppliersController::class, 'view'])->name('suppliers.view');
Route::get('/suppliers/edit/{supplier}', [SuppliersController::class, 'edit'])->name('suppliers.edit');
Route::patch('/suppliers/update/{supplier}', [SuppliersController::class, 'update'])->name('suppliers.update');
Route::delete('/suppliers/delete/{supplier}', [SuppliersController::class, 'delete'])->name('suppliers.delete');


/*************************
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
Route::post('/products/qty/fetchotherbranches', [ProductsController::class, 'fetchOtherBranches'])->name('products.fetchOtherBranches');
Route::get('/products/qty/add/{product}', [ProductsController::class, 'addQty'])->name('products.addQty');
Route::post('/products/qty/adding', [ProductsController::class, 'addingQty'])->name('products.addingQty');


/*************************
 **** Purchases orders ****
 **************************/
Route::get('/purchase_orders', [PurchasesOrdersController::class, 'purchasesordersList'])->name('purchasesorders.list');
Route::get('/purchase_orders/add', [PurchasesOrdersController::class, 'add'])->name('purchasesorders.add');
Route::post('/purchase_orders/adding', [PurchasesOrdersController::class, 'store'])->name('purchasesorders.adding');
Route::get('/purchase_orders/edit/{order}', [PurchasesOrdersController::class, 'edit'])->name('purchasesorders.edit');
Route::patch('/purchase_orders/update/{order}', [PurchasesOrdersController::class, 'update'])->name('purchasesorders.update');


/*************************
 **** Selling Channels ****
 **************************/
//Invoices
Route::get('/invoices', [InvoicesController::class, 'invoicesList'])->name('invoices.list');
Route::get('/invoices/add', [InvoicesController::class, 'add'])->name('invoices.add');
Route::post('/invoices/adding', [InvoicesController::class, 'store'])->name('invoices.adding');
Route::get('/invoices/edit/{invoice}', [InvoicesController::class, 'edit'])->name('invoices.edit');
//Route::post('/invoices/getOtherProducts', [InvoicesController::class, 'getOtherProducts'])->name('invoices.getOtherProducts');
Route::patch('/invoices/update/{invoice}', [InvoicesController::class, 'update'])->name('invoices.update');

//Price Quotations
Route::get('/invoices/price_quotations', [InvoicesPriceQuotationController::class, 'invoicesPriceQuotationsList'])->name('invoicespricequotations.list');
Route::get('/invoices/price_quotations/add', [InvoicesPriceQuotationController::class, 'add'])->name('invoicespricequotations.add');
Route::post('/invoices/price_quotations/adding', [InvoicesPriceQuotationController::class, 'store'])->name('invoicespricequotations.adding');
Route::get('/invoices/price_quotations/edit/{invoice}', [InvoicesPriceQuotationController::class, 'edit'])->name('invoicespricequotations.edit');
Route::patch('/invoices/price_quotations/update/{invoice}', [InvoicesPriceQuotationController::class, 'update'])->name('invoicespricequotations.update');


/*************************
 ******* Projects ********
 **************************/
Route::get('/projects', [ProjectsController::class, 'projectsList'])->name('projects.list');
Route::get('/projects/add', [ProjectsController::class, 'add'])->name('projects.add');
Route::post('/projects/adding', [ProjectsController::class, 'store'])->name('projects.adding');
Route::get('/projects/edit/{project}', [ProjectsController::class, 'edit'])->name('projects.edit');
Route::patch('/projects/update/{project}', [ProjectsController::class, 'update'])->name('projects.update');



/*************************
 ******** Branches ********
 **************************/
Route::get('/branches', [BranchesController::class, 'branchesList'])->name('branches.list');
Route::get('/branches/add', [BranchesController::class, 'add'])->name('branches.add');
Route::post('/branches/adding', [BranchesController::class, 'store'])->name('branches.adding');
Route::get('/branches/view/{branch}', [BranchesController::class, 'view'])->name('branches.view');
Route::get('/branches/edit/{branch}', [BranchesController::class, 'edit'])->name('branches.edit');
Route::patch('/branches/update/{branch}', [BranchesController::class, 'update'])->name('branches.update');
Route::delete('/branches/delete/{branch}', [BranchesController::class, 'delete'])->name('branches.delete');


/*************************
 ********* Safes **********
 **************************/
Route::get('/safes', [SafesController::class, 'safesList'])->name('safes.list');
Route::post('/safes/adding', [SafesController::class, 'store'])->name('safes.adding');
Route::get('/safes/view/{safe}', [SafesController::class, 'view'])->name('safes.view');
Route::patch('/safes/update/{safe}', [SafesController::class, 'update'])->name('safes.update');
Route::delete('/safes/delete/{safe}', [SafesController::class, 'delete'])->name('safes.delete');
Route::get('/safes/transfer/', [SafesController::class, 'transfer'])->name('safes.transfer');
Route::post('/safes/transfering', [SafesController::class, 'transfering'])->name('safes.transfering');
Route::post('/safes/fetchamount', [SafesController::class, 'fetchAmount'])->name('safes.fetchAmount');
Route::post('/products/fetchothersafes', [SafesController::class, 'fetchOtherSafes'])->name('safes.fetchOtherSafes');
