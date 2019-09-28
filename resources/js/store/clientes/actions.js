let defaultCliente = {
  id: 0,
  tipo_de_documento: 0,
  nombre: '',
  apellidos: '',
  email: '',
  direccion: '',
  barrio: '',
  telefono: '',
  fecha_de_nacimiento: ''
}

let actions = {
  fetchAll({commit}) {
    axios.get('/api/clientes')
      .then(res => {
        commit('FETCH_ALL', res.data)
      }).catch(err => {
        console.log(err)
      })
  },
  fetch({commit}, id){
    if (id && id > 0){
      axios.get(`/api/clientes/${id}`).then(res => {
        commit('FETCH', res.data);
      })
    } else {
      console.log('fetch default');
      commit('FETCH', defaultCliente)
    }
  },
  save({commit}, cliente) {
    commit('SAVING');
    axios.post('/api/clientes', cliente).then(res => {
      $.notify(res.data.mensaje, "success");
      commit('CREATE', res.data.cliente)
    }).catch(err => {
      let errores = err.response;
      if (errores && errores.status === 422){
        $.notify("Errores de validación.", "warn");
        commit('ERROR', errores.data.errors);
      } else {
        console.log(err)
        $.notify("Error desconocido.");
      }
    }).finally(() => {
      commit('SAVING');
    });
  },
  update({commit}, cliente){
    cliente['_method'] = 'put';
    commit('SAVING');
    axios.post(`/api/clientes/${cliente.id}/edit`, cliente).then(res => {
      $.notify(res.data.mensaje, "success");
      commit('UPDATE', cliente)
    }).catch(err => {
      let errores = err.response;
      if (errores && errores.status === 422){
        $.notify("Errores de validación.", "warn");
        commit('ERROR', errores.data.errors);
      } else {
        console.log(err)
        $.notify("Error desconocido.");
      }
    }).finally(() => {
      commit('SAVING');
    });
  },
  delete({commit}, cliente){
    axios.delete(`/api/clientes/${cliente.id}`)
      .then(res => {
        $.notify(res.data.mensaje , 'success');
        commit('DELETE', cliente);
      }).catch(err => {
        if (err.response && err.response.status === 422){
          $.notify(err.response.data.mensaje, 'warn')
        } else {
          console.log(err)
          $.notify("Error desconocido al eliminar.", 'danger');
        }
      });
  }
}

export default actions;