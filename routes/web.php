<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

//Route::middleware(['role'])->group(function () {
    Route::get('customer/home', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.home');
    Route::resource('customer/orders', '\App\Http\Controllers\OrderController');
//});

Route::get('/delivery/home', [App\Http\Controllers\DeliveryController::class, 'index'])->name('delivery.home');
Route::get('/delivery/order/pick/{id}', [App\Http\Controllers\DeliveryController::class, 'pickOrder'])->name('delivery.orders.picked');
Route::get('/delivery/order/delivered/{id}', [App\Http\Controllers\DeliveryController::class, 'deliverOrder'])->name('delivery.orders.delivered');

//Route::get('/orders/get-invoice/{id}', [App\Http\Controllers\OrderController::class,'getDataForInvoice'])->name('orders.invoice.get');
