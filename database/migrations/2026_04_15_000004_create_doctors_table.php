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
        Schema::create('doctors', function (Blueprint $table) {
            $table->string('employee_code')->primary();
            $table->string('specialization');
            $table->string('sip_number');
            $table->enum('status', ['aktif', 'cuti', 'non-aktif'])->default('aktif');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('employee_code')->references('employee_code')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
