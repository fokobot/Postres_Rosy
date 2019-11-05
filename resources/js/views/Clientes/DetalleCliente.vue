<template>
  <b-row>
    <b-col>
      <table class="table table-responsive-sm table-bordered">
        <thead>
          <th colspan="2">Información del Cliente</th>
        </thead>
        <tbody>
          <tr>
            <td>Tipo De Documento</td>
            <td>{{cliente.persona.tipo_de_documento.nombre}}</td>
          </tr>
          <tr>
            <td>Documento</td>
            <td>{{cliente.persona.documento}}</td>
          </tr>
          <tr>
            <td>Nombre</td>
            <td>{{cliente.persona.nombre}}</td>
          </tr>
          <tr>
            <td>Apellidos</td>
            <td>{{cliente.persona.apellidos}}</td>
          </tr>
          <tr>
            <td>Fecha de Nacimiento</td>
            <td>{{cliente.persona.fecha_de_nacimiento | moment('LL')}}</td>
          </tr>
        </tbody>
      </table>
    </b-col>
    <b-col>
      <table class="table table-bordered table-responsive-sm">
        <thead>
          <th colspan="4">Información de Contacto</th>
        </thead>
        <tbody>
          <tr>
            <td>Email</td>
            <td>{{cliente.email}}</td>
          </tr>
          <tr>
            <td>Celular</td>
            <td>{{cliente.persona.celular}}</td>
          </tr>
          <tr>
            <td>Teléfono</td>
            <td>{{cliente.persona.telefono}}</td>
          </tr>
          <tr>
            <td>Dirección</td>
            <td>{{cliente.persona.direccion}}</td>
          </tr>
          <tr>
            <td>Barrio</td>
            <td>{{cliente.persona.barrio}}</td>
          </tr>
        </tbody>
      </table>
    </b-col>
  </b-row>
</template>

<script>
export default {
  name: 'DetalleCliente',
  props: {
    cliente: {
      type: Object,
      required: true
    }
  }
}
</script>