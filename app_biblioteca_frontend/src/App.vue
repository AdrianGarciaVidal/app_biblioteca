<script>
import Fooder from './components/layouts/fooder.vue';
import Header from './components/layouts/header.vue';


export default {
  name: 'App',
  components: {
    Fooder,
    Header,
  },
};

</script>

<template>
  <div id="app">
<Header></Header>
    <router-view></router-view>
    <Fooder></Fooder>
  </div>
</template>



<style>
/* Estilos opcionales */
nav ul {
  list-style-type: none;
  padding: 0;
}

nav li {
  display: inline;
  margin-right: 10px;
}
a{
  text-decoration: none;
  font-weight: 200;
  color: black;
}
</style>