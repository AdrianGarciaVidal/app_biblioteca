<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamosController extends Controller
{
    public function store($id,Request $request){
        $prestamo = Prestamo::join("libros", "prestamos.libro_id", "libros.id")
        ->join("usuarios", "prestamos.usuario_id", "usuarios.id")
        ->select("usuarios.nombre","usuarios.apellido","usuarios.email","usuarios.tipo",
        "prestamos.libro_id",  "prestamos.usuario_id",  "prestamos.fecha_prestamo",  "prestamos.fecha_devolucion","prestamos.estado",
        "libros.titulo","libros.autor_id","libros.isbn","libros.año_publicacion","libros.estante" )
        ->where("prestamos.id","=",$id)->first();
        return response()->json(['prestamo'=>$prestamo], 200);
    }

    public function show(Request $request){

        $prestamos =Prestamo::join("libros", "prestamos.libro_id", "libros.id")
        ->join("usuarios", "prestamos.usuarios_id", "usuarios.id")
        ->select("usuarios.nombre","usuarios.apellido","usuarios.email","usuarios.tipo",
        "prestamos.libro_id",  "prestamos.usuario_id",  "prestamos.fecha_prestamo",  "prestamos.fecha_devolucion","prestamos.estado",
        "libros.titulo","libros.autor_id","libros.isbn","libros.año_publicacion","libros.estante" )
        ->get();
        return response()->json(['prestamos', $prestamos], 200);
    }


    public function create(Request $request){

        $request->validate([
            'libro_id' => 'required',
            'usuario_id' => 'required',
            'fecha_prestamo' => 'required',
            'fecha_devolucion' => 'required',
            'estado' => 'required',

            // Agrega aquí las reglas de validación para cada campo necesario
        ]);


        try {
            $prestamo = new Prestamo();
        $prestamo->libro_id = $request->libro_id;
        $prestamo->usuario_id = $request->usuario_id;
        $prestamo->fecha_prestamo = $request->fecha_prestamo;
        $prestamo->fecha_devolucion = $request->fecha_devolucion;
        $prestamo->estado = $request->estado;
        if (!$prestamo->save()) {
            return response()->json(['message', 'datos incorrectos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['prestamo', $prestamo], 200);
    }
    public function edit(Request $request){


        $request->validate([
            'id_prestamo' => 'required',
            'libro_id' => 'required',
            'usuario_id' => 'required',
            'fecha_prestamo' => 'required',
            'fecha_devolucion' => 'required',
            'estado' => 'required',

            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
            $prestamo = Prestamo::find($request->id_prestamo);
            $prestamo->libro_id = $request->libro_id;
            $prestamo->usuario_id = $request->usuario_id;
            $prestamo->fecha_prestamo = $request->fecha_prestamo;
            $prestamo->fecha_devolucion = $request->fecha_devolucion;
            $prestamo->estado = $request->estado;
        if (!$prestamo->save()) {
            return response()->json(['message', 'datos incorrectos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['prestamo', $prestamo], 200);
    }

    public function delete(Request $request){

        $request->validate([
            'id_prestamo' => 'id_prestamo',
            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
        $prestamo = Prestamo::find($request->id_prestamo);
        if (!$prestamo->delete()) {
            return response()->json(['message', 'algo salio mal con los datos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['prestamo', $prestamo], 200);
    }
}
