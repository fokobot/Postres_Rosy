@extends('layouts.principal')
@section('content')
<div class="card mb-4">
  <div class="card-header">
    Lista de Clientes
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Tipo de Documento</th>
        <th>Documento</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Dirección</th>
        <th>Ciudad</th>
        <th>Telefono</th>
        <th>Celular</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        @foreach($clientes as $cliente)
        <tr>
          <td>{{$cliente->tipo_de_documento->abreviatura}}</td>
          <td>{{$cliente->documento}}</td>
          <td>{{$cliente->nombre}}</td>
          <td>{{$cliente->apellidos}}</td>
          <td>{{$cliente->direccion}}</td>
          <td>{{$cliente->ciudad}}</td>
          <td>{{$cliente->telefono}}</td>
          <td>{{$cliente->celular}}</td>
          <td>
          <a class="btn btn-sm btn-primary" href="{{route('clientes.edit',  $cliente->id)}}">
						<i class="fa fa-edit" ></i>
					</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
