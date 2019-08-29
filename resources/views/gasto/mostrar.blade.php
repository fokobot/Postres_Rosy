@extends('layouts.principal')

{{-- C O N T E N T --}}
@section('content')
<div class="card mb-4">
  <div class="card-header">
    Lista de Gastos
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Descripcion</th>
        <th>Valor</th>
        <th>Estado</th>
        <th>Fecha</th>
      </thead>
      <tbody>
        @foreach($gastos as $gasto)
        <tr>
          <td>{{$gasto->descripcion}}</td>
          <td>{{$gasto->valor}}</td>
          <td>{{$gasto->estado->nombre}}</td>
          <td>{{$gasto->fecha}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
