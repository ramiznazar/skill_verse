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
        Schema::table('teacher_salaries', function (Blueprint $table) {
            $table->unsignedInteger('online_bonus')->default(0)->after('salary_amount');
            $table->unsignedInteger('total_online_students')->default(0)->after('total_students');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teacher_salaries', function (Blueprint $table) {
             $table->dropColumn(['online_bonus','total_online_students']);
        });
    }
};
