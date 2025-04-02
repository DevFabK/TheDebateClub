<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioDebate extends Model
{
    use HasFactory;

    protected $table = 'usuarios_debates';

    protected $fillable = ['usuario_id', 'debate_id'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function debate()
    {
        return $this->belongsTo(Debate::class, 'debate_id');
    }
}
