<template>
  <div class="card mb-4">
    <div class="card-header">
      Lista de Gastos
      <router-link class="btn btn-sm btn-primary float-right" to="/gastos/new">
        <i class="fa fa-plus"></i> Nuevo Gasto
      </router-link>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <th>#</th>
            <th>Proveedor</th>
            <th>Valor</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Opciones</th>
          </thead>
          <tbody v-if="!loading">
            <tr v-for="gasto in gastos" :key="gasto.id" :class="gasto.estado.color">
              <td>{{gasto.id | zerofill}}</td>
              <td>{{gasto.proveedor.razon_social}}</td>
              <td>{{gasto.total | currency}}</td>
              <td>{{gasto.estado.nombre}}</td>
              <td>{{gasto.fecha}}</td>
              <td>
                <router-link class="btn btn-sm btn-primary" :to="{name: 'mostrar-gasto', params:{id: gasto.id}}">
                  <i class="fa fa-eye"></i>
                </router-link>&nbsp;
                <router-link class="btn btn-sm btn-success" :to="{name:'editar-gasto', params:{id: gasto.id}}">
                  <i class="fa fa-edit"></i>
                </router-link>&nbsp;
                <a class="btn btn-sm btn-danger" href="#" @click="eliminar(index)">
                  <i class="fa fa-trash"></i>
                </a>
                &nbsp;
              </td>
            </tr>
          </tbody>
          <FilaCargando :cols="6" v-else/>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
// TODO USAR EL STORE DE ESTADOS GASTO PARA EXIGIR MENOS EN EL SERVIDOR
import { mapGetters } from "vuex";
import FilaCargando  from "../../components/FilaCargando";

export default {
  name: 'ListaGastos',
  components: {FilaCargando},
  mounted() {
    this.$store.dispatch('gastos/fetchAll')
  },
  computed: {
    ...mapGetters({
      gastos: 'gastos/gastos',
      loading: 'gastos/loading'
    })
  },
  methods: {
    eliminar: function (index) {
      bootbox.confirm("¿Realmente desea eliminar este gasto?", result => {
        if (!result) return;
        this.$store.dispatch('gastos/delete', index);
      });
    }
  }
}
</script>
