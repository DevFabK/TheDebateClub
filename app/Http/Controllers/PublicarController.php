<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Argumento;
use App\Models\Debate;
use Illuminate\Http\Request;

class PublicarController extends Controller
{

    public function mostrarPanelCrear()
    {
        return view('crear');
    }

    public function post(Request $request)
    {
        $validacion = $request->validate([
            "argumento-usuario" => 'required|string|min:0|max:255',
            "eleccion"=> 'required|in:debate,argumento'
        ]);

        if($validacion){
            $eleccion = $validacion["eleccion"];
           switch($eleccion){
            case "debate":
                $debate = new Debate();
           } 
        }

    }
}
