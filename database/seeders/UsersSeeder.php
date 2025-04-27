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
                'nombre' => 'Admin1',
                'email' => 'admin1@admin.com',
                'password' => Hash::make('Admin123'),
                'puntos_de_debate' => 0,
                'rol_id' => 1,
                'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
            ],
            [
                'nombre' => 'Admin2',
                'email' => 'admin2@admin.com',
                'password' => Hash::make('Admin123'),
                'puntos_de_debate' => 0,
                'rol_id' => 1,
                'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
            ],
            [
                'nombre' => 'Moderador1',
                'email' => 'mod1@mod.com',
                'password' => Hash::make('Moderador123'),
                'puntos_de_debate' => 0,
                'rol_id' => 2,
                'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
            ],
            [
                'nombre' => 'Moderador2',
                'email' => 'mod2@mod.com',
                'password' => Hash::make('Moderador123'),
                'puntos_de_debate' => 0,
                'rol_id' => 2,
                'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
            ],
            [
                'nombre' => 'Usuario1',
                'email' => 'user1@example.com',
                'password' => Hash::make('Usuario123'),
                'puntos_de_debate' => 10,
                'rol_id' => 3,
                'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
            ],
            [
                'nombre' => 'Test',
                'email' => 'test@test.com',
                'password' => Hash::make('test12345'),
                'puntos_de_debate' => 10,
                'rol_id' => 3,
                'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
            ],
            [
                'nombre' => 'Usuario2',
                'email' => 'user2@example.com',
                'password' => Hash::make('Usuario123'),
                'puntos_de_debate' => 5,
                'rol_id' => 3,
                'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
            ],
            [
                'nombre' => 'Usuario3',
                'email' => 'user3@example.com',
                'password' => Hash::make('Usuario123'),
                'puntos_de_debate' => 8,
                'rol_id' => 3,
                'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
            ],
        ]);
    }
}
