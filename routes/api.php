<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FrontOffice\PatientController;
use App\Http\Controllers\Api\FrontOffice\RegistrationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('front-office')->group(function () {
    Route::apiResource('patients', PatientController::class);
    Route::post('register', [RegistrationController::class, 'store']);
});
