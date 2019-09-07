/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./notify');

window.Vue = require('vue');

Vue.component('lista-productos', require('./components/ListaProductos.vue').default);
Vue.component('lista-trabajos', require('./components/ListaTrabajos.vue').default);
Vue.component('lista-clientes', require('./components/ListaClientes.vue').default);

Vue.component('form-detalleventa', require('./components/DetalleVenta.vue').default);
Vue.component('form-error', require('./components/ValidationError.vue').default);
Vue.component('form-venta', require('./components/FormVenta.vue').default);

const app = new Vue({
    el: '#app',
});
