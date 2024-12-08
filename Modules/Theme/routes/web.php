<?php

use Illuminate\Support\Facades\Route;
use Modules\Theme\Http\Controllers\Web\Client\Files\DownloadFilesController;
use Modules\Theme\Http\Controllers\Web\Client\Home\HomeController;


Route::get('/', [HomeController::class ,'show'])->name('home');

Route::get('downloads/',[DownloadFilesController::class,'downloads'])->name('downloads.get');

