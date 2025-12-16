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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bill_month_id')->nullable()
                ->constrained('bill_months')
                ->onDelete('cascade');

            $table->foreignId('bill_package_id')
                ->constrained('bill_packages')
                ->onDelete('cascade');

            $table->foreignId('student_id')
                ->constrained('students')
                ->onDelete('cascade');

            $table->integer('amount');
            $table->string('proof_image')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};
