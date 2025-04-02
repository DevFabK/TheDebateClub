<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('temas_debates')->insert([
            ['titulo' => 'Religión', 'descripcion' => 'Debates sobre creencias y fe.'],
            ['titulo' => 'Política', 'descripcion' => 'Discusión sobre gobiernos y políticas.'],
            ['titulo' => 'Ciencia', 'descripcion' => 'Exploración de teorías científicas.'],
        ]);
    }
}
