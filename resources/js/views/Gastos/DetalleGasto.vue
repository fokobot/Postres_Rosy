<template>
  <div>
    <label>
      <b>Lista de Productos</b>
    </label>
    <div class="row">
      <div class="form-group col-md-5">
        <label for="producto">Producto</label>
        <input
          type="text"
          placeholder="Nombre del producto"
          v-model="nombre"
          @keydown.enter.prevent="addProducto"
          class="form-control"
        />
      </div>
      <div class="form-group col-md-3">
        <label for="valor">Valor Unit.</label>
        <input
          type="text"
          v-model.number="valor"
          @keydown.enter.prevent="addProducto"
          class="form-control"
        />
      </div>
      <div class="form-group col-md-2">
        <label>Cantidad</label>
        <input
          min="1"
          @keydown.enter.prevent="addProducto"
          type="number"
          v-model.number="cantidad"
          class="form-control"
        />
      </div>
      <div class="form-group col-md-2">
        <label style="color: white;">FIX</label>
        <button
          type="button"
          @click.prevent="addProducto"
          class="btn btn-block btn-sm btn-primary"
          :disabled="nombre.length < 3 || cantidad <= 0 || valor < 0"
        >
          <i class="fa fa-plus"></i>
        </button>
      </div>
    </div>
    <table class="table tbl-responsive tbl-stripped">
      <thead class="thead-light">
        <th>Producto</th>
        <th>Precio Unit.</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for="(producto, index) in productos" :key="producto.id">
          <td>
            <input
              v-if="edition[index]"
              class="form-control"
              type="text"
              v-model.number="producto.nombre"
              @keydown.enter.prevent="editarProducto(index)"
            />
            <span v-else>{{producto.nombre}}</span>
          </td>
          <td>
            <input
              v-if="edition[index]"
              class="form-control"
              type="text"
              v-model.number="producto.valor"
              @keydown.enter.prevent="editarProducto(index)"
            />
            <span v-else>$ {{producto.valor | currency}}</span>
          </td>
          <td>
            <input
              v-if="edition[index]"
              class="form-control"
              type="number"
              min="1"
              v-model.number="producto.cantidad"
              @keydown.enter.prevent="editarProducto(index)"
            />
            <span v-else>{{producto.cantidad}}</span>
          </td>
          <td>$ {{producto.cantidad * producto.valor | currency}}</td>
          <td>
            <button class="btn btn-sm btn-primary" type="button" @click="editarProducto(index)">
              <i class="fa fa-edit" v-if="!edition[index]"></i>
              <i class="fa fa-save" v-else></i>
            </button>
            <button class="btn btn-sm btn-danger" type="button" @click="eliminarProducto(index)">
              <i class="fa fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="table-active">
          <td>
            <b>Total:</b>
          </td>
          <td colspan="2"></td>
          <td>
            <strong>
              <u>$ {{total | currency}}</u>
            </strong>
          </td>
          <td></td>
        </tr>
      </tfoot>
    </table>
  </div>
</template>

<script>

export default {
  name: 'DetalleGasto',
  props: ['value'],
  data() {
    return {
      productos: [],
      edition: [],
      nombre: '',
      valor: 0,
      cantidad: 1,
    }
  },
  methods: {
    addProducto: function () {
      if (this.nombre.length < 3 || this.cantidad <= 0 || this.valor < 0) return;
      var producto = {
        nombre: this.nombre,
        cantidad: Math.max(1, Math.abs(this.cantidad)),
        valor: this.valor,
      }
      this.$set(this.edition, this.productos.length, false)
      this.productos.push(producto);
    },
    editarProducto: function (index) {
      this.$set(this.edition, index, !this.edition[index])
    },
    eliminarProducto: function (index) {
      this.productos.splice(index, 1);
    }
  },
  watch: {
    productos: function () {
      this.$emit("input", this.productos);
    }
  }, computed: {
    total: function () {
      return this.productos.reduce(function (prev, current, index) {
        return prev + current.cantidad * current.valor;
      }, 0);
    }
  }
}
</script>
