<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('libro_id');
            $table->unsignedBigInteger('usuario_id');
            $table->date('fecha_reserva');
            $table->enum('estado', ['pendiente', 'completado']);
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('libro_id')->references('id')->on('libros');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
