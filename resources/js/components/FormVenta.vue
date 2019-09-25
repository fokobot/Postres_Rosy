<template>
  <div class="card">
    <div class="card-header">
      Nueva Venta
      <router-link to="/ventas" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-list"></i> Ventas
      </router-link>
    </div>
    <div class="card-body">
      <form method="POST" @submit.prevent="registrarVenta" novalidate  class="needs-validation">
        <div class="form-row">
          <div class="col-md-12">
            <label>Cliente</label>
            <v-select 
              :options="lista_clientes" 
              v-model="venta.cliente"
              label="nombre"
              :reduce="cliente => cliente.id">
              </v-select>
          </div>
          <span>¿No encuentras el cliente? <router-link :to="{name: 'nuevo-cliente', query: {next: '/ventas/new'}}">Crea un nuevo cliente</router-link>.</span>
        </div> 
        <hr>
        <detalle-venta @updatedProductos="updateProductos" :errores="errores">
        </detalle-venta>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-success">Registrar Compra</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  import DetalleVenta from './DetalleVenta';
  export default {
    name: 'FormVenta',
    components: {
      'detalle-venta': DetalleVenta
    },
    mounted() {
      axios
      .get('/api/tipos_de_documento/')
      .then(response => (this.tipos_de_documento = response.data, this.venta.tipo_de_documento_id = response.data[0].id))
      axios
      .get('/api/clientes/')
      .then(res => {
        this.clientes = res.data
      }).finally(() => {
        this.loadingClientes = false;
      });
    },
    data () { return {
      clientes: [],
      productos: [],
      venta: {},
      errores: [],
      loadingClientes: true
    }},
    methods: {
      registrarVenta: function(){
        let lista = this.productos.map(function(item) {
          return {id: item.id, cantidad: item.cantidad};
        });
        this.venta.productos = lista;
        axios.post('/api/ventas', this.venta).then(res => {
          this.errores = [];
          $.notify("Venta realizada con éxito.", "success");
          this.$router.push('/ventas')
        }).catch(err => { 
          let errores = err.response;
          if (errores.status && errores.status === 422){
            $.notify("Errores de validación.", "warn");
            this.errores = errores.data.errors;
          } else {
            $.notify("Error desconocido..");
          }
        });
      }, updateProductos(productos){
        this.productos = productos;
      }
    }, computed: {
      lista_clientes: function() {
        return this.clientes.map(function(T){
          return {id: T.id, nombre: `${T.nombre} ${T.apellidos}`};
        });
      }
    }
  }
</script>
