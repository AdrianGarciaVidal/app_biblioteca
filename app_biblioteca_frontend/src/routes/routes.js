import { createRouter, createWebHistory } from 'vue-router';


import App from '../App.vue';

import Inicio from '../inicio.vue';

import usuarios from '../components/usuarios/show.vue'
import editar_usuario from '../components/usuarios/editar.vue'

import libros from '../components/libros/show.vue'
import editar_libro from '../components/libros/editar.vue'

import autores from '../components/autores/show.vue'
import editar_autor from '../components/autores/editar.vue'

import reservas from '../components/reservas/show.vue'
import editar_reserva from '../components/reservas/editar.vue'

import prestamos from '../components/prestamos/show.vue'
import editar_prestamo from '../components/prestamos/editar.vue'



const routes = [
  {
    path: '/',
    name: 'Inicio',
    component: Inicio,
  },
  {
    path: '/usuarios',
    name: 'usuarios',
    component: usuarios,
  },

  {
    path: '/usuarios/editar/:id',
    name: 'editar_usuario',
    component: editar_usuario,
  },

  {
    path: '/libros',
    name: 'libros',
    component: libros,
  },
  {
    path: '/libros/editar/:id',
    name: 'editar_libro',
    component: editar_libro,
  },

  {
    path: '/autores',
    name: 'autores',
    component: autores,
  },
  {
    path: '/autores/editar/:id',
    name: 'editar_autor',
    component: editar_autor,
  },
  {
    path: '/reservas',
    name: 'reservas',
    component: reservas,
  },
  {
    path: '/reservas/editar/:id',
    name: 'editar_reserva',
    component: editar_reserva,
  },
  {
    path: '/prestamos',
    name: 'prestamos',
    component: prestamos,
  },
  {
    path: '/prestamos/editar/:id',
    name: 'editar_prestamo',
    component: editar_prestamo,
  },
  // Añade más rutas según sea necesario
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;