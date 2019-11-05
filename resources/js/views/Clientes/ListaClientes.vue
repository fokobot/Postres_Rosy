<template>
  <div class="card mb-4">
    <div class="card-header">
      Lista de Clientes
      <router-link class="btn btn-sm btn-primary float-right" :to="{name:'lista-clientes'}">
        <i class="fa fa-plus"></i> Nuevo Cliente
      </router-link>
    </div>
    <div class="card-body">
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
          <tr v-for="cliente in clientes" :key="cliente.id">
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
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import FilaCargando from '../../components/FilaCargando';

export default {
  name: 'Clientes',
  components: { FilaCargando },
  mounted() {
    if (this.clientes.length === 0) {
      this.$store.dispatch('clientes/fetchAll');
    }
  },
  computed: mapGetters({
    clientes: 'clientes/clientes',
    loading: 'clientes/loading'
  }),
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
