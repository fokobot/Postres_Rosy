<template>
<div class="col-md-5">
  <div class="card">
    <div class="card-header">
      {{trabajo.id > 0 ? 'Editar' : 'Nuevo'}} Trabajo
    </div>
    <div class="card-body">
      <form method="POST" @submit.prevent="save" novalidate  class="needs-validation">
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
</div>
</template>

<script>
    export default {
      mounted() {
        this.trabajo = {};
        this.$set(this.trabajo, 'id', parseInt(this.$route.params.id) || 0);
        this.show(this.trabajo.id)
      },
      data: function() {return {
        trabajo: {},
        errores: []
      }}, 
      methods: {
        show: function(id) {
          if (id <= 0) { return ; }
          axios.get(`/api/trabajos/${id}`).then(res => {
            this.trabajo = res.data;
          }).catch(err => {
            $.notify("Error desconocido..");
          });
        },
        save: function() {
          let extra = this.trabajo.id == 0 ? '' : `/${this.trabajo.id}/edit`;
          this.trabajo['_method'] = this.trabajo.id == 0 ? 'post' : 'put';
          const ruta = '/api/trabajos' + extra;
          axios.post(ruta, this.trabajo).then(res => {
            this.errores = [];
            $.notify(res.data.mensaje, "success");
            this.$router.push('/trabajos');
          }).catch(err => { 
            let errores = err.response;
            if (errores && errores.status === 422){
              $.notify("Errores de validación.", "warn");
              this.errores = errores.data.errors;
            } else {
              console.log(errores)
              $.notify("Error desconocido..");
            }
          });
        }
      }
    }
</script>
