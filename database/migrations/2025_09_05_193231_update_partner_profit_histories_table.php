<?php
// database/migrations/2025_09_05_000020_update_partner_profit_histories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('partner_profit_histories', function (Blueprint $table) {
            // Make partner_profit_id nullable (so we can log balance payouts too)
            $table->foreignId('partner_profit_id')->nullable()->change();

            // Add partner_id, month, year
            if (!Schema::hasColumn('partner_profit_histories', 'partner_id')) {
                $table->foreignId('partner_id')->after('id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('partner_profit_histories', 'month')) {
                $table->unsignedTinyInteger('month')->nullable()->after('partner_id');
            }
            if (!Schema::hasColumn('partner_profit_histories', 'year')) {
                $table->unsignedSmallInteger('year')->nullable()->after('month');
            }

            // Replace action → status
            if (Schema::hasColumn('partner_profit_histories', 'action')) {
                $table->string('status', 50)->after('partner_profit_id');
                $table->dropColumn('action');
            } else {
                $table->string('status', 50)->after('partner_profit_id');
            }

            // Performed_by + performed_at
            if (!Schema::hasColumn('partner_profit_histories', 'performed_by')) {
                $table->foreignId('performed_by')->nullable()->after('note')->constrained('users')->nullOnDelete();
            }
            if (!Schema::hasColumn('partner_profit_histories', 'performed_at')) {
                $table->timestamp('performed_at')->nullable()->after('performed_by');
            }

            // Helpful indexes
            $table->index(['partner_id','month','year']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::table('partner_profit_histories', function (Blueprint $table) {
            // Drop new indexes
            $table->dropIndex(['partner_id','month','year']);
            $table->dropIndex(['status']);

            // Drop new columns
            $table->dropConstrainedForeignId('partner_id');
            $table->dropConstrainedForeignId('performed_by');
            $table->dropColumn(['month','year','performed_at','status']);

            // Restore action
            $table->enum('action', ['calculated', 'marked_paid', 'moved_to_balance']);
        });
    }
};
