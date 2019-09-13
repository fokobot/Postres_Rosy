<template>
<div class="card mb-4">
  <div class="card-header">
    Lista de Productos
    <router-link class="btn btn-sm btn-primary float-right" to="/productos/new">
      <i class="fa fa-plus" ></i> Nuevo Producto
    </router-link>
  </div>
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
        <tr v-for="producto in productos" :key="producto.id">
          <td>{{producto.nombre}}</td>
          <td>{{producto.valordetal}}</td>
          <td>{{producto.valormayor}}</td>
          <td>{{producto.minimopormayor}}</td>
          <td>
          <router-link class="btn btn-sm btn-success" :to="url('edit', producto.id)">
            <i class="fa fa-edit" ></i>
          </router-link>
          <a class="btn btn-sm btn-danger" href="#" @click="eliminar(producto.id)">
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
    name: 'ListaProductos',
    mounted() {
      axios
        .get('/api/productos/')
        .then(response => (this.productos = response.data))
    },
    data(){ return {
      productos:  []
    }},
    methods: {
      url: function (verb, id) {
        return `/productos/${id}/${verb}`;
      },
      eliminar: function (id) {
        bootbox.confirm("¿Realmente desea eliminar este producto?", result => {
          if (!result) return;
          axios.delete('/api/productos/' + id)
          .then(res => {
            let index = this.productos.findIndex(function (item) {
              return item.id == id;
            });
            this.productos.splice(index, 1);
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
