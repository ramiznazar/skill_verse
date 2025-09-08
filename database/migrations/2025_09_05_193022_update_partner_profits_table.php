<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('partner_profits', function (Blueprint $table) {
            // Add new columns
            if (!Schema::hasColumn('partner_profits', 'month')) {
                $table->unsignedTinyInteger('month')->after('partner_id');
            }
            if (!Schema::hasColumn('partner_profits', 'year')) {
                $table->unsignedSmallInteger('year')->after('month');
            }

            // Drop the foreign key and column profit_calculation_id
            if (Schema::hasColumn('partner_profits', 'profit_calculation_id')) {
                $table->dropForeign(['profit_calculation_id']);
                $table->dropColumn('profit_calculation_id');
            }
        });

        // Add indexes and unique constraint
        Schema::table('partner_profits', function (Blueprint $table) {
            $table->unique(['partner_id','month','year'], 'uq_partner_month_year');
            $table->index(['month','year']);
            $table->index(['partner_id','status']);
        });
    }

    public function down(): void
    {
        Schema::table('partner_profits', function (Blueprint $table) {
            // Rollback: drop new indexes/columns
            $table->dropUnique('uq_partner_month_year');
            $table->dropIndex(['month','year']);
            $table->dropIndex(['partner_id','status']);

            $table->dropColumn(['month','year']);

            // Restore profit_calculation_id if rolled back
            $table->foreignId('profit_calculation_id')->constrained()->onDelete('cascade');
        });
    }
};
