let actions = {
	fetchAll({commit}) {
		axios.get('/api/productos')
			.then(res => {
				commit('FETCH_ALL', res.data)
			}).catch(err => {
				console.log(err)
			})
	},
	fetch({commit}, id){
			if (id && id > 0){
					axios.get(`/api/productos/${id}`).then(res => {
							commit('FETCH', res.data);
					})
			} else {
				commit('FETCH', {})
			}
	},
	save({commit}, producto) {
			commit('SAVING');
			axios.post('/api/productos', producto).then(res => {
					$.notify(res.data.mensaje, "success");
					commit('CREATE', res.data.producto)
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
	update({commit}, producto){
			producto['_method'] = 'put';
			commit('SAVING');
			axios.post(`/api/productos/${producto.id}/edit`, producto).then(res => {
					$.notify(res.data.mensaje, "success");
					commit('UPDATE', producto)
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
	delete({commit}, producto){
			axios.delete(`/api/productos/${producto.id}`)
					.then(res => {
							$.notify(res.data.mensaje , 'success');
							commit('DELETE', producto);
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