@extends('layouts.principal')

{{-- C O N T E N T --}}
@section('content')
<div class="card mb-4">
  <div class="card-header">
    Lista de Ventas
    <a class="btn btn-sm btn-primary float-right" href="{{route('ventas.new')}}">
      <i class="fa fa-plus" ></i> Nueva Venta
    </a>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Cliente</th>
        <th>Vendedor</th>
        <th>Fecha</th>
        <th>Valor Total</th>
        <th>Estado</th>
      </thead>
      <tbody>
        @foreach($ventas as $venta)
        <tr>
          <td>{{$venta->cliente->nombre_completo()}}</td>
          <td>{{$venta->vendedor->nombre_completo()}}</td>
          <td>{{$venta->fecha}}</td>
          <td>{{$venta->valor_total}}</td>
          <td>{{$venta->estado->nombre}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
