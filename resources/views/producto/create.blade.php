@extends('layouts.principal')

@section('content')
<div class="col-md-9">
<div class="card">
  <div class="card-header">
  </div>
  <div class="card-body">
    <form method="POST" action="{{isset($producto) ? route('productos.put', $producto->id) : route('productos.store')}}" >
      @csrf
      @isset($producto)
        @method('PUT')
      @endisset
      <div class="row">
        <div class="col-md-6">
          <label for="nombre">Nombre del producto</label>
          <div class="form-group has-default">
            <input type="text" name="nombre" value="{{isset($producto) ? $producto->nombre : old('nombre')}}" placeholder="Nombre"
            class="form-control form-control-default @error('nombre') is-invalid @enderror" >
          </div>
          @error('nombre')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="valordetal">Valor al detal</label>
          <div class="form-group has-default">
            <input type="text" name="valordetal" value="{{isset($producto) ? $producto->valordetal : old('valordetal')}}" placeholder="$3000"
            class="form-control form-control-default @error('valordetal') is-invalid @enderror">
          </div>
          @error('valordetal')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="valormayor">Valor al por mayor</label>
          <div class="form-group has-default">
            <input type="text" name="valormayor" value="{{isset($producto) ? $producto->valormayor : old('valormayor')}}" placeholder="$2000"
            class="form-control form-control-default @error('valormayor') is-invalid @enderror">
          </div>
          @error('valormayor')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="minimopormayor">Cantidad minima al por mayor</label>
          <div class="form-group has-default">
            <input type="text" name="minimopormayor" value="{{isset($producto) ? $producto->minimopormayor : old('minimopormayor')}}" placeholder="6"
            class="form-control form-control-default @error('minimopormayor') is-invalid @enderror">
          </div>
          @error('minimopormayor')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <button type="submit" class="btn btn-block btn-success">{{ __('Registrar Producto') }}</button>
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
