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
        Schema::create('bateria_surfista', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bateria_id');
            $table->unsignedBigInteger('surfista_id');
            $table->foreign('bateria_id')->references('id')->on('baterias')->onDelete('cascade');
            $table->foreign('surfista_id')->references('id')->on('surfistas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bateria_surfista');
    }
};
