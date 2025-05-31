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
        $temas = Tema::with('usuario')->get();
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

    public function temas()
    {
        $temas = Tema::with('usuario')->get();
        $usuarios = User::all();
        return view('admin.temas', compact('temas', 'usuarios'));
    }

    // Crear un nuevo tema
    public function crearTema(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'usuario_id' => 'nullable|exists:users,id',
        ]);

        Tema::create($request->only('titulo', 'descripcion', 'usuario_id'));

        return redirect()->to(route('panel') . '#temas')->with('success', 'Tema creado correctamente.');
    }

    // Actualizar un tema
    public function actualizarTema(Request $request, Tema $tema)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'usuario_id' => 'nullable|exists:users,id',
        ]);

        $tema->update($request->only('titulo', 'descripcion', 'usuario_id'));

        return redirect()->to(route('panel') . '#temas')->with('success', 'Tema actualizado correctamente.');
    }

    // Eliminar un tema
    public function eliminarTema(Tema $tema)
    {
        $tema->delete();

        return redirect()->to(route('panel') . '#temas')->with('success', 'Tema eliminado correctamente.');
    }

    // Mostrar lista de debates
    public function debates()
    {
        $debates = Debate::with(['tema', 'usuario'])->get();
        $temas = Tema::all();
        $usuarios = User::all();
        return view('admin.debates', compact('debates', 'temas', 'usuarios'));
    }

    // Actualizar debate
    public function actualizarDebate(Request $request, Debate $debate)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tema_id' => 'required|exists:temas_debates,id',
            'usuario_id' => 'nullable|exists:users,id',
        ]);

        $debate->update($request->only('titulo', 'descripcion', 'tema_id', 'usuario_id'));

        return redirect()->route('panel', ['#debates'])->with('success', 'Debate actualizado correctamente.');
    }

    // Eliminar debate
    public function eliminarDebate(Debate $debate)
    {
        $debate->delete();

        return redirect()->to(route('panel') . '#debates')->with('success', 'Debate eliminado correctamente.');
    }

    // Mostrar lista de argumentos
    public function argumentos()
    {
        $argumentos = Argumento::with(['debate', 'usuario'])->get();
        $debates = Debate::all();
        $usuarios = User::all();
        return view('admin.argumentos', compact('argumentos', 'debates', 'usuarios'));
    }

    // Actualizar argumento
    public function actualizarArgumento(Request $request, Argumento $argumento)
    {
        $request->validate([
            'contenido' => 'required|string',
            'postura' => 'required|in:A favor,Parcialmente a favor,Neutral,Parcialmente en contra,En contra',
            'debate_id' => 'required|exists:debates,id',
            'usuario_id' => 'required|exists:users,id',
        ]);

        $argumento->update($request->only('contenido', 'postura', 'debate_id', 'usuario_id'));

        return redirect()->route('panel', ['#argumentos'])->with('success', 'Argumento actualizado correctamente.');
    }

    // Eliminar argumento
    public function eliminarArgumento(Argumento $argumento)
    {
        $argumento->delete();

        return redirect()->to(route('panel') . '#argumentos')->with('success', 'Argumento eliminado correctamente.');
    }
}
