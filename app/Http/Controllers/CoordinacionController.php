<?php

namespace App\Http\Controllers;

use App\Models\Coordinacion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoordinacionController extends Controller
{
    public function index()
    {
        $coordinaciones = Coordinacion::orderBy('id', 'desc')->paginate('4');
        return view('coordinacion.principal', compact('coordinaciones'));
    }


    public function crear(Request $request)
    {
        /* return response()->json($request->all()); */
       
        $validator  = Validator::make($request->all(), [
            'coordinacion' => ['required', 'string', 'max:255', 'unique:coordinaciones'],
            'encargado' => ['required', 'string', 'max:255'],
            'idUsuario' => ['required', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
            /*  return redirect()->back()->withErrors($validator->errors()); */
        }
        try {

            Coordinacion::create([
                'coordinacion' => $request->input('coordinacion'),
                'encargado' => $request->input('encargado'),
                'idUsuario' => $request->input('idUsuario'),
            ]);
            return response()->json(['msg' => 'excelente']);
        } catch (Exception $e) {
            return response()->json(['msg' => 'error']);
        }
    }


    public function actualizar(Request $request, $id)
    {
        $dato = Coordinacion::find($id);
         /* return response()->json($dato); */

        $validator  = Validator::make($request->all(), [
            'encargado' => ['required', 'string', 'max:255'],
            'idUsuario' => ['required', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        }
        try {

            if($dato->coordinacion != $request->input('coordinacion'));
            {
                $dato->coordinacion = $request->input('coordinacion');
            }
            $dato->encargado = $request->input('encargado');
            $dato->idUsuario = $request->input('idUsuario');
            $dato->save();

            return response()->json(['msg' => 'excelente']);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function borrar($id)
    {

        try {
            $datos = Coordinacion::find($id);
            $datos->delete();

            return response()->json(['msg'=> 'excelente']);
        } catch (Exception $e) {
            return response()->json(['msg'=>'error']);
        }
    }
}
