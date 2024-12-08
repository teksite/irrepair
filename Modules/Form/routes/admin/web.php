<?php


use Illuminate\Support\Facades\Route;
use Modules\Form\Http\Controllers\Web\Admin\Forms\FormsController;
use Modules\Form\Http\Controllers\Web\Admin\Receives\AnalyticsController;
use Modules\Form\Http\Controllers\Web\Admin\Receives\ExportsController;
use Modules\Form\Http\Controllers\Web\Admin\Receives\InboxesController;
use Modules\Form\Http\Controllers\Web\Admin\Receives\InboxesTrashController;

Route::prefix('forms')->name('forms.')->group(function () {
    Route::trashResource('inboxes', InboxesTrashController::class);
    Route::resource('inboxes', InboxesController::class);
    Route::get('analytics', [AnalyticsController::class, 'show'])->name('analytics.show');

    Route::prefix('forms/export')->name('inboxes.export.')->group(function () {
        Route::get('/', [ExportsController::class, 'index'])->name('index');
        Route::get('/execute', [ExportsController::class, 'export'])->name('execute');
    });
});

Route::resource('forms', FormsController::class);
