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
        Schema::create('teacher_salary_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->foreignId('teacher_salary_id')->nullable()->constrained('teacher_salaries')->nullOnDelete();
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->unsignedInteger('amount')->default(0);
            $table->string('status');
            // metadata
            $table->foreignId('performed_by')->nullable()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('performed_at')->nullable();

            $table->index(['teacher_id', 'year', 'month']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_salary_histories');
    }
};
