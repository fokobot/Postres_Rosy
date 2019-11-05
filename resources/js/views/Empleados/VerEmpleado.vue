<template>
  <div class="card mb-4">
    <div class="card-header">
      Información del Empleado
      <router-link class="btn btn-sm btn-primary float-right" :to="{name:'lista-empleados'}">
        <i class="fa fa-list"></i> Empleados
      </router-link>
    </div>
    <div class="card-body">
      <DetalleEmpleado :empleado="empleado" v-if="!loading" />
      <div class="text-center" v-else>
        <b-spinner variant="primary" label="Cargando" />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import DetalleEmpleado from './DetalleEmpleado'

export default {
  name: 'VerEmpleado',
  components: { DetalleEmpleado },
  created() {
    let id = this.$route.params.empleado
    axios.get(`/api/empleados/${id}`).then(res => {
      Vue.set(this, 'empleado', res.data)
    }).finally(() => Vue.set(this, 'loading', false))
  }, data() {
    return {
      loading: true,
      empleado: {},
    }
  }
}
</script>