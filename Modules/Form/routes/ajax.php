<?php

use Illuminate\Support\Facades\Route;
use Modules\Form\Http\Controllers\Ajax\Client\Receives\SubmitFormController;

Route::post('/forms/submit',[SubmitFormController::class,'store'])->name('forms.submit');
