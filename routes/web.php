<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// PRIMERA PAGINA (LOGIN)
Route::get('/', [LoginController::class, 'mostrarFormularioLogin']);

// REGISTRO
Route::get('/registro', [RegistroController::class, 'mostrarFormularioRegistro'])->name('registro');
Route::post('/registro', [RegistroController::class, 'registrar']);

// LOGIN
Route::get('/login', [LoginController::class, 'mostrarFormularioLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// LOGOUT
Route::get('/logout', function () {
    Auth::logout(); // Cerrar la sesión
    return redirect()->route('login'); // Redirigir a la página de login
})->name('logout');

// MOSTRAR LOS TEMAS EN HOME
Route::get('/home', [HomeController::class, 'index'])->name('home');

// PERFIL
Route::get('/perfil', function(){
    return view('perfil');
})->name('perfil');
