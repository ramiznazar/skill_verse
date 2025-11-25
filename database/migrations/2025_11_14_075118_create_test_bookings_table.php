<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('test_bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreignId('batch_id')->nullable()->constrained('batches')->nullOnDelete();
            $table->unsignedBigInteger('test_day_id');
            $table->foreign('test_day_id')->references('id')->on('test_days')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('purpose')->nullable();
            $table->string('slot_time')->nullable();
            $table->string('attendance_status')->nullable();
            $table->string('result_status')->default('pending');
            $table->string('discount_code')->nullable();
            $table->integer('score')->nullable();
            $table->timestamp('attempted_at')->nullable();

            $table->date('test_date')->nullable();
            $table->enum('status', ['pending', 'attended', 'absent', 'cancelled'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_bookings');
    }
};
