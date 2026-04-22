<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FrontOffice\PatientController;
use App\Http\Controllers\Api\FrontOffice\RegistrationController;
use App\Http\Controllers\Api\FrontOffice\PolyclinicController;
use App\Http\Controllers\Api\FrontOffice\InsuranceController;
use App\Http\Controllers\Api\BackOffice\EmployeeController;
use App\Http\Controllers\Api\BackOffice\DoctorController;
use App\Http\Controllers\Api\BackOffice\NurseController;
use App\Http\Controllers\Api\BackOffice\DepartmentController;
use App\Http\Controllers\Api\BackOffice\PositionController;

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

Route::prefix('back-office')->name('api.back-office.')->group(function () {
    // Staffing Routes
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('doctors', DoctorController::class)->except(['destroy']);
    Route::apiResource('nurses', NurseController::class)->except(['destroy']);
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('positions', PositionController::class);
});
