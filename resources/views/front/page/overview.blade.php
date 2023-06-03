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
        <div class="col-md-8">
            <h3>Overview</h3>
            <p>iCar Japan is a reputed automobile trading company whose headquarter is located in Toyoma, Japan; From where you can buy your desired cars. We are a joint venture company working with TMT Corporation for many years. We are providing our services to all over the world with our extensive experiences in the automotive field. We have gained a place in the heart of our customers by providing quality service with outstanding quality used vehicles. The flexible payment method is another key point for our customers to come back to us in a repetitive manner. We have a very suitable payment plan for our customers to ensure maximum clarity and swift transaction. Moreover, we never compromise to secure our shipping options as well. We always chose the best shipping companies to export our vehicles to our respective clients. Once a customer buys our automobile, it is sent to the customer in the shortest possible time through our smooth and prompt procedures.
            </p>
            <p>
            Not so long ago, buying a car online was the worst experience for people. The payment and shipping method was so critical. Sometimes, the customers waited more than six months to receive their car. Knowing all the cases, iCar Japan and TMT Corporation has come to the platform with a promise to make all the process easier and make sure to deliver the customer’s purchased car in the shortest possible time to make the clients smile. Our other promise to our clients is to provide high-quality vehicles at the lowest possible price through a smooth procedure.
            </p>
            <h3>Our Mission</h3>
            <p>
                The first mission of iCar Japan is to build a long-lasting relationship with its customers by focusing on quality service and providing high-quality used cars at a reasonable price.
            </p>
            <h3>Our Vision</h3>
            <p>
                iCar Japan has a vision of assisting car dealers, brokers and individuals all over the worlds to find the best auction cars.
            </p>
        </div>
        <div class="col-md-4">
        <img src="{{asset('uploads/default/banner.jpg')}}" width="" class="img-fluid">
        </div>
    </div>
</div>
@endsection