<template>
  <div class="card mb-4">
    <div class="card-header">
      Lista de Empleados
      <router-link class="btn btn-sm btn-primary float-right" to="/empleados/new">
        <i class="fa fa-plus"></i> Nuevo Empleado
      </router-link>
    </div>
    <div class="card-body">
      <tabla-empleados :empleados="empleados" :loading="loading" />
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import TablaEmpleados from '../../components/TablaEmpleados'

export default {
  name: 'ListaEmpleados',
  components: {TablaEmpleados},
  created() {
    if (this.empleados.length === 0) {
      this.$store.dispatch('empleados/fetchAll');
    }
  },
  computed: {
    ...mapGetters({
      empleados: 'empleados/empleados',
      loading: 'empleados/loading',
    })
  },
}
</script>