<script setup>

</script>

<template>
    <ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#"><router-link to="/usuarios"><i class="bi bi-people-fill"></i>  Usuarios</router-link></a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#"><router-link to="/libros"><i class="bi bi-book"></i>  Libros</router-link></a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#"><router-link to="/autores"><i class="bi bi-person-badge"></i>  Autores</router-link></a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#"><router-link to="/reservas"><i class="bi bi-journal-bookmark-fill"></i>  Reservas</router-link></a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#"><router-link to="/prestamos"><i class="bi bi-journal-bookmark-fill"></i>  Prestamos</router-link></a>
  </li>
</ul>
</template>


<style scoped>
.nav{
    position: relative;
    bottom: 0;
    width: 100%;
}
</style>