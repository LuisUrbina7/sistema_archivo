<?php

use App\Http\Controllers\CoordinacionController;
use App\Http\Controllers\DireccionController;
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

Route::get('/direccion',[DireccionController::class,'index'])->name('direccion');
Route::get('/direccion/formulario-crear',[DireccionController::class,'formulario_crear'])->name('direccion.formulario.crear');
Route::post('/direccion/crear',[DireccionController::class,'crear'])->name('direccion.crear');
Route::post('/direccion/actualizar/{id}',[DireccionController::class,'actualizar'])->name('direccion.actualizar');
Route::get('/direccion/borrar/{id}',[DireccionController::class,'borrar'])->name('direccion.borrar');

Route::get('/coordinacion',[CoordinacionController::class,'index'])->name('coordinacion');
Route::post('/coordinacion/crear',[CoordinacionController::class,'crear'])->name('coordinacion.crear');
Route::post('/coordinacion/actualizar/{id}',[CoordinacionController::class,'actualizar'])->name('coordinacion.actualizar');
Route::get('/coordinacion/borrar/{id}',[CoordinacionController::class,'borrar'])->name('coordinacion.borrar');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
