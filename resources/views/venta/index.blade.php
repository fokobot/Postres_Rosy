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
  <lista-ventas></lista-ventas>
</div>
@endsection
