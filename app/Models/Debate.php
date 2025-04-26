<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debate extends Model
{
    use HasFactory;

    protected $table = 'debates';

    protected $fillable = ['tema_id', 'titulo', 'descripcion', 'usuario_id'];

    // Un debate pertenece a un tema
    public function tema()
    {
        return $this->belongsTo(Tema::class, 'tema_id');
    }

    // Un debate tiene muchos argumentos
    public function argumentos()
    {
        return $this->hasMany(Argumento::class, 'debate_id');
    }

    // Un debate pertenece a un usuario (el creador del debate)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
