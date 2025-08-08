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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->references('id')->on('courses')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('lead_type')->default('website');
            $table->string('name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_contact')->nullable();
            $table->string('cnic')->nullable();
            $table->string('dob')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('qualification')->nullable();
            $table->string('last_institute')->nullable();
            $table->text('address')->nullable();
            $table->string('referral_type')->nullable();

            $table->string('referral_source')->nullable();
            $table->string('referral_source_contact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
