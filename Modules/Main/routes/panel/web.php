<?php

use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\Web\Panel\PanelController;
use Modules\Main\Http\Controllers\Web\Panel\Users\PasswordController;
use Modules\Main\Http\Controllers\Web\Panel\Users\SessionsController;
use Modules\Main\Http\Controllers\Web\Panel\Users\TwoFactorAuthenticationController;
use Modules\Main\Http\Controllers\Web\Panel\Users\UsersController;

Route::get('/',[PanelController::class,'index'])->name('index');

Route::prefix('profile')->name('users.')->group(function () {
    Route::get('/', [UsersController::class, 'edit'])->name('edit');
    Route::patch('/', [UsersController::class, 'update'])->name('update');

    Route::prefix('password')->name('password.')->group(function (){
        Route::get('/', [PasswordController::class, 'edit'])->name('edit');
        Route::patch('/', [PasswordController::class, 'update'])->name('update');
    });

    Route::get('/two-factor-authentication', [TwoFactorAuthenticationController
    ::class, 'index'])->name('twofactorauth');

    Route::prefix('sessions')->name('sessions.')->group(function(){
        Route::get('/', [SessionsController::class, 'index'])->name('index');
        Route::delete('/', [SessionsController::class, 'destroy'])->name('destroy');
    });


});
