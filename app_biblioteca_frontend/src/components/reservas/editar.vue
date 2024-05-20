<template>
    <div class="row justify-content-center p-3 m-2">

        <div class="card" style="width: 25rem;">
            <div class="card-header">EDITAR RESERVA</div>
            <div class="card-body">


                <form action="">
                    <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">LIBRO</label>
                            <select class="form-select"  id="libro_id" aria-label="Default select example">
                                <option value="">Seleccione un libro</option>
                                <option v-for="(libro, index) in libros" :key="index" :value="libro.id">{{libro.titulo}}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">USUARIO</label>
                            <select class="form-select"  id="usuario_id" aria-label="Default select example">
                                <option value="">Seleccione un usuario</option>
                                <option v-for="(usuario, index) in usuarios" :key="index" :value="usuario.id">{{usuario.nombre + ' ' + usuario.apellido}}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">FECHA DE RESERVA</label>
                            <input type="date" class="form-control" id="fecha_reserva">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1"  class="form-label">ESTADO</label>
                            <select class="form-select" id="estado" aria-label="Default select example">
                                <option value="">Seleccione un estado</option>
                                <option value="1">Pendiente</option>
                                <option value="2">Completado</option>
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


import { useRoute } from 'vue-router';
import axios from 'axios';
import { computed, ref } from 'vue';

const route = useRoute();

const id = route.params.id;

const libros = ref([])

const traer_libros = () =>{
    axios.get('http://127.0.0.1:8000/api/libros')
        .then(response => {
            const api_libros = response.data.libros;
           
            api_libros.forEach(libro => {
                cargar_libros(libro);
            });

           
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });

}
const cargar_libros = (libro)=>{


libros.value.push({
    id: libro.id,
      titulo: libro.titulo,
    });

       
}

traer_libros();



const usuarios = ref([])

const traer_usuarios = () =>{
    axios.get('http://127.0.0.1:8000/api/usuarios')
        .then(response => {
            const api_usuarios = response.data.usuarios;
           
            api_usuarios.forEach(usuario => {
                cargar_usuarios(usuario);
            });

           
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });

}
const cargar_usuarios = (usuario)=>{


usuarios.value.push({
    id: usuario.id,
      nombre: usuario.nombre,
      apellido: usuario.apellido,
    });

       
}

traer_usuarios();






const traer_objeto = (id) =>{
    axios.get(`http://127.0.0.1:8000/api/reservas/store/${id}`)
        .then(response => {
            const api_reserva = response.data.reserva;
           libro_id.value = api_reserva.libro_id;
           usuario_id.value = api_reserva.usuario_id;
           fecha_reserva.value = api_reserva.fecha_reserva;
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
}
traer_objeto(id);


document.addEventListener('DOMContentLoaded', function () {
    // const input_id = document.querySelector("#id");
    
var libro_id = document.querySelector("#libro_id");
var usuario_id = document.querySelector("#usuario_id");
var fecha_reserva = document.querySelector("#fecha_reserva");
var estado = document.querySelector("#estado");



});

   

// traer_objeto(id);

const guardar_datos = () => {


    if (libro_id.value == "" || usuario_id.value == "" || fecha_reserva.value == ""|| estado.value == "") {
        Swal.fire({
  title: "Hay campos vacios",
  icon: "error"
});
    }else{

    const datos = {
        id_reserva : id,
        libro_id : libro_id.value,
        usuario_id : usuario_id.value,
        fecha_reserva : fecha_reserva.value,
        estado : estado.value,
    }

    axios.post('http://127.0.0.1:8000/api/reservas/edit', datos)
        .then(response => {

           if (response.data.reserva) {

             Swal.fire({
  title: "reserva editado correctamente",
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
