<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('puntuaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('argumento_id');
            $table->unsignedBigInteger('usuario_id');
            $table->integer('puntuacion');

            $table->unique(['argumento_id', 'usuario_id']);

            $table->foreign('argumento_id')->references('id')->on('argumentos')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('puntuaciones');
    }
};
