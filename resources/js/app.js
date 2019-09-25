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
import BootstrapVue from 'bootstrap-vue'
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

import routes from './routes';
import './filters.js';

Vue.use(VueRouter);
// bootstrap and bootstrap-vue
Vue.use(BootstrapVue);
// vue select
Vue.use(vSelect);
Vue.component('v-select', vSelect);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.component('form-error', require('./components/ValidationError.vue').default);

const router = new VueRouter({routes});

const app = new Vue({
  router
}).$mount('#app')