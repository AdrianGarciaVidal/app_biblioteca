<template>
    <div class="row justify-content-center p-3 m-2">

        <div class="card" style="width: 25rem;">
            <div class="card-header">EDITAR PRESTAMO</div>
            <div class="card-body">


                <form action="">
                    <div class="mb-3">
                            <label for="exampleFormControlTextarea1"  class="form-label">AUTOR</label>
                            <input type="number" class="form-control" id="id" disabled>
                        </div>

                    <div class="mb-3">
                            <label for="exampleFormControlTextarea1"  class="form-label">AUTOR</label>
                            <select class="form-select" id="libro_id" aria-label="Default select example">
                                <option selected>Seleccione un libro</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1"  class="form-label">AUTOR</label>
                            <select class="form-select" id="usuario_id" aria-label="Default select example">
                                <option selected>Seleccione un usuario</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">FECHA PRESTAMO</label>
                            <input type="date" class="form-control" id="fecha_prestamo">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">FECHA DEVOLUCIÓN</label>
                            <input type="date" class="form-control" id="fecha_devolucion">
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
                                <a href=""> <router-link to="/prestamos"> <i class="bi bi-arrow-return-left"></i>
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
