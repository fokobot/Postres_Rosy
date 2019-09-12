const ListaVentas = require('./components/ListaVentas.vue').default;
const FormVenta = require('./components/FormVenta.vue').default;

const routes = [
    { path: '/ventas/new', component: FormVenta},
    { path: '/ventas', component: ListaVentas },
];

export default routes;