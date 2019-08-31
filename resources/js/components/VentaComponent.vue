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
			<label>Cantidad&nbsp;</label>
			<input :disabled="productos.length==0" type="number" v-model.number="unidades" class="form-control">
		</div>
		<div class="form-group col-md-2">
			<label style="color: white;">FIX THIS</label>
			<button :disabled="productos.length==0" type="button" v-on:click.prevent="addProducto" class="btn btn-block btn-sm btn-primary">
				<i class="fa fa-plus"></i>
			</button>
		</div>
	</div>
	<table class="table tbl-responsive tbl-stripped">
		<thead class="thead-light">
			<th>Producto</th>
			<th>Precio Unit.</th>
			<th>Cant.</th>
			<th>Subtotal</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			<tr v-for="producto in escogidos">
				<td>{{producto.nombre}}</td>
				<td>$ {{producto.precio}}</td>
				<td>{{producto.cantidad}}</td>
				<td>$ {{producto.cantidad * producto.precio}}</td>
				<td>
					<button class="btn btn-sm btn-danger" type="button" v-bind:value="producto.id" v-on:click="eliminarProducto(producto.id)">
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
	data: function() { return {
		productos : [
			{id: 1, nombre: "A", precio: 10000},
			{id: 2, nombre: "B", precio: 20000},
			{id: 3, nombre: "C", precio: 30000}
		],
		escogidos: [],
		productoactual: 0,
		unidades: 0,
		total: 0.0
	}},
	methods: {
		addProducto: function() {
      		var pactual = this.productoactual;
      		console.log('Buscando ' + pactual )
      		var index = this.productos.findIndex(function(el) {
	          return el.id == pactual;
	        });
	        console.log(index);
	        var item = this.productos[index];
	        console.log(item);
	        item.cantidad = this.unidades;
	        this.productos.splice(index, 1);
	        this.escogidos.push(item);
	        this.total += item.cantidad * item.precio;
		},
		eliminarProducto: function(id) {
      		var index = this.escogidos.findIndex(function(el) {
	          return el.id == id;
	        });
	        var item = this.escogidos[index];
	        if (item){
		        this.unidades = item.cantidad;
		        this.escogidos.splice(index, 1);
		        this.productos.push(item)
		       	this.total -= item.cantidad * item.precio;
		   	}
		}
	}
}
</script>
