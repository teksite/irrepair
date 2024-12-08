<?php


use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\Ajax\Client\Comments\CommentsController;

Route::middleware(['throttle:5,1'])->group(function () {
    Route::post('/comments/store', [CommentsController::class, 'store'])->name('comments.store');
});
Route::get('/comments/more', [CommentsController::class, 'more'])->name('comments.more')->middleware(['throttle:10,1']);

