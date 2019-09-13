
const ListaTrabajos = require('./components/ListaTrabajos').default;
const ListaVentas = require('./components/ListaVentas.vue').default;

const FormVenta = require('./components/FormVenta.vue').default;
const FormTrabajo = require('./components/FormTrabajo.vue').default;

const routes = [
    { path: '/ventas/new', component: FormVenta},
    { path: '/ventas', component: ListaVentas },
    { path: '/trabajos', component: ListaTrabajos },
    {	
    	path: '/trabajos/:id/edit', 
    	name: 'EditarTrabajo', 
    	component: FormTrabajo
   	},
    { path: '/trabajos/new', component: FormTrabajo },
];

export default routes;