<template>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        {{cliente.id != 0 ? 'Editar' : 'Nuevo'}} Cliente
        <router-link class="btn btn-sm btn-primary float-right" to="/clientes">
          <i class="fa fa-list" ></i> Clientes
        </router-link>
      </div>
      <div class="card-body">
        <form method="POST" @submit.prevent="save" novalidate  class="needs-validation">
        <div class="form-row">
          <div class="col-md-6">
            <label for="nombre">Nombre</label>
            <div class="form-group has-default">
              <input type="text" v-model="cliente.nombre" placeholder="Nombre"
              class="form-control form-control-default" :class="{ 'is-invalid': errores['nombre'] }"/>
              <form-error :errores="errores" :campo="'nombre'"></form-error>
            </div>
          </div>
          <div class="col-md-6">
            <label for="apellidos">Apellidos</label>
            <div class="form-group has-default">
              <input type="text" v-model="cliente.apellidos" placeholder="Apellidos" class="form-control form-control-default" :class="{ 'is-invalid': errores['apellidos'] }" />
              <form-error :errores="errores" :campo="'apellidos'"></form-error>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6">
            <label for="direccion">Dirección</label>
            <div class="form-group has-default">
              <input type="text" v-model="cliente.direccion" placeholder="Dirección"
              class="form-control form-control-default" :class="{ 'is-invalid': errores['direccion'] }" />
              <form-error :errores="errores" :campo="'direccion'"></form-error>
            </div>
          </div>
          <div class="col-md-6">
            <label for="barrio">Barrio</label>
            <div class="form-group has-default">
              <input type="text" v-model="cliente.barrio" placeholder="Barrio"
              class="form-control form-control-default" :class="{ 'is-invalid': errores['barrio'] }" />
              <form-error :errores="errores" :campo="'barrio'"></form-error>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6">
            <div class="form-group has-default">
              <label for="telefono">Telefono</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                <input type="text" v-model="cliente.telefono" placeholder="Teléfono" 
                class="form-control form-control-default" :class="{ 'is-invalid': errores['telefono'] }" />
                <form-error :errores="errores" :campo="'telefono'"></form-error>
                </div>
            </div>
          </div>
          <div class="col-md-6">
              <label for="nacimiento">Fecha de Nacimiento: </label>
              <input type="date" class="form-control form-control-default" v-model="cliente.nacimiento" :class="{ 'is-invalid': errores['nacimiento'] }" >
              <form-error :errores="errores" :campo="'nacimiento'"></form-error>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-success">
              Registrar Cliente
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
    name: 'FormCliente',
    mounted() {
      var id = parseInt(this.$route.params.id) || 0;
      this.$set(this.cliente, 'id', id);
      this.show(this.cliente.id)
    },
    data() { return {
      cliente: {},
      errores: []
    }},
    methods: {
      show: function(id) {
        if (id <= 0) { return ; }
        axios.get(`/api/clientes/${id}`).then(res => {
          this.cliente = res.data;
        }).catch(err => {
          $.notify("Error desconocido..");
        });
      },
      save: function() {
        let extra = this.cliente.id == 0 ? '' : `/${this.cliente.id}/edit`;
        this.cliente['_method'] = this.cliente.id == 0 ? 'post' : 'put';
        axios.post('/api/clientes' + extra, this.cliente).then(res => {
          this.errores = [];
          $.notify(res.data.mensaje, "success");
          this.$router.push('/clientes');
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
      }
    }
  }
</script>
