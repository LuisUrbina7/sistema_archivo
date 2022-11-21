<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    public function index()
    {
        return view('auth.perfil');
    }
    public function usuarios()
    {
        $Usuarios =  User::all();
        return view('auth.usuarios', compact('Usuarios'));
    }
    public function crear_formulario()
    {
        return view('auth.register');
    }
    public function crear(Request $request)
    {
        $input = $request->all();
        /*  dd($input); */


        if ($request->input('password') == $request->input('password_confirmation')) {
            $validator  = Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'rol' => ['required', 'string', 'max:20'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }
            User::create([
                'name' => $input['name'],
                'username' => $input['username'],
                'email' => $input['email'],
                'rol' => $input['rol'],
                'password' => Hash::make($input['password']),
            ]);
            return redirect()->back()->with('name', 'excelente');
        } else {
            var_dump('hlaa');
            return redirect()->back()->withErrors(['password' => 'Las claves no son iguales']);
        }
    }
    public function actualizarPerfil(Request $request)
    {
        $user           = Auth::user();
        $userId         = $user->id;
        $userEmail      = $user->email;
        $userPassword   = $user->password;/* 
        dd($request->all()); */
        if ($request->input('clave_vieja') != "") {
            $nueva_clave   = $request->clave;
            $confirmacion_clave = $request->confirmacion_clave;

            if (Hash::check($request->input('clave_vieja'), $userPassword)) {


                if ($nueva_clave  == $confirmacion_clave) {

                    $actualizar = User::find($userId);
                    $actualizar->name = $request->input('nombre');
                    $actualizar->rol = $request->input('rol');
                    $actualizar->email = $request->input('email');
                    $actualizar->username = $request->input('username');
                    $actualizar->password = Hash::make($request->input('clave'));
                    $actualizar->update();

                    return redirect()->back()->with('Clave', 'La clave fue cambiada correctamente.');
                } else {
                    return redirect()->back()->withErrors(['clave' => 'No son iguales']);
                }
            } else {
                return back()->withErrors(['clave_vieja' => 'La clave no es correcta.']);
            }
        } else {
            $update = User::find($userId);
            $update->name = $request->input('nombre');
            $update->email = $request->input('email');
            $update->username = $request->input('username');
            if ($request->input('rol') != null) {
                $update->rol = $request->input('rol');
            }

            $update->update();
            return redirect()->back()->with('nombre', 'El nombre fue cambiado correctamente.');;
        }
    }
    public function usuarios_vista($id)
    {
        $usuario =  User::find($id);
        return view('auth.usuario_actualizar', compact('usuario'));
    }

    public function actualizar_usuario(Request $request, $id)
    {
        $user           = User::find($id);


        if ($request->input('clave') != "") {
            $nueva_clave   = $request->clave;
            $clave_confirmada = $request->confirmacion_clave;

            if ($nueva_clave == $clave_confirmada) {


                $user->name = $request->input('nombre');
                $user->rol = $request->input('rol');
                $user->email = $request->input('email');
                $user->username = $request->input('username');
                $user->password = Hash::make($request->input('clave'));
                $user->update();

                return redirect()->back()->with('Clave', 'La clave fue cambiada correctamente.');
            } else {
                return redirect()->back()->withErrors(['clave' => 'Las claves no son iguales']);
            }
        } else {

            $user->name = $request->input('nombre');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            if ($request->input('rol') != null) {
                $user->rol = $request->input('rol');
            }
            $user->update();

            return redirect()->back()->with('nombre', 'El nombre fue cambiado correctamente.');;
        }
    }
    public function borrar_usuario($id)
    {
        $dato = User::find($id);
        if ($dato->delete()) {
            return response()->json(['msg' => 'Bien']);
        } else {
            return response()->json(['msg' => 'Error']);
        }
    }
}
