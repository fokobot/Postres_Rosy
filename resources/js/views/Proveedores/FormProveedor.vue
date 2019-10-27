<template>
  <b-card>
    <template v-slot:header>
      {{proveedor.id > 0 ? 'Editar' : 'Nuevo'}} Proveedor
      <router-link class="btn btn-sm btn-primary float-right" to="/proveedores">
        <i class="fa fa-list"></i> Proveedores
      </router-link>
    </template>
    <b-card-text>
      <form method="POST" @submit.prevent="save" novalidate class="needs-validation">
        <div class="form-row">
          <div class="from-group has-default col-md-6">
            <label for="razon_social">Razón Social</label>
            <b-form-input
              id="razon_social"
              type="text"
              v-model="razon_social"
              placeholder="Razón Social"
              :state="hasError('razon_social')"
            ></b-form-input>
            <b-form-invalid-feedback id="errores-razon_social">{{error('razon_social')}}</b-form-invalid-feedback>
          </div>
          <div class="form-group has-default col-md-6">
            <label for="gerente">Gerente</label>
            <b-form-input
              id="gerente"
              type="text"
              placeholder="Gerente"
              v-model="gerente"
              :state="hasError('gerente')"
            />
            <b-form-invalid-feedback id="errores-gerente">{{error('gerente')}}</b-form-invalid-feedback>
          </div>
        </div>
        <div class="form-row">
          <b-col cols="4">
            <b-form-group
              label="Departamentos"
              label-for="departamentos">
              <v-select
                id="departamentos" 
                :options="departamentos"
                label="nombre" 
                v-model="departamento"
                :state="hasError('departamento')" >
              </v-select>
              <b-form-invalid-feedback id="errores-departamento">
                {{error('departamento')}}
              </b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <div class="form-group col-md-4">
            <label for="ciudad">Ciudad</label>
            <b-form-select id="ciudad" text-field="nombre" value-field="id"
               :options="ciudades"
                v-model="ciudad"
                :state="hasError('ciudad')">
                <template v-slot:first>
                  <option :value="null">-- Seleccione la ciudad --</option>
                </template>
              </b-form-select>
              <b-form-invalid-feedback id="errores-ciudad">{{error('ciudad')}}</b-form-invalid-feedback>
          </div>
          <div class="form-group has-default col-md-4">
            <label for="direccion">Dirección</label>
            <b-form-input
              type="text"
              v-model="direccion"
              placeholder="Dirección"
              :state="hasError('direccion')"
            />
            <b-form-invalid-feedback id="errores-direccion">{{error('direccion')}}</b-form-invalid-feedback>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <b-form-input
              type="email"
              placeholder="Email"
              v-model="email"
              :state="hasError('email')"
            ></b-form-input>
            <b-form-invalid-feedback id="errores-email">{{error('email')}}</b-form-invalid-feedback>
          </div>
          <div class="form-group has-default col-md-3">
            <label for="telefono">Teléfono</label>
            <b-input-group>
              <template v-slot:prepend>
                <b-input-group-text>
                  <i class="fa fa-phone"></i>
                </b-input-group-text>
              </template>
              <b-form-input
                id="telefono"
                type="text"
                placeholder="Teléfono"
                v-model="telefono"
                :state="hasError('telefono')"
              ></b-form-input>
              <b-form-invalid-feedback id="errores-telefono">{{error('telefono')}}</b-form-invalid-feedback>
            </b-input-group>
          </div>
          <div class="form-group col-md-3">
            <label for="edad_rc">Edad RC</label>
            <b-form-input
              id="edad_rc"
              type="text"
              placeholder="Edad RC"
              v-model="edad_rc"
              :state="hasError('edad_rc')"
            />
            <b-form-invalid-feedback id="errores-edad_rc">{{error('edad_rc')}}</b-form-invalid-feedback>
          </div>
        </div>
        <b-form-row>
          <b-button block variant="success" :disabled="saving" type="submit">
            <span v-if="saving">
              <b-spinner small type="grow"></b-spinner>Guardando...
            </span>
            <span v-else>Registrar Proveedor</span>
          </b-button>
        </b-form-row>
      </form>
    </b-card-text>
  </b-card>
</template>

<script>
import { mapGetters } from "vuex";
import { mapFields } from "vuex-map-fields";
import getErrors from "../../mixins";

export default {
  name: "FormProveedor",
  mixins: [getErrors],
  mounted() {
    this.$store.dispatch("fetchDepartamentos");
    var id = parseInt(this.$route.params.id) || 0;
    this.$store.dispatch("proveedores/fetch", id);
  },
  computed: {
    ciudades(){
      // let newCiudadID = this.departamento ? this.departamento.ciudades[0].id : 0;
      // Vue.set(this.proveedor, 'ciudad', newCiudadID);
      if(this.departamento) return this.departamento.ciudades;
      return [];
    },
    ...mapFields('proveedores', [
      'proveedor.id',
      'proveedor.razon_social',
      'proveedor.gerente',
      'proveedor.direccion',
      'proveedor.ciudad',
      'proveedor.telefono',
      'proveedor.edad_rc',
      'proveedor.email'
    ]),
    ...mapGetters({
      departamentos: 'departamentos',
      proveedor: 'proveedores/proveedor',
      errores: 'proveedores/errores',
      saving: 'proveedores/saving',
      sent: 'proveedores/sent'
    })
  },
  data() {
    return{
      departamento: null,
    }
  },
  methods: {
    save: function() {
      if (this.proveedor.id && this.proveedor.id > 0) {
        this.$store.dispatch('proveedores/update', this.proveedor);
      } else {
        this.$store.dispatch('proveedores/save', this.proveedor);
      }
    }
  }
};
</script>