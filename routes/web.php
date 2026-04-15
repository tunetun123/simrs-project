<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index', ['title' => 'Home']);
});

Route::prefix('front-office')->group(function () {
    Route::resource('patients', PatientController::class);
    Route::resource('admissions', AdmissionController::class);
});
