<?php


use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\Api\V1\Users\UsersController;

Route::ApiResource('users',UsersController::class);
