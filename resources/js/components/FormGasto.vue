<template>
  <b-card>
    <template v-slot:header>
      {{gasto.id > 0 ? 'Editar' : 'Nuevo'}} Gasto
      <router-link class="btn btn-sm btn-primary float-right" to="/gastos">
        <i class="fa fa-list" ></i> Gastos
      </router-link>
    </template>
    <b-card-text>
      <form method="POST" @submit.prevent="save" novalidate  class="needs-validation" v-if="!loading">
        <div class="form-row">
          <div class="form-group has-default col-md-12">
            <label for="nombre">Proveedor</label>
            <select v-model="gasto.proveedor" class="form-control form-control-default" :class="{ 'is-invalid': errores['proveedor'] }" >
              <option value="-1">Seleccione una opción...</option>
              <option v-for="proveedor in proveedores" :key="proveedor.id" :value="proveedor.id">
                  {{proveedor.razon_social}}
              </option>
            </select>
            <span>¿No encuentras el proveedor? <router-link :to="{name: 'nuevo-proveedor', query: {next: '/gastos/new'}}">Crea un nuevo proveedor</router-link>.</span>
            <form-error :errores="errores" :campo="'proveedor'"></form-error>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group has-default col-md-4">
            <label for="valor">Valor</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
              <input type="text" :value="total | currency" class="form-control form-control-default" disabled>
            </div>
          </div>
          <div class="form-group has-default col-md-4">
            <label for="estado">Estado del Gasto</label>
            <select v-model="gasto.estado" class="form-control form-control-default" :class="{ 'is-invalid': errores['estado'] }">
              <option v-for="estado in estados" :key="estado.id" :value="estado.id">
                {{estado.nombre}}
              </option>
            </select>
            <form-error :errores="errores" :campo="'estado'"></form-error>
          </div>
          <div class="form-group col-md-4">
            <label for="fecha">Fecha: </label>
            <input type="date" class="form-control form-control-default" v-model="gasto.fecha" :class="{ 'is-invalid': errores['fecha'] }" >
            <form-error :errores="errores" :campo="'fecha'"></form-error>
          </div>
        </div>
        <detalle-gasto @updatedProductos="updateProductos" :errores="errores" :iProductos="productos"></detalle-gasto>
        <div class="form-row">
          <div class="col-md-12">
            <b-button block variant="success" :disabled="saving" type="submit">
              <span v-if="saving">
                <b-spinner small type="grow"></b-spinner>
                Guardando...
              </span>
              <span v-else>Registrar Gasto</span>
            </b-button>
          </div>
        </div>
      </form>
      <div class="text-center" v-else>
        <b-spinner variant="primary" type="grow" label="Cargando..." style="width: 6rem; height: 6rem;"></b-spinner>
      </div>
    </b-card-text>
  </b-card>
</template>

<script>
  import DetalleGasto from './DetalleGasto';

  export default {
    name: 'FormGasto',
    components: {
      'detalle-gasto': DetalleGasto
    },
    mounted() {
      var id =parseInt(this.$route.params.id) || 0;
      this.getEstados(id);
      this.$set(this.gasto, 'id', id);
      this.show(this.gasto.id)
      axios.get('/api/proveedores')
        .then(res => {
          this.proveedores = res.data;
        }).finally(() => {
          this.loading = false;
        });
    },
    data() { return {
      gasto: {},
      estados: [],
      errores: [],
      productos: [],
      proveedores: [],
      showFormProveedor: false,
      loading: true,
      saving: false
    }}, 
    methods: {
      show: function(id) {
        if (id <= 0) { return ; }
        axios.get(`/api/gastos/${id}`).then(res => {
          this.gasto = res.data;
          this.productos = this.gasto.productos
        }).catch(err => {
          $.notify("Error desconocido..");
        });
      },
      save: function() {
        this.saving = true;
        // TODO Edición de Gastos (id asignada)
        let extra = this.gasto.id == 0 ? '' : `/${this.gasto.id}/edit`;
        this.gasto['_method'] = this.gasto.id == 0 ? 'post' : 'put';
        this.$set(this.gasto, 'productos', this.productos);
        axios.post('/api/gastos' + extra, this.gasto).then(res => {
          this.errores = [];
          $.notify(res.data.mensaje, "success");
          this.$router.push('/gastos');
        }).catch(err => { 
          let errores = err.response;
          if (errores && errores.status === 422){
            $.notify("Errores de validación.", "warn");
            this.errores = errores.data.errors;
          } else {
            console.log(err)
            $.notify("Error desconocido.");
          }
        }).finally(() => {
          this.saving = false;
        }) ;
      },  
      getEstados: function(id) {
        axios.get(`/api/gastos/estados`).then(res => {
          this.estados = res.data;
          if (id == 0) Vue.set(this.gasto, 'estado_id', this.estados[0].id);
        }).catch(err => {
          $.notify("Error desconocido..");
        });
      },
      updateProductos: function(productos) {
        this.productos = productos;
      }
    }, computed: {
      total: function(){
        return this.productos.reduce((sum, current) => {
          return sum + current.cantidad * current.valor;
        }, 0);
      }
    }
  }
</script>
