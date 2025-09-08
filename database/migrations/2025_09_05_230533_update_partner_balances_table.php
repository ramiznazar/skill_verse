<?php
// database/migrations/2025_09_05_000030_update_partner_balances_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('partner_balances', function (Blueprint $table) {
            // Remove old cumulative column
            if (Schema::hasColumn('partner_balances', 'total_balance')) {
                $table->dropColumn('total_balance');
            }

            // Add per-cycle fields
            if (!Schema::hasColumn('partner_balances', 'amount')) {
                $table->decimal('amount', 12, 2)->default(0)->after('partner_id');
            }
            if (!Schema::hasColumn('partner_balances', 'month')) {
                $table->unsignedTinyInteger('month')->after('amount'); // 1..12
            }
            if (!Schema::hasColumn('partner_balances', 'year')) {
                $table->unsignedSmallInteger('year')->after('month');  // e.g. 2025
            }
            if (!Schema::hasColumn('partner_balances', 'status')) {
                $table->string('status', 20)->default('balance')->after('year'); // 'balance' | 'paid'
            }

            // Indexes/uniques
            $table->unique(['partner_id','month','year'], 'uq_partner_balance_month_year');
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::table('partner_balances', function (Blueprint $table) {
            // Drop new constraints
            $table->dropUnique('uq_partner_balance_month_year');
            $table->dropIndex(['status']);

            // Remove per-cycle fields
            if (Schema::hasColumn('partner_balances', 'status')) $table->dropColumn('status');
            if (Schema::hasColumn('partner_balances', 'year'))   $table->dropColumn('year');
            if (Schema::hasColumn('partner_balances', 'month'))  $table->dropColumn('month');
            if (Schema::hasColumn('partner_balances', 'amount')) $table->dropColumn('amount');

            // Restore old cumulative column
            if (!Schema::hasColumn('partner_balances', 'total_balance')) {
                $table->decimal('total_balance', 12, 2)->default(0);
            }
        });
    }
};
