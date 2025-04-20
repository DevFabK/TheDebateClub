<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'nombre' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('Admin123'),
                'puntos_de_debate' => 0,
                'rol_id' => 1,
                'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
            ],
            [
                'id' => 2, 
                'nombre' => 'Moderador',
                'email' => 'mod@mod.com',
                'password' => Hash::make('Moderador123'),
                'puntos_de_debate' => 0,
                'rol_id' => 2,
                'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
            ],
            [
                'id' => 3, 
                'nombre' => 'Usuario1',
                'email' => 'user1@example.com',
                'password' => Hash::make('Usuario123'),
                'puntos_de_debate' => 10,
                'rol_id' => 3,
                'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
            ],
        ]);
    }
}
