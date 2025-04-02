<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'Admin'],
            ['id' => 2, 'nombre' => 'Moderador'],
            ['id' => 3, 'nombre' => 'Usuario'],
        ]);
    }
}
