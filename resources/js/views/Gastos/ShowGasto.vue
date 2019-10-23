<template>
  <div class="card">
    <div class="card-header">
      Gasto {{gasto.id | zerofill}}
      <router-link to="/gastos" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-list"></i> Gastos
      </router-link>
    </div>
    <div class="card-body">
      <div v-if="!loading">
        <div class="row">
          <div class="col-md-6 table-responsive">
            <h4 class="sub-header">Usuario</h4>
            <table class="table">
              <tr>
                <th>#</th>
                <td>{{gasto.usuario.id | zerofill}}</td>
              </tr>
              <tr>
                <th>Nombre</th>
                <td>{{gasto.usuario.persona.nombre}} {{gasto.usuario.persona.apellidos}}</td>
              </tr>
              <tr>
                <th>E-mail</th>
                <td>{{gasto.usuario.email}}</td>
              </tr>
            </table>
          </div>
          <div class="col-md-6 table-responsive">
            <h4 class="sub-header">Proveedor</h4>
            <table class="table">
              <tr>
                <th>Razón Social</th>
                <td>{{gasto.proveedor.razon_social}}</td>
              </tr>
              <tr>
                <th>Telefono</th>
                <td>{{gasto.proveedor.telefono}}</td>
              </tr>
              <tr>
                <th>Dirección</th>
                <td>Barrio {{gasto.proveedor.direccion}}</td>
              </tr>
            </table>
          </div>
        </div>
        <hr />
        <detalle-gasto :productos="gasto.productos" :total="gasto.total"></detalle-gasto>
      </div>
      <div class="text-center" v-else>
        <b-spinner
          variant="primary"
          type="grow"
          label="Cargando..."
          style="width: 6rem; height: 6rem;"
        ></b-spinner>
      </div>
    </div>
  </div>
</template>

<script>
import ShowDetalleGasto from "./ShowDetalleGasto";
import { mapGetters } from "vuex";
export default {
  name: "ShowGasto",
  components: {
    "detalle-gasto": ShowDetalleGasto
  },
  mounted() {
    let id = this.$route.params.id;

    let a = this.$store.dispatch('gastos/fetch', id);
    a.then(() => {
      Vue.set(this, 'gasto', this.getGastoByID(id));
      console.log(this.getGastoByID(2));
      
      Vue.set(this, 'loading', false)
    });
  },
  computed: {
    ...mapGetters({
      gastos      : 'gastos/gastos',
      getGastoByID: 'gastos/getGastoByID'
    })
  },
  data() {
    return {
      gasto: {},
      loading: true
    };
  },
};
</script>
