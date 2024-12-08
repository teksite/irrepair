<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\Web\Client\Posts\PostsController;


Route::prefix('blog')->name('posts.')->group(callback: function (){
    Route::get('{post:slug}', [PostsController::class,'show'])->name('show');
    Route::get('/', [PostsController::class,'index'])->name('index');
});


