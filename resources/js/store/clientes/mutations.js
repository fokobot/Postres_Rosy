import router from '../../routes';
import { updateField } from 'vuex-map-fields';

let mutations = {
  CREATE(state, cliente){
    Vue.set(state, 'errores', [])
    state.clientes.unshift(cliente);
    let next;
    if(next = this.state.route.query.next){
      router.push(next)
    } else {
      router.push('/clientes')
    }
  },
  UPDATE(state, cliente){
    let index = state.clientes.findIndex(item => item.id == cliente.id);
    Vue.set(state.clientes, index, cliente );
    let next;
    if(next = this.state.route.query.next){
      router.push(next)
    } else {
      router.push('/clientes')
    }
  },
  FETCH_ALL(state, clientes) {
    state.clientes = clientes
    Vue.set(state, 'clientes', clientes);
  },
  FETCH(state, cliente){
    Vue.set(state, 'cliente', cliente);
    Vue.set(state, 'sent', null);
  },
  DELETE(state, cliente){
    let index = state.clientes.findIndex(item => item.id == cliente.id);
    state.clientes.splice(index, 1);
  },
  SAVING(state){
    Vue.set(state, 'saving', !state.saving);
    if(!state.saving){
      Vue.set(state, 'sent', true)
    }
  },
  ERROR(state, errores){
    Vue.set(state, 'errores', errores);
  },
  updateField
}

export default mutations;