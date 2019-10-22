<template>
<div class="card mb-4">
  <div class="card-header">
    Lista de Gastos
    <router-link class="btn btn-sm btn-primary float-right" to="/gastos/new">
      <i class="fa fa-plus" ></i> Nuevo Gasto
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
        <tbody>
          <tr v-for="gasto in gastos" :key="gasto.id" :class="color(gasto)">
            <td>{{gasto.id | zerofill}}</td>
            <td>{{gasto.proveedor.razon_social}}</td>
            <td>{{gasto.total | currency}}</td>
            <td>{{estado(gasto).nombre}}</td>
            <td>{{gasto.fecha}}</td>
            <td>
              <router-link class="btn btn-sm btn-primary" :to="url('', gasto.id)">
                <i class="fa fa-eye" ></i>
              </router-link>
              &nbsp;
              <router-link class="btn btn-sm btn-success" :to="url('edit', gasto.id)">
                <i class="fa fa-edit" ></i>
              </router-link>
              &nbsp;
              <a class="btn btn-sm btn-danger" href="#" @click="eliminar(index)">
                <i class="fa fa-trash"></i>
              </a>
              &nbsp;
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</template>

<script>
  export default {
    name: 'ListaGastos',
    mounted() {
      axios
        .get('/api/gastos/')
        .then(response => (this.gastos = response.data['gastos'], this.estados = response.data['estados']))
        .catch(err => $.notify('Ha ocurrido un error desconocido.', 'error'))
    },
    data() { return {
      gastos:  [],
      estados: []
    }},
    methods: {
      url: function (verb, id) {
        if(verb=='') verb = `/${verb}`;
        return `/gastos/${id}${verb}`;
      },
      estado: function (gasto) {
        return this.estados.find(function (item) {
          return item.id == gasto.estado;
        });
      },
      color: function(gasto){
        return `table-${this.estado(gasto).color}`;
      },
      eliminar: function (index) {
        bootbox.confirm("¿Realmente desea eliminar este gasto?", result => {
          if (!result) return;
          this.$store.dispatch('gastos/delete', index);
        });
      }
    }
  }
</script>
