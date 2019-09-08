<template>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Nombre del trabajo</th>
        <th>Costo</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for="trabajo in trabajos">
          <td>{{trabajo.nombre}}</td>
          <td>{{trabajo.costo}}</td>
          <td>
            <a class="btn btn-sm btn-success" :href="url('edit', trabajo.id)">
              <i class="fa fa-edit" ></i>
            </a>
            <a class="btn btn-sm btn-danger" href="#" @click="eliminar(trabajo.id)">
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
      name: 'lista-trabajos',
      mounted() {
        axios
          .get('/api/trabajos/')
          .then(response => (this.trabajos = response.data))
          .catch(err => $.notify('Ha ocurrido un error desconocido.', 'error'))
      },
      data: function(){ return {
        trabajos:  []
      }},
      methods: {
        url: function (verb, id) {
          return `trabajos/${id}/${verb}`;
        },
        eliminar: function (id) {
          bootbox.confirm("¿Realmente desea eliminar este trabajo?", result => {
              if (!result) return;
              axios.delete('/api/trabajos/' + id)
                .then(res => {
                  let index = this.trabajos.findIndex(function (item) {
                    item.id == id;
                  });
                  this.trabajos.splice(index, 1);
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
