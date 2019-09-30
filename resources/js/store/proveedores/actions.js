let defaultProveedor = {
	id: 0,
	razon_social: '',
	gerente: '',
	direccion: '',
	email: '',
	telefono: '',
	edad_rc: '',
	departamento: null,
	ciudad: null
}

let actions = {
	fetchAll({commit}) {
		axios.get('/api/proveedores')
			.then(res => {
				commit('FETCH_ALL', res.data)
			}).catch(err => {
				console.log(err)
			})
	},
	fetch({commit}, id){
			if (id && id > 0){
					axios.get(`/api/proveedores/${id}`).then(res => {
							commit('FETCH', res.data);
					})
			} else {
				commit('FETCH', defaultProveedor)
			}
	},
	save({commit}, proveedor) {
			commit('SAVING');
			axios.post('/api/proveedores', proveedor).then(res => {
					$.notify(res.data.mensaje, "success");
					commit('CREATE', res.data.proveedor)
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
	update({commit}, proveedor){
			proveedor['_method'] = 'put';
			commit('SAVING');
			axios.post(`/api/proveedores/${proveedor.id}/edit`, proveedor).then(res => {
					$.notify(res.data.mensaje, "success");
					commit('UPDATE', proveedor)
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
	delete({commit}, proveedor){
			axios.delete(`/api/proveedores/${proveedor.id}`)
					.then(res => {
							$.notify(res.data.mensaje , 'success');
							commit('DELETE', proveedor);
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