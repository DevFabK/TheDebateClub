<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebatesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('debates')->insert([
            ['tema_id' => 1, 'titulo' => 'Ateos vs Cristianos', 'descripcion' => 'Discusión sobre la existencia de Dios.'],
            ['tema_id' => 1, 'titulo' => '¿Existe el alma?', 'descripcion' => 'Exploración filosófica del alma.'],
            ['tema_id' => 2, 'titulo' => 'Monarquía vs República', 'descripcion' => 'Discusión sobre el mejor sistema de gobierno.'],
        ]);
    }
}
