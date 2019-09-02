@extends('layouts.principal')

{{-- C O N T E N T --}}
@section('content')
<div class="card mb-4">
  <div class="card-header">
    Lista de Productos
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <th>Nombre del producto</th>
        <th>Valor al detal</th>
        <th>Valor al por mayor</th>
        <th>Cantidad min. al por mayor</th>
        <th>Opciones</th>
      </thead>
      <tbody>
        @foreach($productos as $producto)
        <tr>
          <td>{{$producto->nombre}}</td>
          <td>{{$producto->valordetal}}</td>
          <td>{{$producto->valormayor}}</td>
          <td>{{$producto->minimopormayor}}</td>
          <td>
          <a class="btn btn-sm btn-primary" href="{{route('productos.edit',  $producto->id)}}">
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
