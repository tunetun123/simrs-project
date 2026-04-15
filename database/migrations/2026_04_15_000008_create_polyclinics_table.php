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
        Schema::create('polyclinics', function (Blueprint $table) {
            $table->string('polyclinic_code')->primary();
            $table->string('name');
            $table->string('doctor_code');
            $table->string('insurance_code');
            $table->string('service_days'); // can be JSON
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('patient_quota');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('doctor_code')->references('employee_code')->on('employees');
            $table->foreign('insurance_code')->references('insurance_code')->on('insurances');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polyclinics');
    }
};
