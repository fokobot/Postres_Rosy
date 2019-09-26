<template>
  <b-card>
    <template v-slot:header>
      Nueva Venta
      <router-link to="/ventas" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-list"></i> Ventas
      </router-link>
    </template>
    <b-card-text>
      <b-form method="POST" @submit.prevent="registrarVenta" novalidate  class="needs-validation">
        <b-form-row>
          <b-col>
            <b-form-group
              label="Cliente"
              label-for="cliente">
              <v-select
                id="cliente"
                :options="lista_clientes" 
                label="nombre"
                v-model="venta.cliente"
                :reduce="cliente => cliente.id">
              </v-select>
            </b-form-group>
            <span>¿No encuentras el cliente? <router-link :to="{name: 'nuevo-cliente', query: {next: '/ventas/new'}}">Crea un nuevo cliente</router-link>.</span>
          </b-col>
        </b-form-row> 
        <hr>
        <detalle-venta @updatedProductos="updateProductos" :errores="errores">
        </detalle-venta>
        <hr>
        <b-form-row>
          <b-button type="submit" block variant="success">Registrar Compra</b-button>
        </b-form-row>
      </b-form>
    </b-card-text>
  </b-card>
</template>

<script>
  import DetalleVenta from './DetalleVenta';
  export default {
    name: 'FormVenta',
    components: {
      'detalle-venta': DetalleVenta
    },
    mounted() {
      axios.get('/api/tipos_de_documento/')
      .then(response => (this.tipos_de_documento = response.data, this.venta.tipo_de_documento_id = response.data[0].id))
      axios.get('/api/clientes/')
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
