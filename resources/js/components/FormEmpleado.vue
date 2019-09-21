<template>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        {{empleado.id != 0 ? 'Editar' : 'Nuevo'}} Empleado
        <router-link class="btn btn-sm btn-primary float-right" to="/empleados">
          <i class="fa fa-list" ></i> Empleados
        </router-link>
      </div>
      <div class="card-body">
        <form method="POST" @submit.prevent="save" novalidate  class="needs-validation">
        <div class="form-row">
            <div class="col-md-6">
              <label for="tipo_de_documento_id">Tipo de documento</label>
              <div class="form-group has-default">
                <select v-model="empleado.tipo_de_documento_id" class="form-control form-control-default"
                :class="{ 'is-invalid': errores['tipo_de_documento_id'] }">
                <option v-for="item in tipos_de_documento" :key="item.id" :value="item.id">{{item.abreviatura}}</option>
              </select>
              <form-error :errores="errores" :campo="'tipo_de_documento_id'"></form-error>
            </div>
          </div>
          <div class="col-md-6">
            <label for="documento">N° de documento</label>
            <div class="form-group has-default">
              <input type="text" v-model="empleado.documento" placeholder="N° de documento"
              class="form-control form-control-default" :class="{ 'is-invalid': errores['documento'] }" />
              <form-error :errores="errores" :campo="'documento'"></form-error>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6">
            <label for="nombres">Nombres</label>
            <div class="form-group has-default">
              <input type="text" v-model="empleado.nombres" placeholder="Nombres"
              class="form-control form-control-default" :class="{ 'is-invalid': errores['nombres'] }"/>
              <form-error :errores="errores" :campo="'nombres'"></form-error>
            </div>
          </div>
          <div class="col-md-6">
            <label for="apellidos">Apellidos</label>
            <div class="form-group has-default">
              <input type="text" v-model="empleado.apellidos" placeholder="Apellidos" class="form-control form-control-default" :class="{ 'is-invalid': errores['apellidos'] }" />
              <form-error :errores="errores" :campo="'apellidos'"></form-error>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6">
            <label for="direccion">Dirección</label>
            <div class="form-group has-default">
              <input type="text" v-model="empleado.direccion" placeholder="Dirección"
              class="form-control form-control-default" :class="{ 'is-invalid': errores['direccion'] }" />
              <form-error :errores="errores" :campo="'direccion'"></form-error>
            </div>
          </div>
          <div class="col-md-6">
            <label for="barrio">Barrio</label>
            <div class="form-group has-default">
              <input type="text" v-model="empleado.barrio" placeholder="Barrio"
              class="form-control form-control-default" :class="{ 'is-invalid': errores['barrio'] }" />
              <form-error :errores="errores" :campo="'barrio'"></form-error>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6">
            <div class="form-group has-default">
              <label for="telefono">Telefono</label>
              <input type="text" v-model="empleado.telefono" placeholder="Teléfono" 
              class="form-control form-control-default" :class="{ 'is-invalid': errores['telefono'] }" />
              <form-error :errores="errores" :campo="'telefono'"></form-error>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group has-default">
              <label for="ocupacion">Ocupación</label>
              <input type="text" v-model="empleado.ocupacion" placeholder="Ocupación" 
              class="form-control form-control-default" :class="{ 'is-invalid': errores['ocupacion'] }" />
              <form-error :errores="errores" :campo="'ocupacion'"></form-error>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-success">
              Registrar Empleado
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</template>

<script>
  export default {
    name: 'FormEmpleado',
    mounted() {
      var id = parseInt(this.$route.params.id) || 0;
      this.getTiposDeDocumento(id);
      this.$set(this.empleado, 'id', id);
      this.show(this.empleado.id)
    },
    data() { return {
      empleado: {},
      tipos_de_documento: [],
      errores: []
    }},
    methods: {
      show: function(id) {
        if (id <= 0) { return ; }
        axios.get(`/api/empleados/${id}`).then(res => {
          this.empleado = res.data;
        }).catch(err => {
          $.notify("Error desconocido..");
        });
      },
      save: function() {
        let extra = this.empleado.id == 0 ? '' : `/${this.empleado.id}/edit`;
        this.empleado['_method'] = this.empleado.id == 0 ? 'post' : 'put';
        axios.post('/api/empleados' + extra, this.empleado).then(res => {
          this.errores = [];
          $.notify(res.data.mensaje, "success");
          this.$router.push('/empleados');
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
      getTiposDeDocumento: function(id) {
        axios.get(`/api/tipos_de_documento`).then(res => {
          this.tipos_de_documento = res.data;
          if (id == 0) Vue.set(this.empleado, 'tipo_de_documento_id', this.tipos_de_documento[0].id);
        }).catch(err => {
          console.log(err)
          $.notify("Error desconocido.");
        });
      }
    }
  }
</script>