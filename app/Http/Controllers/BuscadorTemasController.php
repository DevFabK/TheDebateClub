<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema;
use App\Models\Debate;

class BuscadorTemasController extends Controller
{
    // Petición AJAX: buscar temas
    public function buscar(Request $request)
    {
        $termino = $request->input('query');

        $temas = Tema::where('titulo', 'like', '%' . $termino . '%')->get();
        $debates = Debate::where('titulo', 'like', '%' . $termino . '%')->get();

        return response()->json([
            'temas' => $temas,
            'debates' => $debates
        ]);
    }

    // Cuando el usuario pincha un tema: redirigir
    public function irAlTema($id)
    {
        $tema = Tema::findOrFail($id);

        return redirect()->route('tema', ['id' => $tema->id]);
    }
}
