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
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Dirección</th>
        <th>Barrio</th>
        <th>Telefono</th>
        <th>Ocupación</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        <tr v-for="empleado in empleados" :key="empleado.id">
          <td>{{tipo_doc(empleado)}}: {{empleado.documento}}</td>
          <td>{{empleado.nombres}}</td>
          <td>{{empleado.apellidos}}</td>
          <td>{{empleado.direccion}}</td>
          <td>{{empleado.barrio}}</td>
          <td>{{empleado.telefono}}</td>
          <td>{{empleado.ocupacion}}</td>
          <td>
          <router-link class="btn btn-sm btn-success" :to="url('edit', empleado.id)">
						<i class="fa fa-edit" ></i>
					</router-link>
          <a class="btn btn-sm btn-danger" href="#" @click="eliminar(empleado.id)">
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
  export default {
    name: 'ListaEmpleados',
    mounted() {
      axios
        .get('/api/empleados/')
        .then(response => {
          this.empleados = response.data['empleados'];
          this.tipos_de_documento = response.data['tipos_de_documento'];
          }).catch(err => $.notify('Ha ocurrido un error desconocido.', 'error'));
    },
    data(){ return {
      empleados:  [],
      tipos_de_documento: []
    }},
    methods: {
      url: function (verb, id) {
        return `/empleados/${id}/${verb}`;
      },
      tipo_doc: function (empleado) {
        return this.tipos_de_documento.find(function (item) {
          return item.id == empleado.tipo_de_documento_id;
        }).abreviatura;
      },
      eliminar: function (id) {
        bootbox.confirm("¿Realmente desea eliminar este empleado?", result => {
          if (!result) return;
          axios.delete('/api/empleados/' + id)
          .then(res => {
            let index = this.empleados.findIndex(function (item) {
              return item.id == id;
            });
            this.empleados.splice(index, 1);
            $.notify(res.data.mensaje , 'success');
          })
          .catch(err => {
            if (err.response && err.response.status === 422){
              $.notify(err.response.data.mensaje, 'warn')
            } else {
              $.notify("Error desconocido al eliminar.", 'danger');
            }
          });
        });
      }
    }
  }
</script>