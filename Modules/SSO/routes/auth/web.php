<?php


use Illuminate\Support\Facades\Route;
use Modules\SSO\Http\Controllers\Web\Auth\Authentication\SsoController;

Route::middleware('guest')->prefix('/sso')->name('sso.')->group(function () {
    Route::get('/callback',[SsoController::class,'callback'])->name('callback');
    Route::get('/',[SsoController::class,'redirect'])->name('redirect');
});
