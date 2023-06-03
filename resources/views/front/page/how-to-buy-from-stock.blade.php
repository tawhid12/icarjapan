@extends('layout.landing')
@section('pageTitle','How to buy from stock')
@section('pageSubTitle','How to buy from stock')
@push('styles')
<style>
    .item {
        width: 140px;
        height: 110px;
        border: 1px solid red;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--brand-color);
    }

    .item i {
        font-size: 26px;
    }

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
<div class="container">
    <div class="row">
        <div class="col-md-12 my-2">
            <h3>How to buy from stock</h3>
            <div class="d-flex">

                <div class="item me-2">
                    <span><i class="fa fa-check-square" aria-hidden="true"></i></span>
                    <p>Select</p>
                </div>
                <div class="item me-2">
                    <span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                    <p>Order Place</p>
                </div>
                <div class="item me-2">
                    <span><i class="fa fa-bar-chart" aria-hidden="true"></i></span>
                    <p>Result</p>
                </div>
                <div class="item me-2">
                    <span><i class="fa fa-cc-paypal" aria-hidden="true"></i></span>
                    <p>Payment</p>
                </div>
                <div class="item me-2">
                    <span><i class="fa fa-ship" aria-hidden="true"></i></span>
                    <p>Shipment</p>
                </div>
                <div class="item me-2">
                    <span><i class="fa fa-truck" aria-hidden="true"></i></span>
                    <p>Delivery</p>
                </div>
                <div class="item me-2">
                    <span><i class="fa fa-th-large" aria-hidden="true"></i></span>
                    <p>Result</p>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <div class="d-flex align-items-center">
                        <p class="m-0"><i class="fa fa-check-square" aria-hidden="true"></i></p>
                        <h4 class="m-0 ms-2">Select The Car</h4>
                    </div>
                    <p>
                        Go to our inventory and choose your desired car from our stock. Send us your query and get a quote through email.
                    </p>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <div class="d-flex align-items-center">
                        <p class="m-0"><i class="fa fa-check-square" aria-hidden="true"></i></p>
                        <h4 class="m-0 ms-2">Place the Order</h4>
                    </div>
                    <p>
                        After getting quotes and selecting the vehicle, ask the sales team to reserve this car. We will issue a profoma invoice for you and receive your profoma invoice through email and print it out.
                    </p>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <div class="d-flex align-items-center">
                        <p class="m-0"><i class="fa fa-check-square" aria-hidden="true"></i></p>
                        <h4 class="m-0 ms-2">Make the Payment</h4>
                    </div>
                    <p>
                        After getting quotes and selecting the vehicle, ask the sales team to reserve this car. We will issue a profoma invoice for you and receive your profoma invoice through email and print it out.
                    </p>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <div class="d-flex align-items-center">
                        <p class="m-0"><i class="fa fa-check-square" aria-hidden="true"></i></p>
                        <h4 class="m-0 ms-2">Shipment of your vehicle</h4>
                    </div>
                    <p>
                        After the payment, we will book your shipment in the next available ship to your destination/ desired port. We will notify you about shipping schedules.
                    </p>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <p><i class="fa fa-truck" aria-hidden="true"></i></p>
                    <p>
                        Get your documents through courier services. The documents will be sent off are below:
                    </p>
                    <ol>
                        <li>Export Certificate (Both Japanese and English)</li>
                        <li>Bill Of Lading</li>
                        <li>Final Invoice</li>
                        <li>Inspection certificate (if required)</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <div class="d-flex align-items-center">
                        <p class="m-0"><i class="fa fa-check-square" aria-hidden="true"></i></p>
                        <h4 class="m-0 ms-2">Vehicle Delivery to the Port</h4>
                    </div>
                    <p>
                    The vehicle will be delivered as per schedule. It is suggested to communicate with your port authority when the ship is closer to your port. Please bring all the documents for a smooth process.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection