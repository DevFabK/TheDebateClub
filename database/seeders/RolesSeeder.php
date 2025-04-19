<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
{
    // Desactivar restricciones de claves foráneas
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
    // Vaciar la tabla y reiniciar los IDs
    DB::table('roles')->truncate();
    
    // Reactivar restricciones de claves foráneas
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    // Insertar los roles
    DB::table('roles')->insert([
        ['nombre' => 'Admin'],
        ['nombre' => 'Moderador'],
        ['nombre' => 'Usuario'],
        ['nombre' => 'Visitante'],
    ]);
}
}