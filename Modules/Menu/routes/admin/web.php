<?php

use Illuminate\Support\Facades\Route;
use Modules\Menu\Http\Controllers\Web\Admin\Menus\ItemsController;
use Modules\Menu\Http\Controllers\Web\Admin\Menus\MenusController;

Route::prefix('appearance')->name('appearance.')->group(function () {

    Route::prefix('menus')->name('menus.items.')->scopeBindings()->group(function (){
        Route::get('{menu}/items', [ItemsController::class, 'index'])->scopeBindings()->name('index');
        Route::post('{menu}/items', [ItemsController::class, 'store'])->scopeBindings()->name('store');
        Route::patch('{menu}/items', [ItemsController::class, 'update'])->scopeBindings()->name('update');
    });

    Route::resource('menus', MenusController::class);
});
