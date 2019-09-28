<template>
  <b-col>
    <b-card>
      <template v-slot:header>
        {{id > 0 ? 'Editar' : 'Nuevo'}} Cliente
        <router-link class="btn btn-sm btn-primary float-right" to="/clientes">
          <i class="fa fa-list" ></i> Clientes
        </router-link>
      </template>
      <b-card-text>
        <b-form method="POST" @submit.prevent="save" novalidate  class="needs-validation">
          <b-form-row>
            <b-col>
              <b-form-group
                label="Tipo de Documento"
                label-for="tipo_de_documento">
                <b-form-select
                  id="tipos_de_documento" 
                  :options="tipos_de_documento"
                  text-field="nombre" 
                  value-field="id"
                  v-model="tipo_de_documento"
                  :state="errores['tipo_de_documento']  ? false : (true && sent)">
                  <template v-slot:first>
                    <option value="0">-- Seleccione el tipo de documento --</option>
                  </template>
                </b-form-select>
                <form-error :errores="errores" :campo="'tipo_de_documento'"></form-error>
              </b-form-group>
            </b-col>
            <b-col>
              <b-form-group
                label="Documento"
                label-for="documento">
                <b-form-input 
                  v-model="documento"
                  id="documento"
                  placeholder="Documento"
                  :state="errores['documento']  ? false : (true && sent)">
                </b-form-input>
                <form-error :errores="errores" :campo="'documento'"></form-error>
              </b-form-group>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-col cols="6">
              <b-form-group
                label="Nombre*"
                label-for="nombre">
                <b-form-input
                  id="nombre"
                  placeholder="Nombre"
                  v-model="nombre" 
                  class="form-control form-control-default" 
                  :state="errores['nombre']  ? false : (true && sent)">
                </b-form-input>
                <form-error :errores="errores" :campo="'nombre'"></form-error>
              </b-form-group>
            </b-col>
            <b-col cols="6">
              <b-form-group
                label="Apellidos*"
                label-for="apellidos">
                <b-form-input
                  id="apellidos"
                  placeholder="Apellidos" 
                  v-model="apellidos"
                  :state="errores['apellidos'] ? false : (true && sent)">
                </b-form-input>
                <form-error :errores="errores" :campo="'apellidos'"></form-error>
              </b-form-group>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-col cols="3">
              <b-form-group
                label="Dirección*"
                label-for="direccion">
                <b-form-input type="text"
                  id="direccion"
                  placeholder="Dirección"
                  v-model="direccion"
                  :state="errores['direccion'] ? false : (true && sent)">
                </b-form-input>
                <form-error :errores="errores" :campo="'direccion'"></form-error>
              </b-form-group>
            </b-col>
            <b-col cols="3">
              <b-form-group
                label="Barrio*"
                label-for="barrio">
                <b-form-input
                  id="barrio"
                  type="text"
                  placeholder="Barrio"
                  v-model="barrio"
                  :state="errores['barrio'] ? false : (true && sent)">
                </b-form-input>
                <form-error :errores="errores" :campo="'barrio'"></form-error>
              </b-form-group>
            </b-col>
            <b-col cols="6">
              <b-form-group
                label="Email"
                label-for="email">
                <b-form-input
                  id="email"
                  type="email"
                  placeholder="Correo Electrónico"
                  v-model="email"
                  :state="errores['email'] ? false : (true && sent)">
                </b-form-input>
                <form-error :errores="errores" :campo="'email'"></form-error>
              </b-form-group>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-col cols="6">
              <b-form-group
                label="Teléfono*"
                label-for="telefono">
                <b-input-group>
                  <template v-slot:prepend>
                    <b-input-group-text><i class="fa fa-phone"></i></b-input-group-text>
                  </template>
                  <b-form-input
                    id="telefono"
                    type="text"
                    placeholder="Teléfono" 
                    v-model="telefono"
                    :state="errores['telefono'] ? false : (true && sent)">
                  </b-form-input>
                  <form-error :errores="errores" :campo="'telefono'"></form-error>
                </b-input-group>
              </b-form-group>
            </b-col>
            <b-col cols="6">
              <b-form-group
                label="Fecha de Nacimiento*"
                label-for="fecha_de_nacimiento">
                <b-form-input
                  id="fecha_de_nacimiento"
                  type="date"
                  v-model="fecha_de_nacimiento" 
                  :state="errores['fecha_de_nacimiento'] ? false : (true && sent)" >
                </b-form-input>
                <form-error :errores="errores" :campo="'fecha_de_nacimiento'"></form-error>
              </b-form-group>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-button block variant="success" :disabled="saving" type="submit">
              <span v-if="saving">
                <b-spinner small type="grow"></b-spinner>
                Guardando...
              </span>
              <span v-else>Registra </span>
            </b-button>
          </b-form-row>
        </b-form>
      </b-card-text>
    </b-card>
  </b-col>
</template>

<script>
  import { mapGetters } from 'vuex';
  import { mapFields }   from 'vuex-map-fields';

  export default {
    name: 'FormCliente',
    mounted() {
      this.$store.dispatch('fetchTiposDeDoc');      
      var id = parseInt(this.$route.params.id) || 0;
      this.$store.dispatch('clientes/fetch', id);
    },
    computed: {
      ...mapFields('clientes', [
        'cliente.id',
        'cliente.tipo_de_documento',
        'cliente.documento',
        'cliente.nombre',
        'cliente.apellidos',
        'cliente.email',
        'cliente.fecha_de_nacimiento',
        'cliente.telefono',
        'cliente.direccion',
        'cliente.barrio'
      ]),
      ...mapGetters({
        tipos_de_documento: 'tipos_de_documento',
        cliente: 'clientes/cliente',
        saving: 'clientes/saving',
        errores: 'clientes/errores',
        sent: 'clientes/sent'
      })
    },
    methods: {
      save: function() {
        if(this.cliente.id == 0){
          this.$store.dispatch('clientes/save', this.cliente);
        } else {
          this.$store.dispatch('clientes/update', this.cliente);
        }
      }
    }
  }
</script>
