import actions from "./actions";
import mutations from "./mutations";

const moduloEmpleados = {
  state: {
    empleados: [],
    errores: [],
    saving: false,
    sent: null,
    loading: true
  },
  getters: {
    empleados: state => {
      return state.empleados
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
    }
  },
  actions,
  mutations
};

export default moduloEmpleados;
