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
        Schema::table('expenses', function (Blueprint $table) {
            $table->string('type')->nullable()->after('amount');
             $table->string('ref_type')->nullable()->after('type');
            $table->unsignedBigInteger('ref_id')->nullable()->after('ref_type');
            $table->index(['ref_type', 'ref_id'], 'expenses_ref_type_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            //
        });
    }
};
