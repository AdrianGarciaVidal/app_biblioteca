import { createRouter, createWebHistory } from 'vue-router';


import App from '../App.vue';
import Inicio from '../inicio.vue';

const routes = [
  {
    path: '/',
    name: 'Inicio',
    component: Inicio,
  },
  // Añade más rutas según sea necesario
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;