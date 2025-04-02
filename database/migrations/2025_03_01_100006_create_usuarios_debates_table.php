<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('debate_usuario', function (Blueprint $table) {
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('debate_id')->constrained('debates')->onDelete('cascade');
            $table->primary(['usuario_id', 'debate_id']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('debate_usuario');
    }
};