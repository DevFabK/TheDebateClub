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
    public function panel(){
        $usuarios = User::all();
        $argumentos = Argumento::all();
        $temas = Tema::all();
        $debates = Debate::all();
        $roles = Rol::all();

        return view('admin', compact('usuarios', 'argumentos', 'temas', 'debates', 'roles'));
    }
}
