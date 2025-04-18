<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'foto_perfil',
        'puntos_de_debate',
        'rol_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relaciones
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function argumentos()
    {
        return $this->hasMany(Argumento::class, 'usuario_id');
    }

    public function puntuaciones()
    {
        return $this->hasMany(Puntuacion::class, 'usuario_id');
    }

    public function debates()
    {
        return $this->belongsToMany(Debate::class, 'debate_usuario', 'usuario_id', 'debate_id');
    }
}
