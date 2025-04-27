<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebatesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('debates')->insert([
            ['tema_id' => 1, 'titulo' => 'Ateos vs Cristianos', 'descripcion' => 'Discusión sobre la existencia de Dios.', 'usuario_id' => 1],
            ['tema_id' => 1, 'titulo' => '¿Existe el alma?', 'descripcion' => 'Exploración filosófica del alma.', 'usuario_id' => 2],
            ['tema_id' => 2, 'titulo' => 'Monarquía vs República', 'descripcion' => 'Discusión sobre el mejor sistema de gobierno.', 'usuario_id' => 3],
            ['tema_id' => 3, 'titulo' => 'Conciencia artificial', 'descripcion' => '¿Puede una IA volverse consciente?', 'usuario_id' => 4],
            ['tema_id' => 5, 'titulo' => 'Empatía y redes sociales', 'descripcion' => 'Cómo afectan las redes sociales a nuestra empatía.', 'usuario_id' => 5],
        ]);
    }
}
