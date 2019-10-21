<template>
<div class="card mb-4">
  <div class="card-header">
    Lista de Empleados
    <router-link class="btn btn-sm btn-primary float-right" to="/empleados/new">
      <i class="fa fa-plus" ></i> Nuevo Empleado
    </router-link>
  </div>
  <div class="card-body">
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
            <!-- <router-link class="btn btn-sm btn-success" :to="{name: 'editar-empleado'}">
              <i class="fa fa-edit" ></i>
            </router-link> -->
            <button class="btn btn-sm btn-danger" @click="eliminar(index)">
              <i class="fa fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
      <fila-cargando :cols="7" v-else></fila-cargando>
    </table>
  </div>
</div>
</template>

<script>
  import {mapGetters} from 'vuex';
  import FilaCargando from '../../components/FilaCargando';
  export default {
    name: 'ListaEmpleados',
    components: {'fila-cargando': FilaCargando},
    mounted() {
      if (this.empleados.length === 0){
        this.$store.dispatch('empleados/fetchAll');
      }
    },
    computed:{
      ...mapGetters({
        empleados: 'empleados/empleados',
        loading  : 'empleados/loading',
      })
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