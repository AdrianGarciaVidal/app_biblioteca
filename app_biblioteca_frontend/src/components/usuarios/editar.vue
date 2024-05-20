<template>
    <div class="row justify-content-center p-3 m-2">

        <div class="card" style="width: 25rem;">
            <div class="card-header">EDITAR USUARIO</div>
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
                        <label for="exampleFormControlTextarea1" class="form-label">EMAIL</label>
                        <input disabled type="email" class="form-control" id="email" placeholder="Ingrese un email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1"  class="form-label">TIPO</label>
                        <select class="form-select" id="tipo" aria-label="Default select example">
                            <option value="">Seleccione un tipo</option>
                            <option value="1">Estudiante</option>
                            <option value="2">Profesor</option>
                            <option value="3">Visitante</option>
                        </select>
                    </div>
                    <div class="mb-3">

                        <div class="row">
                            <div class="col-md-8">
                                <button @click.prevent="guardar_datos" class="btn btn-success">GUARDAR CAMBIOS</button>
                            </div>
                            <div class="col-md-4">
                                <a href=""> <router-link to="/usuarios"> <i class="bi bi-arrow-return-left"></i>
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
    axios.get(`http://127.0.0.1:8000/api/usuarios/store/${id}`)
        .then(response => {
            const api_usuario = response.data.usuario;
            
           nombre.value = api_usuario.nombre;
           apellido.value = api_usuario.apellido;
           email.value = api_usuario.email;
          
           
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
var email = document.querySelector("#email");
var tipo = document.querySelector("#tipo");
  


});

   

// traer_objeto(id);

const guardar_datos = () => {

    console.log(tipo.value)
    if (nombre.value == "" || apellido.value == "" || email.value == "" || tipo.value == "") {
        Swal.fire({
  title: "Hay campos vacios",
  icon: "error"
});
    }else{


    const datos = {
        id_usuario : id,
        nombre : nombre.value,
        apellido : apellido.value,
        email : email.value,
        tipo : tipo.value,
    }

    axios.post('http://127.0.0.1:8000/api/usuarios/edit', datos)
        .then(response => {

           if (response.data.usuario) {

             Swal.fire({
  title: "Usuario editado correctamente",
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
