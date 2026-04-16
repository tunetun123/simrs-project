<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FrontOffice\PatientController;
use App\Http\Controllers\Api\FrontOffice\RegistrationController;
use App\Http\Controllers\Api\FrontOffice\PolyclinicController;
use App\Http\Controllers\Api\FrontOffice\InsuranceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('front-office')->name('api.')->group(function () {
    Route::apiResource('patients', PatientController::class);
    Route::post('register', [RegistrationController::class, 'store'])->name('register');
    Route::apiResource('polyclinics', PolyclinicController::class);
    Route::post('polyclinics/schedules', [PolyclinicController::class, 'storeSchedule'])->name('polyclinics.schedules.store');
    Route::delete('polyclinics/schedules/{id}', [PolyclinicController::class, 'destroySchedule'])->name('polyclinics.schedules.destroy');
    Route::apiResource('insurances', InsuranceController::class);
});
