@extends('layouts.principal')

@section('content')
<form method="POST" action="{{route('clientes.store')}}" class="col-md-6">
  @csrf
  <div class="row">
  	<div class="col-md-6">
        <label for="nombre">Nombre</label>
        <div class="form-group has-default">
        	<input type="text" name="nombre" value="{{old('nombre')}}" placeholder="Nombre"
        		class="form-control form-control-default @error('nombre') is-invalid @enderror" >
        </div>
        @error('nombre')
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
  </div>
  <div class="row">
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
      <label for="telefono">Telefono</label>
      <div class="form-group has-default">
      <input type="text" name="telefono" value="{{old('telefono')}}" placeholder="Teléfono"
      	class="form-control form-control-default @error('telefono') is-invalid @enderror">
      </div>
      @error('telefono')
				<div class="alert alert-danger">{{ $message }}</div>
			@enderror
  	</div>
  </div>
  <div class="row">
  	<div class="col-md-6">
  		<button type="submit" class="btn btn-block btn-success">{{ __('Registrar Cliente') }}</button>
  	</div>
  </div>
</form>
@endsection
