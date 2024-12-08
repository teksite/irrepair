<?php


use Illuminate\Support\Facades\Route;
use Modules\Widget\Http\Controllers\Web\Admin\Widgets\WidgetsController;
use Modules\Widget\Http\Controllers\Web\Admin\Widgets\WidgetsTrashController;

Route::prefix('appearance')->group(function () {
    Route::trashResource('widgets', WidgetsTrashController::class);
    Route::resource('widgets', WidgetsController::class);
});
