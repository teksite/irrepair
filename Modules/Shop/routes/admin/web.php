<?php


use Illuminate\Support\Facades\Route;
use Modules\Shop\Http\Controllers\Web\Admin\Attributes\AttributesController;
use Modules\Shop\Http\Controllers\Web\Admin\Attributes\ValuesController;
use Modules\Shop\Http\Controllers\Web\Admin\Categories\CategoriesController;
use Modules\Shop\Http\Controllers\Web\Admin\Orders\AnalyticsController;
use Modules\Shop\Http\Controllers\Web\Admin\Orders\OrdersController;
use Modules\Shop\Http\Controllers\Web\Admin\Products\ProductsController;

Route::prefix('shop')->name('shop.')->group(function () {
    Route::resource('attributes.values', ValuesController::class);
    Route::resource('attributes', AttributesController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductsController::class);
});


Route::prefix('sell')->name('sell.')->group(function () {
    Route::get('orders/change/{order}', [OrdersController::class, 'change'])->name('orders.change');
    Route::patch('orders/change/{order}', [OrdersController::class, 'setChange'])->name('orders.setChange');
    Route::get('analytics', [AnalyticsController::class, 'show'])->name('analytics.show');

    Route::resource('orders', OrdersController::class);
});
