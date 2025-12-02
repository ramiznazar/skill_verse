<?php

use Illuminate\Support\Facades\DB;
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
        Schema::table('test_settings', function (Blueprint $table) {
            $table->date('booking_start_date')->nullable()->after('daily_end_time');
            $table->date('booking_end_date')->nullable()->after('booking_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_settings', function (Blueprint $table) {
            $table->dropColumn(['booking_start_date', 'booking_end_date']);
        });
    }
};
