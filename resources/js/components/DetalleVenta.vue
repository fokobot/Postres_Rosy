<template>
  <div>
    <label>
      <b>Lista de Productos</b>
    </label>
    <div class="row">
      <div class="form-group col-md-6">
        <label for="producto">Producto</label>
        <select :disabled="productos.length==0" v-model="productoactual" class="form-control">
          <option v-for="producto in productos" :key="producto.id" :value="producto.id">
            {{producto.nombre}}
          </option>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label>Cantidad</label>
        <input :disabled="productos.length==0" min="1" @keydown.enter.prevent="addProducto" type="number" v-model.number="unidades" class="form-control" />
      </div>
      <div class="form-group col-md-2">
        <label style="color: white;">FIX THIS</label>
        <button :disabled="!productoactual || productos.length==0 || productoactual <= 0" type="button" @click.prevent="addProducto" class="btn btn-block btn-sm btn-primary">
          <i class="fa fa-plus"></i>
        </button>
      </div>
    </div>
    <div class="alert alert-danger" v-if="errores['productos']">
      {{ errores.productos[0] }}
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
        <tr v-for="producto in escogidos" :key="producto.id">
          <td>{{producto.nombre}} {{producto.edition}}</td>
          <td>$ {{valorProducto(producto)}}</td>
          <td>
            <input class="form-control" type="number" min="1" v-if="edition[producto.id]" v-model="producto.cantidad" @keydown.enter.prevent="editarProducto(producto)"/>
            <span v-else>{{producto.cantidad}}</span>
          </td>
          <td>$ {{producto.cantidad * valorProducto(producto)}}</td>
          <td>
            <button class="btn btn-sm btn-primary" type="button" @click="editarProducto(producto)">
              <i class="fa fa-edit" v-if="!edition[producto.id]"></i>
              <i class="fa fa-save" v-else></i>
            </button>
            <button class="btn btn-sm btn-danger" type="button" @click="eliminarProducto(producto.id)">
              <i class="fa fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
      <tfoot>
      <tr class="table-active">
        <td><b>Total: </b></td>
        <td colspan="2"></td>
        <td><strong><u>$ {{total}}</u></strong></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</div>
</template>

<script>
  export default {
    props: ['errores'],
    mounted () {
      axios
      .get('/api/productos/')
      .then(response => (this.productos = response.data, this.productoactual = this.productos[0].id))
    },
    data() { return {
      productos : [],
      escogidos: [],
      edition: [],
      productoactual: 0,
      unidades: 1,
      total: 0.0
    }},
    methods: {
      addProducto: function() {
        var pactual = this.productoactual;
        var index = this.productos.findIndex(function(el) {
          return el.id == pactual;
        });
        var item = this.productos[index];
        item.cantidad = Math.max(1, Math.abs(this.unidades));
        this.edition[item.id] = false;
        this.productos.splice(index, 1);
        this.escogidos.push(item);
        this.total += item.cantidad * this.valorProducto(item);
        this.productoactual = this.productos.length === 0 ? 0 : this.productos[0].id;
      },
      editarProducto: function(producto){
        this.$set(this.edition, producto.id, !this.edition[producto.id]);
        this.total= this.escogidos.reduce(function(sum, current, index, vector){
          current.cantidad = Math.max(1, Math.abs(current.cantidad));
          return sum + this.valorProducto(current) * current.cantidad;
        }.bind(this), 0);
      },
      eliminarProducto: function(id) {
        var index = this.escogidos.findIndex(function(el) {
          return el.id == id;
        });
        var item = this.escogidos[index];
        if (item){
          this.edition[item.id] = false;
          this.unidades = item.cantidad;
          this.escogidos.splice(index, 1);
          this.total -= item.cantidad * this.valorProducto(item);
          delete item['cantidad'];
          this.productos.push(item)
          this.productoactual = item.id;
        }
      },
      valorProducto: function(producto, cantidad){
        if (producto.cantidad >= producto.minimopormayor){
          return producto.valormayor;
        } else {
          return producto.valordetal;
        }
      }
    },
    watch: {
      escogidos: function() {
        this.$emit("updatedProductos", this.escogidos);
      }
    }
  }
</script>
