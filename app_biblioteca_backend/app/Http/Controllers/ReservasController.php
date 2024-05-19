<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function store($id,Request $request){
        $reserva = Reserva::join("libros", "reservas.libro_id", "libros.id")
        ->join("usuarios", "reservas.usuario_id", "usuarios.id")
        ->select("usuarios.nombre","usuarios.apellido","usuarios.email","usuarios.tipo",
        "reservas.libro_id",  "reservas.usuario_id",  "reservas.fecha_reserva",  "reservas.estado",
        "libros.titulo","libros.autor_id","libros.isbn","libros.año_publicacion","libros.estante" )
        ->where("reservas.id","=",$id)->first();
        return response()->json(['reserva'=>$reserva], 200);
    }

    public function show(Request $request){

        $reservas =Reserva::join("libros", "reservas.libro_id", "libros.id")
        ->join("usuarios", "reservas.usuario_id", "usuarios.id")
        ->select("usuarios.nombre","usuarios.apellido","usuarios.email","usuarios.tipo",
        "reservas.libro_id",  "reservas.usuario_id",  "reservas.fecha_reserva",  "reservas.estado",
        "libros.titulo","libros.autor_id","libros.isbn","libros.año_publicacion","libros.estante" )
        ->get();
        return response()->json(['reservas', $reservas], 200);
    }


    public function create(Request $request){

        $request->validate([
            'libro_id' => 'required',
            'usuario_id' => 'required',
            'fecha_reserva' => 'required',
            'estado' => 'required',


            // Agrega aquí las reglas de validación para cada campo necesario
        ]);


        try {
            $reserva = new Reserva();
        $reserva->libro_id = $request->libro_id;
        $reserva->usuario_id = $request->usuario_id;
        $reserva->fecha_reserva = $request->fecha_reserva;
        $reserva->estado = $request->estado;
        if (!$reserva->save()) {
            return response()->json(['message', 'datos incorrectos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['reserva', $reserva], 200);
    }
    public function edit(Request $request){


        $request->validate([
            'id_reserva' => 'required',
            'libro_id' => 'required',
            'usuario_id' => 'required',
            'fecha_reserva' => 'required',
            'estado' => 'required',

            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
            $reserva = Reserva::find($request->id_reserva);
            $reserva->libro_id = $request->libro_id;
            $reserva->usuario_id = $request->usuario_id;
            $reserva->fecha_reserva = $request->fecha_reserva;
            $reserva->estado = $request->estado;
        if (!$reserva->save()) {
            return response()->json(['message', 'datos incorrectos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['reserva', $reserva], 200);
    }

    public function delete(Request $request){

        $request->validate([
            'id_reserva' => 'id_reserva',
            // Agrega aquí las reglas de validación para cada campo necesario
        ]);
        try {
        $reserva = Reserva::find($request->id_reserva);
        if (!$reserva->delete()) {
            return response()->json(['message', 'algo salio mal con los datos'], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message', $th], 200);
        }

        return response()->json(['reserva', $reserva], 200);
    }
}
