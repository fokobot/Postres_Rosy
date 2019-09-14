"use strict";
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./notify');
window.bootbox = require('bootbox');

window.Vue = require('vue');

const VueRouter = require('vue-router').default;
Vue.use(VueRouter);
import routes from './routes';
import './filters.js';

const router = new VueRouter({routes});

Vue.component('lista-productos', require('./components/ListaProductos.vue').default);
Vue.component('lista-trabajos', require('./components/ListaTrabajos.vue').default);
Vue.component('lista-clientes', require('./components/ListaClientes.vue').default);
Vue.component('lista-gastos', require('./components/ListaGastos.vue').default);
Vue.component('lista-ventas', require('./components/ListaVentas.vue').default);

Vue.component('form-detalleventa', require('./components/DetalleVenta.vue').default);
Vue.component('form-error', require('./components/ValidationError.vue').default);
Vue.component('form-venta', require('./components/FormVenta.vue').default);
Vue.component('form-trabajo', require('./components/FormTrabajo.vue').default);

const app = new Vue({
  router
}).$mount('#app')