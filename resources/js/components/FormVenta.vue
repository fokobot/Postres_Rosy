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
        <b-form-row>
          <b-col>
            <b-form-group
              label="Fecha de Venta"
              label-for="fecha">
              <b-form-input 
                id="fecha"
                type="date"
                v-model="venta.fecha"
                required
                :state="errores['fecha'] ? false : (true && sent)">
              </b-form-input>
              <form-error :errores="errores" :campo="'fecha'"></form-error>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label="Dirección"
              label-for="direccion">
              <b-form-input
                id="direccion"
                v-model="venta.direccion"
                placeholder="Dirección"
                :state="errores['direccion'] ? false : (true && sent)">
              </b-form-input>
              <form-error :errores="errores" :campo="'direccion'"></form-error>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label="Estado"
              label-for="estado">
              <b-form-select
                id="estado"
                :options="estados"
                text-field="nombre" 
                  value-field="id"
                  v-model="venta.estado"
                  :state="errores['estado']  ? false : (true && sent)">
                  <template v-slot:first>
                    <option value="">-- Seleccione el estado --</option>
                  </template>
              </b-form-select>
              <form-error :errores="errores" :campo="'estado'"></form-error>
            </b-form-group>
          </b-col>
        </b-form-row>
        <hr>
        <detalle-venta @updatedProductos="updateProductos" :errores="errores">
        </detalle-venta>
        <b-form-row>
          <b-button block variant="success" :disabled="saving" type="submit">
            <span v-if="saving">
                <b-spinner small type="grow"></b-spinner>
                Guardando...
              </span>
              <span v-else>Registrar Compra</span>
          </b-button>
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
      axios.get('/api/ventas/estados')
        .then(res => {
          this.estados = res.data;
        }).catch(err => {
          console.log(err);
        }).finally(() => {
          this.loadingEstados = false;
        });
    },
    data () { return {
      clientes: [],
      productos: [],
      estados: [],
      venta: {},
      errores: [],
      loadingClientes: true,
      saving: false,
      sent: null
    }},
    methods: {
      registrarVenta: function(){
        let lista = this.productos.map(function(item) {
          return {id: item.id, cantidad: item.cantidad};
        });
        this.saving = true;
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
        }).finally(() => {
          this.saving = false;
        }) ;
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
