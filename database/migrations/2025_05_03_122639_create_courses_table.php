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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_category_id')->nullable()->references('id')->on('course_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('duration')->nullable();
            $table->string('level')->nullable(); // e.g., "Beginner", "Intermediate", "Advanced"
            $table->string('mode')->nullable();  // e.g., "Online", "On-campus", "Hybrid"
            $table->string('full_fee')->nullable();
            $table->string('discount')->nullable();
            $table->string('min_fee')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
