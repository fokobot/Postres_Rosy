@extends('layouts.principal')

{{-- C O N T E N T --}}
@section('content')
<div class="card mb-4">
  <div class="card-header">
    Lista de Gastos
    <a class="btn btn-sm btn-primary float-right" href="{{route('gastos.new')}}">
      <i class="fa fa-plus" ></i> Nuevo Gasto
    </a>
  </div>
  <lista-gastos></lista-gastos>
</div>
@endsection
