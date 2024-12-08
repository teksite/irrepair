<?php

use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\Ajax\Admin\Roles\RolesController;
use Modules\Main\Http\Controllers\Ajax\Admin\Seo\GetSeoTypeController;
use Modules\Main\Http\Controllers\Ajax\Admin\Users\UsersController;


Route::post('seo/types', [GetSeoTypeController::class, 'get'])->name('seo.types.get');
Route::post('users/get', [UsersController::class, 'get'])->name('users.get');
Route::post('roles/get', [RolesController::class, 'get'])->name('roles.get');
