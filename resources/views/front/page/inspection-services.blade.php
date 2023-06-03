@extends('layout.landing')
@section('pageTitle','Inspection Services')
@section('pageSubTitle','Inspection Services')
@push('styles')
<style>

</style>
@endpush
@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <h3>Inspection Services</h3>
            <p>
                Inspection of vehicles is a significant factor to consider when importing vehicles into your country. Different nations around the globe have ensured that every car imported into their nation has passed a particular inspection such as JAAI, JEVIC, DORT etc. The car is not permitted to leave the port at any cost without formal inspection. Below are a few significant inspections certifications which I Carjapan provides to all its clients
            </p>
        </div>
        <div class="col-md-8">
            <img src="{{asset('front/img/left-top-catagory-banner.png')}}" width="" class="img-fluid">
        </div>
        <div class="col-md-4">
            <img src="{{asset('front/img/left-top-catagory-banner.png')}}" width="" class="img-fluid">
        </div>
    </div>
</div>
@endsection