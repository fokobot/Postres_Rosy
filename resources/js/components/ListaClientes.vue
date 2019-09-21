<template>
<div class="card mb-4">
  <div class="card-header">
    Lista de Clientes
    <router-link class="btn btn-sm btn-primary float-right" to="/clientes/new">
      <i class="fa fa-plus" ></i> Nuevo Cliente
    </router-link>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Dirección</th>
        <th>Barrio</th>
        <th>Telefono</th>
        <th>Fecha de Nacimiento</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for="cliente in clientes" :key="cliente.id">
          <td>{{cliente.nombre}}</td>
          <td>{{cliente.apellidos}}</td>
          <td>{{cliente.direccion}}</td>
          <td>{{cliente.barrio}}</td>
          <td>{{cliente.telefono}}</td>
          <td>{{cliente.nacimiento}}</td>
          <td>
          <router-link class="btn btn-sm btn-success" :to="url('edit', cliente.id)">
						<i class="fa fa-edit" ></i>
					</router-link>
          <a class="btn btn-sm btn-danger" href="#" @click="eliminar(cliente.id)">
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
    name: 'ListaClientes',
    mounted() {
      axios
        .get('/api/clientes/')
        .then(response => (this.clientes = response.data)).catch(err => $.notify('Ha ocurrido un error desconocido.', 'error'));
    },
    data(){ return {
      clientes:  []
    }},
    methods: {
      url: function (verb, id) {
        return `/clientes/${id}/${verb}`;
      },
      eliminar: function (id) {
        bootbox.confirm("¿Realmente desea eliminar este cliente?", result => {
          if (!result) return;
          axios.delete('/api/clientes/' + id)
          .then(res => {
            let index = this.clientes.findIndex(function (item) {
              return item.id == id;
            });
            this.clientes.splice(index, 1);
            $.notify(res.data.mensaje , 'success');
          })
          .catch(err => {
            if (err.response && err.response.status === 422){
              $.notify(err.response.data.mensaje, 'warn')
            } else {
              $.notify("Error desconocido al eliminar.", 'danger');
            }
          });
        });
      }
    }
  }
</script>
