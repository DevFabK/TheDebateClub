<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            TemasSeeder::class,
            DebatesSeeder::class,
            ArgumentosSeeder::class,
            PuntuacionesSeeder::class,
            DebateUsuarioSeeder::class,
        ]);
    }
}
