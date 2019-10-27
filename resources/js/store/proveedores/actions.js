let defaultProveedor = {
  id: 0,
  razon_social: '',
  gerente: '',
  direccion: '',
  email: '',
  telefono: '',
  edad_rc: '',
  ciudad: null
}

let actions = {
  fetchAll({ commit, state }) {
    commit('LOADING', true)
    if (state.proveedores.length === 0 || _.sample([true, false])) {
      axios.get('/api/proveedores')
        .then(res => {
          commit('FETCH_ALL', res.data)
        }).catch(err => {
          console.log(err)
        }).finally(() => commit('LOADING', false))
    } else {
      commit('LOADING', false)
    }
  },
  fetch({ commit }, id) {
    if (id && id > 0) {
      axios.get(`/api/proveedores/${id}`).then(res => {
        commit('FETCH', res.data);
      })
    } else commit('FETCH', defaultProveedor)
  },
  save({ commit }, proveedor) {
    commit('SAVING', true);
    axios.post('/api/proveedores', proveedor).then(res => {
      $.notify(res.data.mensaje, "success");
      commit('CREATE', res.data.proveedor)
    }).catch(err => {
      let errores = err.response;
      if (errores && errores.status === 422) {
        $.notify("Errores de validación.", "warn");
        commit('ERROR', errores.data.errors);
      } else {
        $.notify("Error desconocido.");
      }
    }).finally(() => {
      commit('SAVING', false);
    });
  },
  update({ commit }, proveedor) {
    proveedor['_method'] = 'put';
    commit('SAVING', true);
    axios.post(`/api/proveedores/${proveedor.id}/edit`, proveedor).then(res => {
      $.notify(res.data.mensaje, "success");
      commit('UPDATE', res.data.proveedor)
    }).catch(err => {
      let errores = err.response;
      if (errores && errores.status === 422) {
        $.notify("Errores de validación.", "warn");
        commit('ERROR', errores.data.errors);
      } else {
        $.notify("Error desconocido.");
      }
    }).finally(() => {
      commit('SAVING', false);
    });
  },
  delete({ commit, state }, index) {
    axios.delete(`/api/proveedores/${state.proveedores[index].id}`)
      .then(res => {
        $.notify(res.data.mensaje, 'success');
        commit('DELETE', index);
      }).catch(err => {
        if (err.response && err.response.status === 422) {
          $.notify(err.response.data.mensaje, 'warn')
        } else {
          $.notify("Error desconocido al eliminar.", 'danger');
        }
      });
  }
}

export default actions;