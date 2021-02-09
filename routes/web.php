<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\HomeController;
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
use App\Http\Controllers\RolesAndPermissionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SettingsController;

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

/**************************
 ********** Auth **********
 **************************/
Auth::routes();



/**************************
 ********** Home **********
 **************************/
Route::get('/', function () {return redirect('home');});
Route::get('/home', [HomeController::class, 'index'])->name('home');



/**************************
 ****** Installation ******
 **************************/
Route::get('/install', [ConfigController::class, 'install'])->name('config.install');
Route::post('/install/verify', [ConfigController::class, 'verify'])->name('config.install.verify');
Route::post('/install/step/2', [ConfigController::class, 'step2'])->name('config.install.step2');



/**************************
 ******** Invoices ********
 **************************/
Route::group(['middleware' => ['permission:View Invoices']], function () {
    Route::get('/invoices', [InvoicesController::class, 'invoicesList'])->name('invoices.list');
    Route::get('/invoices/view/{invoice}', [InvoicesController::class, 'view'])->name('invoices.view');
});
Route::group(['middleware' => ['permission:Add Invoices']], function () {
    Route::get('/invoices/add', [InvoicesController::class, 'add'])->name('invoices.add');
    Route::post('/invoices/adding', [InvoicesController::class, 'store'])->name('invoices.adding');
});
Route::group(['middleware' => ['permission:Edit Invoices']], function () {
    Route::get('/invoices/edit/{invoice}', [InvoicesController::class, 'edit'])->name('invoices.edit');
    Route::patch('/invoices/update/{invoice}', [InvoicesController::class, 'update'])->name('invoices.update');
});
Route::group(['middleware' => ['permission:Print Invoices']], function () {
    Route::get('/invoices/print2/{invoice}', [InvoicesController::class, 'print2'])->name('invoices.print2');
    Route::post('/invoices/print3/{invoice}', [InvoicesController::class, 'print3'])->name('invoices.print3');
});
Route::post('/invoices/installment/pay', [InvoicesController::class, 'installment'])->name('invoices.installment');



/**************************
 **** Price Quotations ****
 **************************/
Route::group(['middleware' => ['permission:View PQ']], function () {
    Route::get('/invoices/price_quotations', [InvoicesPriceQuotationController::class, 'invoicesPriceQuotationsList'])->name('invoicespricequotations.list');
    Route::get('/invoices/price_quotations/view/{invoice}', [InvoicesPriceQuotationController::class, 'view'])->name('invoicespricequotations.view');
});
Route::group(['middleware' => ['permission:Add PQ']], function () {
    Route::get('/invoices/price_quotations/add', [InvoicesPriceQuotationController::class, 'add'])->name('invoicespricequotations.add');
    Route::post('/invoices/price_quotations/adding', [InvoicesPriceQuotationController::class, 'store'])->name('invoicespricequotations.adding');
});
Route::group(['middleware' => ['permission:Edit PQ']], function () {
    Route::get('/invoices/price_quotations/edit/{invoice}', [InvoicesPriceQuotationController::class, 'edit'])->name('invoicespricequotations.edit');
    Route::patch('/invoices/price_quotations/update/{invoice}', [InvoicesPriceQuotationController::class, 'update'])->name('invoicespricequotations.update');
});
Route::group(['middleware' => ['permission:Print PQ']], function () {
    Route::get('/price_quotations/print2/{invoice}', [InvoicesPriceQuotationController::class, 'print2'])->name('invoicespricequotations.print2');
    Route::post('/price_quotations/print3/{invoice}', [InvoicesPriceQuotationController::class, 'print3'])->name('invoicespricequotations.print3');
});
Route::group(['middleware' => ['permission:Accept PQ|Decline PQ']], function () {
    Route::get('/invoices/price_quotations/status/{invoice}/{status}', [InvoicesPriceQuotationController::class, 'status'])->name('invoicespricequotations.status');
});
Route::group(['middleware' => ['permission:Convert PQ']], function () {
    Route::get('/invoices/price_quotations/toinvoice/{invoice}', [InvoicesPriceQuotationController::class, 'toinvoice'])->name('invoicespricequotations.toinvoice');
    Route::post('/invoices/price_quotations/converting/{invoice}', [InvoicesPriceQuotationController::class, 'converting'])->name('invoicespricequotations.converting');
});



/**************************
 ********** POS ***********
 **************************/
Route::group(['middleware' => ['permission:View POS']], function () {
    Route::get('/pos/landing', [PosController::class, 'landing'])->name('pos.landing');
});
Route::group(['middleware' => ['permission:Sell POS']], function () {
    Route::get('/pos/{sessionId}', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/search', [PosController::class, 'search'])->name('pos.search');
    Route::post('/pos/barcode', [PosController::class, 'barcode'])->name('pos.barcode');
    Route::post('/pos/start', [PosController::class, 'start'])->name('pos.start');
    Route::post('/pos/finish', [PosController::class, 'finish'])->name('pos.finish');
    Route::get('/pos/receipt/{sessionId}', [PosController::class, 'receipt'])->name('pos.receipt');
});



/**************************
 ******** Customers *******
 **************************/
Route::group(['middleware' => ['permission:View Customers']], function () {
    Route::get('/customers', [CustomersController::class, 'customersList'])->name('customers.list');
    Route::get('/customers/view/{customer}', [CustomersController::class, 'view'])->name('customers.view');
});
Route::group(['middleware' => ['permission:Add Customers']], function () {
    Route::get('/customers/add', [CustomersController::class, 'add'])->name('customers.add');
    Route::post('/customers/adding', [CustomersController::class, 'store'])->name('customers.adding');
    Route::post('/customers/quickadd', [PosController::class, 'quickadd'])->name('pos.quickadd');
});
Route::group(['middleware' => ['permission:Edit Customers']], function () {
    Route::get('/customers/edit/{customer}', [CustomersController::class, 'edit'])->name('customers.edit');
    Route::patch('/customers/update/{customer}', [CustomersController::class, 'update'])->name('customers.update');
});
Route::group(['middleware' => ['permission:Delete Customers']], function () {
    Route::delete('/customers/delete/{customer}', [CustomersController::class, 'delete'])->name('customers.delete');
});
Route::post('/customers/checkcustomer', [CustomersController::class, 'checkcustomer'])->name('customers.checkcustomer');



/**************************
 ******** Suppliers *******
 **************************/
Route::group(['middleware' => ['permission:View Suppliers']], function () {
    Route::get('/suppliers', [SuppliersController::class, 'suppliersList'])->name('suppliers.list');
    Route::get('/suppliers/view/{supplier}', [SuppliersController::class, 'view'])->name('suppliers.view');
});
Route::group(['middleware' => ['permission:Add Suppliers']], function () {
    Route::get('/suppliers/add', [SuppliersController::class, 'add'])->name('suppliers.add');
    Route::post('/suppliers/adding', [SuppliersController::class, 'store'])->name('suppliers.adding');
});
Route::group(['middleware' => ['permission:Edit Suppliers']], function () {
    Route::get('/suppliers/edit/{supplier}', [SuppliersController::class, 'edit'])->name('suppliers.edit');
    Route::patch('/suppliers/update/{supplier}', [SuppliersController::class, 'update'])->name('suppliers.update');
});
Route::group(['middleware' => ['permission:Delete Suppliers']], function () {
    Route::delete('/suppliers/delete/{supplier}', [SuppliersController::class, 'delete'])->name('suppliers.delete');
});
Route::post('/suppliers/checksupplier', [SuppliersController::class, 'checksupplier'])->name('suppliers.checksupplier');



/**************************
 ******** Products ********
 **************************/
Route::group(['middleware' => ['permission:View Products']], function () {
    Route::get('/products', [ProductsController::class, 'productsList'])->name('products.list');
    Route::get('/products/view/{product}', [ProductsController::class, 'view'])->name('products.view');
    Route::get('/products/barcode/{code}/{qty}', [ProductsController::class, 'barcode'])->name('products.barcode');
});
Route::group(['middleware' => ['permission:Add Products']], function () {
    Route::get('/products/add', [ProductsController::class, 'add'])->name('products.add');
    Route::post('/products/adding', [ProductsController::class, 'store'])->name('products.adding');
    Route::post('/products/quickadd', [InvoicesPriceQuotationController::class, 'quickadd'])->name('invoicespricequotations.quickadd');
});
Route::group(['middleware' => ['permission:Edit Products']], function () {
    Route::get('/products/edit/{product}', [ProductsController::class, 'edit'])->name('products.edit');
    Route::patch('/products/update/{product}', [ProductsController::class, 'update'])->name('products.update');
});
Route::group(['middleware' => ['permission:Delete Products']], function () {
    Route::delete('/products/delete/{product}', [ProductsController::class, 'delete'])->name('products.delete');
});
Route::group(['middleware' => ['permission:Transfer Products']], function () {
    Route::get('/products/qty/transfer/{product}', [ProductsController::class, 'transfer'])->name('products.transfer');
    Route::post('/products/qty/transfering', [ProductsController::class, 'transfering'])->name('products.transfering');
    Route::get('/products/select', [ProductsController::class, 'productSelect'])->name('products.select');
    Route::post('/products/selecting', [ProductsController::class, 'selecting'])->name('products.selecting');
});
Route::group(['middleware' => ['permission:Accept Products Transfer|Decline Products Transfer']], function () {
    Route::get('/products/acceptingTransfer/{transfer}', [ProductsController::class, 'acceptingTransfer'])->name('products.acceptingTransfer');
});
Route::post('/products/qty/fetch', [ProductsController::class, 'fetchQty'])->name('products.fetchQty');
Route::post('/products/qty/fetchprice', [ProductsController::class, 'fetchPrice'])->name('products.fetchPrice');
Route::post('/products/qty/fetchcost', [ProductsController::class, 'fetchCost'])->name('products.fetchCost');
Route::post('/products/qty/fetchotherbranches', [ProductsController::class, 'fetchOtherBranches'])->name('products.fetchOtherBranches');
#Manual QTY adding, removed from current version#
//Route::get('/products/qty/add/{product}', [ProductsController::class, 'addQty'])->name('products.addQty');
//Route::post('/products/qty/adding', [ProductsController::class, 'addingQty'])->name('products.addingQty');



/**************************
 **** Purchases orders ****
 **************************/
Route::group(['middleware' => ['permission:View PO']], function () {
    Route::get('/purchase_orders', [PurchasesOrdersController::class, 'purchasesordersList'])->name('purchasesorders.list');
    Route::get('/purchase_orders/view/{order}', [PurchasesOrdersController::class, 'view'])->name('purchasesorders.view');
});
Route::group(['middleware' => ['permission:Add PO']], function () {
    Route::get('/purchase_orders/add', [PurchasesOrdersController::class, 'add'])->name('purchasesorders.add');
    Route::post('/purchase_orders/adding', [PurchasesOrdersController::class, 'store'])->name('purchasesorders.adding');
});
Route::group(['middleware' => ['permission:Edit PO']], function () {
    Route::get('/purchase_orders/edit/{order}', [PurchasesOrdersController::class, 'edit'])->name('purchasesorders.edit');
    Route::patch('/purchase_orders/update/{order}', [PurchasesOrdersController::class, 'update'])->name('purchasesorders.update');
});
Route::group(['middleware' => ['permission:Accept PO']], function () {
    Route::get('/purchase_orders/status/{order}/{status}', [PurchasesOrdersController::class, 'status'])->name('purchasesorders.status');
    Route::post('/purchase_orders/converting/{purchaseOrder}', [PurchasesOrdersController::class, 'accepting'])->name('purchasesorders.accepting');
});
Route::group(['middleware' => ['permission:Import PO']], function () {
    Route::get('/purchase_orders/toinventory/{purchaseOrder}', [PurchasesOrdersController::class, 'toinventory'])->name('purchasesorders.toinventory');
    Route::post('/purchase_orders/importing/{purchaseOrder}', [PurchasesOrdersController::class, 'importing'])->name('purchasesorders.importing');
});



/*************************
 ******* Projects ********
 *************************/
Route::group(['middleware' => ['permission:View Projects']], function () {
    Route::get('/projects', [ProjectsController::class, 'projectsList'])->name('projects.list');
});
Route::group(['middleware' => ['permission:Add Projects']], function () {
    Route::get('/projects/add', [ProjectsController::class, 'add'])->name('projects.add');
    Route::post('/projects/adding', [ProjectsController::class, 'store'])->name('projects.adding');
});
Route::group(['middleware' => ['permission:Edit Projects']], function () {
    Route::get('/projects/edit/{project}', [ProjectsController::class, 'edit'])->name('projects.edit');
    Route::patch('/projects/update/{project}', [ProjectsController::class, 'update'])->name('projects.update');
});



/*************************
 ******* Branches ********
 *************************/
Route::group(['middleware' => ['permission:View Branches']], function () {
    Route::get('/branches', [BranchesController::class, 'branchesList'])->name('branches.list');
    Route::get('/branches/view/{branch}', [BranchesController::class, 'view'])->name('branches.view');
});
Route::group(['middleware' => ['permission:Add Branches']], function () {
    Route::get('/branches/add', [BranchesController::class, 'add'])->name('branches.add');
    Route::post('/branches/adding', [BranchesController::class, 'store'])->name('branches.adding');
});
Route::group(['middleware' => ['permission:Edit Branches']], function () {
    Route::get('/branches/edit/{branch}', [BranchesController::class, 'edit'])->name('branches.edit');
    Route::patch('/branches/update/{branch}', [BranchesController::class, 'update'])->name('branches.update');
});
Route::group(['middleware' => ['permission:Delete Branches']], function () {
    Route::delete('/branches/delete/{branch}', [BranchesController::class, 'delete'])->name('branches.delete');
});



/*************************
 ********* Safes *********
 *************************/
Route::group(['middleware' => ['permission:View Safes']], function () {
    Route::get('/safes', [SafesController::class, 'safesList'])->name('safes.list');
    Route::get('/safes/view/{safe}', [SafesController::class, 'view'])->name('safes.view');
    Route::get('/safes/receipt/{transactionId}', [SafesController::class, 'receipt'])->name('safes.receipt');
    Route::post('/safes/fetchamount', [SafesController::class, 'fetchAmount'])->name('safes.fetchAmount');
    Route::post('/safes/fetchothersafes', [SafesController::class, 'fetchOtherSafes'])->name('safes.fetchOtherSafes');

});
Route::group(['middleware' => ['permission:Add Safes']], function () {
    Route::post('/safes/adding', [SafesController::class, 'store'])->name('safes.adding');
});
Route::group(['middleware' => ['permission:Edit Safes']], function () {
    Route::patch('/safes/update/{safe}', [SafesController::class, 'update'])->name('safes.update');
});
Route::group(['middleware' => ['permission:Deposit Safes']], function () {
    Route::get('/safes/deposit/{safe}', [SafesController::class, 'deposit'])->name('safes.deposit');
    Route::post('/safes/depositing', [SafesController::class, 'depositing'])->name('safes.depositing');
});
Route::group(['middleware' => ['permission:Withdraw Safes']], function () {
    Route::get('/safes/withdraw/{safe}', [SafesController::class, 'withdraw'])->name('safes.withdraw');
    Route::post('/safes/withdrawing', [SafesController::class, 'withdrawing'])->name('safes.withdrawing');
});
Route::group(['middleware' => ['permission:Transfer Safes']], function () {
    Route::get('/safes/transfer/', [SafesController::class, 'transfer'])->name('safes.transfer');
    Route::post('/safes/transfering', [SafesController::class, 'transfering'])->name('safes.transfering');
});
Route::group(['middleware' => ['permission:Delete Safes']], function () {
    Route::delete('/safes/delete/{safe}', [SafesController::class, 'delete'])->name('safes.delete');
});



/*************************
 ********** Ins **********
 *************************/
Route::group(['middleware' => ['permission:View Income']], function () {
    Route::get('/ins', [InsController::class, 'insList'])->name('ins.list');

});
Route::group(['middleware' => ['permission:Add Income']], function () {
    Route::get('/ins/add', [InsController::class, 'add'])->name('ins.add');
    Route::post('/ins/adding', [InsController::class, 'store'])->name('ins.adding');

});
Route::group(['middleware' => ['permission:View Income Cat']], function () {
    Route::get('/ins/categories', [InsController::class, 'categories'])->name('ins.categories');
});
Route::group(['middleware' => ['permission:Add Income Cat']], function () {
    Route::post('/ins/categories/adding', [InsController::class, 'categoriesstore'])->name('ins.categories.adding');
});
// Route::get('/ins/view/{in}', [InsController::class, 'view'])->name('ins.view');
// Route::get('/ins/edit/{in}', [InsController::class, 'edit'])->name('ins.edit');
// Route::patch('/ins/update/{in}', [InsController::class, 'update'])->name('ins.update');
// Route::delete('/ins/delete/{in}', [InsController::class, 'delete'])->name('ins.delete');



/*************************
 ********* Outs **********
 *************************/
Route::group(['middleware' => ['permission:View Expenses']], function () {
    Route::get('/outs', [OutsController::class, 'outsList'])->name('outs.list');
});
Route::group(['middleware' => ['permission:Add Expenses']], function () {
    Route::get('/outs/add', [OutsController::class, 'add'])->name('outs.add');
    Route::post('/outs/adding', [OutsController::class, 'store'])->name('outs.adding');
});
Route::group(['middleware' => ['permission:View Expenses Cat']], function () {
    Route::get('/outs/categories', [OutsController::class, 'categories'])->name('outs.categories');
});
Route::group(['middleware' => ['permission:Add Expenses Cat']], function () {
    Route::post('/outs/categories/adding', [OutsController::class, 'categoriesstore'])->name('outs.categories.adding');
});
Route::group(['middleware' => ['permission:View Expenses Ent']], function () {
    Route::get('/outs/entities', [OutsController::class, 'entities'])->name('outs.entities');
});
Route::group(['middleware' => ['permission:Add Expenses Ent']], function () {
    Route::post('/outs/entities/adding', [OutsController::class, 'entitiesstore'])->name('outs.entities.adding');
});
// Route::get('/outs/view/{out}', [OutsController::class, 'view'])->name('outs.view');
// Route::get('/outs/edit/{out}', [OutsController::class, 'edit'])->name('outs.edit');
// Route::patch('/outs/update/{out}', [OutsController::class, 'update'])->name('outs.update');
// Route::delete('/outs/delete/{out}', [OutsController::class, 'delete'])->name('outs.delete');



/*************************
 ******** Reports ********
 *************************/
Route::group(['middleware' => ['permission:View Reports']], function () {
Route::get('/reports', [ReportsController::class, 'landing'])->name('reports.landing');
Route::get('/reports/sales/{from}/{to}/{branch}', [ReportsController::class, 'sales'])->name('reports.sales');
Route::get('/reports/projects/{from}/{to}/{branch}', [ReportsController::class, 'projects'])->name('reports.projects');
Route::get('/reports/income/{from}/{to}/{branch}', [ReportsController::class, 'income'])->name('reports.income');
Route::get('/reports/expenses/{from}/{to}/{branch}', [ReportsController::class, 'expenses'])->name('reports.expenses');
Route::get('/reports/invoicespayments/{from}/{to}/{branch}', [ReportsController::class, 'invoicespayments'])->name('reports.invoicespayments');
Route::get('/reports/purchasesorderspayments/{from}/{to}/{branch}', [ReportsController::class, 'purchasesorderspayments'])->name('reports.purchasesorderspayments');
Route::get('/reports/transactions/{from}/{to}/{branch}', [ReportsController::class, 'transactions'])->name('reports.transactions');
Route::post('/reports/sales/search', [ReportsController::class, 'searchsales'])->name('reports.sales.search');
Route::post('/reports/projects/search', [ReportsController::class, 'searchprojects'])->name('reports.projects.search');
Route::post('/reports/income/search', [ReportsController::class, 'searchincome'])->name('reports.income.search');
Route::post('/reports/expenses/search', [ReportsController::class, 'searchexpenses'])->name('reports.expenses.search');
Route::post('/reports/invoicespayments/search', [ReportsController::class, 'searchinvoicespayments'])->name('reports.invoicespayments.search');
Route::post('/reports/purchasesorderspayments/search', [ReportsController::class, 'searchexpensespurchasesorderspayments'])->name('reports.purchasesorderspayments.search');
Route::post('/reports/transactions/search', [ReportsController::class, 'searchtransactions'])->name('reports.transactions.search');
});


/*************************
 ********* Users *********
 *************************/
Route::group(['middleware' => ['permission:View Users']], function () {
    Route::get('/users', [UsersController::class, 'usersList'])->name('users.list');
    Route::get('/users/view/{user}', [UsersController::class, 'view'])->name('users.view');
});
Route::group(['middleware' => ['permission:Add Users']], function () {
    Route::get('/users/add', [UsersController::class, 'add'])->name('users.add');
    Route::post('/users/adding', [UsersController::class, 'store'])->name('users.adding');
});
Route::group(['middleware' => ['permission:Edit Users']], function () {
    Route::get('/users/edit/{user}', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/users/update/{user}', [UsersController::class, 'update'])->name('users.update');
});

Route::group(['middleware' => ['permission:Delete Users']], function () {
    Route::delete('/users/delete/{out}', [UsersController::class, 'delete'])->name('users.delete');
});



/*************************
 ******** Settings ********
 *************************/
Route::group(['middleware' => ['permission:View Settings']], function () {
    Route::get('/settings', [SettingsController::class, 'settings'])->name('settings.list');
    Route::patch('/settings/update/{setting}', [SettingsController::class, 'update'])->name('settings.update');
});



//Roles & Permissions
Route::group(['middleware' => ['permission:View Roles']], function () {
    Route::get('/settings/roles', [RolesAndPermissionsController::class, 'roles'])->name('settings.roles');
});
Route::group(['middleware' => ['permission:View Roles Permissions']], function () {
    Route::get('/settings/permissions/{role}', [RolesAndPermissionsController::class, 'permissions'])->name('settings.permissions');
});
Route::group(['middleware' => ['permission:Edit Roles Permissions']], function () {
    Route::post('/settings/roles/adding', [RolesAndPermissionsController::class, 'addingRoles'])->name('settings.roles.adding');
    Route::post('/settings/permissions/adding', [RolesAndPermissionsController::class, 'addingPermissions'])->name('settings.permissions.adding');
    Route::get('/settings/assignPermissionToRole/{role}/{permission}', [RolesAndPermissionsController::class, 'assignPermissionToRole'])->name('settings.assignPermissionToRole');
    Route::get('/settings/assignUserToRole/{user}/{role}', [RolesAndPermissionsController::class, 'assignUserToRole'])->name('settings.assignUserToRole');
});

