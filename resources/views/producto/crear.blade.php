@extends('layouts.principal')

@section('content')
<div class="col-md-9">
<div class="card">
  <div class="card-header">
    Nuevo Producto
  </div>
  <div class="card-body">
    <form method="POST" action="{{route('productos.store')}}" >
      @csrf
      <div class="row">
        <div class="col-md-6">
          <label for="nombre">Nombre del producto</label>
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
          <label for="valordetal">Valor al detal</label>
          <div class="form-group has-default">
            <input type="text" name="valordetal" value="{{old('valordetal')}}" placeholder="$3000"
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
            <input type="text" name="valormayor" value="{{old('valormayor')}}" placeholder="$2000"
            class="form-control form-control-default @error('valormayor') is-invalid @enderror">
          </div>
          @error('valormayor')
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
