let defaultVenta = {
	id: 0,
	cliente: null,
	fecha: null,
	direccion: '',
	estado: null,
	productos: []
}

let actions = {
	fetchAll({commit}) {
		axios.get('/api/ventas')
			.then(res => {
				commit('FETCH_ALL', res.data)
			}).catch(err => {
				console.log(err)
			})
	},
	fetch({commit}, id){
			if (id && id > 0){
					axios.get(`/api/ventas/${id}`).then(res => {
							commit('FETCH', res.data);
					})
			} else {
				commit('FETCH', defaultVenta)
			}
	},
	save({commit}, venta) {
			commit('SAVING');
			axios.post('/api/ventas', venta).then(res => {
					$.notify(res.data.mensaje, "success");
					commit('CREATE', res.data.venta)
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
	update({commit}, venta){
			venta['_method'] = 'put';
			commit('SAVING');
			axios.post(`/api/ventas/${venta.id}/edit`, venta).then(res => {
					$.notify(res.data.mensaje, "success");
					commit('UPDATE', venta)
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
	delete({commit}, venta){
			axios.delete(`/api/ventas/${venta.id}`)
					.then(res => {
							$.notify(res.data.mensaje , 'success');
							commit('DELETE', venta);
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