import actions from "./actions";
import mutations from "./mutations";

const moduloGastos = {
  state: {
    gastos: [],
    errores: [],
    saving: false,
    sent: null,
    loading: true
  },
  getters: {
    gastos: state => {
      return state.gastos
    },
    getGastoByID: (state) => (id) => {
      console.log('ESTOY BUSCANDDO EL GASTO PARA ACTUALZIARLO');
      return state.gastos.find(item => item.id == id)
    },
    errores: state => {
      return state.errores
    },
    saving: state => {
      return state.saving
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
};

export default moduloGastos;
