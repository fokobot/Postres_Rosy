import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'inicio',
    component: () => import('./views/Reportes/ReporteDiario')
  },
  {
    path: '/reporte',
    name: ' reportes',
    component: () => import('./views/Reportes/ReporteDiario')
  },
  {
    path: "/ventas/new",
    name: "nueva-venta",
    component: () => import("./views/Ventas/FormVenta")
  },
  {
    path: "/ventas",
    name: "ventas",
    component: () => import("./views/Ventas/ListaVentas")
  },
  {
    path: "/ventas/:id",
    name: "mostrar-venta",
    component: () => import("./views/Ventas/ShowVenta")
  },
  {
    path: "/trabajos",
    name: "trabajos",
    component: () => import("./components/ListaTrabajos")
  },
  {
    path: "/trabajos/:id/edit",
    name: "EditarTrabajo",
    component: () => import("./components/FormTrabajo")
  },
  {
    path: "/trabajos/new",
    name: "nuevo-trabajo",
    component: () => import("./components/FormTrabajo")
  },
  {
    path: "/gastos",
    name: "gastos",
    component: () => import("./views/Gastos/ListaGastos")
  },
  {
    path: "/gastos/new",
    name: "nuevo-gasto",
    component: () => import("./views/Gastos/FormGasto")
  },
  {
    path: "/gastos/:id",
    name: "mostrar-gasto",
    component: () => import("./views/Gastos/ShowGasto")
  },
  {
    path: "/gastos/:id/edit",
    name: "editar-gasto",
    component: () => import("./views/Gastos/FormGasto")
  },
  {
    path: "/productos",
    name: "productos",
    component: () => import("./views/Productos/ListaProductos")
  },
  {
    path: "/productos/nuevo",
    name: "nuevo-producto",
    component: () => import("./views/Productos/NuevoProducto")
  },
  {
    path: "/productos/:producto/editar",
    name: "editar-producto",
    component: () => import("./views/Productos/EditarProducto")
  },
  {
    path: "/proveedores",
    name: "proveedores",
    component: () => import("./views/Proveedores/ListaProveedores")
  },
  {
    path: "/proveedores/new",
    name: "nuevo-proveedor",
    component: () => import("./views/Proveedores/FormProveedor")
  },
  {
    path: "/proveedores/:id/edit",
    name: "editar-proveedor",
    component: () => import("./views/Proveedores/FormProveedor")
  },
  {
    path: "/clientes",
    name: "lista-clientes",
    component: () => import("./views/Clientes/ListaClientes.vue")
  },
  {
    path: "/clientes/new",
    name: "nuevo-cliente",
    component: () => import("./views/Clientes/FormCliente.vue")
  },
  {
    path: '/clientes/:cliente',
    name: 'ver-cliente',
    component: () => import('./views/Clientes/VerCliente.vue')
  },
  {
    path: "/clientes/:id/edit",
    name: "editar-cliente",
    component: () => import("./views/Clientes/FormCliente.vue")
  },
  {
    path: "/empleados",
    name: "lista-empleados",
    component: () => import("./views/Empleados/ListaEmpleados")
  },
  {
    path: "/empleados/new",
    name: "nuevo-empleado",
    component: () => import("./views/Empleados/FormEmpleado")
  },
  {
    path: '/empleados/:empleado',
    name: 'ver-empleado',
    component: () => import('./views/Empleados/VerEmpleado')
  },
  {
    path: "/empleados/:id/edit",
    name: "editar-empleado",
    component: () => import("./views/Empleados/FormEmpleado")
  }
];

export default new VueRouter({ routes });
