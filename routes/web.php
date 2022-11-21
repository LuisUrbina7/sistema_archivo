<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/perfil', [UsuariosController::class, 'index'])->name('perfil');
     Route::post('/perfil/actualizar/{id}', [UsuariosController::class, 'actualizarPerfil'])->name('perfil.actualizar');
     Route::get('/usuarios', [UsuariosController::class, 'usuarios'])->name('usuarios');
     Route::get('/usuarios/crear', [UsuariosController::class, 'crear_formulario'])->name('usuarios.crear.formulario');
     Route::post('/usuarios/guardar', [UsuariosController::class, 'crear'])->name('usuarios.crear');
     Route::get('/usuarios/vista/{id}', [UsuariosController::class, 'usuarios_vista'])->name('usuarios.actualizar.formulario');
     Route::post('/usuarios/actualizar/{id}', [UsuariosController::class, 'actualizar_usuario'])->name('usuarios.actualizar');
     Route::get('/usuarios/borrar/{id}', [UsuariosController::class, 'borrar_usuario'])->name('usuarios.borrar');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
