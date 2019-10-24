import actions from './actions';
import mutations from './mutations';
import {getField} from 'vuex-map-fields';

const moduloProductos = {
  state: {
    productos: [],
    producto: {},
    errores: [],
    saving: false,
    sent: null,
    loading: false,
  },
  getters: {
    producto: state => {
        return state.producto
    },
    productos: state => {
        return state.productos;
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
    getField
  },
  actions,
  mutations
}

export default moduloProductos;
