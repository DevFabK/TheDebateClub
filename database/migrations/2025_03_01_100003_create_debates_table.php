<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebatesTable extends Migration
{
    public function up(): void
    {
        Schema::create('debates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tema_id');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->string('titulo');
            $table->text('descripcion');
            $table->timestamps();

            $table->foreign('tema_id')->references('id')->on('temas_debates')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('debates');
    }
}
