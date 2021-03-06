let actions = {
  fetchAll({ commit, state }) {
    commit('LOADING', true)
    if (state.gastos.length == 0 || _.sample([true, false])) {
      axios.get('/api/gastos')
        .then(res => {
          commit('FETCH_ALL', res.data)
          commit('LOADING', false)
        }).catch(err => {
          console.log(err)
        })
    } else commit('LOADING', false)
  },
  fetch({ commit }, id) {
    if (id && id > 0) {
      axios.get(`/api/gastos/${id}`).then(res => {
        commit('FETCH', res.data);
      })
    }
  },
  save({ commit }, gasto) {
    commit('SAVING', true);
    axios.post('/api/gastos', gasto).then(res => {
      $.notify(res.data.mensaje, "success");
      commit('CREATE', res.data.gasto)
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
  update({ commit }, gasto) {
    gasto['_method'] = 'put';
    commit('SAVING', true);
    axios.post(`/api/gastos/${gasto.id}/edit`, gasto).then(res => {
      $.notify(res.data.mensaje, "success");
      commit('UPDATE', gasto)
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
    axios.delete(`/api/gastos/${state.gastos[index].id}`)
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