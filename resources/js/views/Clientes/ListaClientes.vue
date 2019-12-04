<template>
  <div class="card mb-4">
    <div class="card-header">
      Lista de Clientes
      <router-link class="btn btn-sm btn-primary float-right" :to="{name:'nuevo-cliente'}">
        <i class="fa fa-plus"></i> Nuevo Cliente
      </router-link>
    </div>
    <div class="card-body">
     <tabla-clientes :clientes="clientes" :loading="loading"/>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import TablaClientes from '../../components/TablaClientes';

export default {
  name: 'Clientes',
  components: { TablaClientes },
  created() {
    if (this.clientes.length === 0) {
      this.$store.dispatch('clientes/fetchAll');
    }
  },
  computed: mapGetters({
    clientes: 'clientes/clientes',
    loading: 'clientes/loading'
  }),
}
</script>
