<template>
    <div class="row justify-content-center p-3 m-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">CREAR USUARIO</div>
                <div class="card-body">


                    <form action="">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">NOMBRE</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese un nombre">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">APELLIDO</label>
                            <input type="text" class="form-control" id="edad" placeholder="Ingrese un apellido">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">EMAIL</label>
                            <input type="email" class="form-control" id="email" placeholder="Ingrese un email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">TIPO</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Seleccione un tipo</option>
                            </select>
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
                        <table class="table" id="tabla_usuarios">
                            <thead>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>EMAIL</th>
                                <th>TIPO</th>
                                <th>GUARDAR</th>
                            </thead>

                            <tbody>
                                <tr v-for="(usuarios, index) in usuario">
                                    <td>{{ usuario.id }}</td>
                                    <td>{{ usuario.nombre }}</td>
                                    <td>{{ usuario.apellido }}</td>
                                    <td>{{ usuario.email }}</td>
                                    <td>{{ usuario.tipo }}</td>
                                    <td><button class=""></button></td>
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


// axios.get('https://yesno.wtf/api')
//         .then(response => {
//           console.log('Respuesta del servidor:', response.data);
//           // Aquí puedes manejar la respuesta del servidor
//         })
//         .catch(error => {
//           console.error('Error al enviar los datos:', error);
//           // Aquí puedes manejar los errores de la solicitud
//         });

const usuarios = ref({})


const traer_usuarios = ()=>{

    
axios.get('http://127.0.0.1:8000/api/usuarios')
        .then(response => {
            const api_usuarios = response.data.usuarios;
            console.log(api_usuarios)
          console.log('Respuesta del servidor:', response.data);
          // Aquí puedes manejar la respuesta del servidor
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
          // Aquí puedes manejar los errores de la solicitud
        });
}
traer_usuarios();

const cargar_datos = (usuario)=>{

    usuarios.value.push({
          nombre: usuario.nombre,
          apellido: usuario.apellido,
          email: usuario.email,
          tipo: usuario.tipo
       
        });
           
}

const guardar_datos = () => {

}

document.addEventListener('DOMContentLoaded', function () {
    $('#tabla_usuarios').DataTable({
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
