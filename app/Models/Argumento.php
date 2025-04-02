<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Argumento extends Model
{
    use HasFactory;

    protected $table = 'argumentos';

    protected $fillable = ['debate_id', 'usuario_id', 'contenido', 'postura'];

    public function debate()
    {
        return $this->belongsTo(Debate::class, 'debate_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function puntuaciones()
    {
        return $this->hasMany(Puntuacion::class, 'argumento_id');
    }
}
