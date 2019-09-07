@extends('layouts.principal')

{{-- C O N T E N T --}}
@section('content')
<div class="card mb-4">
  <div class="card-header">
    Lista de Productos
    <a class="btn btn-sm btn-primary float-right" href="{{route('productos.new')}}">
      <i class="fa fa-plus" ></i> Nuevo Producto
    </a>
  </div>
  <lista-productos></lista-productos>
</div>
@endsection
