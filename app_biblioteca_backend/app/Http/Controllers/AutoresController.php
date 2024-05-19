<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutoresController extends Controller
{


    public function store($id,Request $request){
        $autor = Autor::find($id);
        return response()->json(['autor'=>$autor], 200);
    }

    public function show(Request $request){

        $autores = Autor::all();
        return response()->json(['autores', $autores], 200);
    }


    public function create(Request $request){

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'nacionalidad' => 'required',

            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
            $autor = new Autor();
        $autor->nombre = $request->nombre;
        $autor->apellido = $request->apellido;
        $autor->nacionalidad = $request->nacionalidad;
        if (!$autor->save()) {
            return response()->json(['message', 'datos incorrectos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['autor', $autor], 200);
    }
    public function edit(Request $request){

        $request->validate([
            'id_autor' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'nacionalidad' => 'required',
            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
        $autor = Autor::find($request->id_autor);
        $autor->nombre = $request->nombre;
        $autor->apellido = $request->apellido;
        $autor->nacionalidad = $request->nacionalidad;
        if (!$autor->save()) {
            return response()->json(['message', 'datos incorrectos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['autor', $autor], 200);
    }

    public function delete(Request $request){

        $request->validate([
            'id_autor' => 'required',
            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
        $autor = Autor::find($request->id_autor);
        if (!$autor->delete()) {
            return response()->json(['message', 'algo salio mal con los datos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['autor', $autor], 200);
    }

}



