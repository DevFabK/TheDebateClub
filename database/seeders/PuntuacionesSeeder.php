<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuntuacionesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('puntuaciones')->insert([
            ['argumento_id' => 1, 'usuario_id' => 1, 'puntuacion' => 4],
            ['argumento_id' => 2, 'usuario_id' => 2, 'puntuacion' => 5],
            ['argumento_id' => 3, 'usuario_id' => 3, 'puntuacion' => 3],
            ['argumento_id' => 4, 'usuario_id' => 4, 'puntuacion' => 4],
            ['argumento_id' => 5, 'usuario_id' => 5, 'puntuacion' => 5],
            ['argumento_id' => 6, 'usuario_id' => 6, 'puntuacion' => 3],
            ['argumento_id' => 7, 'usuario_id' => 7, 'puntuacion' => 2],
            ['argumento_id' => 8, 'usuario_id' => 8, 'puntuacion' => 5],
            ['argumento_id' => 9, 'usuario_id' => 5, 'puntuacion' => 3],
            ['argumento_id' => 10, 'usuario_id' => 6, 'puntuacion' => 4],
        ]);
    }
}
