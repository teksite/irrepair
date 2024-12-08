<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\Web\Admin\Comments\CommentsController;
use Modules\Comment\Http\Controllers\Web\Admin\Comments\CommentsTrashController;

Route::trashResource('comments', CommentsTrashController::class);
Route::resource('comments', CommentsController::class);
Route::delete('comments/deletes/items', [CommentsController::class,'delete'])->name('comments.delete.items');
