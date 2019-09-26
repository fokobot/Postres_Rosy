<template>
  <div>
    <label>
      <b>Lista de Productos</b>
    </label>
    <b-row @keydown.enter.prevent="addProducto">
      <div class="form-group col-md-6">
        <label for="producto">Producto</label>
        <v-select id="producto"
          :options="productos"
          label="nombre"
          v-model="productoactual"
          :disabled="productos.length===0">
        </v-select>
      </div>
      <div class="form-group col-md-4">
        <label>Cantidad {{productos.length}}</label>
        <b-input :disabled="productos.length==0" min="1"  type="number" v-model.number="unidades"></b-input>
      </div>
      <div class="form-group col-md-2">
        <label style="color: white;">FIX THIS</label>
        <b-button
          block
          variant="primary"
          size="sm"
          :disabled="!productoactual || productos.length==0 || productoactual <= 0" 
          @click.prevent="addProducto">
          <i class="fa fa-plus"></i>
        </b-button>
      </div>
    </b-row>
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
        <tr v-for="(producto, index) in escogidos" :key="producto.id">
          <td>{{producto.nombre}}</td>
          <td>$ {{valorProducto(producto) | currency}}</td>
          <td>
            <b-input
              type="number"
              min="1" 
              v-model.number="producto.cantidad"
              @keydown.enter.prevent="editarProducto(producto)"
              v-if="producto.edition">
            </b-input>
            <span v-else>{{producto.cantidad}}</span>
          </td>
          <td>$ {{producto.cantidad * valorProducto(producto) | currency}}</td>
          <td>
            <button class="btn btn-sm btn-primary" type="button" @click="editarProducto(producto)">
              <i class="fa fa-edit" v-if="!producto.edition"></i>
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
        <td><b>Total: </b></td>
        <td colspan="2"></td>
        <td><strong><u>$ {{total | currency}}</u></strong></td>
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
      .then(response => {
        this.productos = response.data;
        this.productoactual = this.productos[0] || {};
      });
    },
    data() { return {
      productos : [],
      escogidos: [],
      edition: [],
      productoactual: {},
      unidades: 1
    }},
    methods: {
      addProducto: function() {
        var index = this.productos.findIndex(el =>  {
          return el.id == this.productoactual.id;
        });
        this.$set(this.productoactual, 'cantidad', Math.max(1, Math.abs(this.unidades)));
        this.$set(this.productoactual, 'edition', false);
        // quitar el producto de la lista de escogibles
        console.log(this.productos.length)
        this.productos.splice(index, 1);
        console.log(this.productos.length)
        // añadir el producto a la lista de escogidos
        this.escogidos.push(this.productoactual);
        // actualizar el valor del producto actual
        this.productoactual = this.productos.length === 0 ? {} : this.productos[0];
      },
      editarProducto: function(producto){
        this.$set(producto, 'edition', !producto.edition);
      },
      eliminarProducto: function(index) {
        var item = this.escogidos[index];
        if (item){
          this.escogidos.splice(index, 1);
          this.productos.push(item)
          this.productoactual = item;
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
    }, computed: {
      total: function(){
        return this.escogidos.reduce((sum, item) => {
          return sum + this.valorProducto(item, item.cantidad) * item.cantidad;
        }, 0);
      }
    }
  }
</script>
