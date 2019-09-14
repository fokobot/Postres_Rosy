const ListaClientes = require('./components/ListaClientes.vue').default;
const ListaTrabajos = require('./components/ListaTrabajos').default;
const ListaVentas = require('./components/ListaVentas.vue').default;
const ListaGastos = require('./components/ListaGastos.vue').default;
const ListaProductos = require('./components/ListaProductos.vue').default;

const FormCliente = require('./components/FormCliente.vue').default;
const FormVenta = require('./components/FormVenta.vue').default;
const FormTrabajo = require('./components/FormTrabajo.vue').default;
const FormGasto = require('./components/FormGasto.vue').default;
const FormProducto = require('./components/FormProducto.vue').default;

const routes = [
    { path: '/clientes', component: ListaClientes},
    { path: '/clientes/new', component: FormCliente},
    { path: '/clientes/:id/edit', component: FormCliente},
    { path: '/ventas/new', component: FormVenta},
    { path: '/ventas', component: ListaVentas },
    { path: '/trabajos', component: ListaTrabajos },
    { path: '/trabajos/:id/edit', name: 'EditarTrabajo', component: FormTrabajo},
    { path: '/trabajos/new', component: FormTrabajo },
    { path: '/gastos', component: ListaGastos},
    { path: '/gastos/new', component: FormGasto},
    { path: '/gastos/:id/edit', component: FormGasto},
    { path: '/productos', component: ListaProductos},
    { path: '/productos/new', component: FormProducto},
    { path: '/productos/:id/edit', component: FormProducto},
];

export default routes;