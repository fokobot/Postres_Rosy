/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};

window.Vue = require('vue');

Vue.component('form-detalleventa', require('./components/DetalleVentaComponent.vue').default);

const app = new Vue({
    el: '#app',
});
