<?php
use Illuminate\Support\Facades\Route;
use Modules\Announcement\Http\Controllers\Web\Admin\Announcements\AnnouncementsController;


Route::prefix('announcements/trash')->name('announcements.trash.')->group(function () {

//    Route::delete('{id}', [AnnouncementsTrashController::class, 'wipe'])->name('wipe');
//    Route::patch('{id}', [AnnouncementsTrashController::class, 'undo'])->name('undo');
//
//    Route::patch('/', [AnnouncementsTrashController::class, 'restore'])->name('restore');
//    Route::delete('/', [AnnouncementsTrashController::class, 'flush'])->name('flush');
//
//    Route::get('/', [AnnouncementsTrashController::class, 'index'])->name('index');

});


Route::resource('announcements', AnnouncementsController::class);
