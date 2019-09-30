import Vue          from 'vue'
import VueRouter    from 'vue-router'

Vue.use(VueRouter)

const routes = [{
        path: '/clientes',
        name: 'clientes',
        component: () => import('./components/Clientes.vue')
    },
    {
        path: '/clientes/new',
        name: 'nuevo-cliente',
        component: () => import('./components/FormCliente.vue')
    },
    {
        path: '/clientes/:id/edit',
        name: 'editar-cliente',
        component: () => import('./components/FormCliente.vue')
    },
    {
        path: '/ventas/new',
        name: 'nueva-venta',
        component: () => import('./components/FormVenta')
    },
    {
        path: '/ventas',
        name: 'ventas',
        component: () => import('./components/ListaVentas')
    },
    {
        path: '/ventas/:id',
        name: 'mostrar-venta',
        component: () => import('./components/ShowVenta')
    },
    {
        path: '/trabajos',
        name: 'trabajos',
        component: () => import('./components/ListaTrabajos')
    },
    {
        path: '/trabajos/:id/edit',
        name: 'EditarTrabajo',
        component: () => import('./components/FormTrabajo')
    },
    {
        path: '/trabajos/new',
        name: 'nuevo-trabajo',
        component: () => import('./components/FormTrabajo')
    },
    {
        path: '/gastos',
        name: 'gastos',
        component: () => import('./components/ListaGastos')
    },
    {
        path: '/gastos/new',
        name: 'nuevo-gasto',
        component: () => import('./components/FormGasto')
    },
    {
        path: '/gastos/:id',
        name: 'mostrar-gasto',
        component: () => import('./components/ShowGasto')
    },
    {
        path: '/gastos/:id/edit',
        name: 'editar-gasto',
        component: () => import('./components/FormGasto')
    },
    {
        path: '/productos',
        name: 'productos',
        component: () => import('./components/Productos')
    },
    {
        path: '/productos/new',
        name: 'nuevo-producto',
        component: () => import('./components/FormProducto')
    },
    {
        path: '/productos/:id/edit',
        name: 'editar-producto',
        component: () => import('./components/FormProducto')
    },
    {
        path: '/proveedores',
        name: 'proveedores',
        component: () => import('./components/Proveedores')
    },
    {
        path: '/proveedores/new',
        name: 'nuevo-proveedor',
        component: () => import('./components/FormProveedor')
    },
    {
        path: '/proveedores/:id/edit',
        name: 'editar-proveedor',
        component: () => import('./components/FormProveedor')
    },
    {
        path: '/empleados',
        name: 'empleados',
        component: () => import('./components/ListaEmpleados')
    },
    {
        path: '/empleados/new',
        name: 'nuevo-empleado',
        component: () => import('./components/FormEmpleado')
    },
    {
        path: '/empleados/:id/edit',
        name: 'editar-empleado',
        component: () => import('./components/FormEmpleado')
    },
];

export default new VueRouter({routes});