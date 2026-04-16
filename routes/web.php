<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\InsuranceController;
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
    Route::get('admissions/{id}', [AdmissionController::class, 'show'])->name('admissions.show');
    Route::get('admissions/{id}/edit', [AdmissionController::class, 'edit'])->name('admissions.edit');
    Route::delete('admissions/{id}', [AdmissionController::class, 'destroy'])->name('admissions.destroy');

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
