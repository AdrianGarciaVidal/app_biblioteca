<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function store($id,Request $request){
        $usuario = Usuario::find($id);
        return response()->json(['usuario'=>$usuario], 200);
    }

    public function show(Request $request){

        $usuarios=Usuario::all();
        return response()->json(['usuarios'=> $usuarios], 200);
    }


    public function create(Request $request){

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'tipo' => 'required',


            // Agrega aquí las reglas de validación para cada campo necesario
        ]);


        try {
            $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
        $usuario->tipo = $request->tipo;
        if (!$usuario->save()) {
            return response()->json(['message', 'datos incorrectos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['usuario'=> $usuario], 200);
    }
    public function edit(Request $request){


        $request->validate([
            'id_usuario' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'tipo' => 'required',

            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
            $usuario = Usuario::find($request->id_usuario);
            $usuario->nombre = $request->nombre;
            $usuario->apellido = $request->apellido;
            $usuario->email = $request->email;
            $usuario->tipo = $request->tipo;
        if (!$usuario->save()) {
            return response()->json(['message'=> 'datos incorrectos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message'=> $th], 200);
        }

        return response()->json(['usuario'=> $usuario], 200);
    }

    public function delete(Request $request){

        $request->validate([
            'id_usuario' => 'required',
            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
        $usuario = Usuario::find($request->id_usuario);
        if (!$usuario->delete()) {
            return response()->json(['message', 'algo salio mal con los datos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message'=> $th], 200);
        }

        return response()->json(['usuario'=> $usuario], 200);
    }
}
