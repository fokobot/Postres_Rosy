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
            <a class="btn btn-sm btn-danger" href="#">
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
          // DO SOMETHING
        }
      }
    }
</script>
