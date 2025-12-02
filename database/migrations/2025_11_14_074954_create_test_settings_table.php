<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_booking_open')->default(true);
            $table->integer('max_days_ahead')->default(15);
            $table->time('daily_start_time')->default('10:00');
            $table->time('daily_end_time')->default('16:00');
            $table->integer('slot_duration_minutes')->default(60);
            $table->integer('slot_capacity')->default(5);

            $table->string('admin_note')->nullable();

            $table->timestamps();
        });

        // Insert default settings
        DB::table('test_settings')->insert([
            'is_booking_open'        => true,
            'max_days_ahead'         => 15,
            'daily_start_time'       => '10:00',
            'daily_end_time'         => '16:00',
            'slot_duration_minutes'  => 60,
            'slot_capacity'          => 5,
            'admin_note'             => null,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_settings');
    }
};
