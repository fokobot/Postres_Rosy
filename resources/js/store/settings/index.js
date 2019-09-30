const moduloSettings = {
  state: {
    tipos_de_documento: [],
    loadingTiposDeDoc: false,
    departamentos: [],
    loadingDepartamentos: false
  },
  getters: {
    tipos_de_documento: state => {
      return state.tipos_de_documento
    }, 
    loadingTiposDeDoc: state => {
      return state.loadingTiposDeDoc
    },
    departamentos: state => {
      return state.departamentos
    },
    loadingDepartamentos: state => {
      return state.loadingDepartamentos;
    }
  },
  mutations: {
    FETCH_TIPOS_DE_DOC(state, tipos_de_documento){
      Vue.set(state, 'tipos_de_documento', tipos_de_documento);
    },
    SW_LOADING_TIPOS_DE_DOC(state){
      Vue.set(state, 'loadingTiposDeDoc', !state.loadingTiposDeDoc)
    },
    FETCH_DEPARTAMENTOS(state, departamentos){
      Vue.set(state, 'departamentos', departamentos);
    },
    SW_LOADING_DEPARTAMENTOS(state){
      Vue.set(state, 'loadingDepartamentos', !state.loadingDepartamentos)
    }
  },
  actions: {
    // -- cargando los tipos de documento -- //
    fetchTiposDeDoc({commit}) {
      axios.get('/api/tipos_de_documento')
      .then(res => {
        commit('FETCH_TIPOS_DE_DOC', res.data);
      }).catch(err => {
        console.log(err);
      }).finally(() => {
        commit('SW_LOADING_TIPOS_DE_DOC');
      });
    },
    // -- cargando los departamentos y ciudades -- //
    fetchDepartamentos({commit}) {
      axios.get('/api/departamentos')
      .then(res => {
        commit('FETCH_DEPARTAMENTOS', res.data);
      }).catch(err => {
        console.log(err);
      }).finally(() => {
        commit('SW_LOADING_DEPARTAMENTOS');
      });
    }
  },
}

export default moduloSettings;
