<?php

use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\CoordinacionController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\EstantesController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\ReportesController;
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
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
Route::get('/perfil', [UsuariosController::class, 'index'])->name('perfil');
Route::post('/perfil/actualizar/{id}', [UsuariosController::class, 'actualizarPerfil'])->name('perfil.actualizar');
Route::get('/usuarios', [UsuariosController::class, 'usuarios'])->name('usuarios')->middleware('adm');
Route::get('/usuarios/crear', [UsuariosController::class, 'crear_formulario'])->name('usuarios.crear.formulario')->middleware('adm');
Route::post('/usuarios/guardar', [UsuariosController::class, 'crear'])->name('usuarios.crear')->middleware('adm');
Route::get('/usuarios/vista/{id}', [UsuariosController::class, 'usuarios_vista'])->name('usuarios.actualizar.formulario')->middleware('adm');
Route::post('/usuarios/actualizar/{id}', [UsuariosController::class, 'actualizar_usuario'])->name('usuarios.actualizar')->middleware('adm');
Route::get('/usuarios/borrar/{id}', [UsuariosController::class, 'borrar_usuario'])->name('usuarios.borrar')->middleware('adm');

Route::get('/direccion', [DireccionController::class, 'index'])->name('direccion');
Route::get('/direccion/formulario-crear', [DireccionController::class, 'formulario_crear'])->name('direccion.formulario.crear');
Route::post('/direccion/crear', [DireccionController::class, 'crear'])->name('direccion.crear');
Route::post('/direccion/actualizar/{id}', [DireccionController::class, 'actualizar'])->name('direccion.actualizar');
Route::get('/direccion/borrar/{id}', [DireccionController::class, 'borrar'])->name('direccion.borrar')->middleware('adm');

Route::get('/coordinacion', [CoordinacionController::class, 'index'])->name('coordinacion');
Route::post('/coordinacion/crear', [CoordinacionController::class, 'crear'])->name('coordinacion.crear');
Route::post('/coordinacion/actualizar/{id}', [CoordinacionController::class, 'actualizar'])->name('coordinacion.actualizar');
Route::get('/coordinacion/borrar/{id}', [CoordinacionController::class, 'borrar'])->name('coordinacion.borrar')->middleware('adm');


Route::get('/archivo', [ArchivoController::class, 'index'])->name('archivo');
Route::get('/archivo/periodo/{id}', [ArchivoController::class, 'archivo_periodo'])->name('archivo.periodo');
Route::get('/archivo/crear/formulario', [ArchivoController::class, 'formulario_crear'])->name('archivo.formulario.crear');
Route::post('/archivo/crear/formulario/guardar', [ArchivoController::class, 'crear'])->name('archivo.crear');
Route::get('/archivo/ver/{id}', [ArchivoController::class, 'archivo_ver'])->name('archivo.ver');
Route::get('/archivo/borrar/{id}', [ArchivoController::class, 'borrar'])->name('archivo.borrar')->middleware('adm');
Route::get('/archivo/actualizar-folder/formulario/{id}', [ArchivoController::class, 'formulario_actualizar_folder'])->name('archivo.formulario.folder.actualizar');
Route::post('/archivo/actualizar-folder/actualizar/{id}', [ArchivoController::class, 'actualizar_folder'])->name('archivo.folder.actualizar');

Route::post('/archivo/agregar-detalles/', [ArchivoController::class, 'agregar_detalles'])->name('archivo.detalles.agregar');
Route::post('/archivo/actualizar-detalles/actualizar/{id}', [ArchivoController::class, 'actualizar_detalles'])->name('archivo.detalles.actualizar');
Route::get('/archivo/actualizar-detalles/borrar/{id}', [ArchivoController::class, 'borrar_detalles'])->name('archivo.detalles.borrar')->middleware('adm');

Route::post('/periodo/agregar', [PeriodoController::class, 'agregar'])->name('periodo.agregar')->middleware('adm');
Route::post('/periodo/actualizar{id}', [PeriodoController::class, 'actualizar'])->name('periodo.actualizar')->middleware('adm');
Route::get('/periodo/borrar/{id}', [PeriodoController::class, 'borrar'])->name('periodo.borrar')->middleware('adm');

Route::get('/estantes', [EstantesController::class, 'index'])->name('estantes');
Route::post('/estantes/agregar', [EstantesController::class, 'agregar'])->name('estante.agregar');
Route::post('/estantes/actualizar/{id}', [EstantesController::class, 'actualizar'])->name('estante.actualizar');
Route::get('/estantes/borrar/{id}', [EstantesController::class, 'borrar'])->name('estante.borrar')->middleware('adm');

Route::get('/reportes/general',[ReportesController::class,'index_general'])->name('reporte.general');
Route::get('/reportes/general/consulta/{fecha1}/{fecha2}',[ReportesController::class,'general_consulta'])->name('reporte.general.consulta');
Route::get('/reportes/general/pdf/{fecha1}/{fecha2}',[ReportesController::class,'general_pdf'])->name('reporte.general.pdf');

Route::get('/reportes/direccion',[ReportesController::class,'index_direcciones'])->name('reporte.direccion');
Route::get('/reportes/direccion/consulta/{nombre}/{fecha1}/{fecha2}',[ReportesController::class,'direcciones_consulta'])->name('reporte.direccion.consulta');
Route::get('/reportes/direccion/pdf/{nombre}/{fecha1}/{fecha2}',[ReportesController::class,'direcciones_pdf'])->name('reporte.direccion.pdf');

Route::get('/reportes/coordinacion',[ReportesController::class,'index_coordinaciones'])->name('reporte.coordinacion');
Route::get('/reportes/coordinacion/consulta/{nombre}/{fecha1}/{fecha2}',[ReportesController::class,'coordinaciones_consulta'])->name('reporte.coordinacion.consulta');
Route::get('/reportes/coordinacion/pdf/{nombre}/{fecha1}/{fecha2}',[ReportesController::class,'coordinaciones_pdf'])->name('reporte.coordinacion.pdf');

Route::get('/reportes/etiqueta/{id}',[ReportesController::class,'etiqueta'])->name('reporte.etiqueta.pdf');

Route::get('/menu', [App\Http\Controllers\HomeController::class, 'index'])->name('menu');

});