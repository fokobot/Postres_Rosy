import router from '../../routes';

let mutations = {
  CREATE(state, proveedor) {
    Vue.set(state, 'errores', [])
    state.proveedores.unshift(proveedor);
    let next;
    if (next = this.state.route.query.next) {
      router.push(next)
    } else {
      router.push('/proveedores')
    }
  },
  UPDATE(state, proveedor) {
    let index = state.proveedores.findIndex(item => item.id == proveedor.id);
    Vue.set(state.proveedores, index, proveedor);
    let next;
    if (next = this.state.route.query.next) {
      router.push(next)
    } else {
      router.push('/proveedores')
    }
  },
  FETCH_ALL(state, proveedores) {
    Vue.set(state, 'proveedores', proveedores);
  },
  FETCH(state, proveedor) {
    let index = state.proveedores.findIndex(item => item.id == proveedor.id);
    Vue.set(state.proveedores, index, proveedor);
    Vue.set(state, 'sent', null);
  },
  DELETE(state, index) {
    state.proveedores.splice(index, 1);
  },
  SAVING(state, saving) {
    Vue.set(state, 'saving', saving);
    if (state.saving == false) {
      Vue.set(state, 'sent', true)
    }
  },
  SAVING(state, loading) {
    Vue.set(state, 'loading', loading);
  },
  ERROR(state, errores) {
    Vue.set(state, 'errores', errores);
  },
}

export default mutations;