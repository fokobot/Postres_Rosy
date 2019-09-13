<template>
<div class="col-md-6">
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
          <div class="col-md-12">
            <label for="nombre">Descripcion del gasto</label>
            <div class="form-group has-default">
              <div>
                <input type="text" v-model="gasto.descripcion" placeholder="Descripcion"
                class="form-control form-control-default" v-bind:class="{ 'is-invalid': errores['descripcion'] }" />
                <form-error v-bind:errores="errores" v-bind:campo="'descripcion'"></form-error>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <label for="valor">Valor</label>
            <div class="form-group has-default">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                </div>
                <input type="text" v-model="gasto.valor" placeholder="10000"
                class="form-control form-control-default" v-bind:class="{ 'is-invalid': errores['valor'] }">
                <form-error v-bind:errores="errores" v-bind:campo="'valor'"></form-error>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <label for="estado">Estado del Gasto</label>
            <div class="form-group has-default">
              <select v-model="gasto.estado_id" class="form-control form-control-default" v-bind:class="{ 'is-invalid': errores['estado_id'] }">
                  <option v-for="estado in estados" v-bind:key="estado.id" :value="estado.id">{{estado.nombre}}</option>
              </select>
              <form-error v-bind:errores="errores" v-bind:campo="'estado_id'"></form-error>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="fecha">Fecha: </label>
              <input type="date" class="form-control form-control-default" v-model="gasto.fecha" v-bind:class="{ 'is-invalid': errores['fecha'] }" >
               <form-error v-bind:errores="errores" v-bind:campo="'fecha'"></form-error>
            </div>
          </div>
        </div>
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
    export default {
      mounted() {
        var id =parseInt(this.$route.params.id) || 0;
        this.getEstados(id);
        this.$set(this.gasto, 'id', id);
        this.show(this.gasto.id)
      },
      data() { return {
        gasto: {},
        estados: [],
        errores: []
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
        }
      }
    }
</script>
