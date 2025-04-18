<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debate extends Model
{
    use HasFactory;

    protected $fillable = ['tema_id', 'titulo', 'descripcion'];

    public function tema()
    {
        return $this->belongsTo(Tema::class, 'tema_id');
    }

    public function argumentos()
    {
        return $this->hasMany(Argumento::class, 'debate_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'debate_usuario', 'debate_id', 'usuario_id');
    }
}
