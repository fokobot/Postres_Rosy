@extends('layouts.principal')
@section('content')
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
      </tr>
@endforeach
  </tbody>
</table>
@endsection
