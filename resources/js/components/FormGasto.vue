<template>
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        {{gasto.id > 0 ? 'Editar' : 'Nuevo'}} Gasto
        <router-link class="btn btn-sm btn-primary float-right" to="/gastos">
          <i class="fa fa-list" ></i> Gastos
        </router-link>
      </div>
      <div class="card-body">
        <form method="POST" @submit.prevent="save" novalidate  class="needs-validation">
          <div class="form-row">
            <div class="form-group has-default col-md-12">
              <label for="nombre">Proveedor</label>
              <select class="form-control form-control-default" :class="{ 'is-invalid': errores['proveedor'] }" >
                <option value="-1">Seleccione una opción...</option>
                <option v-for="proveedor in proveedores" :key="proveedor.id" :value="proveedor.id">
                   {{proveedor.razon_social}}
                </option>
              </select>
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
              <select v-model="gasto.estado_id" class="form-control form-control-default" :class="{ 'is-invalid': errores['estado_id'] }">
                <option v-for="estado in estados" :key="estado.id" :value="estado.id">
                  {{estado.nombre}}
                </option>
              </select>
              <form-error :errores="errores" :campo="'estado_id'"></form-error>
            </div>
            <div class="form-group col-md-4">
              <label for="fecha">Fecha: </label>
              <input type="date" class="form-control form-control-default" v-model="gasto.fecha" :class="{ 'is-invalid': errores['fecha'] }" >
              <form-error :errores="errores" :campo="'fecha'"></form-error>
            </div>
          </div>
          <detalle-gasto @updatedProductos="updateProductos" :errores="errores"></detalle-gasto>
          <div class="form-row">
            <div class="col-md-12">
              <button type="submit" class="btn btn-block btn-success">Registrar Gasto</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import DetalleGasto from './DetalleGasto';

  export default {
    name: 'FormProducto',
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
        });
    },
    data() { return {
      gasto: {},
      estados: [],
      errores: [],
      productos: [],
      proveedores: []
    }}, 
    methods: {
      show: function(id) {
        if (id <= 0) { return ; }
        axios.get(`/api/gastos/${id}`).then(res => {
          this.gasto = res.data;
        }).catch(err => {
          $.notify("Error desconocido..");
        });
      },
      save: function() {
        let extra = this.gasto.id == 0 ? '' : `/${this.gasto.id}/edit`;
        this.gasto['_method'] = this.gasto.id == 0 ? 'post' : 'put';
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
        });
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
