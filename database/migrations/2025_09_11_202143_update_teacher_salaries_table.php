<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('teacher_salaries', function (Blueprint $table) {
            // snapshot of payout mode for that month
            $table->enum('pay_type', ['percentage','fixed'])
                  ->default('percentage')
                  ->after('year');

            // always compute & store both
            $table->unsignedInteger('computed_percentage_amount')
                  ->default(0)
                  ->after('total_fee_collected');

            $table->unsignedInteger('computed_fixed_amount')
                  ->default(0)
                  ->after('computed_percentage_amount');
        });
    }

    public function down(): void
    {
        Schema::table('teacher_salaries', function (Blueprint $table) {
            $table->dropColumn(['pay_type','computed_percentage_amount','computed_fixed_amount']);
        });
    }
};
