<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\Web\Admin\Article\ArticlesController;
use Modules\Blog\Http\Controllers\Web\Admin\Article\ArticlesTrashController;
use Modules\Blog\Http\Controllers\Web\Admin\Categories\CategoriesController;
use Modules\Blog\Http\Controllers\Web\Admin\Posts\PostsTrashController;
use Modules\Blog\Http\Controllers\Web\Admin\Posts\PinnedPostsController;
use Modules\Blog\Http\Controllers\Web\Admin\Posts\PostsController;
use Modules\Blog\Http\Controllers\Web\Admin\Seo\SeoController;


Route::prefix('blog')->name('blog.')->group(function () {
    Route::resource('categories', CategoriesController::class);

    Route::prefix('pinned')->name('pinned.')->group(function () {
        Route::get('/', [PinnedPostsController::class, 'index'])->name('index');
        Route::post('/', [PinnedPostsController::class, 'store'])->name('store');
        Route::patch('/', [PinnedPostsController::class, 'update'])->name('update');
    });

    Route::trashResource('posts', PostsTrashController::class);
    Route::resource('posts', PostsController::class);

    Route::trashResource('articles', ArticlesTrashController::class);
    Route::resource('articles', ArticlesController::class);
});

Route::prefix('seo/others/blog')->name('seo.others.blog.')->group(function () {
    Route::get('/', [SeoController::class, 'edit'])->name('edit');
    Route::patch('/', [SeoController::class, 'update'])->name('update');

});
