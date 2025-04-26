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

    // Un usuario pertenece a un rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Un usuario tiene muchos argumentos
    public function argumentos()
    {
        return $this->hasMany(Argumento::class, 'usuario_id');
    }

    // Un usuario tiene muchas puntuaciones
    public function puntuaciones()
    {
        return $this->hasMany(Puntuacion::class, 'usuario_id');
    }

    // Un usuario tiene muchos debates (debates que ha creado)
    public function debates()
    {
        return $this->hasMany(Debate::class, 'usuario_id');
    }
}
