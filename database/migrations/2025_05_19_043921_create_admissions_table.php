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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table-> foreignId('course_id')->nullable()->references('id')->on('courses')
            ->onDelete('cascade')->onUpdate('cascade');
            $table-> foreignId('batch_id')->nullable()->references('id')->on('batches')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('roll_no')->nullable()->unique();
            $table-> string('image')-> nullable();
            $table-> string('name')->nullable();
            $table-> string('guardian_name')->nullable();
            $table-> string('guardian_contact')->nullable();
            $table-> string('cnic')-> nullable();
            $table-> string('dob')-> nullable();
            $table-> string('email')-> nullable();
            $table-> string('phone')-> nullable();
            $table-> string('gender')-> nullable();
            $table-> string('qualification')-> nullable();
            $table->string('last_institute')->nullable();
            $table-> text('address')-> nullable();
            $table->string('referral_type')->nullable();
            
            $table->string('referral_source')->nullable();
            $table->string('referral_source_contact')->nullable();
            $table->string('referral_source_commission')->nullable();
            $table-> string('joining_date')->nullable();
            $table-> string('student_status')->nullable();
            $table-> string('fee_status')->default('pending');
            $table->enum('payment_type', ['full_fee', 'installment']);
            $table->unsignedInteger('full_fee');
            $table->unsignedInteger('installment_1')->nullable();
            $table->unsignedInteger('installment_2')->nullable();
            $table->unsignedInteger('installment_3')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
