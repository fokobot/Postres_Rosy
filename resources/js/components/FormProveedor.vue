<template>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        {{proveedor.id > 0 ? 'Editar' : 'Nuevo'}} Proveedor
        <router-link class="btn btn-sm btn-primary float-right" to="/proveedores">
          <i class="fa fa-list" ></i> Proveedores
        </router-link>
      </div>
      <div class="card-body">
        <form method="POST" @submit.prevent="save" novalidate  class="needs-validation">
          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group has-default">
                <label for="razon_social">Razón Social</label>
                <input type="text" v-model="proveedor.razon_social" placeholder="Razón Social"
                class="form-control form-control-default" :class="{ 'is-invalid': errores['razon_social'] }" />
                <form-error :errores="errores" :campo="'razon_social'"></form-error>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="from-group col-md-6">
              <label for="departamento">Departamento</label>
              <select v-model="proveedor.departamento" class="form-control" @change="proveedor.ciudad_id = departamentos[proveedor.departamento-1].ciudades[0].id">
                <option v-for="departamento in departamentos" :key="departamento.id" :value="departamento.id">
                  {{departamento.nombre}}
                </option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="ciudad">Ciudad</label>
              <select v-if="!proveedor.departamento > 0" class="form-control" disabled>
                <option value="1">Seleccione un departamento...</option>
              </select>
              <select v-model="proveedor.ciudad_id" class="form-control" v-else>
                <option v-for="ciudad in departamentos[proveedor.departamento-1].ciudades" :key="ciudad.id" :value="ciudad.id">
                  {{ciudad.nombre}}
                </option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-group has-default">
                <label for="telefono">Teléfono</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                  </div>
                  <input type="text" v-model="proveedor.telefono" placeholder="Teléfono"
                  class="form-control form-control-default" :class="{ 'is-invalid': errores['telefono'] }">
                  <form-error :errores="errores" :campo="'telefono'"></form-error>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group has-default">
                <label for="direccion">Dirección</label>
                <input type="text" v-model="proveedor.direccion" placeholder="Dirección"
                class="form-control form-control-default" :class="{ 'is-invalid': errores['direccion'] }" />
                <form-error :errores="errores" :campo="'direccion'"></form-error>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="gerente">Gerente</label>
                <input type="text" placeholder="Gerente" class="form-control form-control-default" v-model="proveedor.gerente" :class="{ 'is-invalid': errores['gerente'] }" >
                <form-error :errores="errores" :campo="'gerente'"></form-error>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" placeholder="Email" class="form-control form-control-default" v-model="proveedor.email" :class="{ 'is-invalid': errores['email'] }" >
                <form-error :errores="errores" :campo="'email'"></form-error>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="edad_rc">Edad RC</label>
                <input type="edad_rc" placeholder="Edad RC" class="form-control form-control-default" v-model="proveedor.edad_rc" :class="{ 'is-invalid': errores['edad_rc'] }" >
                <form-error :errores="errores" :campo="'edad_rc'"></form-error>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <button type="submit" class="btn btn-block btn-success">Registrar Proveedor</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'FormProducto',
    mounted() {
      var id = parseInt(this.$route.params.id) || 0;
      this.$set(this.proveedor, 'id', id);
      this.show(this.proveedor.id)

      axios.get('/api/departamentos')
        .then(res => {
          this.departamentos = res.data;
          if(id == 0) this.$set(this.proveedor, 'departamento',  this.departamentos[0].id);
          // TODO Seleccionar el departamento cuando va a editar al cargar la info del proveedor
        });
    },
    data() { return {
      proveedor: {},
      departamentos: [],
      errores: []
    }}, 
    methods: {
      show: function(id) {
        if (id <= 0) { return ; }
        axios.get(`/api/proveedores/${id}`).then(res => {
          this.proveedor = res.data;
        }).catch(err => {
          $.notify("Error desconocido..");
        });
      },
      save: function() {
        let extra = this.proveedor.id == 0 ? '' : `/${this.proveedor.id}/edit`;
        this.proveedor['_method'] = this.proveedor.id == 0 ? 'post' : 'put';
        axios.post('/api/proveedores' + extra, this.proveedor).then(res => {
          this.errores = [];
          $.notify(res.data.mensaje, "success");
          this.$router.push('/proveedores');
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
