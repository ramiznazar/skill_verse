<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->enum('mode', ['physical', 'online'])->default('physical')->after('student_status');
            $table->unsignedTinyInteger('online_percentage')->nullable()->after('mode'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
             $table->dropColumn(['mode','online_percentage']);
        });
    }
};
