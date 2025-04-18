<?php

// app/Http/Controllers/Auth/RegistroController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistroController extends Controller
{
    // Mostrar formulario de registro
    public function mostrarFormularioRegistro()
    {
        return view('auth.register');
    }

    // Registrar un nuevo usuario
    public function registrar(Request $request)
    {
        // Validación y lógica de registro
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }
}

