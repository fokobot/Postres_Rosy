@extends('layouts.principal')

@section('content')
<div class="col-md-9">
<div class="card">
  <div class="card-header">
    Nueva Venta
  </div>
  <div class="card-body">
    <form method="POST" action="{{route('ventas.store')}}" >
      @csrf
      <div class="row">
        <div class="col-md-6">
          <label for="cliente_id">Cliente</label>
          <div class="form-group has-default">
            <select name="cliente_id" class="form-control form-control-default @error('cliente_id') is-invalid @enderror">
              @foreach ($cliente_ids as $cliente_id)
                <option value="{{$cliente_id->id}}">{{$cliente_id->nombre}}</option>
              @endforeach
            </select>
          </div>
          @error('cliente_id')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
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
            <label for="direccion_domicilio">Dirección domicilio</label>
            <div class="form-group has-default">
            <input type="text" name="direccion_domicilio" value="{{old('direccion_domicilio')}}" placeholder="Dirección domicilio"
            	class="form-control form-control-default @error('direccion_domicilio') is-invalid @enderror">
            </div>
            @error('direccion_domicilio')
    				  <div class="alert alert-danger">{{ $message }}</div>
    				@enderror
      	</div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="valor_total">Valor Total</label>
          <div class="form-group has-default">
            <input type="text" name="valor_total" value="{{old('valor_total')}}" placeholder="$10000"
            class="form-control form-control-default @error('valor_total') is-invalid @enderror">
          </div>
          @error('valor_total')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="costo_domicilio">Costo Domicilio</label>
          <div class="form-group has-default">
            <input type="text" name="costo_domicilio" value="{{old('costo_domicilio')}}" placeholder="$5000"
            class="form-control form-control-default @error('costo_domicilio') is-invalid @enderror">
          </div>
          @error('costo_domicilio')
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
