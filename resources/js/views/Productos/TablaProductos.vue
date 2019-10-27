<template>
  <table class="table table-hover">
    <thead>
      <th>Nombre del producto</th>
      <th>Valor al detal</th>
      <th>Valor al por mayor</th>
      <th>Cantidad min. al por mayor</th>
      <th>Opciones</th>
    </thead>
    <tbody v-if="!loading">
      <tr v-for="producto in productos" :key="producto.id">
        <td>{{producto.nombre}}</td>
        <td>{{producto.valordetal | currency}}</td>
        <td>{{producto.valormayor | currency}}</td>
        <td>{{producto.minimopormayor}}</td>
        <td>
          <router-link class="btn btn-sm btn-success" :to="{name: 'editar-producto', params: {producto: producto.id}}">
            <i class="fa fa-edit" ></i>
          </router-link>
          <button class="btn btn-sm btn-danger" @click="eliminar(producto)">
            <i class="fa fa-trash"></i>
          </button>
        </td>
      </tr>
    </tbody>
    <FilaCargando :cols="5" v-else />
  </table>
</template>

<script>
import FilaCargando from '../../components/FilaCargando'

export default {
  name: 'TablaProductos',
  components: { FilaCargando },
  props: {
    productos: {
      type: Array,
      required: true
    },
    loading: {
      type: Boolean,
      default: false
    }
  }, methods: {
    eliminar(producto) {
      bootbox.confirm("¿Realmente desea eliminar este producto?", result => {
        if (!result) return;
        this.$store.dispatch('productos/delete', producto);
      })
    }
  }
}
</script>

<style>
</style>