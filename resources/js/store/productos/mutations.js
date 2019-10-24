import router from '../../routes';
import { updateField } from 'vuex-map-fields';

let mutations = {
  CREATE(state, producto) {
    Vue.set(state, 'errores', [])
    state.productos.unshift(producto);
    let next;
    if (next = this.state.route.query.next) {
      router.push(next)
    } else {
      router.push('/productos')
    }
  },
  UPDATE(state, producto) {
    let index = state.productos.findIndex(item => item.id == producto.id);
    Vue.set(state.productos, index, producto);
    let next;
    if (next = this.state.route.query.next) {
      router.push(next)
    } else {
      router.push('/productos')
    }
  },
  FETCH_ALL(state, productos) {
    Vue.set(state, 'productos', productos);
  },
  FETCH(state, producto) {
    Vue.set(state, 'producto', producto);
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
  LOADING(state, loading){
    Vue.set(state, 'loading', loading)
  },
  ERROR(state, errores) {
    Vue.set(state, 'errores', errores);
  },
  updateField
}

export default mutations;