<template>
  <b-card>
    <template v-slot:header>
      {{gasto.id > 0 ? 'Editar' : 'Nuevo'}} Gasto
      <router-link class="btn btn-sm btn-primary float-right" to="/gastos">
        <i class="fa fa-list"></i> Gastos
      </router-link>
    </template>
    <b-card-text>
      <form method="POST" @submit.prevent="save" novalidate class="needs-validation">
        <b-form-row>
          <b-col>
            <b-form-group label="Proveedor" label-for="proveedor">
              <b-form-select
                text-field="razon_social"
                value-field="id"
                v-model="gasto.proveedor"
                :options="proveedores"
                :state="hasError('proveedor')"
              >
                <template v-slot:first>
                  <option value="0">-- Seleccione el proveedor --</option>
                </template>
              </b-form-select>
              <b-form-invalid-feedback id="errores-proveedor">{{error('proveedor')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        </b-form-row>
        <b-form-row>
          <b-col>
            <b-form-group label="Total" label-for="total">
              <b-input-group>
                <template v-slot:prepend>
                  <b-input-group-text>$</b-input-group-text>
                </template>
                <b-form-input id="total" type="text" :value="total | currency" disabled />
              </b-input-group>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label="Estado del Gasto">
              <b-form-select
                id="estado_gasto"
                v-model="gasto.estado"
                :options="estados"
                text-field="nombre"
                value-field="id"
                :state="hasError('estado')"
              >
                <template v-slot:first>
                  <option value="0">-- Seleccione el estado --</option>
                </template>
              </b-form-select>
              <b-form-invalid-feedback id="errores-estado">{{error('estado')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label="Fecha" label-for="fecha">
              <b-form-input id="fecha" v-model="gasto.fecha" type="date" :state="hasError('fecha')" />
              <b-form-invalid-feedback id="errores-fecha">{{error('fecha')}}</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        </b-form-row>
        <DetalleGasto v-model="gasto.productos" />
        <b-form-row>
          <b-button block variant="success" :disabled="saving" type="submit">
            <span v-if="saving">
              <b-spinner small type="grow"></b-spinner>Guardando...
            </span>
            <span v-else>Registrar Gasto</span>
          </b-button>
        </b-form-row>
      </form>
    </b-card-text>
  </b-card>
</template>

<script>
import DetalleGasto from "./DetalleGasto";
import getErrors from "../../mixins";
import { mapGetters } from "vuex";

export default {
  name: "FormGasto",
  mixins: [getErrors],
  components: { DetalleGasto },
  mounted() {
    var id = parseInt(this.$route.params.id) || 0;
    this.$store.dispatch('proveedores/fetchAll')
    this.$store.dispatch('fetchEstadosGasto')
    this.$store.dispatch('gastos/fetch', id);
  },
  data() {
    return {
      gasto: defaultGasto
    }
  },
  computed: {
    ...mapGetters({
      estados: 'estados_gasto',
      proveedores: 'proveedores/proveedores',
      errores: 'gastos/errores',
      saving: 'gastos/saving',
      sent: 'gastos/sent',
    }),
    total: function () {
      if (!this.gasto.productos) return 0;
      return this.gasto.productos.reduce((sum, current) => {
        return sum + current.cantidad * current.valor;
      }, 0);
    }
  },
  methods: {
    save: function () {
      if (this.gasto.id && this.gasto.id > 0) {
        this.$store.dispatch('gastos/update', this.gasto);
      } else {
        this.$store.dispatch('gastos/save', this.gasto);
      }
    }
  }
};

let defaultGasto = {
  id: 0,
  proveedor: 0,
  estado: 0,
  fecha: null,
  productos: []
}
</script>
