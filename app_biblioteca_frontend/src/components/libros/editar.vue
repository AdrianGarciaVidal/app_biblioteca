<template>
    <div class="row justify-content-center p-3 m-2">

        <div class="card" style="width: 25rem;">
            <div class="card-header">EDITAR LIBRO</div>
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
                        <input type="number" maxlength="4" minlength="4" class="form-control" id="año_publicacion"
                            placeholder="Ingrese el año de publicacion">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">ESTANTE</label>
                        <input type="text" class="form-control" id="estante" placeholder="Ingrese un estante">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-8">
                                <button @click.prevent="guardar_datos" class="btn btn-success">GUARDAR CAMBIOS</button>
                            </div>
                            <div class="col-md-4">
                                <a href=""> <router-link to="/libros"> <i class="bi bi-arrow-return-left"></i>
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
