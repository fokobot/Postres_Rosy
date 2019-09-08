<template>
<div class="card">
  <div class="card-header">
    Nuevo Trabajo
  </div>
  <div class="card-body">
    <form method="POST" @submit.prevent="post" novalidate  class="needs-validation">
      <div class="form-row">
        <div class="form-group col-md-12">
          <label >Nombre</label>
          <input type="text" v-bind:class="{ 'is-invalid': errores['nombre'] }" placeholder="Trabajo" class="form-control" v-model="trabajo.nombre" required>
          <form-error v-bind:errores="errores" v-bind:campo="'nombre'"></form-error>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="costo">Costo del trabajo</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
              <input type="text" name="costo" v-model="trabajo.costo" placeholder="25000"
              class="form-control form-control-default" v-bind:class="{ 'is-invalid': errores['costo'] }">
            </div>
            <form-error v-bind:errores="errores" v-bind:campo="'costo'"></form-error>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-block btn-success">Registrar</button>
        </div>
      </div>
    </form>
  </div>
</div>
</template>

<script>
    export default {
        data: function() {return {
          trabajo: {},
          errores: []
        }}, 
        methods: {
          post: function() {
            axios.post('/api/trabajos', this.trabajo).then(res => {
              this.errores = [];
              $.notify(res.data.mensaje, "success");
            }).catch(err => { 
              let errores = err.response;
              if (errores.status === 422){
                $.notify("Errores de validación.", "warn");
                this.errores = errores.data.errors;
              } else {
                $.notify("Error desconocido..");
              }
            });
          }
        }
    }
</script>
