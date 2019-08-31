<template>
<div>
	<label><b>Lista de Productos</b></label>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="producto">Producto</label>
			<select :disabled="productos.length==0" v-model="productoactual" class="form-control">
				<option v-for="(producto, index) in productos" v-bind:value="producto.id">
					{{producto.nombre}}
				</option>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label>Cantidad</label>
			<input :disabled="productos.length==0" type="number" v-model.number="unidades" class="form-control">
		</div>
		<div class="form-group col-md-2">
			<label style="color: white;">FIX THIS</label>
			<button :disabled="!productoactual || productos.length==0 || productoactual <= 0" type="button" v-on:click.prevent="addProducto" class="btn btn-block btn-sm btn-primary">
				<i class="fa fa-plus"></i>
			</button>
		</div>
	</div>
	{{productoactual}}
	<table class="table tbl-responsive tbl-stripped">
		<thead class="thead-light">
			<th>Producto</th>
			<th>Precio Unit.</th>
			<th>Cantidad</th>
			<th>Subtotal</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			<tr v-for="producto in escogidos">
				<td>{{producto.nombre}} {{producto.edition}}</td>
				<td>$ {{valorProducto(producto)}}</td>
				<td>
					<input class="form-control" type="number" v-if="edition[producto.id]" v-model="producto.cantidad"/>
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
			<tr>
				<td><b>Total: </b></td>
				<td colspan="2"></td>
				<td><b>$ {{total}}</b></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</div>
</template>

<script>
export default {
	mounted () {
    axios
      .get('/api/productos/')
      .then(response => (this.productos = response.data))
  	},
	data: function() { return {
		productos : [],
		escogidos: [],
		edition: [],
		productoactual: 0,
		unidades: 0,
		total: 0.0
	}},
	methods: {
		addProducto: function() {
      		var pactual = this.productoactual;
      		var index = this.productos.findIndex(function(el) {
	          return el.id == pactual;
	        });
	        var item = this.productos[index];
	        item.cantidad = this.unidades;
	        this.edition[item.id] = false;
	        this.productos.splice(index, 1);
	        this.escogidos.push(item);
	        this.total += item.cantidad * this.valorProducto(item);
	        this.productoactual = 0;
		},
		editarProducto: function(producto){
			this.$set(this.edition, producto.id, !this.edition[producto.id]);
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
		   	}
		},
		valorProducto: function(producto){
			if (this.unidades >= producto.minimopormayor){
				return producto.valormayor;
			} else {
				return producto.valordetal;
			}
		}
	}
}
</script>
