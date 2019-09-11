<template>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Documento</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Dirección</th>
        <th>Ciudad</th>
        <th>Telefono</th>
        <th>Celular</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for="cliente in clientes">
          <td>{{tipo_doc(cliente)}}: {{cliente.documento}}</td>
          <td>{{cliente.nombre}}</td>
          <td>{{cliente.apellidos}}</td>
          <td>{{cliente.direccion}}</td>
          <td>{{cliente.ciudad}}</td>
          <td>{{cliente.telefono}}</td>
          <td>{{cliente.celular}}</td>
          <td>
          <a class="btn btn-sm btn-success" :href="url('edit', cliente.id)">
						<i class="fa fa-edit" ></i>
					</a>
          <a class="btn btn-sm btn-danger" href="#" @click="eliminar(cliente.id)">
            <i class="fa fa-trash"></i>
          </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
    export default {
      name: 'lista-clientes',
      mounted() {
        axios
          .get('/api/clientes/')
          .then(response => {
            this.clientes = response.data['clientes'];
            this.tipos_de_documento = response.data['tipos_de_documento'];
           }).catch(err => $.notify('Ha ocurrido un error desconocido.', 'error'));
      },
      data: function(){ return {
        clientes:  [],
        tipos_de_documento: []
      }},
      methods: {
        url: function (verb, id) {
          return `clientes/${id}/${verb}`;
        },
        tipo_doc: function (cliente) {
          return this.tipos_de_documento.find(function (item) {
            return item.id == cliente.tipo_de_documento_id;
          }).abreviatura;
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
