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
                                <tr v-for="(autor, index) in autores">
                                    <td>{{ autor.id }}</td>
                                    <td>{{ autor.nombre }}</td>
                                    <td>{{ autor.apellido }}</td>
                                    <td>{{ autor.nacionalidad }}</td>
                                    <td><button @click="eliminar_dato(autor, index)" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></button>
                                        <router-link :key="$route.fullPath" :to="{ name: 'editar_autor', params: { id: autor.id } }">
                                             <button class="btn btn-outline-warning"><i class="bi bi-pencil"></i> </button>
                                            </router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import axios from 'axios';
import { computed, ref } from 'vue';

const autores = ref([])

const traerautores = ()=>{

    
axios.get('http://127.0.0.1:8000/api/autores')
        .then(response => {
            const api_usuarios = response.data.autores;
           
            api_usuarios.forEach(autor => {
                cargar_datos(autor);
            });

           
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
}
traerautores();
//  cargar_tabla();
const cargar_datos = (autor)=>{


    autores.value.push({
        id: autor.id,
          nombre: autor.nombre,
          apellido: autor.apellido,
          nacionalidad: autor.nacionalidad,
       
        });

           
}

const eliminar_dato = (autor, index)=>{
    // usuarios.value.splice(index, 1);
    if (confirm('¿Estás seguro de que deseas eliminar este autor?')) {
     const datos = {
        id_autor : autor.id
     }
     axios.post('http://127.0.0.1:8000/api/autores/delete', datos)
        .then(response => {
            autores.value.splice(index, 1);
            Swal.fire({
  title: "Autor eliminado correctamente!",
  icon: "success"
});
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
    }

  
}

const guardar_datos = () => {


 
    const nombre = document.querySelector("#nombre");
    const apellido = document.querySelector("#apellido");
    const nacionalidad = document.querySelector("#nacionalidad");

    if (nombre.value == "" || apellido.value == "" || nacionalidad.value == "") {
        Swal.fire({
  title: "Hay campos vacios",
  icon: "error"
});
    }else{
    const datos = {
        nombre : nombre.value,
        apellido : apellido.value,
        nacionalidad : nacionalidad.value,
    }

    axios.post('http://127.0.0.1:8000/api/autores/create', datos)
        .then(response => {

           if (response.data.autor) {
             cargar_datos(response.data.autor);
            //  cargar_tabla();
             Swal.fire({
  title: "Usuario insertado correctamente",
  icon: "success"
});

             nombre.value = "";
             apellido.value = "";
             nacionalidad.value = "";


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


// document.addEventListener('DOMContentLoaded', function () {
//     $('#tabla_autores').DataTable({
//         "paging": true,//Paginacion en tabla
//         "lengthChange": false,//Ajustador de campos en tabla
//         "searching": true,//Buscador en tabla
//         "ordering": false,//Ordentar
//         "info": false,//Informacion de tabla
//         "autoWidth": false,//ancho automatico
//         responsive: true,//colocar diseño responsive
//         "pageLength": 5// numero de filas que se muestran en tabla
//     });
// });
</script>

<style scoped></style>
