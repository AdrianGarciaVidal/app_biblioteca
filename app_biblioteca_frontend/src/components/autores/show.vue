<template>
    <div class="row justify-content-center p-3 m-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">CREAR AUTOR</div>
                <div class="card-body">


                    <form action="">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">NOMBRE</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese un nombre">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">APELLIDO</label>
                            <input type="text" class="form-control" id="apellido" placeholder="Ingrese un apellido">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">NACIONALIDAD</label>
                            <input type="text" class="form-control" id="nacionalidad" placeholder="Ingrese una nacionalidad">
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
                        <table class="table" id="tabla_autores">
                            <thead>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>NACIONALIDAD</th>
                                <th>GUARDAR</th>
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
    $('#tabla_autores').DataTable({
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
