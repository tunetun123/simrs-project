<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\StaffingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index', ['title' => 'Home']);
});

Route::prefix('front-office')->group(function () {
    // Patient Routes
    Route::get('patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::get('patients/{id}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::delete('patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');

    // Admission Routes
    Route::get('admissions', [AdmissionController::class, 'index'])->name('admissions.index');
    Route::get('admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
    Route::get('admissions/{visit_number}', [AdmissionController::class, 'show'])->name('admissions.show')->where('visit_number', '.*');
    Route::get('admissions/{visit_number}/edit', [AdmissionController::class, 'edit'])->name('admissions.edit')->where('visit_number', '.*');
    Route::delete('admissions/{visit_number}', [AdmissionController::class, 'destroy'])->name('admissions.destroy')->where('visit_number', '.*');

    // Polyclinic Routes
    Route::get('polyclinics', [PolyclinicController::class, 'index'])->name('polyclinics.index');
    Route::get('polyclinics/create', [PolyclinicController::class, 'create'])->name('polyclinics.create');
    Route::get('polyclinics/{id}', [PolyclinicController::class, 'show'])->name('polyclinics.show');
    Route::get('polyclinics/{id}/edit', [PolyclinicController::class, 'edit'])->name('polyclinics.edit');
    Route::delete('polyclinics/{id}', [PolyclinicController::class, 'destroy'])->name('polyclinics.destroy');

    // Insurance Routes
    Route::get('insurances', [InsuranceController::class, 'index'])->name('insurances.index');
    Route::get('insurances/create', [InsuranceController::class, 'create'])->name('insurances.create');
    Route::get('insurances/{id}', [InsuranceController::class, 'show'])->name('insurances.show');
    Route::get('insurances/{id}/edit', [InsuranceController::class, 'edit'])->name('insurances.edit');
    Route::delete('insurances/{id}', [InsuranceController::class, 'destroy'])->name('insurances.destroy');
});

Route::prefix('back-office')->group(function () {
    // Staffing Routes
    Route::get('staffing', [StaffingController::class, 'index'])->name('staffing.index');
    Route::get('staffing/create', [StaffingController::class, 'create'])->name('staffing.create');
    Route::get('staffing/{id}', [StaffingController::class, 'show'])->name('staffing.show');
    Route::get('staffing/{id}/edit', [StaffingController::class, 'edit'])->name('staffing.edit');
    Route::delete('staffing/{id}', [StaffingController::class, 'destroy'])->name('staffing.destroy');
});
