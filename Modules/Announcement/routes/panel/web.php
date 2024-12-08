<?php
use Illuminate\Support\Facades\Route;
use Modules\Announcement\Http\Controllers\Web\Panel\Announcements\AnnouncementsController;

Route::prefix('announcements')->name('announcements.')->group(function (){
    Route::get('/{announcement}', [AnnouncementsController::class, 'show'])->name('show');
    Route::get('/', [AnnouncementsController::class, 'index'])->name('index');
    Route::patch('/', [AnnouncementsController::class, 'markAsRead'])->name('mark');
});

