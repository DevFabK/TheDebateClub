<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('debates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tema_id');
            $table->string('titulo', 255);
            $table->text('descripcion');

            $table->foreign('tema_id')->references('id')->on('temas_debates')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('debates');
    }
};