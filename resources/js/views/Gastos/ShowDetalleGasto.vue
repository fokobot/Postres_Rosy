<template>
  <div>
    <label>
      <h4>Lista de Productos</h4>
    </label>
    <table class="table tbl-responsive tbl-stripped">
      <thead class="thead-light">
        <th>Producto</th>
        <th>Precio Unit.</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
      </thead>
      <tbody>
        <tr v-for="producto in productos" :key="producto.id">
          <td>{{producto.producto}}</td>
          <td>$ {{producto.valor | currency}}</td>
          <td>
            <span>{{producto.cantidad}}</span>
          </td>
          <td>$ {{producto.cantidad * producto.valor | currency}}</td>
        </tr>
      </tbody>
      <tfoot>
      <tr class="table-active">
        <td><b>Total: </b></td>
        <td colspan="2"></td>
        <td><strong><u>$ {{total | currency}}</u></strong></td>
      </tr>
    </tfoot>
  </table>
</div>
</template>

<script>
  export default {
    props: ['productos', 'total'], 
  }
</script>