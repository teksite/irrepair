<?php

use Illuminate\Support\Facades\Route;
use Modules\Captcha\Http\Controllers\Ajax\Client\LocalCaptchaController;

Route::post('/captcha/reload', [LocalCaptchaController::class,'reload'])->name('captcha.reload');
