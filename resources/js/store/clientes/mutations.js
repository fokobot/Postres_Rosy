import router from '../../routes';

let mutations = {
  CREATE(state, cliente) {
    Vue.set(state, 'errores', [])
    state.clientes.unshift(cliente);
    let next;
    if (next = this.state.route.query.next) {
      router.push(next)
    } else {
      router.push('/clientes')
    }
  },
  UPDATE(state, cliente, index) {
    Vue.set(state.clientes, index, cliente);
    let next;
    if (next = this.state.route.query.next) {
      router.push(next)
    } else {
      router.push('/clientes')
    }
  },
  FETCH_ALL(state, clientes) {
    state.clientes = clientes
    Vue.set(state, 'clientes', clientes);
  },
  FETCH(state, cliente) {
    let index = state.clientes.findIndex(item => item.id == cliente.id);
    Vue.set(state.clientes, index, cliente);
    Vue.set(state, 'sent', null);
  },
  DELETE(state, cliente) {
    let index = state.clientes.findIndex(item => item.id == cliente.id);
    state.clientes.splice(index, 1);
  },
  SAVING(state, saving) {
    Vue.set(state, 'saving', saving);
    if (!state.saving) {
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