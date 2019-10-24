<template>
  <b-col>
    <b-card>
      <template v-slot:header>
        {{cliente.id > 0 ? 'Editar' : 'Nuevo'}} Cliente
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
                  v-model="cliente.persona.tipo_de_documento"
                  :state="hasError('persona.tipo_de_documento')" >
                  <template v-slot:first>
                    <option value="0">-- Seleccione el tipo de documento --</option>
                  </template>
                </b-form-select>
                <b-form-invalid-feedback id="errores-tipo_de_documento">
                  {{error('persona.tipo_de_documento')}}
                </b-form-invalid-feedback>
              </b-form-group>
            </b-col>
            <b-col>
              <b-form-group
                label="Documento"
                label-for="documento">
                <b-form-input 
                  v-model="cliente.persona.documento"
                  id="documento"
                  placeholder="Documento"
                  :state="hasError('persona.documento')" >
                </b-form-input>
                <b-form-invalid-feedback id="errores-documento">
                  {{error('persona.documento')}}
                </b-form-invalid-feedback>
              </b-form-group>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-col cols="6">
              <b-form-group
                label="Nombre"
                label-for="nombre">
                <b-form-input
                  id="nombre"
                  placeholder="Nombre"
                  v-model="cliente.persona.nombre" 
                  class="form-control form-control-default" 
                  :state="hasError('persona.nombre')" >
                </b-form-input>
                <b-form-invalid-feedback id="errores-nombre">
                  {{error('persona.nombre')}}
                </b-form-invalid-feedback>
              </b-form-group>
            </b-col>
            <b-col cols="6">
              <b-form-group
                label="Apellidos"
                label-for="apellidos">
                <b-form-input
                  id="apellidos"
                  placeholder="Apellidos" 
                  v-model="cliente.persona.apellidos"
                  :state="hasError('persona.apellidos')" >
                </b-form-input>
                <b-form-invalid-feedback id="errores-apellidos">
                  {{error('persona.apellidos')}}
                </b-form-invalid-feedback>
              </b-form-group>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-col cols="3">
              <b-form-group
                label="Dirección"
                label-for="direccion">
                <b-form-input type="text"
                  id="direccion"
                  placeholder="Dirección"
                  v-model="cliente.persona.direccion"
                  :state="hasError('persona.direccion')" >
                </b-form-input>
                <b-form-invalid-feedback id="errores-direccion">
                  {{error('persona.direccion')}}
                </b-form-invalid-feedback>
              </b-form-group>
            </b-col>
            <b-col cols="3">
              <b-form-group
                label="Barrio"
                label-for="barrio">
                <b-form-input
                  id="barrio"
                  type="text"
                  placeholder="Barrio"
                  v-model="cliente.persona.barrio"
                  :state="hasError('persona.barrio')" >
                </b-form-input>
                <b-form-invalid-feedback id="errores-barrio">
                  {{error('persona.barrio')}}
                </b-form-invalid-feedback>
              </b-form-group>
            </b-col>
            <b-col>
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
                    v-model="cliente.persona.telefono"
                    :state="hasError('persona.telefono')" >
                  </b-form-input>
                  <b-form-invalid-feedback id="errores-telefono">
                    {{error('persona.telefono')}}
                  </b-form-invalid-feedback>
                </b-input-group>
              </b-form-group>
            </b-col>
            <b-col>
              <b-form-group label='Estrato Social' label-for="estrato_social">
                <b-form-input id="estrato_social" placeholder="Estrato Social" type="number"
                 v-model='cliente.estrato_social'
                 :state="hasError('estrato_social')"/>
                <b-form-invalid-feedback id="errores-estrato_social">{{error('estrato_social')}}</b-form-invalid-feedback>
              </b-form-group>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-col>
              <b-form-group
                label="Email"
                label-for="email">
                <b-form-input
                  id="email"
                  type="email"
                  placeholder="Correo Electrónico"
                  v-model="cliente.email"
                  :state="hasError('email')" >
                </b-form-input>
                <b-form-invalid-feedback id="errores-email">
                  {{error('email')}}
                </b-form-invalid-feedback>
              </b-form-group>
            </b-col>
            <b-col cols="6">
              <b-form-group
                label="Fecha de Nacimiento"
                label-for="fecha_de_nacimiento">
                <b-form-input
                  id="fecha_de_nacimiento"
                  type="date"
                  v-model="cliente.persona.fecha_de_nacimiento" 
                  :state="hasError('persona.fecha_de_nacimiento')" >
                </b-form-input>
                <b-form-invalid-feedback id="errores-fecha_de_nacimiento">
                  {{error('persona.fecha_de_nacimiento')}}
                </b-form-invalid-feedback>
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
  import { mapGetters } from 'vuex';
  import getErrors from '../../mixins';

  export default {
    name: 'FormCliente',
    mixins: [getErrors],
    mounted() {
      Vue.set(this.cliente, 'id', parseInt(this.$route.params.id) || 0);
      this.$store.dispatch('fetchTiposDeDoc');      
      this.$store.dispatch('clientes/fetch', this.cliente.id);
    },
    computed: {
      ...mapGetters({
        departamentos     : "departamentos",
        tipos_de_documento: 'tipos_de_documento',
        saving            : 'clientes/saving',
        errores           : 'clientes/errores',
        sent              : 'clientes/sent'
      })
    },
    data() {
      return {
        departamento: null,
        cliente: defaultCliente
      }
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

  let defaultCliente = {
    persona: {
      id                 : 0,
      tipo_de_documento  : 0,
      documento          : '',
      nombre             : '',
      apellidos          : '',
      ciudad             : null,
      barrio             : '',
      direccion          : '',
      telefono           : '',
      celular            : '',
      fecha_de_nacimiento: null
    },
    estrato_social: 0,
    email: ''
  }
</script>
