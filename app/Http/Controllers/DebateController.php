<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema;
use App\Models\Debate;

class DebateController extends Controller
{
    public function obtenerDebatesDestacados()
    {
        $temas = Tema::with(['debates.argumentos.puntuaciones'])
            ->has('debates')
            ->inRandomOrder()
            ->take(3)
            ->get();

        $debatesDestacados = $temas->map(function ($tema) {
            $debate = $tema->debates->sortByDesc('created_at')->first();

            if (!$debate) {
                return null;
            }

            // Calculamos la puntuación total de cada argumento
            $argumentoDestacado = $debate->argumentos->sortByDesc(function ($argumento) {
                return $argumento->puntuaciones->sum('puntuacion');
            })->first();

            // Obtenemos la puntuación total del argumento destacado
            $puntuacionTotal = $argumentoDestacado ? $argumentoDestacado->puntuaciones->sum('puntuacion') : 0;

            return [
                'debate' => $debate,
                'argumentoDestacado' => $argumentoDestacado,
                'puntuacionTotal' => $puntuacionTotal,
            ];
        })->filter();

        return $debatesDestacados->values();
    }

    public function mostrar($id)
    {
        $debate = Debate::with(['tema', 'argumentos.puntuaciones', 'argumentos.usuario'])->findOrFail($id);

        return view('debates', compact('debate'));
    }
}
