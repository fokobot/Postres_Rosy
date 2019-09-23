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
              <a class="btn btn-sm btn-danger" href="#" @click="eliminar(gasto.id)">
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
      eliminar: function (id) {
        bootbox.confirm("¿Realmente desea eliminar este gasto?", result => {
          if (!result) return;
          axios.delete('/api/gastos/' + id)
            .then(res => {
              let index = this.gastos.findIndex(function (item) {
                return item.id == id;
              });
              this.gastos.splice(index, 1);
              $.notify(res.data.mensaje , 'success');
            })
            .catch(err => {
              if (err.response && err.response.status === 422){
                $.notify(err.response.data.mensaje, 'warn')
              } else {
                $.notify("Error desconocido al eliminar", 'danger');
              }
            })
        });
      }
    }
  }
</script>
