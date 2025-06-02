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
use App\Http\Controllers\PublicarController;
use App\Http\Controllers\AdminController;
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
Route::get('/tema/{id}', [TemaController::class, 'ver'])->name('tema.ver');

// Funcion de las estrellas
Route::get('/estrellas', [ArgumentoController::class, 'estrellas'])->name('estrellas');
Route::post('/estrellas', [ArgumentoController::class, 'guardarEstrella'])
    ->middleware('auth')
    ->name('estrellas.guardar');

// Editar el perfil
Route::get('/perfil/editar', [ProfileController::class, 'mostrarPerfil'])->name('perfil.edit');
Route::put('/perfil/editar', [ProfileController::class, 'update'])->name('perfil.update');

Route::get('/debate/{id}', [DebateController::class, 'mostrar'])->name('debate');

Route::get('/admin', [AdminController::class, 'panel'])->name('panel');

// USUARIOS (panel de administración)
Route::get('/admin/usuarios/{user}/editar', [AdminController::class, 'editarUsuario'])->name('admin.usuarios.editar');
Route::put('/admin/usuarios/{user}', [AdminController::class, 'actualizarUsuario'])->name('admin.usuarios.actualizar');
Route::delete('/admin/usuarios/{user}', [AdminController::class, 'eliminarUsuario'])->name('admin.usuarios.eliminar');

// TEMAS (panel de administración)
Route::get('/admin/temas', [AdminController::class, 'temas'])->name('admin.temas.index');
Route::put('/admin/temas/{tema}', [AdminController::class, 'actualizarTema'])->name('admin.temas.actualizar');
Route::delete('/admin/temas/{tema}', [AdminController::class, 'eliminarTema'])->name('admin.temas.eliminar');

// DEBATES (panel de administración)
Route::get('/admin/debates', [AdminController::class, 'debates'])->name('admin.debates.index');
Route::put('/admin/debates/{debate}', [AdminController::class, 'actualizarDebate'])->name('admin.debates.actualizar');
Route::delete('/admin/debates/{debate}', [AdminController::class, 'eliminarDebate'])->name('admin.debates.eliminar');

// ARGUMENTOS (panel de administración)
Route::get('/admin/argumentos', [AdminController::class, 'argumentos'])->name('admin.argumentos.index');
Route::put('/admin/argumentos/{argumento}', [AdminController::class, 'actualizarArgumento'])->name('admin.argumentos.actualizar');
Route::delete('/admin/argumentos/{argumento}', [AdminController::class, 'eliminarArgumento'])->name('admin.argumentos.eliminar');
