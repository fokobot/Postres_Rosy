<template>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        {{ producto.id != 0 ? 'Editar' : 'Nuevo'}} Producto
        <router-link class="btn btn-sm btn-primary float-right" to="/productos">
          <i class="fa fa-list" ></i> Productos
        </router-link>
      </div>
      <div class="card-body">
        <form method="POST" @submit.prevent="save" novalidate  class="needs-validation">
          <div class="form-row">
            <div class="col-md-12">
              <label for="nombre">Nombre del producto</label>
              <div class="form-group has-default">
                <input type="text" v-model="producto.nombre" placeholder="Nombre"
                class="form-control form-control-default" :class="{ 'is-invalid': errores['nombre'] }">
                <form-error :errores="errores" :campo="'nombre'"></form-error>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <label for="valordetal">Valor al detal</label>
              <div class="form-group has-default">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="text" v-model="producto.valordetal" placeholder="3000"
                  class="form-control form-control-default" :class="{ 'is-invalid': errores['valordetal'] }">
                  <form-error :errores="errores" :campo="'valordetal'"></form-error>
                </div>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <label for="valormayor">Valor al por mayor</label>
              <div class="form-group has-default">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="text" v-model="producto.valormayor" placeholder="2000"
                  class="form-control form-control-default" :class="{ 'is-invalid': errores['valormayor'] }">
                  <form-error :errores="errores" :campo="'valormayor'"></form-error>
                </div>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <label for="minimopormayor">Cantidad minima al por mayor</label>
              <div class="form-group has-default">
                <input type="text" v-model="producto.minimopormayor" placeholder="6"
                class="form-control form-control-default" :class="{ 'is-invalid': errores['minimopormayor'] }">
                <form-error :errores="errores" :campo="'minimopormayor'"></form-error>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <button type="submit" class="btn btn-block btn-success">Registrar Producto</button>
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
      var id =parseInt(this.$route.params.id) || 0;
      this.$set(this.producto, 'id', id);
      this.show(this.producto.id)
    },
    data() {return {
      producto: {},
      errores: []
    }}, 
    methods: {
      show: function(id) {
        if (id <= 0) { return ; }
        axios.get(`/api/productos/${id}`).then(res => {
          this.producto = res.data;
        }).catch(err => {
          $.notify("Error desconocido..");
        });
      },
      save: function() {
        let extra = this.producto.id == 0 ? '' : `/${this.producto.id}/edit`;
        this.producto['_method'] = this.producto.id == 0 ? 'post' : 'put';
        axios.post('/api/productos' + extra, this.producto).then(res => {
          this.errores = [];
          $.notify(res.data.mensaje, "success");
          this.$router.push('/productos');
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
