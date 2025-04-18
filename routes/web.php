<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistroController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/registro', [RegistroController::class, 'mostrarFormularioRegistro'])->name('registro');
Route::post('/registro', [RegistroController::class, 'registrar']);

