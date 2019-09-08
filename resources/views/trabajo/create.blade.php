@extends('layouts.principal')

@section('content')
<div class="col-md-5">
<div class="card">
  <div class="card-header">
    {{isset($trabajo) ? 'Editar' : 'Nuevo'}} Trabajo
    <a class="btn btn-sm btn-primary float-right" href="{{route('trabajos.index')}}">
      <i class="fa fa-list" ></i> Trabajo
    </a>
  </div>
  <div class="card-body">
    <form method="POST" action="{{isset($trabajo) ? route('trabajos.put', $trabajo->id) : route('trabajos.store')}}" >
      @csrf
      @isset($trabajo)
        @method('PUT')
      @endisset
      <div class="form-row">
        <div class="col-md-12">
          <label for="nombre">Nombre del trabajo</label>
          <div class="form-group has-default">
            <input type="text" name="nombre" value="{{isset($trabajo) ? $trabajo->nombre : old('nombre')}}" placeholder="Nombre"
            class="form-control form-control-default @error('nombre') is-invalid @enderror" >
          </div>
          @error('nombre')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-12">
          <label for="costo">Costo del trabajo</label>
          <div class="form-group has-default">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
              <input type="text" name="costo" value="{{isset($trabajo) ? $trabajo->costo : old('costo')}}" placeholder="25000"
              class="form-control form-control-default @error('costo') is-invalid @enderror">
            </div>
          </div>
          @error('costo')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-block btn-success">{{ __('Registrar Trabajo') }}</button>
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