@extends('layouts.principal')

@section('content')
<div id="app" class="col-md-9">
  <form-venta></form-venta>
</div>
@endsection
{{-- S C R I P T S --}}
@push('scripts')
  @include('layouts.error')
@endpush
