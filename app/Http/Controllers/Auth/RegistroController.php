<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    // Mostrar formulario de registro
    public function mostrarFormularioRegistro()
    {
        return view('auth.registro');
    }

    // Registrar un nuevo usuario
    public function registrar(Request $request)
    {
        // Validación con mensajes personalizados
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|email|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Introduce un email válido.',
            'email.unique' => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        // Crear usuario
        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => 3,
            'foto_perfil' => 'storage/imagenes/perfil/default.jpg',
        ]);

        return redirect()->route('login')->with('success', 'Cuenta registrada correctamente.');
    }
}
