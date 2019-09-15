<template>
<div class="card mb-4">
  <div class="card-header">
    Lista de Proveedores
    <router-link class="btn btn-sm btn-primary float-right" to="/proveedores/new">
      <i class="fa fa-plus" ></i> Nuevo Proveedor
    </router-link>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Razón Social</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Gerente</th>
        <th>Email</th>
        <th>Edad RC</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for="proveedor in proveedores" :key="proveedor.id">
          <td>{{proveedor.razon_social}}</td>
          <td>{{proveedor.telefono}}</td>
          <td>{{proveedor.direccion}}</td>
          <td>{{proveedor.gerente}}</td>
          <td>{{proveedor.email}}</td>
          <td>{{proveedor.edad_rc}}</td>
          <td>
            <router-link class="btn btn-sm btn-success" :to="url('edit', proveedor.id)">
  			      <i class="fa fa-edit" ></i>
  		      </router-link>
            <a class="btn btn-sm btn-danger" href="#" @click="eliminar(proveedor.id)">
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
    name: 'ListaProveedores',
    mounted() {
      axios
        .get('/api/proveedores')
        .then(response => (this.proveedores = response.data))
        .catch(err => $.notify('Ha ocurrido un error desconocido.', 'error'))
    },
    data() { return {
      proveedores:  [],
    }},
    methods: {
      url: function (verb, id) {
        return `/proveedores/${id}/${verb}`;
      },
      estado: function (proveedor) {
        return this.estados.find(function (item) {
          return item.id == proveedor.estado_id;
        }).nombre;
      },
      eliminar: function (id) {
        bootbox.confirm("¿Realmente desea eliminar este proveedor?", result => {
          if (!result) return;
          axios.delete('/api/proveedores/' + id)
            .then(res => {
              let index = this.proveedores.findIndex(function (item) {
                return item.id == id;
              });
              this.proveedores.splice(index, 1);
              $.notify(res.data.mensaje , 'success');
            })
            .catch(err => {
              if (err.response && err.response.status === 422){
                //TODO PONER EL ERROR DEVUELTO POR EL SERVIDOR.
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
