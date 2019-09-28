<template>
<div class="card mb-4">
  <div class="card-header">
    Lista de Productos
    <router-link class="btn btn-sm btn-primary float-right" to="/productos/new">
      <i class="fa fa-plus" ></i> Nuevo Producto
    </router-link>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Nombre del producto</th>
        <th>Valor al detal</th>
        <th>Valor al por mayor</th>
        <th>Cantidad min. al por mayor</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for="producto in productos" :key="producto.id">
          <td>{{producto.nombre}}</td>
          <td>{{producto.valordetal | currency}}</td>
          <td>{{producto.valormayor | currency}}</td>
          <td>{{producto.minimopormayor}}</td>
          <td>
          <router-link class="btn btn-sm btn-success" :to="{name: 'editar-producto', params: {id: producto.id}}">
            <i class="fa fa-edit" ></i>
          </router-link>
          <button class="btn btn-sm btn-danger" @click="eliminar(producto)">
            <i class="fa fa-trash"></i>
          </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script>
  import {mapGetters} from 'vuex';

  export default {
    name: 'Productos',
    mounted() {
      this.$store.dispatch('productos/fetchAll');
    },
    computed: {
      ...mapGetters({
        productos: 'productos/productos'
      })
    },
    methods: {
      eliminar(producto) {
        bootbox.confirm("¿Realmente desea eliminar este producto?", result => {
          if (!result) return;
          this.$store.dispatch('productos/delete', producto);
        })
      }
    }
  }
</script>
