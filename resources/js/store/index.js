import Vue from 'vue';
import Vuex from 'vuex';
import moduloClientes from './clientes/index';
import moduloSettings from './settings/index';

Vue.use(Vuex);

export default new Vuex.Store({
    strict: process.env.NODE_ENV !== 'production',
    modules: {
        clientes: {
            namespaced: true,
            ...moduloClientes
        },
        settings: {
            namespaced: false,
            ...moduloSettings
        }
    }
});
