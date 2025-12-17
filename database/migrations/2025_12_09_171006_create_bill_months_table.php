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
        Schema::create('bill_months', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_package_id')->constrained('bill_packages')->onDelete('cascade');
            $table->unsignedTinyInteger('month')->nullable();
            $table->enum('status', ['unpaid', 'pending', 'paid'])->default('unpaid');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_months');
    }
};
