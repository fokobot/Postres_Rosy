const moduloSettings = {
  state: {
    tipos_de_documento: [],
    loadingTiposDeDoc: false,
    departamentos: [],
    loadingDepartamentos: false,
    estados_civiles: [],
    loadingEstadosCiv: false,
    estados_gasto: [],
    loadingEstadosGasto: false
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
    },
    estados_civiles: state => {
      return state.estados_civiles
    },
    loadingloadingEstadosCiv: state => {
      return state.loadingEstadosCiv;
    },
    estados_gasto: state => {
      return state.estados_gasto
    },
    loadingloadingEstadosGasto: state => {
      return state.loadingEstadosGasto;
    },
  },
  mutations: {
    FETCH_TIPOS_DE_DOC(state, tipos_de_documento) {
      Vue.set(state, 'tipos_de_documento', tipos_de_documento);
    },
    SW_LOADING_TIPOS_DE_DOC(state, loading) {
      Vue.set(state, 'loadingTiposDeDoc', loading)
    },
    FETCH_DEPARTAMENTOS(state, departamentos) {
      Vue.set(state, 'departamentos', departamentos);
    },
    SW_LOADING_DEPARTAMENTOS(state, loading) {
      Vue.set(state, 'loadingDepartamentos', loading)
    },
    FETCH_ESTADOS_CIVILES(state, estados) {
      Vue.set(state, 'estados_civiles', estados);
    },
    SW_LOADING_ESTADOS_CIVILES(state, loading) {
      Vue.set(state, 'loadingEstadosCiv', loading)
    },
    FETCH_ESTADOS_GASTO(state, estados) {
      Vue.set(state, 'estados_gasto', estados);
    },
    SW_LOADING_ESTADOS_GASTO(state, loading) {
      Vue.set(state, 'loadingEstadosGasto', loading)
    },
  },
  actions: {
    // -- cargando los tipos de documento -- //
    fetchTiposDeDoc({ commit }) {
      commit('SW_LOADING_TIPOS_DE_DOC', true);
      axios.get('/api/tipos_de_documento')
        .then(res => {
          commit('FETCH_TIPOS_DE_DOC', res.data);
        }).catch(err => {
          console.log(err);
        }).finally(() => {
          commit('SW_LOADING_TIPOS_DE_DOC', false);
        });
    },
    // -- cargando los departamentos y ciudades -- //
    fetchDepartamentos({ commit, state }) {
      // evitar volver a cargar esta información
      if (state.departamentos.length === 0) {
        commit('SW_LOADING_DEPARTAMENTOS', true);
        axios.get('/api/departamentos')
          .then(res => {
            commit('FETCH_DEPARTAMENTOS', res.data);
          }).catch(err => {
            console.log(err);
          }).finally(() => {
            commit('SW_LOADING_DEPARTAMENTOS', false);
          });
      }
    },
    // -- cargando los estados civiles -- //
    fetchEstadosCiviles({ commit }) {
      commit('SW_LOADING_ESTADOS_CIVILES', true);
      axios.get('/api/estados_civiles')
        .then(res => {
          commit('FETCH_ESTADOS_CIVILES', res.data);
        }).catch(err => {
          console.log(err);
        }).finally(() => {
          commit('SW_LOADING_ESTADOS_CIVILES', false);
        });
    },
    // -- cargando los estados civiles -- //
    fetchEstadosGasto({ commit }) {
      commit('SW_LOADING_ESTADOS_GASTO', true);
      axios.get('/api/estados_gasto')
        .then(res => {
          commit('FETCH_ESTADOS_GASTO', res.data);
        }).catch(err => {
          console.log(err);
        }).finally(() => {
          commit('SW_LOADING_ESTADOS_GASTO', false);
        });
    },
  },
}

export default moduloSettings;
