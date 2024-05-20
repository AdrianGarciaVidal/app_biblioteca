<template>
    <div class="row justify-content-center p-3 m-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">CREAR RESERVA</div>
                <div class="card-body">


                    <form action="">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">AUTOR</label>
                            <select class="form-select"  id="libro_id" aria-label="Default select example">
                                <option selected>Seleccione un libro</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">USUARIO</label>
                            <select class="form-select"  id="usuario_id" aria-label="Default select example">
                                <option selected>Seleccione un usuario</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">FECHA DE RESERVA</label>
                            <input type="date" class="form-control" id="fecha_reserva">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1"  class="form-label">ESTADO</label>
                            <select class="form-select" id="estado" aria-label="Default select example">
                                <option selected>Seleccione un estado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button @click.prevent="guardar_datos" class="btn btn-success">GUARDAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table" id="tabla_reservas">
                            <thead>
                                <th>ID</th>
                                <th>TITULO</th>
                                <th>AUTOR</th>
                                <th>ISBN</th>
                                <th>AÑO DE PUBLICACION</th>
                                <th>ESTANTE</th>
                                <th>ACCION</th>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>


const guardar_datos = () => {

}

document.addEventListener('DOMContentLoaded', function () {
    $('#tabla_reservas').DataTable({
        "paging": true,//Paginacion en tabla
        "lengthChange": false,//Ajustador de campos en tabla
        "searching": true,//Buscador en tabla
        "ordering": false,//Ordentar
        "info": false,//Informacion de tabla
        "autoWidth": false,//ancho automatico
        responsive: true,//colocar diseño responsive
        "pageLength": 5// numero de filas que se muestran en tabla
    });
});
</script>

<style scoped></style>
