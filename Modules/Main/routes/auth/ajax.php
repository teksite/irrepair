<?php

use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\Ajax\Auth\OtpController;

Route::middleware(['throttle:5,1'])->name('opt.')->group(function () {
    Route::post('send-otp', [OtpController::class, 'send'])->name('send');
});
