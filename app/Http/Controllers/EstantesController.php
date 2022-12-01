<?php

namespace App\Http\Controllers;

use App\Models\Estante;
use Exception;
use Illuminate\Http\Request;

class EstantesController extends Controller
{

    public function index(){
        $estantes = Estante::withCount(['archivos'])->get();
        dd($estantes);
       return view('estantes.principal');
    }
    public function agregar(Request $request)
    {

        if ($request->all()) {
            try {

                Estante::create([
                    'periodo' => $request->input('periodo'),
                    'regidor' => $request->input('regidor'),
                    'partido' => $request->input('partido'),
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
                $dato->periodo = $request->input('periodo');
                $dato->regidor = $request->input('regidor');
                $dato->partido = $request->input('partido');
                $dato->save();
                return redirect()->back()->with(['excelente' => 'Dato agregado correctamente.']);
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
