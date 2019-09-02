
@extends('layouts.principal')

@section('content')
<div class="col-md-6">
	<div class="card">
		<div class="card-header">
			{{isset($cliente) ? 'Editar' : 'Nuevo'}} Cliente
			<a class="btn btn-sm btn-primary float-right" href="{{route('clientes.index')}}">
	      <i class="fa fa-list" ></i> Clientes
	    </a>
		</div>
		<div class="card-body">
			<form method="POST" action="{{isset($cliente) ? route('clientes.put', $cliente->id) : route('clientes.store')}}" class="col-md-12">
				@csrf
				@isset($cliente)
					@method('PUT')
				@endisset
				<div class="form-row">
					<div class="col-md-6">
						<label for="tipo_de_documento_id">Tipo de documento</label>
						<div class="form-group has-default">
							<select name="tipo_de_documento_id" class="form-control form-control-default @error('tipo_de_documento_id') is-invalid @enderror">
								@foreach ($tipos_de_documento as $item)
								<option value="{{$item->id}}" @isset($cliente) @if($cliente->tipo_de_documento_id ==$item->id) selected @endif @endisset>{{$item->abreviatura}}</option>
								@endforeach
							</select>
						</div>
						@error('tipo_de_documento_id')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="col-md-6">
						<label for="documento">N° de documento</label>
						<div class="form-group has-default">
							<input type="text" name="documento" value="{{isset($cliente) ? $cliente->documento : old('documento')}}" placeholder="N° de documento"
							class="form-control form-control-default @error('documento') is-invalid @enderror" >
						</div>
						@error('documento')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<label for="nombre">Nombre</label>
						<div class="form-group has-default">
							<input type="text" name="nombre" value="{{isset($cliente) ? $cliente->nombre : old('nombre')}}" placeholder="Nombre"
							class="form-control form-control-default @error('nombre') is-invalid @enderror" />
						</div>
						@error('nombre')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="col-md-6">
						<label for="apellidos">Apellidos</label>
						<div class="form-group has-default">
							<input type="text" name="apellidos" value="{{isset($cliente) ? $cliente->apellidos : old('apellidos')}}" placeholder="Apellidos"
							class="form-control form-control-default @error('apellidos') is-invalid @enderror" >
						</div>
						@error('apellidos')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<label for="direccion">Dirección</label>
						<div class="form-group has-default">
							<input type="text" name="direccion" value="{{isset($cliente) ? $cliente->direccion : old('direccion')}}" placeholder="Dirección"
							class="form-control form-control-default @error('direccion') is-invalid @enderror">
						</div>
						@error('direccion')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="col-md-6">
						<label for="ciudad">Ciudad</label>
						<div class="form-group has-default">
							<input type="text" name="ciudad" value="{{isset($cliente) ? $cliente->ciudad : old('ciudad')}}" placeholder="Ciudad"
							class="form-control form-control-default @error('ciudad') is-invalid @enderror">
						</div>
						@error('ciudad')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
						<div class="form-group has-default">
							<label for="telefono">Telefono</label>
							<input type="text" name="telefono" value="{{isset($cliente) ? $cliente->telefono : old('telefono')}}" placeholder="Teléfono" class="form-control form-control-default @error('telefono') is-invalid @enderror">
						</div>
						@error('telefono')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="col-md-6">
						<label for="celular">Celular</label>
						<div class="form-group has-default">
							<input type="text" name="celular" value="{{isset($cliente) ? $cliente->celular : old('celular')}}" placeholder="Celular"
							class="form-control form-control-default @error('celular') is-invalid @enderror">
						</div>
						@error('celular')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-block btn-success">
							{{ __('Registrar Cliente') }}
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
{{-- S C R I P T S --}}
@push('scripts')
@include('layouts.error')
@endpush
