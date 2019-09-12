@extends('layouts.principal')

@section('content')
	<router-view></router-view>
@endsection
{{-- S C R I P T S --}}
@push('scripts')
  @include('layouts.error')
@endpush
