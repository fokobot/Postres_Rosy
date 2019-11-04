<template>
  <div>
    <label>
      <b>Lista de Productos</b>
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
          <td>{{producto.nombre}} {{producto.edition}}</td>
          <td>$ {{producto.precio | currency}}</td>
          <td>
            <span>{{producto.cantidad}}</span>
          </td>
          <td>$ {{producto.cantidad * producto.precio | currency}}</td>
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
