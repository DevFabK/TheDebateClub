<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion'];

    public function debates()
    {
        return $this->hasMany(Debate::class, 'tema_id');
    }
}
