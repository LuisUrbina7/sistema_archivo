<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DireccionController extends Controller
{
    public function index()
    {
        $direcciones = Direccion::orderBy('id','desc')->paginate('4');
        return view('direccion.principal',compact('direcciones'));
    }

    public function formulario_crear()
    {
        return view('direccion.formulario_crear');
    }
    public function crear(Request $request)
    {
        /* dd($request->all()); */
        $validator  = Validator::make($request->all(), [
            'direccion' => ['required', 'string', 'max:255', 'unique:direcciones'],
            'encargado' => ['required', 'string', 'max:255'],
            'idUsuario' => ['required', 'max:255'],
        ]);

        if ($validator->fails()) {
          
            return redirect()->back()->withErrors($validator->errors());
        }
        try {

            Direccion::create([
                'direccion' => $request->input('direccion'),
                'encargado' => $request->input('encargado'),
                'idUsuario' => $request->input('idUsuario'),
            ]);
            return redirect()->back()->with(['correcto'=>'Datos Guardados correctamente.']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error'=>'Existe un problema en los registro.']);
        }
    }
    public function formulario_actualizar($id)
    {
        $datos = Direccion::find($id);
        return view('', compact('datos'));
    }

    public function actualizar(Request $request,$id){
        
        $dato = Direccion::find($id);

        $validator  = Validator::make($request, [
            'direccion' => ['required', 'string', 'max:255', 'unique:direcciones'],
            'encargado' => ['required', 'string', 'max:255'],
            'idUsuario' => ['required', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors([$validator->errors()]);
        }
        try {

            $dato->direccion = $request->input('direccion');
            $dato->encargado = $request->input('encargado');
            $dato->idUsuario = $request->input('idUsuario');
            $dato->save();

            return redirect()->back()->with(['correcto','Datos Guardados correctamente.']);
        } catch (Exception $e) {
            return redirect()->back()->with(['Error','Existe un problema en los registro.']);
        }

    }

    public function borrar($id)
    {

        try {
            $datos = Direccion::find($id);
            $datos->delete();

            return response()->json(['msg', 'Borrado correctamente']);
        } catch (Exception $e) {
            return response()->json(['msg', 'Error, intentalo más tarde.']);
        }
    }
}
