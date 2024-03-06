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
        Schema::create('ondas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surfista_id');
            $table->unsignedBigInteger('bateria_id');
            $table->foreign('surfista_id')->references('numero')->on('surfistas');
            $table->foreign('bateria_id')->references('id')->on('baterias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ondas');
    }
};
