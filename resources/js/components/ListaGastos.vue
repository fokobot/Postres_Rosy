<template>
<div class="card mb-4">
  <div class="card-header">
    Lista de Gastos
    <router-link class="btn btn-sm btn-primary float-right" to="/gastos/new">
      <i class="fa fa-plus" ></i> Nuevo Gasto
    </router-link>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Descripcion</th>
        <th>Valor</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for="gasto in gastos">
          <td>{{gasto.descripcion}}</td>
          <td>{{gasto.valor}}</td>
          <td>{{estado(gasto)}}</td>
          <td>{{gasto.fecha}}</td>
          <td>
            <router-link class="btn btn-sm btn-success" :to="url('edit', gasto.id)">
  						<i class="fa fa-edit" ></i>
  					</router-link>
            <a class="btn btn-sm btn-danger" href="#" @click="eliminar(gasto.id)">
              <i class="fa fa-trash"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script>
    export default {
      name: 'lista-gastos',
      mounted() {
        axios
          .get('/api/gastos/')
          .then(response => (this.gastos = response.data['gastos'], this.estados = response.data['estados']))
          .catch(err => $.notify('Ha ocurrido un error desconocido.', 'error'))
      },
      data: function(){ return {
        gastos:  [],
        estados: []
      }},
      methods: {
        url: function (verb, id) {
          return `/gastos/${id}/${verb}`;
        },
        estado: function (gasto) {
          console.log(this.estados)
          return this.estados.find(function (item) {
            return item.id == gasto.estado_id;
          }).nombre;
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
                    // PONER EL ERROR DEVUELTO POR EL SERVIDOR.
                    $.notify("Error al eliminar.", 'warn')
                  } else {
                    $.notify("Error desconocido al eliminar", 'danger');
                  }
                })
          });
        }
      }
    }
</script>
