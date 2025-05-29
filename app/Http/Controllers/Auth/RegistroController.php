<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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
            'nombre' => 'required|string|max:30',
            'email' => 'required|string|email|max:60|unique:users',
            'password' => 'required|string|min:8|max:30|confirmed',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El maximo de carácteres para el nombre son 30.',
            'email.required' => 'El email es obligatorio.',
            'email.max' => 'El maximo de carácteres para el email es de 60.',
            'email.email' => 'Introduce un email válido.',
            'email.unique' => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.max' => 'El maximo de carácteres para la contraseña son 30.',
        ]);

        // Crear usuario
        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => 3,
        ]);

        return redirect()->route('login')->with('success', 'Cuenta registrada correctamente.');
    }

    // Función para entrar como invitado
    public function entrarComoInvitado()
    {
        // Similar al LoginController, simplemente redirigimos sin loguear a nadie
        Auth::logout(); // Aseguramos que no haya un usuario autenticado
        return redirect()->route('home'); // Redirigir a la home
    }
}
