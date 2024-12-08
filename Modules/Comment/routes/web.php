<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\Web\Client\Comments\CommentsController;

Route::middleware(['throttle:5,1'])->group(function () {
    Route::post('/comments/store', [CommentsController::class, 'store'])->name('comments.store');
});

