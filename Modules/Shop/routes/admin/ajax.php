<?php


use Illuminate\Support\Facades\Route;
use Modules\Shop\Http\Controllers\Ajax\Admin\Attributes\AttributesController;


Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('attributes', [AttributesController::class ,'get']);
});
