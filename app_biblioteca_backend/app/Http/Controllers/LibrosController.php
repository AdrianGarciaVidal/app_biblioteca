<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class LibrosController extends Controller{

    public function store($id,Request $request){
        $libro = Libro::join("autores", "libros.autor_id", "autores.id")
        ->select("autores.nombre","autores.apellido","autores.nacionalidad","libros.id","libros.titulo","libros.autor_id","libros.isbn","libros.año_publicacion","libros.estante" )
        ->where("libros.id","=",$id)->first();
        return response()->json(['libro'=>$libro], 200);
    }

    public function show(Request $request){

        $libros = Libro::join("autores", "libros.autor_id", "autores.id")
        ->select("autores.nombre","autores.apellido","autores.nacionalidad","libros.id","libros.titulo","libros.autor_id","libros.isbn","libros.año_publicacion","libros.estante" )
        ->get();
        return response()->json(['libros', $libros], 200);
    }


    public function create(Request $request){

        $request->validate([
            'titulo' => 'required',
            'autor_id' => 'required',
            'isbn' => 'required',
            'ano_publicacion' => 'required',
            'estante' => 'required',

            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
            $libro = new Libro();
        $libro->titulo = $request->titulo;
        $libro->autor_id = $request->autor_id;
        $libro->isbn = $request->isbn;
        $libro->ano_publicacion = $request->ano_publicacion;
        $libro->estante = $request->estante;
        if (!$libro->save()) {
            return response()->json(['message', 'datos incorrectos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['libro', $libro], 200);
    }
    public function edit(Request $request){

        $request->validate([
            'id_libro' => 'required',
            'titulo' => 'required',
            'autor_id' => 'required',
            'isbn' => 'required',
            'ano_publicacion' => 'required',
            'estante' => 'required',

            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
            $libro = Libro::find($request->id_libro);
        $libro->titulo = $request->titulo;
        $libro->autor_id = $request->autor_id;
        $libro->isbn = $request->isbn;
        $libro->ano_publicacion = $request->ano_publicacion;
        $libro->estante = $request->estante;
        if (!$libro->save()) {
            return response()->json(['message', 'datos incorrectos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['libro', $libro], 200);
    }

    public function delete(Request $request){

        $request->validate([
            'id_libro' => 'required',
            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
        $libro = Libro::find($request->id_libro);
        if (!$libro->delete()) {
            return response()->json(['message', 'algo salio mal con los datos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['libro', $libro], 200);
    }

}




