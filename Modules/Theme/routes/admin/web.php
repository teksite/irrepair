<?php


use Illuminate\Support\Facades\Route;
use Modules\Theme\Http\Controllers\Web\Admin\Home\HomeController;

Route::prefix('/appearance/homepage')->name('appearance.theme.')->group(function () {
    Route::get('/', [HomeController::class,'edit'])->name('edit');
    Route::patch('/', [HomeController::class,'update'])->name('update');
});
