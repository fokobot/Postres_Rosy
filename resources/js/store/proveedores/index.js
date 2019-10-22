import actions from './actions';
import mutations from './mutations';
import {getField} from 'vuex-map-fields';

const moduloProveedores = {
  state: {
    proveedores: [],
    proveedor: {},
    errores: [],
    saving: false,
    sent: null,
    loading: false
  },
  getters: {
    proveedor: state => {
        return state.proveedor
    },
    proveedores: state => {
        return state.proveedores;
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

export default moduloProveedores;
