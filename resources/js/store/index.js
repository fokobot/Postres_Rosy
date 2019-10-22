import Vue from "vue";
import Vuex from "vuex";
import moduloClientes from "./clientes/index";
import moduloEmpleados from "./empleados/index";
import moduloSettings from "./settings/index";
import moduloProductos from "./productos/index";
import moduloProveedores from "./proveedores/index";
import moduloVentas from "./ventas/index";
import moduloGastos from "./gastos/index";

Vue.use(Vuex);

export default new Vuex.Store({
    strict: process.env.NODE_ENV !== "production",
    modules: {
        clientes: {
            namespaced: true,
            ...moduloClientes
        },
        empleados: {
            namespaced: true,
            ...moduloEmpleados
        },
        productos: {
            namespaced: true,
            ...moduloProductos
        },
        gastos: {
            namespaced: true,
            ...moduloGastos
        },
        proveedores: {
            namespaced: true,
            ...moduloProveedores
        },
        ventas: {
            namespaced: true,
            ...moduloVentas
        },
        settings: {
            namespaced: false,
            ...moduloSettings
        }
    }
});
