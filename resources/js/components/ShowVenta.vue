<template>
  <div class="card">
    <div class="card-header">
      Venta {{venta.id | zerofill}}
      <router-link to="/ventas" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-list"></i> Ventas
      </router-link>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 table-responsive">
          <h4 class="sub-header">Vendedor</h4>
          <table class="table" >
             <tr>
              <th>#</th>
              <td>{{venta.vendedor.id | zerofill}}</td>
            </tr>
            <tr>
              <th>Nombre</th>
              <td>{{venta.vendedor.nombre}} {{venta.vendedor.apellidos}}</td>
            </tr>
            <tr>
              <th>E-mail</th>
              <td>{{venta.vendedor.email}}</td>
            </tr>
          </table>
        </div> 
        <div class="col-md-6 table-responsive">
          <h4 class="sub-header">Cliente</h4>
          <table class="table" >
            <tr>
              <th>Nombre</th>
              <td>{{venta.cliente.nombre}} {{venta.cliente.apellidos}}</td>
            </tr>
            <tr>
              <th>Telefono</th>
              <td>{{venta.cliente.telefono}}</td>
            </tr>
            <tr>
              <th>Dirección</th>
              <td>Barrio {{venta.cliente.barrio}}. {{venta.cliente.direccion}}</td>
            </tr>
          </table>
        </div> 
      </div>
      <hr />
      <detalle-venta :productos="venta.productos" :total="venta.total"></detalle-venta>
    </div>
  </div>
</template>

<script>
  import ShowDetalleVenta from './ShowDetalleVenta';

  export default {
    name: 'ShowVenta',
    components: {
      'detalle-venta': ShowDetalleVenta
    },
    mounted() {
      axios
      .get(`/api/ventas/${this.$route.params.id}`)
      .then(res => {
          this.venta = res.data
          this.loading = false;
      }).catch(err => {
        console.log('Error', err);
      });
    },
    data () { return {
      venta: {},
      loading: true
    }}
  }
</script>
