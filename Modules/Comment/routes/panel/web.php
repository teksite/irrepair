<?php


use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\Web\Panel\Comments\CommentsController;

Route::resource('comments',CommentsController::class);

