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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('employee_code')->primary();
            $table->string('full_name');
            $table->string('nik')->unique();
            $table->date('birth_date');
            $table->string('birth_place');
            $table->enum('gender', ['male', 'female']);
            $table->string('last_education');
            $table->string('contact');
            $table->text('address');
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
            $table->string('bank_account_number')->nullable();
            $table->string('photo_path')->nullable();
            $table->enum('status', ['active', 'on_leave', 'inactive'])->default('active');
            $table->string('department_code');
            $table->string('position_code');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('department_code')->references('department_code')->on('departments');
            $table->foreign('position_code')->references('position_code')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
