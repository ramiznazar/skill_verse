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
        Schema::create('referral_commission_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_commission_id')->nullable()->references('id')->on('referral_commissions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('admission_id')->nullable()->references('id')->on('admissions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('fee_submission_id')->nullable()->references('id')->on('fee_submissions')->onDelete('cascade')->onUpdate('cascade');

            $table->string('referral_name')->nullable();
            $table->string('referral_contact')->nullable();

            $table->decimal('amount', 10, 2)->default(0); // +ve earn, -ve payout if you like (we’ll keep +ve)
            $table->string('status');

            $table->foreignId('performed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('performed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_commission_histories');
    }
};
