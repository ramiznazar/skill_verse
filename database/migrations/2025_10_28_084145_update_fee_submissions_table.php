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
        Schema::table('fee_submissions', function (Blueprint $table) {
               $table->foreignId('course_id')->nullable()->after('admission_id')->constrained('courses')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fee_submissions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('course_id');
        });
    }
};
