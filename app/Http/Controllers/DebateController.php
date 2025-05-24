<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema;

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
                return $argumento->puntuaciones->sum('puntuacion'); // Asumiendo que el campo puntuación es 'valor'
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
}
