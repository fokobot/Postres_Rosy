<template>
  <div class="card mb-4">
    <div class="card-header">
      Lista de Productos
      <router-link class="btn btn-sm btn-primary float-right" :to="{name:'nuevo-producto'}">
        <i class="fa fa-plus"></i> Nuevo Producto
      </router-link>
    </div>
    <div class="card-body">
      <TablaProductos :productos="productos" :loading="loading" />
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import TablaProductos from './TablaProductos'

export default {
  name: 'ListaProductos',
  components: { TablaProductos },
  created() {
    this.$store.dispatch('productos/fetchAll');
  },
  computed: {
    ...mapGetters({
      productos: 'productos/productos',
      loading: 'productos/loading',
    })
  },
}
</script>
