@extends('layout.landing')
@section('pageTitle','Why Choose Us')
@section('pageSubTitle','Why Choose Us')
@push('styles')
<style>
.item p {
        font-size: 18px;
        font-weight: 900;
    }

    .des p i.fa {
        font-size: 40px;
        color: var(--brand-color);
    }
</style>
@endpush
@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <h3>Why Choose Us</h3>
            <p>
                When it is about the automobile trading industry, iCar Japan is a reliable name you can rely on. We are experienced in ensuring high-quality vehicle inspection. We thoroughly inspect all the vehicles booked on our list. It is true; thousands of such companies are available out there. If you want to choose us, ‘WHY’ is a big question in your mind. We are delighted to share these answers. Let’s have a look at some of the aspects that makes us unique from others:
            </p>
        </div>
        <div class="col-md-6 my-4">
            <div class="des">
                <div class="d-flex align-items-center">
                    <p class="m-0"><i class="fa fa-check-square" aria-hidden="true"></i></p>
                    <h4 class="m-0 ms-2">Regular Updated Stok</h4>
                </div>
                <p>
                    The vehicle will be delivered as per schedule. It is suggested to communicate with your port authority when the ship is closer to your port. Please bring all the documents for a smooth process.
                </p>
            </div>
        </div>
        <div class="col-md-6 my-4">
            <div class="des">
                <div class="d-flex align-items-center">
                    <p class="m-0"><i class="fa fa-check-square" aria-hidden="true"></i></p>
                    <h4 class="m-0 ms-2">Vehicles Are 100% Inspected</h4>
                </div>
                <p>
                As we mentioned above, we inspect all the vehicles we add to our list. We are extremely careful about the certification of several inspection bodies. The clients can immediately drive the car after just purchase their dream car.
                </p>
            </div>
        </div>
        <div class="col-md-6 my-4">
            <div class="des">
                <div class="d-flex align-items-center">
                    <p class="m-0"><i class="fa fa-check-square" aria-hidden="true"></i></p>
                    <h4 class="m-0 ms-2">Lowest Price That Matches Your Budget</h4>
                </div>
                <p>
                ICar Japan is ensuring the lowest price for their customers to purchase their loving car within their budget. We try to make a mixture of the price that everyone will be capable enough to purchase their dream car.
                </p>
            </div>
        </div>
        <div class="col-md-6 my-4">
            <div class="des">
                <div class="d-flex align-items-center">
                    <p class="m-0"><i class="fa fa-check-square" aria-hidden="true"></i></p>
                    <h4 class="m-0 ms-2">Translated Auction Sheet</h4>
                </div>
                <p>
                How will you understand the condition of your selected car? It is a common issue that a customer feels puzzled when they come to buy auction cars or even they are going for stock cars. There is nothing to worry as we provide translated auction sheet by which you will be clear about the specifications as well as the condition of the selected vehicle at a glance.
                </p>
            </div>
        </div>
        <div class="col-md-6 my-4">
            <div class="des">
                <div class="d-flex align-items-center">
                    <p class="m-0"><i class="fa fa-check-square" aria-hidden="true"></i></p>
                    <h4 class="m-0 ms-2">Fast and Safe Delivery</h4>
                </div>
                <p>
                We are always conscious of the shipping method. We use world best shipping companies to ensure not only quick but also safe delivery. We are committed to our clients to provide the best shipping process.
                </p>
            </div>
        </div>
        <div class="col-md-6 my-4">
            <div class="des">
                <div class="d-flex align-items-center">
                    <p class="m-0"><i class="fa fa-check-square" aria-hidden="true"></i></p>
                    <h4 class="m-0 ms-2">24/7 Customer Service</h4>
                </div>
                <p>
                We have 24/7 customer service who is very serious and dedicated customer service officers. They are always ready to solve customer's problem. They provide the answers to our customer's question and motivated to provide the best possible solution for each and every problem. We believe in service and prioritize all the individual clients to save their valuable time and provide the best possible facilities to help them to take better decisions.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection