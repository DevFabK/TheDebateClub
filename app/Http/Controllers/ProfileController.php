<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Argumento;

class ProfileController extends Controller
{
    public function mostrarPerfil()
    {
        $user = Auth::user();
        $temasParticipados = $user->argumentos() // Da error pero no afecta. Funciona correctamente.
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

    public function edit()
    {
        $user = auth()->user();
        return view('perfil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate(
            [
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email,' . $user->id . '|max:255',
                'password' => 'nullable|string|min:8',
                'foto_perfil' => 'nullable|image|max:2048',
            ],
            [
                'nombre.required' => 'El nombre es obligatorio.',
                'email.required' => 'El email es obligatorio.',
                'email.email' => 'Introduce un email válido.',
                'email.unique' => 'Este email ya está registrado.',
                'password.required' => 'La contraseña es obligatoria.',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            ]
        );

        $user->nombre = $request->nombre;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('foto_perfil')) {
            $ruta = $request->file('foto_perfil')->store('fotos_perfil', 'public');
            $user->foto_perfil = $ruta;
        }

        $user->save();

        return redirect()->route('perfil.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
