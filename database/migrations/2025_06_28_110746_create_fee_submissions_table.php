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
        Schema::create('fee_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admission_id')->references('id')->on('admissions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('account_id')->nullable()->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('receipt_no')->nullable()->unique();
            $table->enum('payment_type', ['full_fee', 'installment_1', 'installment_2', 'installment_3', 'installment_4']);
            $table->string('payment_method')->nullable();
            $table->unsignedInteger('amount')->nullable();
            $table->date('submission_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_submissions');
    }
};
