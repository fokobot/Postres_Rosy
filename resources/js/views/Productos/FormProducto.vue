<template>
  <b-col>
    <div class="card">
      <div class="card-header">
        {{ producto.id ? 'Editar' : 'Nuevo'}} Producto
        <router-link class="btn btn-sm btn-primary float-right" to="/productos">
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
                  v-model="nombre"
                  placeholder="Nombre"
                  :state="hasError('nombre')"
                ></b-form-input>
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
                    v-model="valordetal"
                    placeholder="3000"
                    :state="hasError('valordetal')"
                    required
                  ></b-form-input>
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
                    v-model="valormayor"
                    placeholder="2000"
                    :state="hasError('valormayor')"
                    required
                  ></b-form-input>
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
                  v-model="minimopormayor"
                  placeholder="1000"
                  :state="hasError('minimopormayor')"
                  aria-describedby="input-live-help errores-minimopormayor"
                ></b-form-input>
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

export default {
  name: 'FormProducto',
  mixins: [getErrors],
  mounted() {
    var id = parseInt(this.$route.params.id) || 0;
    this.$store.dispatch('productos/fetch', id);
  },
  computed: {
    ...mapFields('productos', [
      'producto.id',
      'producto.nombre',
      'producto.valormayor',
      'producto.valordetal',
      'producto.minimopormayor'
    ]),
    ...mapGetters({
      producto: 'productos/producto',
      errores: 'productos/errores',
      sent: 'productos/sent',
      saving: 'productos/saving'
    })
  },
  methods: {
    save: function () {
      if (this.producto.id && this.producto.id > 0) {
        this.$store.dispatch('productos/update', this.producto);
      } else {
        this.$store.dispatch('productos/save', this.producto);
      }
    },

  }
}
</script>
