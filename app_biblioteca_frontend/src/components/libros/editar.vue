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
                        <label for="exampleFormControlTextarea1"  class="form-label">AUTOR</label>
                        <select id="autor_id" class="form-select" aria-label="Default select example">
                            <option value="">Seleccione un autor</option>
                            <option v-for="(autor, index) in autores" :key="index" :value="autor.id">{{autor.nombre}}</option>
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

import { useRoute } from 'vue-router';
import axios from 'axios';
import { computed, ref } from 'vue';

const route = useRoute();

const id = route.params.id;

const autores = ref([])

const traer_autores = () =>{
    axios.get('http://127.0.0.1:8000/api/autores')
        .then(response => {
            const api_autores = response.data.autores;
           
            api_autores.forEach(autor => {
                cargar_autores(autor);
            });

           
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });

}
const cargar_autores = (autor)=>{


autores.value.push({
    id: autor.id,
      nombre: autor.nombre + ' '+ autor.apellido,
    });

       
}

traer_autores();


const traer_objeto = (id) =>{
    axios.get(`http://127.0.0.1:8000/api/libros/store/${id}`)
        .then(response => {
            const api_libro = response.data.libro;
           titulo.value = api_libro.nombre;
           isbn.value = api_libro.apellido;
           autor_id.value = api_libro.autor_id;
           año_publicacion.value = api_libro.año_publicacion;
           estante.value = api_libro.estante;
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
}
traer_objeto(id);


document.addEventListener('DOMContentLoaded', function () {
    // const input_id = document.querySelector("#id");
    
var titulo = document.querySelector("#titulo");
var autor_id = document.querySelector("#autor_id");
var isbn = document.querySelector("#isbn");
var año_publicacion = document.querySelector("#año_publicacion");
var estante = document.querySelector("#estante");


});

   

// traer_objeto(id);

const guardar_datos = () => {


    if (titulo.value == "" || autor_id.value == "" || isbn.value == ""|| año_publicacion.value == ""|| estante.value == "") {
        Swal.fire({
  title: "Hay campos vacios",
  icon: "error"
});
    }else{

    const datos = {
        id_libro : id,
        titulo : titulo.value,
        autor_id : autor_id.value,
        isbn : isbn.value,
        año_publicacion : año_publicacion.value,
        estante : estante.value,
    }

    axios.post('http://127.0.0.1:8000/api/libros/edit', datos)
        .then(response => {

           if (response.data.libro) {

             Swal.fire({
  title: "libro editado correctamente",
  icon: "success"
});

           }else{
            Swal.fire({
  title: "uppss... parece que ocurrio un error",
  icon: "error"
});

console.log(response.data.message)

           }
         
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
    }

}

</script>

<style scoped></style>
