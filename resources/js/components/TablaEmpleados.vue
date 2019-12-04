<template>
  <table class="table table-hover">
    <thead>
      <th>Documento</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Dirección</th>
      <th>Barrio</th>
      <th>Teléfono</th>
      <th>Opciones</th>
    </thead>
    <tbody v-if="!loading">
      <tr v-for="(empleado, index) in empleados" :key="empleado.id">
        <td>{{empleado.persona.tipo_de_documento.abreviatura}} {{empleado.persona.documento}}</td>
        <td>{{empleado.persona.nombre}}</td>
        <td>{{empleado.persona.apellidos}}</td>
        <td>{{empleado.persona.direccion}}</td>
        <td>{{empleado.persona.barrio}}</td>
        <td>{{empleado.persona.telefono}}</td>
        <td>
          <router-link
            class="btn btn-sm btn-primary"
            :to="{name: 'ver-empleado', params: {empleado: empleado.id}}"
          >
            <i class="fa fa-eye"></i>
          </router-link>
          <button class="btn btn-sm btn-danger" @click="eliminar(index)">
            <i class="fa fa-trash"></i>
          </button>
        </td>
      </tr>
    </tbody>
    <fila-cargando :cols="7" v-else />
  </table>
</template>

<script>
import FilaCargando from './FilaCargando';

export default {
  name: 'TablaEmpleados',
  components: { FilaCargando },
  props: {
    empleados: {
      type: Array,
      required: true
    },
    loading: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    eliminar: function (index) {
      bootbox.confirm("¿Realmente desea eliminar este empleado?", result => {
        if (!result) return;
        else this.$store.dispatch('empleados/delete', index)
      });
    }
  }
}
</script>

<style>
</style>