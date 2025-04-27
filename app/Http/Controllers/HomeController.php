<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema;
use App\Http\Controllers\DebateController;

class HomeController extends Controller
{
    public function index(DebateController $debateController)
    {
        // Obtener los temas
        $temasArray = Tema::all();

        // Obtener los debates destacados a través de DebateController
        $debatesDestacados = $debateController->obtenerDebatesDestacados();

        // Pasar datos a la vista
        return view('home', compact('temasArray', 'debatesDestacados'));
    }
}
