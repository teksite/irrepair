<?php

use Illuminate\Support\Facades\Route;
use Modules\SSO\Http\Controllers\Web\Admin\Settings\SsoController;

Route::prefix('settings/sso')->name('settings.sso.')->group(function(){
    Route::get('/', [SsoController::class, 'edit'])->name('edit');
    Route::patch('/', [SsoController::class, 'update'])->name('update');
});
