@extends('_partial.app')
@section('title', 'Customer')
@section('content')
    @yield('content-customer')
@endsection
@push('custom-js')
    <script src="{{ asset('assets/js/custom/customer/customer.js') }}"></script>
@endpush
