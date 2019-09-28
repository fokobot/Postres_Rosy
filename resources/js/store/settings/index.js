const moduloSettings = {
  state: {
    tipos_de_documento: [],
    loadingTiposDeDoc: true
  },
  getters: {
    tipos_de_documento: state => {
      return state.tipos_de_documento
    }, 
    loadingTiposDeDoc: state => {
      return state.loadingTiposDeDoc
    }
  },
  mutations: {
    FETCH_TIPOS_DE_DOC(state, tipos_de_documento){
      state.tipos_de_documento = tipos_de_documento;
    },
    SW_LOADING_TIPOS_DE_DOC(state){
      state.loadingTiposDeDoc = !state.loadingTiposDeDoc;
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
      }
  },
}

export default moduloSettings;
