import Vue from 'vue';
import Vuex from 'vuex';
import moduloClientes   from './clientes/index';
import moduloSettings   from './settings/index';
import moduloProductos  from './productos/index';

Vue.use(Vuex);

export default new Vuex.Store({
    strict: process.env.NODE_ENV !== 'production',
    modules: {
        clientes: {
            namespaced: true,
            ...moduloClientes
        },
        productos: {
            namespaced: true,
            ...moduloProductos
        },
        settings: {
            namespaced: false,
            ...moduloSettings
        }
    }
});
