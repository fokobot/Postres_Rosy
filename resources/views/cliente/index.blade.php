@extends('layouts.principal')
@section('content')
<div class="card mb-4">
  <div class="card-header">
    Lista de Clientes
      <a class="btn btn-sm btn-primary float-right" href="{{route('clientes.new')}}">
        <i class="fa fa-plus" ></i> Nuevo Cliente
      </a>
  </div>
  <lista-clientes></lista-clientes>
</div>
@endsection
