<template>
  <div class="card">
    <div class="card-header">
      Gasto #
      <span v-if="gasto">{{gasto.id | zerofill}}</span>
      <router-link to="/gastos" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-list"></i> Gastos
      </router-link>
    </div>
    <div class="card-body">
      <div v-if="!loading">
        <div class="row">
          <div class="col-md-6 table-responsive-sm">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="2">
                    <h4 class="sub-header">
                      Usuario
                      <!-- <router-link
                        class="btn btn-primary btn-sm float-right"
                        :to="{name:'ver-empleado', params:{empleado: gasto.usuario.id}}"
                      >
                        <i class="fa fa-eye"></i>
                      </router-link> -->
                    </h4>
                  </th>
                </tr>
              </thead>
              <tbody>
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
              </tbody>
            </table>
          </div>
          <div class="col-md-6 table-responsive-sm">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="2">
                    <h4 class="sub-header">Proveedor</h4>
                  </th>
                </tr>
              </thead>
              <tbody>
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
              </tbody>
            </table>
          </div>
        </div>
        <hr />
        <detalle-gasto :productos="gasto.productos" :total="gasto.total"></detalle-gasto>
      </div>
      <div class="text-center" v-else>
        <b-spinner
          variant="primary"
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
    this.$store.dispatch('gastos/fetch', id);
  },
  computed: {
    ...mapGetters({
      gastos: 'gastos/gastos',
      getGastoByID: 'gastos/getGastoByID'
    }),
    gasto() {
      let id = this.$route.params.id;
      let gasto = this.gastos.find(item => item.id == id)
      if (gasto) Vue.set(this, 'loading', false)
      return gasto;
    },
  },
  data() {
    return {
      loading: true
    };
  },
};
</script>
