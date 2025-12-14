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
        Schema::create('bill_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // contoh: SPP Tahun 2024, Uang Pembangunan
            $table->integer('amount'); // harga per bulan / harga sekali bayar
            $table->enum('type', ['monthly', 'once'])->default('monthly');
            $table->year('year')->default(now()->year); // SPP biasanya per tahun
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_packages');
    }
};
