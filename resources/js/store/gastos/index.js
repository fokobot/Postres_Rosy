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
