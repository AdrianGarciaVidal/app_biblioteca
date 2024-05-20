<template>
    <div class="row justify-content-center p-3 m-2">

        <div class="card" style="width: 25rem;">
            <div class="card-header">EDITAR RESERVA</div>
            <div class="card-body">


                <form action="">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">ID</label>
                        <input type="text" disabled class="form-control" id="id" placeholder="Ingrese un id">
                    </div>
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
                        <div class="row">
                            <div class="col-md-8">
                                <button @click.prevent="guardar_datos" class="btn btn-success">GUARDAR CAMBIOS</button>
                            </div>
                            <div class="col-md-4">
                                <a href=""> <router-link to="/reservas"> <i class="bi bi-arrow-return-left"></i>
                                        VOLVER</router-link></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>


const guardar_datos = () => {

}


</script>

<style scoped></style>
