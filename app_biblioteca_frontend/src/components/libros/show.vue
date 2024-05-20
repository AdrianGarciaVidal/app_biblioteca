<template>
    <div class="row justify-content-center p-3 m-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">CREAR LIBRO</div>
                <div class="card-body">


                    <form action="">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">TITULO</label>
                            <input type="text" class="form-control" id="titulo" placeholder="Ingrese un titulo">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" id="autor_id" class="form-label">AUTOR</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Seleccione un autor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="isbn" placeholder="Ingrese un ISBN">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">AÑO DE PUBLICACION</label>
                            <input type="number" maxlength="4" minlength="4" class="form-control" id="año_publicacion" placeholder="Ingrese el año de publicacion">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">ESTANTE</label>
                            <input type="text" class="form-control" id="estante" placeholder="Ingrese un estante">
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
                        <table class="table" id="tabla_usuarios">
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
    $('#tabla_usuarios').DataTable({
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
