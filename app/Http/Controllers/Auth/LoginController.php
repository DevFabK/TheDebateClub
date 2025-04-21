<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar formulario de login
    public function mostrarFormularioLogin()
    {
        return view('auth.login');
    }

    // Validar usuario y hacer login
    public function login(Request $request)
    {
        // Validación con mensajes personalizados
        $request->validate([
            'nombre' => 'required|string',
            'password' => 'required|string|min:8',
        ], [
            'nombre.required' => 'El nombre de usuario es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        // Buscar usuario por nombre
        $user = User::where('nombre', $request->nombre)->first();

        if (!$user) {
            return back()->withErrors(['nombre' => 'El usuario no existe'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'La contraseña es incorrecta'])->withInput();
        }

        // Hacer login manualmente si pasó las comprobaciones
        Auth::login($user);

        return redirect()->route('home'); // Redirigir a la página principal
    }

    // Función para entrar como invitado
    public function entrarComoInvitado()
    {
        Auth::logout(); // Aseguramos que no haya un usuario autenticado
        return redirect()->route('home'); // Redirigir a la home
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
