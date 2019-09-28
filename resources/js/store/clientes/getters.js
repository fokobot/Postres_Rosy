import { getField } from 'vuex-map-fields';

let getters = {
  cliente: state => {
    return state.cliente
  },
  clientes: state => {
    return state.clientes;
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
}

export default getters;