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
        Schema::create('registrations', function (Blueprint $table) {
            $table->string('visit_number')->primary()->unique();
            $table->string('medical_record_number');
            $table->enum('visit_status', ['Terdaftar', 'Dilayani', 'Selesai', 'Rawat Inap'])->default('Terdaftar');
            $table->enum('visit_type', ['Rawat Jalan', 'IGD']);
            $table->string('polyclinic_code');
            $table->dateTime('visit_date');
            $table->string('insurance_code');
            $table->string('participant_number')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('medical_record_number')->references('medical_record_number')->on('patients');
            $table->foreign('polyclinic_code')->references('polyclinic_code')->on('polyclinics');
            $table->foreign('insurance_code')->references('insurance_code')->on('insurances');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
