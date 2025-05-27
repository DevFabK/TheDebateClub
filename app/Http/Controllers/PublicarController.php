<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Argumento;
use App\Models\Debate;
use App\Models\Tema;
use Illuminate\Http\Request;

class PublicarController extends Controller
{
    public function mostrarPanelCrear()
    {
        $temas = Tema::all();
        $debates = Debate::all();
        return view('crear', compact('temas', 'debates'));
    }

    public function post(Request $request)
    {
        $eleccion = $request->input('eleccion');

        if ($eleccion === 'debate') {
            $datosValidados = $request->validate([
                'eleccion' => 'required|in:debate,argumento',
                'texto-usuario' => 'required|max:255',
                'titulo-debate' => 'required|string|max:255',
                'tema_id' => 'required|exists:temas_debates,id',
            ], [
                'eleccion.required' => 'Selecciona qué quieres crear.',
                'texto-usuario.required' => 'Has de rellenar la caja de texto.',
                'texto-usuario.max' => 'Solo puedes escribir 255 carácteres.',
                'titulo-debate.required' => 'Has de ponerle un nombre al debate.',
                'tema_id.required' => 'Es necesario que elijas un tema para el debate.',
            ]);

            $debate = new Debate();
            $debate->titulo = $datosValidados['titulo-debate'];
            $debate->descripcion = $datosValidados['texto-usuario'];
            $debate->tema_id = $datosValidados['tema_id'];
            $debate->usuario_id = Auth::id();
            $debate->save();

            return redirect()->route('home')->with('exito', 'Debate creado correctamente.');
        } elseif ($eleccion === 'argumento') {
            $datosValidados = $request->validate([
                'eleccion' => 'required|in:debate,argumento',
                'texto-usuario' => 'required|max:255',
                'debate_id' => 'required|exists:debates,id',
            ], [
                'eleccion.required' => 'Selecciona qué quieres crear.',
                'texto-usuario.required' => 'Has de rellenar la caja de texto.',
                'texto-usuario.max' => 'Solo puedes escribir 255 carácteres.',
                'debate_id.required' => 'Has de seleccionar un debate al que añadir el argumento.',
            ]);

            $argumento = new Argumento();
            $argumento->contenido = $datosValidados['texto-usuario'];
            $argumento->debate_id = $datosValidados['debate_id'];
            $argumento->usuario_id = Auth::id();
            $argumento->postura = $request->input('postura', 'Neutral'); 

            $argumento->save();

            return redirect()->route('home')->with('exito', 'Argumento publicado correctamente.');
        } elseif ($eleccion === 'tema') {
            $datosValidados = $request->validate([
                'eleccion' => 'required|in:debate,argumento,tema',
                'texto-usuario' => 'required|max:255',   
                'titulo-tema' => 'required|string|max:255',
            ], [
                'eleccion.required' => 'Selecciona qué quieres crear.',
                'texto-usuario.required' => 'Has de rellenar la caja de texto.',
                'texto-usuario.max' => 'Solo puedes escribir 255 carácteres.',
                'titulo-tema.required' => 'Has de ponerle un nombre al tema.',
            ]);

            $tema = new Tema();
            $tema->titulo = $datosValidados['titulo-tema'];
            $tema->descripcion = $datosValidados['texto-usuario'];  
            $tema->usuario_id = Auth::id();
            $tema->save();

            return redirect()->route('home')->with('exito', 'Tema creado correctamente.');
        }

        return redirect()->back()->withErrors(['eleccion' => 'Opción no válida.']);
    }
}
