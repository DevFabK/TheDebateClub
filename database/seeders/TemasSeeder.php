<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('temas_debates')->insert([
            ['titulo' => 'Tecnología y conciencia', 'descripcion' => '¿Puede la conciencia humana replicarse en máquinas?'],
            ['titulo' => 'El culto a la fama', 'descripcion' => '¿Por qué idolatramos a personas sin mérito real?'],
            ['titulo' => 'Inteligencia vs poder', 'descripcion' => '¿Por qué el poder rara vez está en manos de los más sabios?'],
            ['titulo' => 'Libertad de expresión vs desinformación', 'descripcion' => '¿Dónde está el límite entre decir lo que piensas y propagar falsedades?'],
            ['titulo' => 'El impacto de la tecnología en la empatía', 'descripcion' => '¿Nos están volviendo más fríos las redes sociales?'],
            ['titulo' => 'Ciencia y fe en la sociedad actual', 'descripcion' => '¿Pueden convivir la ciencia y la espiritualidad en el pensamiento moderno?'],
            ['titulo' => '¿Somos verdaderamente libres?', 'descripcion' => '¿Hasta qué punto nuestras decisiones son realmente nuestras?'],
            ['titulo' => 'La inteligencia artificial y la ética', 'descripcion' => '¿Debe una IA tener derechos?'],
            ['titulo' => 'La banalidad del contenido viral', 'descripcion' => '¿Por qué lo superficial domina los medios?'],
            ['titulo' => 'La educación como motor de cambio', 'descripcion' => '¿Qué pasa si educamos para cuestionar y no solo para obedecer?'],
            ['titulo' => 'Cambio climático', 'descripcion' => '¿Estamos a tiempo de salvar el planeta?'],
            ['titulo' => 'Economía digital', 'descripcion' => 'El futuro del dinero y la desaparición del efectivo.'],
        ]);
    }
}
