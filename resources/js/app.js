"use strict";

// TODO organizar
require('./bootstrap');
require('./notify');
window.bootbox = require('bootbox');

window.Vue = require('vue');

import { sync } from 'vuex-router-sync';
// Boostrap-Vue
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// Vue-Select
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
// Routes
import store from './store/index';
// Filters
import './filters.js';

// bootstrap and bootstrap-vue
Vue.use(BootstrapVue);
// vue select
Vue.use(vSelect);
Vue.component('v-select', vSelect);
// Show form validations errors
const FormError = () => import('./components/ValidationError');
Vue.component('form-error', FormError);

import router from './routes';
const unsync = sync(store, router); // done. Returns an unsync callback fn

const app = new Vue({
  router,
  store
}).$mount('#app')