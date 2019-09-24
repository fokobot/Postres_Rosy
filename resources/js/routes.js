const ListaClientes = require('./components/ListaClientes.vue').default;
const ListaTrabajos = require('./components/ListaTrabajos').default;
const ListaVentas = require('./components/ListaVentas.vue').default;
const ListaGastos = require('./components/ListaGastos.vue').default;
const ListaProductos = require('./components/ListaProductos.vue').default;
const ListaProveedores = require('./components/ListaProveedores.vue').default;
const ListaEmpleados = require('./components/ListaEmpleados.vue').default;

const FormCliente = require('./components/FormCliente.vue').default;
const FormVenta = require('./components/FormVenta.vue').default;
const FormTrabajo = require('./components/FormTrabajo.vue').default;
const FormGasto = require('./components/FormGasto.vue').default;
const FormProducto = require('./components/FormProducto.vue').default;
const FormProveedor = require('./components/FormProveedor.vue').default;
const FormEmpleado = require('./components/FormEmpleado.vue').default;

const ShowVenta = require('./components/ShowVenta').default;
const ShowGasto = require('./components/ShowGasto').default;

const routes = [
    { path: '/clientes', component: ListaClientes},
    { path: '/clientes/new', component: FormCliente},
    { path: '/clientes/:id/edit', component: FormCliente},
    { path: '/ventas/new', component: FormVenta},
    { path: '/ventas', component: ListaVentas },
    { path: '/ventas/:id', component: ShowVenta },
    { path: '/trabajos', component: ListaTrabajos },
    { path: '/trabajos/:id/edit', name: 'EditarTrabajo', component: FormTrabajo},
    { path: '/trabajos/new', component: FormTrabajo },
    { path: '/gastos', component: ListaGastos},
    { path: '/gastos/new', component: FormGasto},
    { path: '/gastos/:id', component: ShowGasto},
    { path: '/gastos/:id/edit', component: FormGasto},
    { path: '/productos', component: ListaProductos},
    { path: '/productos/new', component: FormProducto},
    { path: '/productos/:id/edit', component: FormProducto},
    { path: '/proveedores', component: ListaProveedores},
    { path: '/proveedores/new', component: FormProveedor, name: 'nuevo-proveedor'},
    { path: '/proveedores/:id/edit', component: FormProveedor},
    { path: '/empleados', component: ListaEmpleados},
    { path: '/empleados/new', component: FormEmpleado},
    { path: '/empleados/:id/edit', component: FormEmpleado},
];

export default routes;