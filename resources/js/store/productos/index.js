import actions from './actions';
import mutations from './mutations';

const moduloProductos = {
  state: {
    productos: [],
    errores: [],
    saving: false,
    sent: null,
    loading: false,
  },
  getters: {
    productos: state => {
      return state.productos;
    },
    getProductoByID: (state) => (id) => {
      return {... state.productos.find(item => item.id == id)}
    },
    saving: state => {
      return state.saving
    },
    errores: state => {
      return state.errores
    },
    sent: state => {
      return state.sent
    },
    loading: state => {
      return state.loading
    },
  },
  actions,
  mutations
}

export default moduloProductos;
