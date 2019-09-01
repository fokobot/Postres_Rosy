@extends('layouts.principal')

@section('content')
<div class="col-md-9">
	<div class="card">
		<div class="card-header">
			Nuevo Cliente
		</div>
		<div class="card-body">
			<form method="POST" action="{{route('clientes.store')}}" class="col-md-12">
				@csrf
				<div class="row">
					<div class="col-md-6">
						<label for="tipo_de_documento_id">Tipo de documento</label>
						<div class="form-group has-default">
							<select name="tipo_de_documento_id" class="form-control form-control-default @error('tipo_de_documento_id') is-invalid @enderror">
								@foreach ($tiposdedocumentos as $tiposdedocumento)
								<option value="{{$tiposdedocumento->id}}">{{$tiposdedocumento->abreviatura}}</option>
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
							<input type="text" name="documento" value="{{old('documento')}}" placeholder="N° de documento"
							class="form-control form-control-default @error('documento') is-invalid @enderror" >
						</div>
						@error('documento')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="nombre">Nombre</label>
						<div class="form-group has-default">
							<input type="text" name="nombre" value="{{old('nombre')}}" placeholder="Nombre"
							class="form-control form-control-default @error('nombre') is-invalid @enderror" />
						</div>
						@error('nombre')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="col-md-6">
						<label for="apellidos">Apellidos</label>
						<div class="form-group has-default">
							<input type="text" name="apellidos" value="{{old('apellidos')}}" placeholder="Apellidos"
							class="form-control form-control-default @error('apellidos') is-invalid @enderror" >
						</div>
						@error('apellidos')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="direccion">Dirección</label>
						<div class="form-group has-default">
							<input type="text" name="direccion" value="{{old('direccion')}}" placeholder="Dirección"
							class="form-control form-control-default @error('direccion') is-invalid @enderror">
						</div>
						@error('direccion')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="col-md-6">
						<label for="ciudad">Ciudad</label>
						<div class="form-group has-default">
							<input type="text" name="ciudad" value="{{old('ciudad')}}" placeholder="Ciudad"
							class="form-control form-control-default @error('ciudad') is-invalid @enderror">
						</div>
						@error('ciudad')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group has-default">
							<label for="telefono">Telefono</label>
							<input type="text" name="telefono" value="{{old('telefono')}}" placeholder="Teléfono"          class="form-control form-control-default @error('telefono') is-invalid @enderror">
						</div>
						@error('telefono')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="col-md-6">
						<label for="celular">Celular</label>
						<div class="form-group has-default">
							<input type="text" name="celular" value="{{old('celular')}}" placeholder="Celular"
							class="form-control form-control-default @error('celular') is-invalid @enderror">
						</div>
						@error('celular')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row">
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
