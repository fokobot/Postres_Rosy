<template>
  <div class="card">
    <div class="card-header">
      Nueva Venta
    </div>
    <div class="card-body">
      <form method="POST" @submit.prevent="registrarVenta" novalidate  class="needs-validation">
        <div class="form-row">
          <div class="col-md-6 form-group">
            <label class="sr-only">Tipo de Documento</label>
            <select class="form-control" v-bind:class="{ 'is-invalid': errores['tipo_de_documento_id'] }" v-model="tipodedocumento">
              <option v-for="tipo in tipos_de_documento" v-bind:value="tipo.id">{{tipo.abreviatura}} - {{tipo.nombre}}</option>
            </select>
            <form-error v-bind:errores="errores" v-bind:campo="'tipo_de_documento_id'"></form-error>
          </div>
          <div class="form-group col-md-6">
            <label class="sr-only">Documento</label>
            <input type="text" v-bind:class="{ 'is-invalid': errores['documento'] }" placeholder="Documento" class="form-control" v-model="documento" required>
            <form-error v-bind:errores="errores" v-bind:campo="'documento'"></form-error>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="sr-only">Nombre</label>
            <input type="text" v-bind:class="{ 'is-invalid': errores['nombre'] }" placeholder="Nombre" class="form-control" v-model="nombre" required>
              <form-error v-bind:errores="errores" v-bind:campo="'nombre'"></form-error>
          </div>
          <div class="form-group col-md-6">
            <label class="sr-only">Apellidos</label>
            <input type="text" v-bind:class="{ 'is-invalid': errores['apellidos'] }" placeholder="Apellidos" class="form-control" v-model="apellidos" required>
              <form-error v-bind:errores="errores" v-bind:campo="'apellidos'"></form-error>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="sr-only">Dirección</label>
            <input type="text" v-bind:class="{ 'is-invalid': errores['direccion'] }" placeholder="Dirección" class="form-control" v-model="direccion" required>
            <form-error v-bind:errores="errores" v-bind:campo="'direccion'"></form-error>
          </div>
          <div class="form-group col-md-6">
            <label class="sr-only">Ciudad</label>
            <input type="text" v-bind:class="{ 'is-invalid': errores['ciudad'] }" placeholder="Ciudad" class="form-control" v-model="ciudad" required>
            <form-error v-bind:errores="errores" v-bind:campo="'ciudad'"></form-error>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="sr-only">Teléfono</label>
            <input type="text" v-bind:class="{ 'is-invalid': errores['telefono'] }" placeholder="Teléfono" class="form-control" v-model="telefono" required>
            <form-error v-bind:errores="errores" v-bind:campo="'telefono'"></form-error>
          </div>
          <div class="form-group col-md-6">
            <label class="sr-only">Celular</label>
            <input type="text" v-bind:class="{ 'is-invalid': errores['celular'] }" placeholder="Celular" class="form-control" v-model="celular" required>
            <form-error v-bind:errores="errores" v-bind:campo="'celular'"></form-error>
          </div>
        </div>
        <hr>
        <form-detalleventa @updatedProductos="updateProductos" v-bind:errores="errores">
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
      .then(response => (this.tipos_de_documento = response.data))
    },
    data: () => { return {
      productos: [],
      tipos_de_documento: [],
      tipodedocumento: 1,
      documento: '',
      nombre: '',
      apellidos: '',
      telefono: '',
      celular: '',
      direccion: '',
      ciudad: '',
      errores: [],
    }},
    methods: {
      registrarVenta: function(){
        let lista = this.productos.map(function(item) {
          return {id: item.id, cantidad: item.cantidad};
        });

        let venta = {
          tipo_de_documento: this.tipodedocumento,
          documento: this.documento,
          nombre: this.nombre,
          apellidos: this.apellidos,
          telefono: this.telefono,
          celular: this.celular,
          direccion: this.direccion,
          ciudad: this.ciudad,
          productos: lista
        }
        axios.post('/api/ventas', venta).then(res => {
          this.errores = [];
          $.notify("Venta realizada con éxito.", "success");
        }).catch(err => { 
          let errores = err.response;
          if (errores.status === 422){
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
