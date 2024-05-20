<template>
    <div class="row justify-content-center p-3 m-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">CREAR PRESTAMO</div>
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
                            <label for="exampleFormControlTextarea1"  class="form-label">USUARIO</label>
                            <select class="form-select" id="usuario_id" aria-label="Default select example">
                                <option value="">Seleccione un usuario</option>
                                <option v-for="(usuario, index) in usuarios" :key="index" :value="usuario.id">{{usuario.nombre + ' ' + usuario.apellido}}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">FECHA PRESTAMO</label>
                            <input type="date" class="form-control" id="fecha_prestamo">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">FECHA DEVOLUCIÓN</label>
                            <input type="date" class="form-control" id="fecha_devolucion">
                        </div>
                        
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1"  class="form-label">ESTADO</label>
                            <select class="form-select" id="estado" aria-label="Default select example">
                                <option value="">Seleccione un estado</option>
                                <option value="1">Activo</option>
                                <option value="2">Finalizado</option>
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
                                <th>LIBRO</th>
                                <th>USUARIO</th>
                                <th>FECHA PRESTAMO</th>
                                <th>FECHA DEVOLUCION</th>
                                <th>ESTADO</th>
                                <th>ACCION</th>
                            </thead>

                            <tbody>
                                <tr v-for="(prestamo, index) in prestamos">
                                    <td>{{ prestamo.id }}</td>
                                    <td>{{ prestamo.libro }}</td>
                                    <td>{{ prestamo.usuario }}</td>
                                    <td>{{ prestamo.fecha_prestamo }}</td>
                                    <td>{{ prestamo.fecha_devolucion }}</td>
                                    <td>{{ prestamo.estado }}</td>
                                    <td><button @click="eliminar_dato(prestamo, index)" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></button>
                                        <router-link  :to="{ name: 'editar_prestamo', params: { id: prestamo.id } }">
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

const prestamos = ref([])

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



const traer_prestamos = ()=>{

    
axios.get('http://127.0.0.1:8000/api/prestamos')
        .then(response => {
            const api_prestamos = response.data.prestamos;
           
            api_prestamos.forEach(prestamo => {
                cargar_datos(prestamo);
            });

           
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
}
traer_prestamos();
//  cargar_tabla();
const cargar_datos = (prestamo)=>{



    prestamos.value.push({
        id: prestamo.id,
          usuario: prestamo.nombre + ' ' + prestamo.apellido,
          libro: prestamo.titulo,
          estado: prestamo.estado,
          fecha_devolucion: prestamo.fecha_devolucion,
          fecha_prestamo: prestamo.fecha_prestamo,
       
        });

    
}

const eliminar_dato = (prestamo, index)=>{
    // prestamos.value.splice(index, 1);
    if (confirm('¿Estás seguro de que deseas eliminar este prestamo?')) {
     const datos = {
        id_prestamo : prestamo.id
     }
   
     axios.post('http://127.0.0.1:8000/api/prestamos/delete', datos)
        .then(response => {

            prestamos.value.splice(index, 1);
            Swal.fire({
  title: "prestamo eliminado correctamente!",
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
    const fecha_prestamo = document.querySelector("#fecha_prestamo");
    const fecha_devolucion = document.querySelector("#fecha_devolucion");
    const estado = document.querySelector("#estado");
    if (libro_id.value == "" || usuario_id.value == "" || fecha_prestamo.value == ""|| fecha_devolucion.value == ""|| estado.value == "") {
        Swal.fire({
  title: "Hay campos vacios",
  icon: "error"
});
    }else{
    const datos = {
        libro_id : libro_id.value,
        usuario_id : usuario_id.value,
        fecha_prestamo : fecha_prestamo.value,
        fecha_devolucion : fecha_devolucion.value,
        estado : estado.value,
    }

    console.log(datos)
    axios.post('http://127.0.0.1:8000/api/prestamos/create', datos)
        .then(response => {

           if (response.data.prestamo) {
             cargar_datos(response.data.prestamo);
            //  cargar_tabla();
             Swal.fire({
  title: "prestamo insertado correctamente",
  icon: "success"
});

libro_id.value = "Seleccione un libro";
usuario_id.value = "Seleccione un usuario";
fecha_prestamo.value = "";
fecha_devolucion.value = "";
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
