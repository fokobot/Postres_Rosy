<template>
  <b-col>
    <b-card>
      <template v-slot:header>
        {{cliente.id != 0 ? 'Editar' : 'Nuevo'}} Cliente
        <router-link class="btn btn-sm btn-primary float-right" to="/clientes">
          <i class="fa fa-list" ></i> Clientes
        </router-link>
      </template>
      <b-card-text>
        <b-form method="POST" @submit.prevent="save" novalidate  class="needs-validation">
          <b-form-row>
            <b-col cols="6">
              <b-form-group
                label="Nombre"
                label-for="nombre">
                <b-form-input
                  id="nombre"
                  placeholder="Nombre"
                  v-model="cliente.nombre" 
                  class="form-control form-control-default" 
                  :state="errores['nombre']  ? false : (true && sent)">
                </b-form-input>
                <form-error :errores="errores" :campo="'nombre'"></form-error>
              </b-form-group>
            </b-col>
            <b-col cols="6">
              <b-form-group
                label="Apellidos"
                label-for="apellidos">
                <b-form-input
                  id="apellidos"
                  placeholder="Apellidos" 
                  v-model="cliente.apellidos"
                  :state="errores['apellidos'] ? false : (true && sent)">
                </b-form-input>
                <form-error :errores="errores" :campo="'apellidos'"></form-error>
              </b-form-group>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-col cols="6">
              <b-form-group
                label="Dirección"
                label-for="direccion">
                <b-form-input type="text"
                  id="direccion"
                  placeholder="Dirección"
                  v-model="cliente.direccion"
                  :state="errores['direccion'] ? false : (true && sent)">
                </b-form-input>
                <form-error :errores="errores" :campo="'direccion'"></form-error>
              </b-form-group>
            </b-col>
            <b-col cols="6">
              <b-form-group
                label="Barrio"
                label-for="barrio">
                <b-form-input
                  id="barrio"
                  type="text"
                  placeholder="Barrio"
                  v-model="cliente.barrio"
                  :state="errores['barrio'] ? false : (true && sent)">
                </b-form-input>
                <form-error :errores="errores" :campo="'barrio'"></form-error>
              </b-form-group>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-col cols="6">
              <b-form-group
                label="Teléfono"
                label-for="telefono">
                <b-input-group>
                  <template v-slot:prepend>
                    <b-input-group-text><i class="fa fa-phone"></i></b-input-group-text>
                  </template>
                  <b-form-input
                    id="telefono"
                    type="text"
                    placeholder="Teléfono" 
                    v-model="cliente.telefono"
                    :state="errores['telefono'] ? false : (true && sent)">
                  </b-form-input>
                  <form-error :errores="errores" :campo="'telefono'"></form-error>
                </b-input-group>
              </b-form-group>
            </b-col>
            <b-col cols="6">
              <b-form-group
                label="Fecha de Nacimiento"
                label-for="fecha_de_nacimiento">
                <b-form-input
                  id="fecha_de_nacimiento"
                  type="date"
                  v-model="cliente.nacimiento" 
                  :state="errores['nacimiento'] ? false : (true && sent)" >
                </b-form-input>
                <form-error :errores="errores" :campo="'nacimiento'"></form-error>
              </b-form-group>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-button block variant="success" :disabled="saving" type="submit">
              <span v-if="saving">
                <b-spinner small type="grow"></b-spinner>
                Guardando...
              </span>
              <span v-else>Registrar Cliente</span>
            </b-button>
          </b-form-row>
        </b-form>
      </b-card-text>
    </b-card>
  </b-col>
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
      errores: [],
      saving: false,
      sent: null
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
        this.saving = true;
        let extra = this.cliente.id == 0 ? '' : `/${this.cliente.id}/edit`;
        this.cliente['_method'] = this.cliente.id == 0 ? 'post' : 'put';
        axios.post('/api/clientes' + extra, this.cliente).then(res => {
          this.errores = [];
          $.notify(res.data.mensaje, "success");
          if(this.$route.query.next){
            this.$router.push(this.$route.query.next)
          } else {
            this.$router.push('/clientes')
          }
        }).catch(err => {
          let errores = err.response;
          if (errores && errores.status === 422){
            $.notify("Errores de validación.", "warn");
            this.errores = errores.data.errors;
          } else {
            console.log(err)
            $.notify("Error desconocido.");
          }
        }).finally(() => {
          this.sent = true;
          this.saving = false;
        });
      }
    }
  }
</script>
