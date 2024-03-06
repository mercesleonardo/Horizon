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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('onda_id');
            $table->decimal('notaParcial1', 3, 1);
            $table->decimal('notaParcial2', 3, 1);
            $table->decimal('notaParcial3', 3, 1);
            $table->foreign('onda_id')->references('id')->on('ondas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
