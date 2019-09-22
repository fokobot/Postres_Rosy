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

Vue.component('form-error', require('./components/ValidationError.vue').default);

const router = new VueRouter({routes});

const app = new Vue({
  router
}).$mount('#app')