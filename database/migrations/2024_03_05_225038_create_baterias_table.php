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
        Schema::create('baterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surfista1');
            $table->unsignedBigInteger('surfista2');
            $table->foreign('surfista1')->references('numero')->on('surfistas');
            $table->foreign('surfista2')->references('numero')->on('surfistas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baterias');
    }
};
