@extends('layouts.principal')

{{-- C O N T E N T --}}
@section('content')
<div class="card mb-4">
  <div class="card-header">
    Lista de Trabajos
    <a class="btn btn-sm btn-primary float-right" href="{{route('trabajos.new')}}">
      <i class="fa fa-plus" ></i> Nuevo Trabajo
    </a>
  </div>
  <lista-trabajos></lista-trabajos>
</div>
@endsection
