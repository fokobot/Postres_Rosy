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
            <label class="sr-only">Barrio</label>
            <input type="text" :class="{ 'is-invalid': errores['barrio'] }" placeholder="Barrio" class="form-control" v-model="venta.barrio" required>
            <form-error :errores="errores" :campo="'barrio'"></form-error>
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
            <label class="sr-only">Fecha de Nacimiento</label>
            <input type="date" :class="{ 'is-invalid': errores['nacimiento'] }" class="form-control" v-model="venta.nacimiento" required>
            <form-error :errores="errores" :campo="'nacimiento'"></form-error>
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
