import router from '../../routes';

let mutations = {
  CREATE(state) {
    Vue.set(state, 'errores', [])
    let next;
    if (next = this.state.route.query.next) {
      router.push(next)
    } else {
      router.push({ name: 'productos' })
    }
  },
  UPDATE(state) {
    let next;
    if (next = this.state.route.query.next) {
      router.push(next)
    } else {
      router.push({ name: 'productos' })
    }
  },
  FETCH_ALL(state, productos) {
    Vue.set(state, 'productos', productos);
  },
  FETCH(state, producto) {
    let index = state.productos.findIndex(item => item.id == producto.id)
    if(index == -1) index = state.productos.length;
    Vue.set(state.productos, index, producto)
    Vue.set(state, 'sent', null);
  },
  DELETE(state, producto) {
    let index = state.productos.findIndex(item => item.id == producto.id);
    state.productos.splice(index, 1);
  },
  SAVING(state, saving) {
    Vue.set(state, 'saving', saving);
    if (state.saving == false) {
      Vue.set(state, 'sent', true)
    }
  },
  LOADING(state, loading) {
    Vue.set(state, 'loading', loading)
  },
  ERROR(state, errores) {
    Vue.set(state, 'errores', errores);
  },
}

export default mutations;