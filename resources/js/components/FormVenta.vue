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
          <div class="col-md-6 form-group">
            <label class="sr-only">Tipo de Documento</label>
            <select class="form-control" :class="{ 'is-invalid': errores['tipo_de_documento_id'] }" v-model="venta.tipo_de_documento_id">
              <option v-for="tipo in tipos_de_documento" :value="tipo.id" :key="tipo.id">{{tipo.abreviatura}} - {{tipo.nombre}}</option>
            </select>
            <form-error :errores="errores" :campo="'tipo_de_documento_id'"></form-error>
          </div>
          <div class="form-group col-md-6">
            <label class="sr-only">Documento</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-id-card"></i></span>
              </div>
              <input type="text" :class="{ 'is-invalid': errores['documento'] }" placeholder="Documento" class="form-control" v-model="venta.documento" required>
            </div>
            <form-error :errores="errores" :campo="'documento'"></form-error>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="sr-only">Nombre</label>
            <input type="text" :class="{ 'is-invalid': errores['nombre'] }" placeholder="Nombre" class="form-control" v-model="venta.nombre" required>
            <form-error :errores="errores" :campo="'nombre'"></form-error>
          </div>
          <div class="form-group col-md-6">
            <label class="sr-only">Apellidos</label>
            <input type="text" :class="{ 'is-invalid': errores['apellidos'] }" placeholder="Apellidos" class="form-control" v-model="venta.apellidos" required>
            <form-error :errores="errores" :campo="'apellidos'"></form-error>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="sr-only">Dirección</label>
            <input type="text" :class="{ 'is-invalid': errores['direccion'] }" placeholder="Dirección" class="form-control" v-model="venta.direccion" required>
            <form-error :errores="errores" :campo="'direccion'"></form-error>
          </div>
          <div class="form-group col-md-6">
            <label class="sr-only">Ciudad</label>
            <input type="text" :class="{ 'is-invalid': errores['ciudad'] }" placeholder="Ciudad" class="form-control" v-model="venta.ciudad" required>
            <form-error :errores="errores" :campo="'ciudad'"></form-error>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="sr-only">Teléfono</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone"></i></span>
              </div>
              <input type="text" :class="{ 'is-invalid': errores['telefono'] }" placeholder="Teléfono" class="form-control" v-model="venta.telefono" required>
              <form-error :errores="errores" :campo="'telefono'"></form-error>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label class="sr-only">Celular</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-mobile-alt"></i></span>
              </div>
              <input type="text" :class="{ 'is-invalid': errores['celular'] }" placeholder="Celular" class="form-control" v-model="venta.celular" required>
            </div>
            <form-error :errores="errores" :campo="'celular'"></form-error>
          </div>
        </div>
        <hr>
        <form-detalleventa @updatedProductos="updateProductos" :errores="errores">
        </form-detalleventa>
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
  export default {
    name: 'FormVenta',
    mounted() {
      axios
      .get('/api/tipos_de_documento/')
      .then(response => (this.tipos_de_documento = response.data, this.venta.tipo_de_documento_id = response.data[0].id))
    },
    data () { return {
      productos: [],
      venta: {},
      errores: [],
      tipos_de_documento: []
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
    }
  }
</script>
