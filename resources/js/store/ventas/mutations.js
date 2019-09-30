import router from '../../routes';
import { updateField } from 'vuex-map-fields';

let mutations = {
  CREATE(state, venta){
    Vue.set(state, 'errores', [])
    state.ventas.unshift(venta);
    let next;
    if(next = this.state.route.query.next){
      router.push(next)
    } else {
      router.push('/ventas')
    }
  },
  UPDATE(state, venta){
    let index = state.ventas.findIndex(item => item.id == venta.id);
    Vue.set(state.ventas, index, venta );
    let next;
    if(next = this.state.route.query.next){
      router.push(next)
    } else {
      router.push('/ventas')
    }
  },
  FETCH_ALL(state, data) {
    Vue.set(state, 'ventas', data.ventas);
    Vue.set(state, 'estados', data.estados);
  },
  FETCH(state, venta){
    Vue.set(state, 'loading', false);
    Vue.set(state, 'sent', null);
    Vue.set(state, 'venta', venta);
  },
  DELETE(state, venta){
    let index = state.ventas.findIndex(item => item.id == venta.id);
    state.ventas.splice(index, 1);
  },
  SAVING(state){
    Vue.set(state, 'saving', !state.saving);
    if(state.saving == false){
      Vue.set(state, 'sent', true)
    }
  },
  ERROR(state, errores){
    Vue.set(state, 'errores', errores);
  },
  updateField
}

export default mutations;