<?php


use Illuminate\Support\Facades\Route;
use Modules\Page\Http\Controllers\Web\Admin\Pages\PagesController;
use Modules\Page\Http\Controllers\Web\Admin\Pages\PagesTrashController;

Route::trashResource('pages', PagesTrashController::class);
Route::resource('pages', PagesController::class);
