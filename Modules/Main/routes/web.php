<?php

use Illuminate\Support\Facades\Route;
use Modules\Theme\Http\Controllers\Web\Client\Files\DownloadFilesController;
use Modules\Theme\Http\Controllers\Web\Client\Search\SearchController;

Route::get('/ajax/downloads',[DownloadFilesController::class,'download'])->name('files.download');


Route::get('search', [SearchController::class, 'index'])->name('search');
