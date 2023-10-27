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
        Schema::create('app_data', function (Blueprint $table) {
            $table->id();
            $table->integer('lasted_version');
            $table->integer('ads_limit');
            $table->integer('ads_spacing');
            $table->boolean('in_maintenance');
            $table->string('app_store');
            $table->string('play_store');
            $table->string('update_message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_data');
    }
};
