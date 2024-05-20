<template>
    <div class="row justify-content-center p-3 m-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">CREAR LIBRO</div>
                <div class="card-body">


                    <form action="">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">TITULO</label>
                            <input type="text" class="form-control" id="titulo" placeholder="Ingrese un titulo">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1"  class="form-label">AUTOR</label>
                            <select class="form-select" id="autor_id" aria-label="Default select example">
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
                            <input type="number" maxlength="4" minlength="4" class="form-control" id="año_publicacion" placeholder="Ingrese el año de publicacion">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">ESTANTE</label>
                            <input type="text" class="form-control" id="estante" placeholder="Ingrese un estante">
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
                        <table class="table" id="tabla_libros">
                            <thead>
                                <th>ID</th>
                                <th>TITULO</th>
                                <th>AUTOR</th>
                                <th>ISBN</th>
                                <th>AÑO DE PUBLICACION</th>
                                <th>ESTANTE</th>
                                <th>ACCION</th>
                            </thead>

                            <tbody>
                                <tr v-for="(libro, index) in libros">
                                    <td>{{ libro.id }}</td>
                                    <td>{{ libro.titulo }}</td>
                                    <td>{{ libro.autor }}</td>
                                    <td>{{ libro.isbn }}</td>
                                    <td>{{ libro.año_publicacion }}</td>
                                    <td>{{ libro.estante }}</td>
                                    <td><button @click="eliminar_dato(libro, index)" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></button>
                                        <router-link  :to="{ name: 'editar_libro', params: { id: libro.id } }">
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

const libros = ref([])

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

const traer_libros = ()=>{

    
axios.get('http://127.0.0.1:8000/api/libros')
        .then(response => {
            const api_libros = response.data.libros;
           
            api_libros.forEach(libro => {
                cargar_datos(libro);
            });

           
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
}
traer_libros();
//  cargar_tabla();
const cargar_datos = (libro)=>{


    libros.value.push({
        id: libro.id,
          titulo: libro.titulo,
          autor: libro.nombre + ' ' + libro.apellido,
          isbn: libro.isbn,
          año_publicacion: libro.año_publicacion,
          estante: libro.estante,
       
        });

           
}

const eliminar_dato = (libro, index)=>{
    // libros.value.splice(index, 1);
    if (confirm('¿Estás seguro de que deseas eliminar este libro?')) {
     const datos = {
        id_libro : libro.id
     }
     console.log(datos)
     axios.post('http://127.0.0.1:8000/api/libros/delete', datos)
        .then(response => {
            console.log(response)
            libros.value.splice(index, 1);
            Swal.fire({
  title: "libro eliminado correctamente!",
  icon: "success"
});
        })
        .catch(error => {
          alert('Error al enviar los datos:', error)
         
        });
    }

  
}

const guardar_datos = () => {


 
    const titulo = document.querySelector("#titulo");
    const autor_id = document.querySelector("#autor_id");
    const isbn = document.querySelector("#isbn");
    const año_publicacion = document.querySelector("#año_publicacion");
    const estante = document.querySelector("#estante");
    if (titulo.value == "" || autor_id.value == "" || isbn.value == ""|| año_publicacion.value == ""|| estante.value == "") {
        Swal.fire({
  title: "Hay campos vacios",
  icon: "error"
});
    }else{
    const datos = {
        titulo : titulo.value,
        autor_id : autor_id.value,
        isbn : isbn.value,
        año_publicacion : año_publicacion.value,
        estante : estante.value,
    }

    console.log(datos)
    axios.post('http://127.0.0.1:8000/api/libros/create', datos)
        .then(response => {

           if (response.data.libro) {
             cargar_datos(response.data.libro);
            //  cargar_tabla();
             Swal.fire({
  title: "libro insertado correctamente",
  icon: "success"
});

titulo.value = "";
isbn.value = "";
año_publicacion.value = "";
autor_id.value = "Seleccione un autor";
estante.value = "";


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





    $('#tabla_libros').DataTable({
        "paging": true,//Paginacion en tabla
        "lengthChange": false,//Ajustador de campos en tabla
        "searching": true,//Buscador en tabla
        "ordering": false,//Ordentar
        "info": false,//Informacion de tabla
        "autoWidth": false,//ancho automatico
        responsive: true,//colocar diseño responsive
        "pageLength": 5// numero de filas que se muestran en tabla
    });

</script>

<style scoped></style>
