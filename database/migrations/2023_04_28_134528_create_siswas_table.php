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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->nullable();
            $table->foreignId('jurusan_id')->nullable();
            $table->char('nisn', 10);
            $table->char('nis', 8);
            $table->string('name');
            $table->string('username');
            $table->string('tahun_ajaran');
            $table->string('no_telp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('image')->default('user.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
