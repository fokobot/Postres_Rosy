@extends('layouts.principal')

@section('content')
<div class="col-md-9">
<div class="card">
  <div class="card-header">
    Nuevo Gasto
  </div>
  <div class="card-body">
    <form method="POST" action="{{route('gastos.store')}}" >
      @csrf
      <div class="row">
        <div class="col-md-6">
          <label for="nombre">Descripcion del gasto</label>
          <div class="form-group has-default">
            <input type="text" name="descripcion" value="{{old('descripcion')}}" placeholder="Descripcion"
            class="form-control form-control-default @error('descripcion') is-invalid @enderror" >
          </div>
          @error('descripcion')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="valor">Valor</label>
          <div class="form-group has-default">
            <input type="text" name="valor" value="{{old('valor')}}" placeholder="$10000"
            class="form-control form-control-default @error('valor') is-invalid @enderror">
          </div>
          @error('valor')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="estado">Estado del Gasto</label>
          <div class="form-group has-default">
            <select name="estado" class="form-control form-control-default @error('estado') is-invalid @enderror">
              @foreach ($estados as $estado)
                <option value="{{$estado->id}}">{{$estado->nombre}}</option>
              @endforeach
            </select>
          </div>
          @error('estado')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="fecha">Fecha: </label>
          <input type="datetime" class="form-control form-control-default" name="fecha" value="{{\Carbon\Carbon::now()}}"/>
          @error('fecha')
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
