<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Estante;
use Exception;
use Illuminate\Http\Request;

class EstantesController extends Controller
{

    public function index(){
        $estantes = Estante::withCount(['Archivos'])->paginate(5);
       /*  $estantes = Estante::paginate(5); */
       /*  dd($estantes); */
       return view('estantes.principal',compact('estantes'));
    }
    public function agregar(Request $request)
    {
        /* dd($request->all()); */
        if ($request->all()) {
            try {

                Estante::create([
                    'codigo' => $request->input('codigo'),
                    'numero' => $request->input('numero'),
                    'descripcion' => $request->input('descripcion'),
                ]);
                return redirect()->back()->with(['excelente' => 'Dato agregado correctamente.']);
            } catch (Exception $e) {
                return redirect()->back()->with(['error' => 'algo ocurrió.']);
            }
        }
        return redirect()->back()->with(['error' => 'Datos no enviados.']);
    }
    public function actualizar(Request $request,$id)
    {
        if ($request->all()) {
            try {
                $dato = Estante::find($id);
                $dato->codigo = $request->input('codigo');
                $dato->numero = $request->input('numero');
                $dato->descripcion = $request->input('descripcion');
                $dato->save();
                return redirect()->back()->with(['excelente' => 'Dato actualizado correctamente.']);
            } catch (Exception $e) {
                return redirect()->back()->with(['error' => 'algo ocurrió.']);
            }
        }
        return redirect()->back()->with(['error' => 'Datos no enviados.']);
    }
    public function borrar($id)
    {
        try {
            $datos = Estante::find($id);
            $datos->delete();

            return response()->json(['msg'=> 'excelente']);
        } catch (Exception $e) {
            return response()->json(['msg'=>$e]);
        }
    }
}
