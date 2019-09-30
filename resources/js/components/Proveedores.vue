<template>
  <div class="card mb-4">
    <div class="card-header">
      Lista de Proveedores
      <router-link class="btn btn-sm btn-primary float-right" to="/proveedores/new">
        <i class="fa fa-plus"></i> Nuevo Proveedor
      </router-link>
    </div>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <th>Razón Social</th>
          <th>Teléfono</th>
          <th>Dirección</th>
          <th>Gerente</th>
          <th>Email</th>
          <th>Edad RC</th>
          <th>Opciones</th>
        </thead>
        <tbody>
          <tr v-for="proveedor in proveedores" :key="proveedor.id">
            <td>{{proveedor.razon_social}}</td>
            <td>{{proveedor.telefono}}</td>
            <td>{{proveedor.direccion}}</td>
            <td>{{proveedor.gerente}}</td>
            <td>{{proveedor.email}}</td>
            <td>{{proveedor.edad_rc}}</td>
            <td>
              <router-link
                class="btn btn-sm btn-success"
                :to="{name: 'editar-proveedor', params: {id: proveedor.id}}"
              >
                <i class="fa fa-edit"></i>
              </router-link>
              <button class="btn btn-sm btn-danger" href="#" @click="eliminar(proveedor)">
                <i class="fa fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "Proveedores",
  mounted() {
    this.$store.dispatch("proveedores/fetchAll");
  },
  computed: mapGetters({
    proveedores: "proveedores/proveedores"
  }),
  methods: {
    eliminar(cliente) {
      bootbox.confirm("¿Realmente desea eliminar este proveedor?", result => {
        if (!result) return;
        this.$store.dispatch("proveedores/delete", cliente);
      });
    }
  }
};
</script>
