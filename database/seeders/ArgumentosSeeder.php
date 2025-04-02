<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArgumentosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('argumentos')->insert([
            ['debate_id' => 1, 'usuario_id' => 2, 'contenido' => 'Dios es una creencia humana para dar sentido a la vida.', 'postura' => 'En contra'],
            ['debate_id' => 1, 'usuario_id' => 1, 'contenido' => 'Dios es el creador del universo y la fe lo demuestra.', 'postura' => 'A favor'],
        ]);
    }
}
