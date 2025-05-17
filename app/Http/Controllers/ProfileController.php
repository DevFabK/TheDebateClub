<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Argumento;
class ProfileController extends Controller
{
    public function mostrarPerfil()
    {
        $user = Auth::user();
        $temasParticipados = $user->argumentos()
        ->with('debate.tema')
        ->get()
        ->pluck('debate.tema')
        ->unique('id');
        // dd($temasParticipados);
        $mejorArgumento = Argumento::join('puntuaciones', 'argumentos.id', '=', 'puntuaciones.argumento_id')
        ->where('argumentos.usuario_id', $user->id)
        ->orderByDesc('puntuaciones.puntuacion')
        ->select('argumentos.*') 
        ->first();
        
        return view('perfil', compact('user', 'temasParticipados', 'mejorArgumento'));
    }
}
