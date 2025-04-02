<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('argumentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('debate_id');
            $table->unsignedBigInteger('usuario_id');
            $table->text('contenido');
            $table->enum('postura', ['A favor', 'Parcialmente a favor','Neutral','Parcialmente en contra','En contra']);
            $table->timestamps();
            $table->foreign('debate_id')->references('id')->on('debates')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('argumentos');
    }
};