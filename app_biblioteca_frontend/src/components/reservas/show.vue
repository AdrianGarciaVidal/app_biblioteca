<template>
    <div class="row justify-content-center p-3 m-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">CREAR RESERVA</div>
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
                        <table class="table" id="tabla_reservas">
                            <thead>
                                <th>ID</th>
                                <th>LIBRO</th>
                                <th>USUARIO</th>
                                <th>FECHA DE RESERVA</th>
                                <th>ESTADO</th>
                                <th>ACCION</th>
                            </thead>

                            <tbody>
                                <tr v-for="(reserva, index) in reservas">
                                    <td>{{ reserva.id }}</td>
                                    <td>{{ reserva.titulo }}</td>
                                    <td>{{ reserva.autor }}</td>
                                    <td>{{ reserva.fecha_reserva }}</td>
                                    <td>{{ reserva.estado }}</td>
                                    <td><button @click="eliminar_dato(reserva, index)" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></button>
                                        <router-link  :to="{ name: 'editar_reserva', params: { id: reserva.id } }">
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

const reservas = ref([])

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



const traer_reservas = ()=>{

    
axios.get('http://127.0.0.1:8000/api/reservas')
        .then(response => {
            const api_reservas = response.data.reservas;
           
            api_reservas.forEach(reserva => {
                cargar_datos(reserva);
            });

           
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
}
traer_reservas();
//  cargar_tabla();
const cargar_datos = (reserva)=>{



    reservas.value.push({
        id: reserva.id,
          titulo: reserva.titulo,
          autor: reserva.nombre + ' ' + reserva.apellido,
          fecha_reserva: reserva.fecha_reserva,
          estado: reserva.estado,
       
        });

    
}

const eliminar_dato = (reserva, index)=>{
    // reservas.value.splice(index, 1);
    if (confirm('¿Estás seguro de que deseas eliminar este reserva?')) {
     const datos = {
        id_reserva : reserva.id
     }
   
     axios.post('http://127.0.0.1:8000/api/reservas/delete', datos)
        .then(response => {
            console.log(response)
            reservas.value.splice(index, 1);
            Swal.fire({
  title: "reserva eliminado correctamente!",
  icon: "success"
});
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
    }

  
}

const guardar_datos = () => {


 
    const libro_id = document.querySelector("#libro_id");
    const usuario_id = document.querySelector("#usuario_id");
    const fecha_reserva = document.querySelector("#fecha_reserva");
    const estado = document.querySelector("#estado");
    if (libro_id.value == "" || usuario_id.value == "" || fecha_reserva.value == ""|| estado.value == "") {
        Swal.fire({
  title: "Hay campos vacios",
  icon: "error"
});
    }else{
    const datos = {
        libro_id : libro_id.value,
        usuario_id : usuario_id.value,
        fecha_reserva : fecha_reserva.value,
        estado : estado.value,
    }

    console.log(datos)
    axios.post('http://127.0.0.1:8000/api/reservas/create', datos)
        .then(response => {

           if (response.data.reserva) {
             cargar_datos(response.data.reserva);
            //  cargar_tabla();
             Swal.fire({
  title: "Reserva insertado correctamente",
  icon: "success"
});

libro_id.value = "Seleccione un libro";
usuario_id.value = "Seleccione un usuario";
fecha_reserva.value = "";
estado.value = "Seleccione un estado";



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
