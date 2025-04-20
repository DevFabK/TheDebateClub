<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('login');
});

// REGISTRO
Route::get('/registro', [RegistroController::class, 'mostrarFormularioRegistro'])->name('registro');
Route::post('/registro', [RegistroController::class, 'registrar']);

// LOGIN
Route::get('/login', [LoginController::class, 'mostrarFormularioLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// HOME
Route::get('/home', function () {
    return view('home');
})->name('home');

// LOGOUT
Route::get('/logout', function () {
    Auth::logout(); // Cerrar la sesión
    return redirect()->route('login'); // Redirigir a la página de login
})->name('logout');
