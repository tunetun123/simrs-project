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
        Schema::create('patients', function (Blueprint $table) {
            $table->string('medical_record_number')->primary()->unique();
            $table->string('full_name');
            $table->string('ihs_number')->nullable();
            $table->string('nik')->unique();
            $table->string('passport_number')->nullable();
            $table->string('mothers_maiden_name');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->string('language');
            $table->text('address');
            $table->string('blood_type')->nullable();
            $table->string('rt');
            $table->string('rw');
            $table->string('village');
            $table->string('subdistrict');
            $table->string('city');
            $table->string('postal_code');
            $table->string('province');
            $table->string('country');
            $table->string('phone_number');
            $table->string('marital_status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
