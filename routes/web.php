<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\SuppliersController;

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
//Customers
Route::get('/customers', [CustomersController::class, 'customersList'])->name('customers.list');
Route::get('/customers/add', [CustomersController::class, 'add'])->name('customers.add');
Route::post('/customer/adding', [CustomersController::class, 'store'])->name('customer.adding');
Route::get('/customer/view/{customer}', [CustomersController::class, 'view'])->name('customer.view');
Route::get('/customer/edit/{customer}', [CustomersController::class, 'edit'])->name('customer.edit');
Route::patch('/customer/update/{customer}', [CustomersController::class, 'update'])->name('customer.update');
Route::delete('/customer/delete/{customer}', [CustomersController::class, 'delete'])->name('customer.delete');
//Suppliers
Route::get('/suppliers', [SuppliersController::class, 'suppliersList'])->name('suppliers.list');
Route::get('/suppliers/add', [SuppliersController::class, 'add'])->name('suppliers.add');
Route::post('/supplier/adding', [SuppliersController::class, 'store'])->name('supplier.adding');
Route::get('/supplier/view/{supplier}', [SuppliersController::class, 'view'])->name('supplier.view');
Route::get('/supplier/edit/{supplier}', [SuppliersController::class, 'edit'])->name('supplier.edit');
Route::patch('/supplier/update/{supplier}', [SuppliersController::class, 'update'])->name('supplier.update');
Route::delete('/supplier/delete/{supplier}', [SuppliersController::class, 'delete'])->name('supplier.delete');
