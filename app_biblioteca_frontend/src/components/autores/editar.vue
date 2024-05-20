<template>
    <div class="row justify-content-center p-3 m-2">

        <div class="card" style="width: 25rem;">
            <div class="card-header">EDITAR AUTOR</div>
            <div class="card-body">


                <form action="">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">ID</label>
                        <input type="text" disabled class="form-control" id="id" placeholder="Ingrese un id">
                    </div>
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

                        <div class="row">
                            <div class="col-md-8">
                                <button @click.prevent="guardar_datos" class="btn btn-success">GUARDAR CAMBIOS</button>
                            </div>
                            <div class="col-md-4">
                                <a href=""> <router-link to="/autores"> <i class="bi bi-arrow-return-left"></i>
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
