import router from '../../routes';
import { updateField } from 'vuex-map-fields';

let mutations = {
  CREATE(state, proveedor){
    Vue.set(state, 'errores', [])
    state.proveedores.unshift(proveedor);
    let next;
    if(next = this.state.route.query.next){
      router.push(next)
    } else {
      router.push('/proveedores')
    }
  },
  UPDATE(state, proveedor){
    let index = state.proveedores.findIndex(item => item.id == proveedor.id);
    Vue.set(state.proveedores, index, proveedor );
    let next;
    if(next = this.state.route.query.next){
      router.push(next)
    } else {
      router.push('/proveedores')
    }
  },
  FETCH_ALL(state, proveedores) {
    Vue.set(state, 'proveedores', proveedores);
  },
  FETCH(state, proveedor){
    Vue.set(state, 'proveedor', proveedor);
		Vue.set(state, 'sent', null);
  },
  DELETE(state, proveedor){
    let index = state.proveedores.findIndex(item => item.id == proveedor.id);
    state.proveedores.splice(index, 1);
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