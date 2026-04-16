<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('polyclinic_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('polyclinic_code');
            $table->string('doctor_code');
            $table->string('insurance_code');
            $table->enum('day', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('patient_quota');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('polyclinic_code')->references('polyclinic_code')->on('polyclinics')->onDelete('cascade');
            $table->foreign('doctor_code')->references('employee_code')->on('employees');
            $table->foreign('insurance_code')->references('insurance_code')->on('insurances');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polyclinic_schedules');
    }
};
