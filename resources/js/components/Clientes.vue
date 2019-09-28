<template>
<div class="card mb-4">
  <div class="card-header">
    Lista de Clientes
    <router-link class="btn btn-sm btn-primary float-right" to="/clientes/new">
      <i class="fa fa-plus" ></i> Nuevo Cliente
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
      <tbody>
        <tr v-for="cliente in clientes" :key="cliente.id">
          <td>{{cliente.nombre}}</td>
          <td>{{cliente.apellidos}}</td>
          <td>{{cliente.direccion}}</td>
          <td>{{cliente.barrio}}</td>
          <td>{{cliente.telefono}}</td>
          <td>{{cliente.fecha_de_nacimiento}}</td>
          <td>
            <router-link 
              class="btn btn-sm btn-success" 
              :to="{name: 'editar-cliente', params: {id: cliente.id}}">
              <i class="fa fa-edit" ></i>
            </router-link>
            <a class="btn btn-sm btn-danger" href="#" @click="eliminar(cliente)">
              <i class="fa fa-trash"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script>
  import {mapGetters} from 'vuex';

  export default {
    name: 'Clientes',
    mounted() {
      this.$store.dispatch('clientes/fetchAll');      
    },
    computed: mapGetters({
      clientes: 'clientes/clientes'
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
