<template>
    <div class="row justify-content-center p-3 m-2">

        <div class="card" style="width: 25rem;">
            <div class="card-header">EDITAR AUTOR</div>
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


import { useRoute } from 'vue-router';
import axios from 'axios';
import { computed, ref } from 'vue';

const route = useRoute();

const id = route.params.id;


const traer_objeto = (id) =>{
    axios.get(`http://127.0.0.1:8000/api/autores/store/${id}`)
        .then(response => {
            const api_autor = response.data.autor;
   
           nombre.value = api_autor.nombre;
           apellido.value = api_autor.apellido;
           nacionalidad.value = api_autor.nacionalidad;
          
           
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
}
traer_objeto(id);


document.addEventListener('DOMContentLoaded', function () {
    // const input_id = document.querySelector("#id");
    
var nombre = document.querySelector("#nombre");
var apellido = document.querySelector("#apellido");
var nacionalidad = document.querySelector("#nacionalidad");

  


});

   

// traer_objeto(id);

const guardar_datos = () => {



    if (nombre.value == "" || apellido.value == "" || nacionalidad.value == "") {
        Swal.fire({
  title: "Hay campos vacios",
  icon: "error"
});
    }else{
    const datos = {
        id_autor : id,
        nombre : nombre.value,
        apellido : apellido.value,
        nacionalidad : nacionalidad.value,
    
    }

    axios.post('http://127.0.0.1:8000/api/autores/edit', datos)
        .then(response => {

           if (response.data.autor) {

             Swal.fire({
  title: "Usuario editado correctamente",
  icon: "success"
});

           }else{
            Swal.fire({
  title: "uppss... parece que ocurrio un error",
  icon: "error"
});
           }
         
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });

    }
}



</script>

<style scoped></style>
