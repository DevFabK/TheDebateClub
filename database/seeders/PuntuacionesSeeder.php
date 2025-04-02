<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuntuacionesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('puntuaciones')->insert([
            ['argumento_id' => 1, 'usuario_id' => 1, 'puntuacion' => 5],
            ['argumento_id' => 2, 'usuario_id' => 2, 'puntuacion' => 3],
        ]);
    }
}
