<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\Ajax\Posts\PostsController;
use Modules\Blog\Http\Controllers\Ajax\Web\Articles\ArticlesController;
use Modules\Blog\Http\Controllers\Ajax\Web\Categories\CategoriesController;


Route::prefix('blog')->name('blog.')->group(function () {
    Route::post('posts/get', [PostsController::class, 'index'])->name('posts.get');
    Route::post('articles/get', [ArticlesController::class, 'index'])->name('articles.get');
    Route::post('categories/get', [CategoriesController::class, 'index'])->name('categories.get');
});

