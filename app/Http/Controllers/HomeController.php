<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Verifica si el usuario está autenticado
        $isAuthenticated = Auth::check(); 

        // Devuelve la vista de la home con la variable 'isAuthenticated'
        return view('home', compact('isAuthenticated'));
    }
}
