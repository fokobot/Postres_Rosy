<template>
    <div class="card">
      <div class="card-header">
        {{empleado.id && empleado.id != 0 ? 'Editar' : 'Nuevo'}} Empleado
        <router-link class="btn btn-sm btn-primary float-right" to="/empleados">
          <i class="fa fa-list" ></i> Empleados
        </router-link>
      </div>
      <div class="card-body">
        <form method="POST" @submit.prevent="save" novalidate  class="needs-validation">
        <b-form-row>
          <b-col>
            <b-form-group label="Tipo de Documento" label-for="tipo_de_documento">
              <b-form-select
                id="tipo_de_documento"
                :options="tipos_de_documento"
                text-field="nombre"
                value-field="id"
                v-model="empleado.persona.tipo_de_documento"
                :state="hasError('persona.tipo_de_documento')"
              >
                <template v-slot:first>
                  <option value="0">-- Seleccione el tipo de documento --</option>
                </template>
              </b-form-select>
              <b-form-invalid-feedback
                id="errores-tipo_de_documento"
              >{{error('persona.tipo_de_documento')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label="Documento">
              <b-form-input
                id="documento"
                placeholder="Documento"
                v-model="empleado.persona.documento"
                :state="hasError('persona.documento')"
              />
              <b-form-invalid-feedback id="errores-documento">{{error('persona.documento')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        </b-form-row>
        <b-form-row>
          <b-col>
            <b-form-group label='Nombre' label-for="nombre">
              <b-form-input id="nombre" placeholder="Nombre"
               v-model='empleado.persona.nombre'
               :state="hasError('persona.nombre')"/>
              <b-form-invalid-feedback id="errores-nombre">{{error('persona.nombre')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label='Apellidos' label-for="apellidos">
              <b-form-input id="apellidos" placeholder="Apellidos"
               v-model='empleado.persona.apellidos'
               :state="hasError('persona.apellidos')"/>
              <b-form-invalid-feedback id="errores-apellidos">{{error('persona.apellidos')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        </b-form-row>
        <b-form-row>
          <b-col>
            <b-form-group label='Departamento' label-for="departamento">
              <v-select
                id="departamento"
                :options="departamentos"
                label="nombre"
                v-model="departamento"/>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label='Ciudad'>
               <b-form-select id="ciudad" text-field="nombre" value-field="id"
               :options="ciudades"
                v-model="empleado.persona.ciudad"
                :state="hasError('persona.ciudad')">
                <template v-slot:first>
                  <option value="0">-- Seleccione la ciudad --</option>
                </template>
              </b-form-select>
              <b-form-invalid-feedback id="errores-ciudad">{{error('persona.ciudad')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label='Barrio'>
              <b-form-input id="barrio" placeholder="Barrio"
               v-model='empleado.persona.barrio'
               :state="hasError('persona.barrio')"/>
              <b-form-invalid-feedback id="errores-barrio">{{error('persona.barrio')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        </b-form-row>
        <b-form-row>
          <b-col>
            <b-form-group label='Dirección' label-for="direccion">
              <b-form-input id="direccion" placeholder="Dirección"
               v-model='empleado.persona.direccion'
               :state="hasError('persona.direccion')"/>
              <b-form-invalid-feedback id="errores-direccion">{{error('persona.direccion')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label='Telefono'>
              <b-form-input id="telefono" placeholder="Telefono"
               v-model='empleado.persona.telefono'
               :state="hasError('persona.telefono')"/>
              <b-form-invalid-feedback id="errores-telefono">{{error('persona.telefono')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label='Celular'>
              <b-form-input id="celular" placeholder="Celular"
               v-model='empleado.persona.celular'
               :state="hasError('persona.celular')"/>
              <b-form-invalid-feedback id="errores-celular">{{error('persona.celular')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        </b-form-row>
        <b-form-row>
          <b-col>
            <b-form-group label='Fecha de Nacimiento' label-for="fecha_de_nacimiento">
              <b-form-input id="fecha_de_nacimiento" type="date"
               v-model='empleado.persona.fecha_de_nacimiento'
               :state="hasError('persona.fecha_de_nacimiento')"/>
              <b-form-invalid-feedback id="errores-fecha_de_nacimiento">{{error('persona.fecha_de_nacimiento')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        <b-col>
          <b-form-group label='Conyuge' label-for="conyuge">
            <b-form-input id="conyuge" placeholder="Conyuge"
             v-model='empleado.conyuge'
             :state="hasError('conyuge')"/>
            <b-form-invalid-feedback id="errores-conyuge">{{error('conyuge')}}</b-form-invalid-feedback>
          </b-form-group>
        </b-col>
        <b-col>
          <b-form-group label='Estado Civil' label-for="estado_civil">
            <b-form-select id="estado_civil" text-field="nombre" value-field="id"
             v-model='empleado.estado_civil'
             :options="estados_civiles"
             :state="hasError('estado_civil')">
                <template v-slot:first>
                  <option value="0">-- Seleccione el estado civil --</option>
                </template>
            </b-form-select>
            <b-form-invalid-feedback id="errores-estado_civil">{{error('estado_civil')}}</b-form-invalid-feedback>
          </b-form-group>
        </b-col>
        </b-form-row>
        <b-form-row>
          <b-col>
            <b-form-group label='Email' label-for="email">
              <b-form-input id="email" placeholder="Email"
               v-model='empleado.usuario.email'
                :state="hasError('usuario.email')"/>
              <b-form-invalid-feedback id="errores-email">{{error('usuario.email')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          </b-form-row>
          <b-form-row>
            <b-col>
              <b-form-group label="Contraseña" label-for="password">
                <b-input
                  type="password" id="password" v-model="empleado.usuario.password"
                  :state="hasError('usuario.password')"  placeholder="Contraseña"
                />
                <b-form-invalid-feedback id="errores-password">{{error('usuario.password')}}</b-form-invalid-feedback>
              </b-form-group>
            </b-col>
            <b-col>
              <b-form-group
                label="Confirmación de Contraseña"
                label-for="password_confirmation">
                <b-input
                  type="password"
                  id="password_confirmation"
                  v-model="empleado.usuario.password_confirmation"
                  :state="hasError('usuario.password')"
                  placeholder="Confirmación de Contraseña"/>
              </b-form-group>
            </b-col>
          </b-form-row>
          <b-button block variant="success" :disabled="saving" type="submit">
            <span v-if="saving">
              <b-spinner small type="grow"></b-spinner>Guardando...
            </span>
            <span v-else>Registrar Empleado</span>
          </b-button>
      </form>
    </div>
  </div>
</template>

<script>
  import {mapGetters} from 'vuex';
  import getErrors from "../../mixins";

  export default {
    name: 'FormEmpleado',
    mixins: [getErrors],
    mounted() {
      var id = parseInt(this.$route.params.id) || 0;
      this.$store.dispatch('fetchTiposDeDoc')
      this.$store.dispatch('fetchEstadosCiviles')
      this.$store.dispatch('fetchDepartamentos')
    },
    computed: {
      ciudades(){
        let newCiudadID = this.departamento ? this.departamento.ciudades[0].id : 0;
        Vue.set(this.empleado.persona, 'ciudad', newCiudadID);
        return this.departamento ? this.departamento.ciudades : [];
      },
      ...mapGetters({
        departamentos: "departamentos",
        estados_civiles: "estados_civiles",
        tipos_de_documento: "tipos_de_documento",
        errores: "empleados/errores",
        saving: "empleados/saving",
      })
    },
    data() { 
      return {
        departamento: null,
        empleado: defaultEmpleado,
      }
    },
    methods: {
      save: function() {
        if (this.empleado.id && this.empleado.id > 0) {
          this.$store.dispatch("empleados/update", this.empleado);
        } else {
          this.$store.dispatch("empleados/save", this.empleado);
        }
      }
    }
  }

  let defaultEmpleado = {
    persona: {
        tipo_de_documento  : 0,
        documento          : '',
        nombre             : '',
        apellidos          : '',
        ciudad             : 0,
        barrio             : '',
        direccion          : '',
        telefono           : '',
        celular            : '',
        fecha_de_nacimiento: '1998-09-10'
      },
    usuario : {
      email                : '',
      password             : '',
      password_confirmation: ''
    },
    conyuge: '',
    estado_civil: 0
  }
</script>