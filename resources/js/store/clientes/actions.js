let actions = {
  fetchAll({ commit }) {
    commit('LOADING', true)
    axios.get('/api/clientes')
      .then(res => {
        commit('FETCH_ALL', res.data)
        commit('LOADING', false)
      }).catch(err => {
        console.log(err)
      })
  },
  fetch({ commit }, id) {
    if (id && id > 0) {
      axios.get(`/api/clientes/${id}`).then(res => {
        commit('FETCH', res.data);
      })
    }
  },
  save({ commit }, cliente) {
    commit('SAVING', true);
    axios.post('/api/clientes', cliente).then(res => {
      $.notify(res.data.mensaje, "success");
      commit('CREATE', res.data.cliente)
    }).catch(err => {
      let errores = err.response;
      if (errores && errores.status === 422) {
        $.notify("Errores de validación.", "warn");
        commit('ERROR', errores.data.errors);
      } else {
        console.log(err)
        $.notify("Error desconocido.");
      }
    }).finally(() => {
      commit('SAVING', false);
    });
  },
  update({ commit }, cliente, index) {
    cliente['_method'] = 'put';
    commit('SAVING', true);
    axios.post(`/api/clientes/${cliente.id}/edit`, cliente).then(res => {
      $.notify(res.data.mensaje, "success");
      commit('UPDATE', res.data.cliente, index)
    }).catch(err => {
      let errores = err.response;
      if (errores && errores.status === 422) {
        $.notify("Errores de validación.", "warn");
        commit('ERROR', errores.data.errors);
      } else {
        console.log(err)
        $.notify("Error desconocido.");
      }
    }).finally(() => {
      commit('SAVING', false);
    });
  },
  delete({ commit, state }, index) {
    axios.delete(`/api/clientes/${state.clientes[index].id}`)
      .then(res => {
        $.notify(res.data.mensaje, 'success');
        commit('DELETE', index);
      }).catch(err => {
        if (err.response && err.response.status === 422) {
          $.notify(err.response.data.mensaje, 'warn')
        } else {
          console.log(err)
          $.notify("Error desconocido al eliminar.", 'danger');
        }
      });
  }
}

export default actions;