<template>
  <div class="card mb-4">
    <div class="card-header">
      Lista de Ventas
      <router-link :to="{name:'nueva-venta'}">
        <button class="btn btn-sm btn-primary float-right">
          <i class="fa fa-plus"></i> Nueva Venta
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
        <tbody v-if="!loading">
          <tr v-for="venta in ventas" :key="venta.id">
            <td>{{venta.id | zerofill}}</td>
            <td>{{venta.cliente.persona.nombre}} {{venta.cliente.persona.apellidos}}</td>
            <td>{{venta.vendedor.persona.nombre}} {{venta.vendedor.persona.apellidos}}</td>
            <td>{{venta.fecha}}</td>
            <td>{{venta.total | currency}}</td>
            <td>{{estado(venta)}}</td>
            <td>
              <router-link
                class="btn btn-sm btn-primary"
                :to="{name:'mostrar-venta', params: {id: venta.id}}"
                @click="show(venta)"
              >
                <i class="fa fa-eye"></i>
              </router-link>
              <!-- <button class="btn btn-sm btn-danger" @click="eliminar(venta)">
                <i class="fa fa-trash"></i>
              </button>-->
            </td>
          </tr>
        </tbody>
        <FilaCargando :cols="7" v-else />
      </table>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import FilaCargando from '../../components/FilaCargando'

export default {
  name: 'ListaVentas',
  components: { FilaCargando },
  created() {
    this.$store.dispatch('ventas/fetchAll').then(() => this.loading = false);
  },
  data() {
    return {
      loading: true
    }
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
    eliminar: function (venta) {
      bootbox.confirm("¿Realmente desea eliminar esta venta?", result => {
        if (!result) return;
        this.$store.dispatch('ventas/delete', venta);
      });
    }
  }
}
</script>
