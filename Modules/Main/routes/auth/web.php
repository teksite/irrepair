<?php

use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\Web\Auth\LoginByOtpController;
use Modules\Main\Http\Controllers\Web\Auth\OtpController;

Route::middleware(['throttle:5,1'])->name('otp.')->group(function () {
        Route::post('send-otp', [OtpController::class, 'send'])->name('send');
        Route::post('login', [LoginByOtpController::class, 'login'])->name('login');
});

