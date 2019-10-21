import router from '../../routes';

let mutations = {
	CREATE(state, empleado) {
		Vue.set(state, 'errores', [])
		state.empleados.unshift(empleado);
		router.push('/empleados')
	},
	UPDATE(state, empleado) {
		let index = state.empleados.findIndex(item => item.id == empleado.id);
		Vue.set(state.empleados, index, empleado);
		router.push('/empleados')
	},
	FETCH_ALL(state, empleados) {
		Vue.set(state, 'empleados', empleados);
	},
	FETCH(state, empleado) {
		Vue.set(state, 'empleado', empleado);
		Vue.set(state, 'sent', null);
	},
	DELETE(state, index) {
		state.empleados.splice(index, 1);
	},
	SAVING(state, saving) {
		Vue.set(state, 'saving', saving);
		if (state.saving == false) {
			Vue.set(state, 'sent', true)
		}
	},
	LOADING(state, loading) {
		Vue.set(state, 'loading', loading);
	},
	ERROR(state, errores) {
		Vue.set(state, 'errores', errores);
	}
}

export default mutations;