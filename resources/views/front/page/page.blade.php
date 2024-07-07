@extends('layout.landing')
@section('pageTitle','Overview')
@section('pageSubTitle','Overview')
@push('styles')
<style>

</style>
@endpush
@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center" style="color:#ED2129">{{$page?->title}}</h3>
            {!!$page?->details!!}
        </div>
    </div>
</div>
@endsection