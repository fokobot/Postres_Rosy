<template>
  <div class="card mb-4">
    <div class="card-header">
      Información del Cliente
      <router-link class="btn btn-sm btn-primary float-right" :to="{name:'lista-clientes'}">
        <i class="fa fa-list"></i> Clientes
      </router-link>
    </div>
    <div class="card-body">
      <DetalleCliente :cliente="cliente" v-if="!loading" />
      <div class="text-center" v-else>
        <b-spinner variant="primary" label="Cargando" />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import DetalleCliente from './DetalleCliente'
export default {
  name: 'VerCliente',
  components: { DetalleCliente },
  created() {
    let id = this.$route.params.cliente
    axios.get(`/api/clientes/${id}`).then(res => {
      Vue.set(this, 'cliente', res.data)
    }).finally(() => Vue.set(this, 'loading', false))
  }, data() {
    return {
      loading: true,
      cliente: {},
    }
  }
}
</script>