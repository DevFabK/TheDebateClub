<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $table = 'temas_debates';

    protected $fillable = ['titulo', 'descripcion'];

    // Un tema tiene muchos debates
    public function debates()
    {
        return $this->hasMany(Debate::class, 'tema_id');
    }

    // Un tema es creado por un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
