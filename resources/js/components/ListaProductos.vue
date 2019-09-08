<template>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <th>Nombre del producto</th>
          <th>Valor al detal</th>
          <th>Valor al por mayor</th>
          <th>Cantidad min. al por mayor</th>
          <th>Opciones</th>
        </thead>
        <tbody>
          <tr v-for="producto in productos">
            <td>{{producto.nombre}}</td>
            <td>{{producto.valordetal}}</td>
            <td>{{producto.valormayor}}</td>
            <td>{{producto.minimopormayor}}</td>
            <td>
            <a class="btn btn-sm btn-success" :href="url('edit', producto.id)">
              <i class="fa fa-edit" ></i>
            </a>
            <a class="btn btn-sm btn-danger" href="#" @click="eliminar(producto.id)">
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
      name: 'lista-productos',
      mounted() {
        axios
          .get('/api/productos/')
          .then(response => (this.productos = response.data))
      },
      data: function(){ return {
        productos:  []
      }},
      methods: {
        url: function (verb, id) {
          return `productos/${id}/${verb}`;
        },
        eliminar: function (id) {
          bootbox.confirm("¿Realmente desea eliminar este producto?", result => {
              if (!result) return;
              axios.delete('/api/productos/' + id)
                .then(res => {
                  let index = this.productos.findIndex(function (item) {
                    item.id == id;
                  });
                  this.productos.splice(index, 1);
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
