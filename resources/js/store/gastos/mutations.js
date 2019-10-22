import router from '../../routes';

let mutations = {
  CREATE(state, gasto) {
    Vue.set(state, 'errores', [])
    state.gastos.unshift(gasto);
    router.push('/gastos')
  },
  UPDATE(state, gasto) {
    let index = state.gastos.findIndex(item => item.id == gasto.id);
    Vue.set(state.gastos, index, gasto);
    router.push('/gastos')
  },
  FETCH_ALL(state, gastos) {
    Vue.set(state, 'gastos', gastos);
  },
  FETCH(state, gasto) {
    let index = state.gastos.findIndex(item => item.id == gasto.id);
    if (index == -1) index = state.gastos.length;
    Vue.set(state.gastos, index, gasto);
    Vue.set(state, 'sent', null);
  },
  DELETE(state, index) {
    state.gastos.splice(index, 1);
  },
  SAVING(state, saving) {
    Vue.set(state, 'saving', saving);
    if (state.saving == false) {
      Vue.set(state, 'sent', true)
    }
  },
  LOADING(state, loading) {
    Vue.set(state, 'loading', loading);
  },
  ERROR(state, errores) {
    Vue.set(state, 'errores', errores);
  },
}

export default mutations;