<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Archivos_detalles;
use App\Models\Coordinacion;
use App\Models\Direccion;
use App\Models\Estante;
use App\Models\Periodo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArchivoController extends Controller
{
    public function index()
    {
        $archivos = Archivo::orderby('id', 'desc')->get();
        return view('archivo.principal', compact('archivos'));
    }
    public function archivo_periodo($id)
    {
      
        $archivos = Archivo::where('periodo',$id)->orderby('id', 'desc')->get();
        return view('archivo.principal_periodo', compact('archivos'));
    }
    public function archivo_ver($id)
    {
        $folder = Archivo::find($id);
        $folder_detalles = Archivos_detalles::where('referencia', $id)->get();
        return view('archivo.archivo_ver', compact('folder', 'folder_detalles'));
    }
    public function formulario_crear()
    {
        $direcciones = Direccion::select('id', 'direccion')->get();
        $coordinaciones = Coordinacion::select('id', 'coordinacion')->get();
        $estantes = Estante::select('id', 'numero')->get();
        $periodos = Periodo::select('id', 'periodo', 'regidor')->orderBy('id', 'desc')->get();

        $archivos = Archivo::select('folder')->latest('folder')->first();

        $indice = [ 'folder' => 1];
        if ($archivos) {
            $indice = [ 'folder' => $archivos->folder + 1];
        }
          
        return view('archivo.agregar_archivo', compact('direcciones', 'coordinaciones', 'indice', 'periodos', 'estantes'));
    }


    public function crear(Request $request)
    {

        /* dd($request->input('periodo')); */

        $validator  = Validator::make($request->all(), [
            'direccion' => ['required'],
            'coordinacion' => ['required'],
            'año' => ['required'],
            'responsable' => ['required', 'max:255'],
            'recibido' => ['required'],
            'folder' => ['required'],
            'fecha' => ['required', 'max:255'],
            'periodo' => ['required'],
            'estante' => ['required'],
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors());
        }
        try {

            Archivo::create([
                'direccion' => $request->input('direccion'),
                'coordinacion' => $request->input('coordinacion'),
                'instituto' => $request->input('instituto'),
                'año' => $request->input('año'),
                'folder' => $request->input('folder'),
                'responsable' => $request->input('responsable'),
                'recibido' => Auth::user()->id,
                'fecha' => $request->date('fecha'),
                'color' => $request->input('color'),
                'observaciones' => $request->input('observaciones'),
                'estante' => $request->input('estante'),
                'periodo' => $request->input('periodo'),
            ]);
            $indice = Archivo::select('id')->latest('id')->first()->toArray();

            for ($x = 0; $x < count($request->input('documento')); $x++) {

                Archivos_detalles::create([
                    'referencia' => $indice['id'],
                    'documento' => $request->input('documento')[$x],
                    'folios' => $request->input('folios')[$x],
                    'solicitud' => $request->input('solicitud')[$x],
                    'ap' => $request->input('ap')[$x],
                ]);
            }

            return redirect()->back()->with(['excelente' => 'Archivo agregado correctamente.']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Algo salió mal.']);
        }
    }

    public function borrar($id)
    {
        try {

            $borrado = Archivo::find($id);
            $borrado->delete();
            return response()->json(['msg' => 'excelente']);
        } catch (Exception $e) {
            return response()->json(['msg' => $e]);
        }
    }

    public function formulario_actualizar_folder($id)
    {
        $folder = Archivo::find($id);
        $estantes = Estante::select('id', 'numero')->get();
        $periodos = Periodo::select('id', 'periodo', 'regidor')->orderBy('id', 'desc')->get();
        $direcciones = Direccion::select('id', 'direccion')->get();
        $coordinaciones = Coordinacion::select('id', 'coordinacion')->get();
        return view('archivo.actualizar_folder', compact('folder', 'direcciones', 'coordinaciones','estantes','periodos'));
    }
    public function actualizar_folder(Request $request, $id)
    {
        $validator  = Validator::make($request->all(), [
            'direccion' => ['required'],
            'año' => ['required'],
            'responsable' => ['required', 'max:255'],
            'recibido' => ['required'],
            'folder' => ['required'],
            'fecha' => ['required', 'max:255'],
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors());
        }

        try {

            $folder = Archivo::find($id);

            $folder->direccion = $request->input('direccion');
            $folder->coordinacion = $request->input('coordinacion');
            $folder->instituto = $request->input('instituto');
            $folder->año = $request->input('año');
            $folder->folder = $request->input('folder');
            $folder->responsable = $request->input('responsable');
            $folder->fecha = $request->date('fecha');
            $folder->color = $request->input('color');
            $folder->observaciones = $request->input('observaciones');
            $folder->estante = $request->input('estante');
            $folder->periodo = $request->input('periodo');
            $folder->save();

            return redirect()->back()->with(['excelente' => 'Archivo actualizado correctamente.']);
        } catch (Exception $e) {
            return $e;
        }
    }


    public function agregar_detalles(Request $request)
    {

        try {

            Archivos_detalles::create([
                'referencia' => $request->input('referencia'),
                'documento' => $request->input('documento'),
                'folios' => $request->input('folios'),
                'solicitud' => $request->input('solicitud'),
                'ap' => $request->input('ap'),
            ]);
            return redirect()->back()->with(['excelente' => 'Detalle agregado correctamente.']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'ocurrió algo en la carga.']);
        }
    }
    public function actualizar_detalles(Request $request, $id)
    {

        try {
            $detalles = Archivos_detalles::find($id);

            $detalles->documento = $request->input('documento');
            $detalles->folios = $request->input('folios');
            $detalles->solicitud = $request->input('solicitud');
            $detalles->ap = $request->input('ap');
            $detalles->save();
            return redirect()->back()->with(['excelente' => 'Detalles actualizado correctamente.']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'ocurrió algo en la actualización de archivos.']);
        }
    }
    public function borrar_detalles($id)
    {

        try {
            $detalles = Archivos_detalles::find($id);
            $detalles->delete();
            return response()->json(['msg' => 'excelente']);
        } catch (Exception $e) {
            return response()->json(['msg' => 'error']);
        }
    }
}
