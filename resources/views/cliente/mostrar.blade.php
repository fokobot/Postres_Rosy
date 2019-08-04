@extends('layouts.principal')

@section('content')
<table class="table table-hover">

  <thead>

    <th>Nombre</th>

    <th>Dirección</th>

    <th>Ciudad</th>

    <th>Telefono</th>
  </thead>

  <tbody>
@foreach($clientes as $cliente)

      <tr>

        <td>{{$cliente->nombre}} </td>

        <td>{{$cliente->direccion}} </td>

        <td>{{$cliente->ciudad}} </td>

        <td>{{$cliente->telefono}} </td>


      </tr>
@endforeach

  </tbody>

</table>
@endsection
