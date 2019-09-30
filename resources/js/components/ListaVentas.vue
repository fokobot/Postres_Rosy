<template>
<div class="card mb-4">
  <div class="card-header">
    Lista de Ventas
    <router-link to="/ventas/new">
      <button class="btn btn-sm btn-primary float-right">
        <i class="fa fa-plus" ></i> Nueva Venta
      </button>
    </router-link>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>#</th>
        <th>Cliente</th>
        <th>Vendedor</th>
        <th>Fecha</th>
        <th>Valor Total</th>
        <th>Estado</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for= "venta in ventas" :key="venta.id">
          <td>{{venta.id | zerofill}}</td>
          <td>{{nombre_cliente(venta.cliente)}}</td>
          <td>{{venta.vendedor.nombre}} {{venta.vendedor.apellidos}}</td>
          <td>{{venta.fecha}}</td>
          <td>{{venta.total | currency}}</td>
          <td>{{estado(venta)}}</td>
          <td>
            <router-link class="btn btn-sm btn-primary" :to="{name:'mostrar-venta', params: {id: venta.id}}" @click="show(venta)">
              <i class="fa fa-eye"></i>
            </router-link>
            <a class="btn btn-sm btn-success" :href="{name:'editar-venta', params: {id: venta.id}}">
              <i class="fa fa-edit" ></i>
            </a>
            <button class="btn btn-sm btn-danger" @click="eliminar(venta)">
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
    name: 'ListaVentas',
    mounted() {
      this.$store.dispatch('ventas/fetchAll');
    },
    computed: mapGetters({
      ventas: 'ventas/ventas',
      estados: 'ventas/estados'
    }),
    methods: {
      estado: function (venta) {
        return this.estados.find(function (item) {
          return item.id == venta.estado;
        }).nombre;
      },
      nombre_cliente: function (cliente) {
        return `${cliente.nombre} ${cliente.apellidos}`;
      },
      eliminar: function (venta) {
        bootbox.confirm("¿Realmente desea eliminar esta venta?", result => {
          if (!result) return;
          this.$store.dispatch('ventas/delete', venta);
        });
      }
    }
  }
</script>
