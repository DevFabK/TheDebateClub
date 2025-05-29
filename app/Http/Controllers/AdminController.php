<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Argumento;
use App\Models\Tema;
use App\Models\Debate;
use App\Models\Rol;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function panel()
    {
        $usuarios = User::all();
        $argumentos = Argumento::all();
        $temas = Tema::all();
        $debates = Debate::all();
        $roles = Rol::all();

        return view('admin', compact('usuarios', 'argumentos', 'temas', 'debates', 'roles'));
    }

    public function editarUsuario(User $user)
    {
        return view('admin.usuarios.editar', compact('user'));
    }

    public function actualizarUsuario(Request $request, User $user)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $user->id . '|max:255',
            'password' => 'nullable|string|min:8',
            'foto_perfil' => 'nullable|image|max:2048',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Introduce un email válido.',
            'email.unique' => 'Este email ya está registrado.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

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

        return redirect()->route('panel')->with('success', 'Usuario actualizado correctamente.');
    }
    
    public function eliminarUsuario(User $user)
    {
        $user->delete();
        return redirect()->route('panel')->with('success', 'Usuario eliminado correctamente.');
    }
}
