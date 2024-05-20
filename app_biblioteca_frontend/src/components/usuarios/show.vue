<script setup>

import axios from 'axios';
import { computed, ref } from 'vue';

const usuarios = ref([])
const alert_danger = false

const traer_usuarios = ()=>{

    
axios.get('http://127.0.0.1:8000/api/usuarios')
        .then(response => {
            const api_usuarios = response.data.usuarios;
           
            api_usuarios.forEach(usuario => {
                cargar_datos(usuario);
            });

           
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
}
traer_usuarios();
//  cargar_tabla();
const cargar_datos = (usuario)=>{


    usuarios.value.push({
        id: usuario.id,
          nombre: usuario.nombre,
          apellido: usuario.apellido,
          email: usuario.email,
          tipo: usuario.tipo
       
        });

           
}

const eliminar_dato = (usuario, index)=>{
    // usuarios.value.splice(index, 1);
    if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
     const datos = {
        id_usuario : usuario.id
     }
     axios.post('http://127.0.0.1:8000/api/usuarios/delete', datos)
        .then(response => {
            usuarios.value.splice(index, 1);
            Swal.fire({
  title: "Usuario eliminado correctamente!",
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
    const email = document.querySelector("#email");
    const tipo = document.querySelector("#tipo");

    if (nombre.value == "" || apellido.value == "" || email.value == "" || tipo.value == "") {
        Swal.fire({
  title: "Hay campos vacios",
  icon: "error"
});
    }else{
    const datos = {
        nombre : nombre.value,
        apellido : apellido.value,
        email : email.value,
        tipo : tipo.value,
    }

    axios.post('http://127.0.0.1:8000/api/usuarios/create', datos)
        .then(response => {

            console.log(response.data)
           if (response.data.usuario) {
             cargar_datos(response.data.usuario);
            //  cargar_tabla();
             Swal.fire({
  title: "Usuario insertado correctamente",
  icon: "success"
});

             nombre.value = "";
             apellido.value = "";
             email.value = "";
             tipo.value = "Seleccione un tipo";


           }else if (response.data.message == false) {
            Swal.fire({
  title: "El usuario no pudo ser creado por correo existente!",
  icon: "error"
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




function cargar_tabla() {
    


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


}
</script>
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
                            <input type="text" class="form-control" id="apellido" placeholder="Ingrese un apellido">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">EMAIL</label>
                            <input type="email" class="form-control" id="email" placeholder="Ingrese un email">
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
                                <tr v-for="(usuario, index) in usuarios">
                                    <td>{{ usuario.id }}</td>
                                    <td>{{ usuario.nombre }}</td>
                                    <td>{{ usuario.apellido }}</td>
                                    <td>{{ usuario.email }}</td>
                                    <td>{{ usuario.tipo }}</td>
                                    <td><button @click="eliminar_dato(usuario, index)" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></button>
                                        <router-link  :to="{ name: 'editar_usuario', params: { id: usuario.id } }">
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



<style scoped></style>
