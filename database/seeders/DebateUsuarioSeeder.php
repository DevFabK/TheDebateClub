<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebateUsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('debate_usuario')->insert([
            ['usuario_id' => 1, 'debate_id' => 1],
            ['usuario_id' => 2, 'debate_id' => 1],
        ]);
    }
}
