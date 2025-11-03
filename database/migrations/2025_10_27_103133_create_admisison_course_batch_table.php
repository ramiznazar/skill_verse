<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admission_course_batch', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admission_id')->constrained('admissions')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('batch_id')->constrained('batches')->onDelete('cascade');

            // 🔹 Fee Details
            $table->unsignedDecimal('course_fee', 10, 2)->default(0);

            // 🔹 New Installment / Payment Fields
            $table->enum('payment_type', ['full_fee', 'installment'])->default('full_fee');
            $table->tinyInteger('installment_count')->nullable();
            $table->unsignedDecimal('installment_1', 10, 2)->nullable();
            $table->unsignedDecimal('installment_2', 10, 2)->nullable();
            $table->unsignedDecimal('installment_3', 10, 2)->nullable();
            $table->boolean('apply_additional_charges')->default(false);

            $table->timestamps();

            // 🔹 Helpful indexes
            $table->unique(['admission_id', 'course_id', 'batch_id'], 'acb_unique');
            $table->index(['course_id', 'batch_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_course_batch');
    }
};
