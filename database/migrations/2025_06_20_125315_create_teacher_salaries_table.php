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
        Schema::create('teacher_salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->unsignedInteger('total_students')->default(0);
            $table->unsignedInteger('total_fee_collected')->default(0);
            $table->unsignedInteger('percentage')->default(0);
            $table->unsignedInteger('salary_amount')->default(0);
            $table->enum('status', ['paid', 'unpaid', 'balance'])->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_salaries');
    }
};
