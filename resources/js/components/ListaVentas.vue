<template>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Cliente</th>
        <th>Vendedor</th>
        <th>Fecha</th>
        <th>Valor Total</th>
        <th>Estado</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for= "venta in ventas">
          <td>{{nombre_cliente(venta.cliente)}}</td>
          <td>{{venta.vendedor}}</td>
          <td>{{venta.fecha}}</td>
          <td>{{venta.valor_total}}</td>
          <td>{{estado(venta)}}</td>
          <td>
            <a class="btn btn-sm btn-primary" href="#" @click="show(venta)">
              <i class="fa fa-eye"></i>
            </a>
            <a class="btn btn-sm btn-success" :href="url('edit', venta.id)">
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
      name: 'lista-ventas',
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
          return `ventas/${id}/${verb}`;
        },
        estado: function (venta) {
          return this.estados.find(function (item) {
            return item.id == venta.estado_venta_id;
          }).nombre;
        },
        nombre_cliente: function (cliente) {
          return `${cliente.nombre} ${cliente.apellidos}`;
        },
        show: function (venta) {
          console.log('Mostrar Venta');
          // DO SOMETHING
        },
        eliminar: function (id) {
          // DO SOMETHING
        }
      }
    }
</script>ventas
