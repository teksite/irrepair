<?php

use Illuminate\Support\Facades\Route;
use Modules\RestrictIP\Http\Controllers\Web\Admin\Settings\RestrictIpsController;

Route::prefix('settings')->group(function () {
    Route::resource('restrictIPs', RestrictIpsController::class);
});
