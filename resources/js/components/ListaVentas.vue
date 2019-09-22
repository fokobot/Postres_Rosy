<template>
<div class="card mb-4">
  <div class="card-header">
    Lista de Ventas
    <router-link to="/ventas/new">
      <button class="btn btn-sm btn-primary float-right">
        <i class="fa fa-plus" ></i> Nueva Venta
      </button>
    </router-link>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>#</th>
        <th>Cliente</th>
        <th>Vendedor</th>
        <th>Fecha</th>
        <th>Valor Total</th>
        <th>Estado</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for= "venta in ventas" :key="venta.id">
          <td>{{venta.id | zerofill}}</td>
          <td>{{nombre_cliente(venta.cliente)}}</td>
          <td>{{venta.vendedor.nombre}} {{venta.vendedor.apellidos}}</td>
          <td>{{venta.fecha}}</td>
          <td>{{venta.total | currency}}</td>
          <td>{{estado(venta)}}</td>
          <td>
            <router-link class="btn btn-sm btn-primary" :to="url('', venta.id)" @click="show(venta)">
              <i class="fa fa-eye"></i>
            </router-link>
            <a class="btn btn-sm btn-success" :href="url('edit', venta.id)">
              <i class="fa fa-edit" ></i>
            </a>
            <a class="btn btn-sm btn-danger" href="#" @click="eliminar(venta.id)">
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
    name: 'ListaVentas',
    mounted() {
      axios
        .get('/api/ventas/')
        .then(response => (this.ventas = response.data['ventas'], this.estados = response.data['estados']))
        .catch(err => $.notify('Ha ocurrido un error desconocido.', 'error'))
    },
    data: function(){ return {
      ventas:  [],
      estados: []
    }},
    methods: {
      url: function (verb, id) {
        if(verb != "") {verb = `/${verb}`}
        return `ventas/${id}${verb}`;
      },
      estado: function (venta) {
        return this.estados.find(function (item) {
          return item.id == venta.estado;
        }).nombre;
      },
      nombre_cliente: function (cliente) {
        return `${cliente.nombre} ${cliente.apellidos}`;
      },
      eliminar: function (id) {
        bootbox.confirm("¿Realmente desea eliminar esta venta?", result => {
          if (!result) return;
          axios.delete('/api/ventas/' + id)
          .then(res => {
            let index = this.ventas.findIndex(function (item) {
              return item.id == id;
            });
            this.ventas.splice(index, 1);
            $.notify(res.data.mensaje , 'success');
          }).catch(err => {
            if (err.response && err.response.status === 422){
              // PONER EL ERROR DEVUELTO POR EL SERVIDOR.
              $.notify("Error al eliminar.", 'warn')
            } else {
              $.notify("Error desconocido al eliminar", 'danger');
            }
          });
        });
      }
    }
  }
</script>
