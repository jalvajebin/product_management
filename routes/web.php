<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\Web\ProductController::class, 'index'])->name('products.index');
Route::get('products/{handle}', [\App\Http\Controllers\Web\ProductController::class, 'show'])->name('products.show');
Route::resource('cart-items', \App\Http\Controllers\Web\CartItemController::class)->only('store');
Route::resource('cart', \App\Http\Controllers\Web\CartController::class)->only('index');
Route::delete('/cart/remove/{productId}', [\App\Http\Controllers\Web\CartController::class, 'remove'])->name('cart.remove');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('login', \App\Http\Controllers\Admin\LoginController::class )->only(['index', 'store'])->middleware('admin.guest');

    Route::middleware('auth:admin')->group(function () {
        Route::resource('dashboard', \App\Http\Controllers\Admin\DashboardController::class)->only('index');
        Route::resource('logout', \App\Http\Controllers\Admin\LogoutController::class)->only('store');
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except('show');

    });

});
