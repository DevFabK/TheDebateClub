<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\DebateController;
use App\Http\Controllers\BuscadorTemasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArgumentoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PublicarController;

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

Route::get('/obtenerDebatesDestacados', [HomeController::class, 'destacados']);

// PERFIL
Route::get('/perfil', [ProfileController::class, 'mostrarPerfil'])
    ->middleware('auth')
    ->name('perfil');

// Ruta para AJAX de búsqueda
Route::post('/buscar-temas', [BuscadorTemasController::class, 'buscar']);

// Ruta para redirigir al tema
Route::get('/tema/{id}', [BuscadorTemasController::class, 'irAlTema'])->name('tema');

// Publicar
Route::get('/crear', [PublicarController::class, 'mostrarPanelCrear'])->middleware('auth')->name('crear');
Route::post('/crear', [PublicarController::class, 'post'])->middleware('auth')->name('crear.post');

// Ver un tema 
Route::get('/tema/{id}', [TemaController::class, 'ver'])
    ->middleware('auth')
    ->name('tema.ver');

// Funcion de las estrellas
Route::get('/estrellas', [ArgumentoController::class, 'estrellas'])->name('estrellas');
Route::post('/estrellas', [ArgumentoController::class, 'guardarEstrella'])
    ->middleware('auth')
    ->name('estrellas.guardar');

// Editar el perfil
Route::get('/perfil/editar', [ProfileController::class, 'mostrarPerfil'])->name('perfil.edit');
Route::put('/perfil/editar', [ProfileController::class, 'update'])->name('perfil.update');

Route::get('/debate/{id}', [DebateController::class, 'mostrar'])->name('debate');
