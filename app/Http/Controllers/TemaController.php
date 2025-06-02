<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Argumento;

use Illuminate\Http\Request;

class TemaController extends Controller
{
    public function ver($id)
    {
        $tema = Tema::with('debates.argumentos')->findOrFail($id);
        return view('tema', compact('tema'));
    }

    public function borrarArgumento($id)
    {
        $argumento = Argumento::findOrFail($id);

        // Comprobar si el usuario es moderador
        if (!auth()->check() || auth()->user()->rol->nombre !== 'Moderador') {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }

        $argumento->delete();

        return redirect()->back()->with('success', 'Argumento eliminado correctamente.');
    }
}
