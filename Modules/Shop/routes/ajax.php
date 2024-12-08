<?php

use Illuminate\Support\Facades\Route;
use Modules\Shop\Http\Controllers\Web\Client\Payment\CartController;
use Modules\Shop\Http\Controllers\Web\Client\Payment\CheckoutController;
use Modules\Shop\Http\Controllers\Web\Client\Payment\PayController;
use Modules\Shop\Http\Controllers\Web\Client\Products\ProductsController;



Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('/', [CartController::class, 'store'])->name('store');
    Route::delete('/', [CartController::class, 'destroy'])->name('destroy');
});
