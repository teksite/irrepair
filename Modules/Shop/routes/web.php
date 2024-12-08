<?php

use Illuminate\Support\Facades\Route;
use Modules\Shop\Http\Controllers\Web\Client\Payment\CartController;
use Modules\Shop\Http\Controllers\Web\Client\Payment\CheckoutController;
use Modules\Shop\Http\Controllers\Web\Client\Payment\PayController;
use Modules\Shop\Http\Controllers\Web\Client\Products\ProductsController;


Route::get('/courses', [ProductsController::class, 'index'])->name('shop.products.index');
Route::get('/articles/{product:slug}', [ProductsController::class, 'show'])->name('shop.products.show');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('/', [CartController::class, 'store'])->name('store');
    Route::delete('/', [CartController::class, 'destroy'])->name('destroy');
    Route::get('/', [CartController::class, 'show'])->name('show');
});

Route::prefix('payment')->name('payment.')->group(function () {

    Route::get('/', [CheckoutController::class, 'order'])->name('order');
    Route::post('/pay', [PayController::class, 'pay'])->name('pay');
    Route::get('/callback', [PayController::class, 'callback'])->name('callback');
});
