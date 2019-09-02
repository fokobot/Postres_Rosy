@extends('layouts.principal')

{{-- C O N T E N T --}}
@section('content')
<div class="card mb-4">
  <div class="card-header">
    Lista de Trabajos
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Nombre del trabajo</th>
        <th>Costo</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        @foreach($trabajos as $trabajo)
        <tr>
          <td>{{$trabajo->nombre}}</td>
          <td>{{$trabajo->costo}}</td>
          <td>
          <a class="btn btn-sm btn-primary" href="{{route('trabajos.edit',  $trabajo->id)}}">
						<i class="fa fa-edit" ></i>
					</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
