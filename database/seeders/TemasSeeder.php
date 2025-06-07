<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class TemasSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener IDs de usuarios con rol de Admin (rol_id = 1)
        $admins = DB::table('users')->where('rol_id', 1)->pluck('id')->toArray();

        // Si no hay admins, no hacer nada
        if (empty($admins)) {
            return;
        }

        $temas = [
            'Tecnología y conciencia' => '¿Puede la conciencia humana replicarse en máquinas?',
            'El culto a la fama' => '¿Por qué idolatramos a personas sin mérito real?',
            'Inteligencia vs poder' => '¿Por qué el poder rara vez está en manos de los más sabios?',
            'Libertad de expresión vs desinformación' => '¿Dónde está el límite entre decir lo que piensas y propagar falsedades?',
            'El impacto de la tecnología en la empatía' => '¿Nos están volviendo más fríos las redes sociales?',
            'Ciencia y fe en la sociedad actual' => '¿Pueden convivir la ciencia y la espiritualidad en el pensamiento moderno?',
            '¿Somos verdaderamente libres?' => '¿Hasta qué punto nuestras decisiones son realmente nuestras?',
            'La inteligencia artificial y la ética' => '¿Debe una IA tener derechos?',
            'La banalidad del contenido viral' => '¿Por qué lo superficial domina los medios?',
            'La educación como motor de cambio' => '¿Qué pasa si educamos para cuestionar y no solo para obedecer?',
            'Cambio climático' => '¿Estamos a tiempo de salvar el planeta?',
            'Economía digital' => 'El futuro del dinero y la desaparición del efectivo.',
        ];

        foreach ($temas as $titulo => $descripcion) {
            DB::table('temas_debates')->insert([
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'usuario_id' => Arr::random($admins),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
