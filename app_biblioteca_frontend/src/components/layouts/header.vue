<script setup>

</script>

<template>
 
    <nav class="navbar navbar-expand-lg bg-body-tertiary p-5" >
      
  <div class="container-fluid ">
    <a class="navbar-brand" href="#">
      <router-link to="./">
      <img src="../icons/favicon.png" alt="Logo" width="29" height="30" class="d-inline-block align-text-top">
      BIBLIOTECA
    </router-link>
    </a>
    <div style="margin-left: 50px;" class="collapse navbar-collapse" id="navbarNavDropdown">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <i class="bi bi-house"></i>  Inicio
          </a>
          <ul class="dropdown-menu" >
            <li><a class="dropdown-item" href="#"><router-link to="/usuarios"><i class="bi bi-people-fill"></i>  Usuarios</router-link></a></li>
            <li><a class="dropdown-item" href="#"><router-link to="/libros"><i class="bi bi-book"></i>  Libros</router-link></a></li>
            <li><a class="dropdown-item" href="#"><router-link to="/autores"><i class="bi bi-person-badge"></i>  Autores</router-link></a></li>
            <li><a class="dropdown-item" href="#"><router-link to="/reservas"><i class="bi bi-journal-bookmark-fill"></i>  Reservas</router-link></a></li>
            <li><a class="dropdown-item" href="#"><router-link to="/prestamos"><i class="bi bi-journal-bookmark-fill"></i>  Prestamos</router-link></a></li>
          </ul>
        </li>
    </div>

</div>
</nav>

</template>


<style scoped>


</style>