import getters from './getters';
import actions from './actions';
import mutations from './mutations';

const moduloClientes = {
  state: {
    clientes: [],
    cliente: {},
    saving: false,
    errores: [],
    sent: null,
    loading: false,
  },
  getters,
  actions,
  mutations
}

export default moduloClientes;