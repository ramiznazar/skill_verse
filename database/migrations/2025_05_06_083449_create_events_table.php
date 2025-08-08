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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->json('additional_images')->nullable();
            $table->string('title')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('date')->nullable();
            $table->string('address')->nullable();
            $table->text('map')->nullable();
            $table->text('description')->nullable();

            $table->text('topics')->nullable();
            $table->text('speakers')->nullable();
            $table->text('audience')->nullable();
            $table->text('quote')->nullable();
            $table->string('quote_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
