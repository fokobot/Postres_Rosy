<template>
  <b-row>
		<b-col>
    <table class="table table-responsive-sm table-bordered">
      <thead>
        <th colspan="2">Información del Empleado</th>
      </thead>
      <tbody>
        <tr>
          <td>Tipo De Documento</td>
          <td>{{empleado.persona.tipo_de_documento.nombre}}</td>
        </tr>
        <tr>
          <td>Documento</td>
          <td>{{empleado.persona.documento}}</td>
        </tr>
        <tr>
          <td>Nombre</td>
          <td>{{empleado.persona.nombre}}</td>
        </tr>
        <tr>
          <td>Apellidos</td>
          <td>{{empleado.persona.apellidos}}</td>
        </tr>
        <tr>
          <td>Fecha de Nacimiento</td>
          <td>{{empleado.persona.fecha_de_nacimiento | moment('LL')}}</td>
        </tr>
        
				<tr>
          <td>Cónyuge</td>
          <td>{{empleado.conyuge ? empleado.conyuge : '-'}}</td>
        </tr>
      </tbody>
    </table>
		</b-col>
		<b-col>
			<table class="table table-bordered table-responsive-sm">
				<thead>
					<th colspan="2">Información de Contacto</th>
				</thead>
				<tbody>
					<tr>
						<td>Email</td>
						<td>{{empleado.email}}</td>
					</tr>
					<tr>
						<td>Celular</td>
						<td>{{empleado.persona.celular}}</td>
					</tr>
					<tr>
						<td>Teléfono</td>
						<td>{{empleado.persona.telefono}}</td>
					</tr>
					<tr>
						<td>Dirección</td>
						<td>{{empleado.persona.direccion}}</td>
					</tr>
					<tr>
						<td>Barrio</td>
						<td>{{empleado.persona.barrio}}</td>
					</tr>
				</tbody>
			</table>
		</b-col>
  </b-row>
</template>

<script>
export default {
  name: 'DetalleEmpleado',
  props: {
    empleado: {
      type: Object,
      required: true
    }
  }
}
</script>