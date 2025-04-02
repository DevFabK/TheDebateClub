<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntuacion extends Model
{
    use HasFactory;

    protected $table = 'puntuaciones';

    protected $fillable = ['argumento_id', 'usuario_id', 'puntuacion'];

    public function argumento()
    {
        return $this->belongsTo(Argumento::class, 'argumento_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
