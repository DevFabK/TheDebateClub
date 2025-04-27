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

            $argumentoDestacado = $debate->argumentos->sortByDesc(function ($argumento) {
                return $argumento->puntuaciones->count();
            })->first();

            return [
                'debate' => $debate,
                'argumentoDestacado' => $argumentoDestacado,
            ];
        })->filter();

        return $debatesDestacados;
    }
}
