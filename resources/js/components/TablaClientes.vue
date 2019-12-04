<template>
  <table class="table table-hover">
    <thead>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Dirección</th>
      <th>Barrio</th>
      <th>Telefono</th>
      <th>Fecha de Nacimiento</th>
      <th>Opciones</th>
    </thead>
    <tbody v-if="!loading">
      <tr v-for="(cliente, index) in clientes" :key="cliente.id">
        <td>{{cliente.persona.nombre}}</td>
        <td>{{cliente.persona.apellidos}}</td>
        <td>{{cliente.persona.direccion}}</td>
        <td>{{cliente.persona.barrio}}</td>
        <td>{{cliente.persona.telefono}}</td>
        <td>{{cliente.persona.fecha_de_nacimiento}}</td>
        <td>
          <router-link
            class="btn btn-sm btn-primary"
            :to="{name: 'ver-cliente', params:{cliente:cliente.id}}"
          >
            <i class="fa fa-eye"></i>
          </router-link>
          <button class="btn btn-sm btn-danger" href="#" @click="eliminar(index)">
            <i class="fa fa-trash"></i>
          </button>
        </td>
      </tr>
    </tbody>
    <FilaCargando :cols="7" v-else />
  </table>
</template>

<script>
import FilaCargando from './FilaCargando';

export default {
  name: 'TablaClientes',
  components: { FilaCargando },
  props: {
    clientes: {
      type: Array,
      required: true
    },
    loading: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    eliminar(cliente) {
      bootbox.confirm("¿Realmente desea eliminar este cliente?", result => {
        if (!result) return;
        this.$store.dispatch('clientes/delete', cliente);
      });
    }
  }
}
</script>

<style>
</style>