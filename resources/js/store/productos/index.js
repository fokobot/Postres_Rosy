import actions from './actions';
import mutations from './mutations';
import {getField} from 'vuex-map-fields';

const moduloProductos = {
  state: {
    productos: [],
    producto: {},
    errores: [],
    saving: false,
    sent: null
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
    getField
  },
  actions,
  mutations
}

export default moduloProductos;
