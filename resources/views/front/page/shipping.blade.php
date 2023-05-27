@extends('layout.landing')
@section('pageTitle','Shipping')
@section('pageSubTitle','Shipping')
@push('styles')
<style>

</style>
@endpush
@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-8">
            <h3>Shipping</h3>
            <p><Strong>Shipment and Documentation</Strong></p>
            <p>
                This process will start instantly when we receive your payment and confirmation. Whenever we receive your money, we will ship your car in your desired destination. We will send you all the papers through DHL for costumes clearance. The sent documents are:
            </p>
            <p>Export Certificate</p>
            <p>Bill of Lading</p>
            <p>Final Invoice</p>
            <p>Marine Insurance (if required)</p>
            <p>Inspection Certificate</p>
            <p>Vehicle Delivered to the Port</p>
            <p>
                The final step is the delivery of the vehicle to the selected port. It will be delivered as per the schedule. Here, we suggest you to bring all the documents provided by us for a smooth clearing process.
            </p>
        </div>
        <div class="col-md-4">
            <a href="{{url('/contact-us')}}"><img src="{{asset('uploads/default/left-top-catagory-banner.png')}}" class="img-fluid" width="400px" height="400px"></a>
        </div>
    </div>
</div>
@endsection