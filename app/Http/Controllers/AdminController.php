<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use App\Models\Tema;
use App\Models\Debate;
use App\Models\Argumento;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Muestra el panel principal con todas las tablas cargadas
    public function panel()
    {
        $usuarios = User::with('rol')->get();
        $roles = Rol::all();
        $temas = Tema::with('usuario')->get();
        $debates = Debate::with(['usuario', 'tema'])->get();
        $argumentos = Argumento::with(['usuario', 'debate'])->get();

        return view('admin', compact('usuarios', 'roles', 'temas', 'debates', 'argumentos'));
    }

    // -------- USUARIOS --------

    public function editarUsuario(User $user)
    {
        $roles = Rol::all();
        return view('admin.usuarios.editar', compact('user', 'roles'));
    }

    public function actualizarUsuario(Request $request, User $user)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'rol_id' => 'nullable|exists:roles,id',
            'password' => 'nullable|string|min:6|confirmed',
            'foto_perfil' => 'nullable|image|max:2048',
            'puntos_de_debate' => 'nullable|integer',
        ]);

        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('public/fotos_perfil');
            $validated['foto_perfil'] = basename($path);
        }

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->to(route('panel') . '#usuarios')->with('success', 'Usuario actualizado correctamente.');
    }

    public function eliminarUsuario(User $user)
    {
        $user->delete();
        return redirect()->to(route('panel') . '#usuarios')->with('success', 'Usuario eliminado correctamente.');
    }

    // -------- TEMAS --------

    public function temas()
    {
        $temas = Tema::with('usuario')->get();
        $usuarios = User::all();
        return view('admin.temas.index', compact('temas', 'usuarios'));
    }

    public function actualizarTema(Request $request, Tema $tema)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $tema->update($validated);

        return redirect()->to(route('panel') . '#temas')->with('success', 'Tema actualizado correctamente.');
    }

    public function eliminarTema(Tema $tema)
    {
        $tema->delete();
        return redirect()->to(route('panel') . '#temas')->with('success', 'Tema eliminado correctamente.');
    }

    // -------- DEBATES --------

    public function debates()
    {
        $debates = Debate::with(['usuario', 'tema'])->get();
        $usuarios = User::all();
        $temas = Tema::all();
        return view('admin.debates.index', compact('debates', 'usuarios', 'temas'));
    }

    public function actualizarDebate(Request $request, Debate $debate)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'usuario_id' => 'nullable|exists:users,id',
            'tema_id' => 'nullable|exists:temas_debates,id',
        ]);

        $debate->update($validated);

        return redirect()->to(route('panel') . '#debates')->with('success', 'Debate actualizado correctamente.');
    }

    public function eliminarDebate(Debate $debate)
    {
        $debate->delete();
        return redirect()->to(route('panel') . '#debates')->with('success', 'Debate eliminado correctamente.');
    }

    // -------- ARGUMENTOS --------

    public function argumentos()
    {
        $argumentos = Argumento::with(['usuario', 'debate'])->get();
        $usuarios = User::all();
        $debates = Debate::all();
        return view('admin.argumentos.index', compact('argumentos', 'usuarios', 'debates'));
    }

    public function actualizarArgumento(Request $request, Argumento $argumento)
    {
        $validated = $request->validate([
            'contenido' => 'required|string',
            'postura' => 'required|string|in:A favor,Parcialmente a favor,Neutral,Parcialmente en contra,En contra',
            'usuario_id' => 'nullable|exists:users,id',
            // No se permite cambiar el debate aquí para evitar incoherencias,
            //'debate_id' => 'nullable|exists:debates,id',
        ]);

        $argumento->update($validated);

        return redirect()->to(route('panel') . '#argumentos')->with('success', 'Argumento actualizado correctamente.');
    }

    public function eliminarArgumento(Argumento $argumento)
    {
        $argumento->delete();
        return redirect()->to(route('panel') . '#argumentos')->with('success', 'Argumento eliminado correctamente.');
    }
}
