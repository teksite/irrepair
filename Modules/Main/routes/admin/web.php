<?php

use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\Web\Admin\Appearances\FilesManagerController;
use Modules\Main\Http\Controllers\Web\Admin\Appearances\IconsController;
use Modules\Main\Http\Controllers\Web\Admin\Authorize\PermissionsController;
use Modules\Main\Http\Controllers\Web\Admin\Authorize\RolesController;
use Modules\Main\Http\Controllers\Web\Admin\DashboardController;
use Modules\Main\Http\Controllers\Web\Admin\Seo\GeneralSeoController;
use Modules\Main\Http\Controllers\Web\Admin\Seo\OtherSeoController;
use Modules\Main\Http\Controllers\Web\Admin\Seo\RoboTDotTxtController;
use Modules\Main\Http\Controllers\Web\Admin\Seo\SitemapController;
use Modules\Main\Http\Controllers\Web\Admin\Settings\BatchJobsController;
use Modules\Main\Http\Controllers\Web\Admin\Settings\CachesController;
use Modules\Main\Http\Controllers\Web\Admin\Settings\InformationController;
use Modules\Main\Http\Controllers\Web\Admin\Settings\LogsController;
use Modules\Main\Http\Controllers\Web\Admin\Settings\JobsController;
use Modules\Main\Http\Controllers\Web\Admin\Tags\TagsController;
use Modules\Main\Http\Controllers\Web\Admin\Users\UsersController;

Route::get('/', [DashboardController::class, 'index'])->name('index');


Route::prefix('appearance')->name('appearance.')->middleware('can:admin')->group(function () {
    Route::get('icon', [IconsController::class, 'index'])->name('icons.index');
    Route::get('/file-manager', [FilesManagerController::class, 'index'])->name('file-manager.index');


});
Route::prefix('settings')->name('settings.')->middleware('can:setting-edit')->group(function () {
    Route::get('information', [InformationController::class, 'index'])->name('info');

    Route::prefix('logs')->name('logs.')->group(function () {
        Route::get('/', [LogsController::class, 'index'])->name('index');
        Route::delete('/', [LogsController::class, 'clear'])->name('clear');
    });

    Route::prefix('batch-jobs')->name('batchjobs.')->group(function () {
        Route::get('/', [BatchJobsController::class, 'index'])->name('index');
        Route::patch('/retry/{id}', [BatchJobsController::class, 'retry'])->name('retry');
        Route::delete('/cancel/{id}', [BatchJobsController::class, 'cancel'])->name('cancel');
        Route::delete('/delete/{id}', [BatchJobsController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('caches')->name('caches.')->group(function () {
        Route::get('/', [CachesController::class, 'index'])->name('index');
        Route::post('/', [CachesController::class, 'store'])->name('store');
        Route::delete('/', [CachesController::class, 'destroy'])->name('destroy');
    });
});

Route::resource('users', UsersController::class);

Route::prefix('authorization')->group(function () {
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
});

Route::resource('tags', TagsController::class);

Route::prefix('seo')->name('seo.')->group(function () {
    Route::prefix('robot_txt')->name('robot.')->group(function () {
        Route::get('/', [RobotDotTxtController::class, 'edit'])->name('edit');
        Route::patch('/', [RobotDotTxtController::class, 'update'])->name('update');
    });

    Route::prefix('general')->name('general.')->group(function () {
        Route::get('/', [GeneralSeoController::class, 'edit'])->name('edit');
        Route::patch('/', [GeneralSeoController::class, 'update'])->name('update');
    });
    Route::get('/others', [OtherSeoController::class, 'index'])->name('others.index');

    Route::prefix('sitemap')->name('sitemap.')->group(function () {
        Route::get('/', [SitemapController::class, 'index'])->name('index');
        Route::patch('/', [SitemapController::class, 'generate'])->name('generate');
    });


});
