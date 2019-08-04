@extends('layouts.principal')

@section('content')
<table class="table table-hover">

  <thead>

    <th>Nombre del producto</th>

    <th>Valor al detal</th>

    <th>Valor al por mayor</th>

  </thead>

  <tbody>
@foreach($productos as $producto)

      <tr>

        <td>{{$producto->nombre}} </td>

        <td>{{$producto->valordetal}} </td>

        <td>{{$producto->valormayor}} </td>


      </tr>
@endforeach

  </tbody>

</table>
@endsection
