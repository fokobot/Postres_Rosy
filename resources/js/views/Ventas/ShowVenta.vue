<template>
  <div class="card">
    <div class="card-header">
      Venta {{venta.id | zerofill}}
      <router-link to="/ventas" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-list"></i> Ventas
      </router-link>
    </div>
    <div class="card-body">
      <div class="row" v-if="!loading">
        <div class="col-md-6 table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th colspan="2">
                  <h4 class="sub-header">
                    Vendedor
                    <router-link
                      class="btn btn-primary btn-sm float-right"
                      :to="{name:'ver-empleado', params:{empleado: venta.vendedor.id}}"
                    >
                      <i class="fa fa-eye"></i>
                    </router-link>
                  </h4>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>#</th>
                <td>{{venta.vendedor.id | zerofill}}</td>
              </tr>
              <tr>
                <th>Nombre</th>
                <td>{{venta.vendedor.persona.nombre}} {{venta.vendedor.persona.apellidos}}</td>
              </tr>
              <tr>
                <th>E-mail</th>
                <td>{{venta.vendedor.email}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-6 table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th colspan="2">
                  <h4 class="sub-header">
                    Cliente
                    <router-link
                      class="btn btn-primary btn-sm float-right"
                      :to="{name:'ver-cliente', params:{cliente: venta.cliente.id}}"
                    >
                      <i class="fa fa-eye"></i>
                    </router-link>
                  </h4>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Nombre</th>
                <td>{{venta.cliente.persona.nombre}} {{venta.cliente.persona.apellidos}}</td>
              </tr>
              <tr>
                <th>Telefono</th>
                <td>{{venta.cliente.persona.telefono}}</td>
              </tr>
              <tr>
                <th>Dirección</th>
                <td>Barrio {{venta.cliente.persona.barrio}}. {{venta.cliente.persona.direccion}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="text-center" v-else>
        <b-spinner
          variant="primary"
          label="Cargando..."
          style="width: 6rem; height: 6rem;"
        >Cargando...</b-spinner>
      </div>
      <hr />
      <detalle-venta :productos="venta.productos" :total="venta.total"></detalle-venta>
    </div>
  </div>
</template>

<script>
import ShowDetalleVenta from "./ShowDetalleVenta";
import { mapGetters } from "vuex";

export default {
  name: "ShowVenta",
  components: {
    "detalle-venta": ShowDetalleVenta
  },
  created() {
    this.$store.dispatch("ventas/fetch", this.$route.params.id).then(() => this.loading = false);
  },
  data() {
    return {
      loading: true
    }
  },
  computed: mapGetters({
    venta: "ventas/venta",
  })
};
</script>
