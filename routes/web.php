<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CustomersController;


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
Route::post('/customer/add', [CustomersController::class, 'store'])->name('customer.add');
Route::get('/customer/view/{customer}', [CustomersController::class, 'view'])->name('customer.view');
Route::get('/customer/edit/{customer}', [CustomersController::class, 'edit'])->name('customer.edit');
Route::patch('/customer/update/{customer}', [CustomersController::class, 'update'])->name('customer.update');
Route::delete('/customer/delete/{customer}', [CustomersController::class, 'delete'])->name('customer.delete');
