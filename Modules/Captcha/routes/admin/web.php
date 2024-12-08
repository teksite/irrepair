<?php

use Illuminate\Support\Facades\Route;
use Modules\Captcha\Http\Controllers\Web\Admin\Settings\CaptchaSettingsController;

Route::prefix('setting/captcha')->name('settings.captcha.')->group(function(){
    Route::get('/', [CaptchaSettingsController::class, 'edit'])->name('edit');
    Route::patch('/', [CaptchaSettingsController::class, 'update'])->name('update');
});
