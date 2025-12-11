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
        Schema::create('series.episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number');
            $table->boolean('watched');
            $table->foreignId('seasons_id')->constrained('series.seasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series.episodes');
    }
};
