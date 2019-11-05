import actions from './actions';
import mutations from './mutations';
import { getField } from 'vuex-map-fields';

const moduloVentas = {
  state: {
    ventas: [],
    venta: {},
    errores: [],
    saving: false,
    sent: null,
  },
  getters: {
    venta: state => {
      return state.venta
    },
    ventas: state => {
      return state.ventas;
    },
    estados: state => {
      return state.estados
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

export default moduloVentas;
