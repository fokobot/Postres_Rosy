<template>
  <b-col>
    <div class="card">
      <div class="card-header">
        Nuevo Producto
        <router-link class="btn btn-sm btn-primary float-right" :to="{name: 'productos'}">
          <i class="fa fa-list"></i> Productos
        </router-link>
      </div>
      <div class="card-body">
        <form method="POST" @submit.prevent="save" novalidate class="needs-validation">
          <b-form-row>
            <b-col>
              <label for="nombre">Nombre del producto</label>
              <div class="form-group has-default">
                <b-form-input
                  type="text"
                  v-model="producto.nombre"
                  placeholder="Nombre"
                  :state="hasError('nombre')"
                />
                <b-form-invalid-feedback id="errores-nombre">{{error('nombre')}}</b-form-invalid-feedback>
              </div>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-col>
              <label for="valordetal">Valor al detal</label>
              <div class="form-group has-default">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <b-form-input
                    id="valordetal"
                    type="text"
                    v-model="producto.valordetal"
                    placeholder="3000"
                    :state="hasError('valordetal')"
                    required
                  />
                  <b-form-invalid-feedback id="errores-valordetal">{{error('valordetal')}}</b-form-invalid-feedback>
                </div>
              </div>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-col>
              <label for="valormayor">Valor al por mayor</label>
              <div class="form-group has-default">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <b-form-input
                    id="valormayor"
                    type="text"
                    v-model="producto.valormayor"
                    placeholder="2000"
                    :state="hasError('valormayor')"
                    required
                  />
                  <b-form-invalid-feedback id="errores-mayorvalor">{{error('mayorvalor')}}</b-form-invalid-feedback>
                </div>
              </div>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-col>
              <label for="minimopormayor">Cantidad minima al por mayor</label>
              <div class="form-group has-default">
                <b-form-input
                  id="minimopormayor"
                  type="text"
                  v-model="producto.minimopormayor"
                  placeholder="1000"
                  :state="hasError('minimopormayor')"
                  aria-describedby="input-live-help errores-minimopormayor"
                />
                <b-form-invalid-feedback id="errores-minimopormayor">{{error('minimopormayor')}}</b-form-invalid-feedback>
              </div>
            </b-col>
          </b-form-row>
          <b-form-row>
            <b-button block variant="success" :disabled="saving" type="submit">
              <span v-if="saving">
                <b-spinner small type="grow"></b-spinner>Guardando...
              </span>
              <span v-else>Guardar Producto</span>
            </b-button>
          </b-form-row>
        </form>
      </div>
    </div>
  </b-col>
</template>

<script>
import { mapGetters } from 'vuex';
import { mapFields } from 'vuex-map-fields';
import getErrors from '../../mixins';
import { defaultProducto } from '../../defaults'

export default {
  name: 'NuevoProducto',
  mixins: [getErrors],
  computed: {
    ...mapGetters({
      errores: 'productos/errores',
      sent: 'productos/sent',
      saving: 'productos/saving'
    })
  },
  data() {
    return {
      producto: { ...defaultProducto }
    }
  },
  methods: {
    save: function () {
      this.$store.dispatch('productos/save', this.producto)
    },

  }
}
</script>
