@extends('layouts.principal')

@section('content')
<div class="col-md-5">
  <form-trabajo></form-trabajo>
</div>
@endsection
{{-- S C R I P T S --}}
@push('scripts')
  @include('layouts.error')
@endpush
