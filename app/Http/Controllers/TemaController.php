<?php

namespace App\Http\Controllers;

use App\Models\Tema;

use Illuminate\Http\Request;

class TemaController extends Controller
{
    public function ver($id)
    {
        $tema = Tema::with('debates.argumentos')->findOrFail($id);
        return view('tema', compact('tema'));
    }
}
