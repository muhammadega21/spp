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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->foreignId('petugas_id')->nullable();
            $table->foreignId('spp_id');
            $table->foreignId('bulan_id');
            $table->boolean('bayar')->default(0);
            $table->string('tgl_bayar')->nullable();
            $table->string('tahun')->nullable();
            $table->string('jml_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
