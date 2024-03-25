@extends('layout.landing')
@section('pageTitle','Overview')
@section('pageSubTitle','Overview')
@push('styles')
<style>

</style>
@endpush
@section('content')
{!!$page->details!!}
@endsection