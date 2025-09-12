<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // payout mode: percentage (default) or fixed
            $table->enum('pay_type', ['percentage','fixed'])
                  ->default('percentage')
                  ->after('experience');

            // new normalized fields
            $table->unsignedInteger('percentage')->nullable()->after('pay_type');     // e.g. 20 => 20%
            $table->unsignedInteger('fixed_salary')->nullable()->after('percentage'); // monthly fixed amount
        });

        // ---- OPTIONAL: backfill percentage from old string column `salary` (MySQL 8+) ----
        // If your `salary` currently stores percentage text like "20%" or "20".
        try {
            DB::statement("
                UPDATE teachers
                SET percentage = CAST(REGEXP_REPLACE(COALESCE(salary, ''), '[^0-9]', '') AS UNSIGNED)
                WHERE salary IS NOT NULL AND salary <> '';
            ");
        } catch (\Throwable $e) {
            // Fallback for older MySQL (no REGEXP_REPLACE): manually clean later if needed.
        }
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn(['pay_type','percentage','fixed_salary']);
        });
    }
};
