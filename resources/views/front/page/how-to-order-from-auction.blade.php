@extends('layout.landing')
@section('pageTitle','How To Order From Auction')
@section('pageSubTitle','How To Order From Auction')
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
            <h3>How To Order From Auction</h3>
            <p class="text-justify">
                The system of our order and shipment is planned to ensure the security and the easiest way to our valuable customers. How does the system work? Well, it starts with the payment of the initial deposit by which you will get access and rights of portal and bidding. Also, it includes the payment of the invoice amount and delivery of your selected vehicle at your required port. Don’t worry; we will continue to aware you about the shipment.
            </p>
            <div class="d-flex">

                <div class="item me-2">
                    <span><i class="fa fa-sign-in" aria-hidden="true"></i></span>
                    <p>Sign Up</p>
                </div>
                <div class="item me-2">
                    <span><i class="fa fa-university" aria-hidden="true"></i></span>
                    <p>Deposit</p>
                </div>
                <div class="item me-2">
                    <span><i class="fa fa-gavel" aria-hidden="true"></i></span>
                    <p>Bidding</p>
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
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <div class="d-flex align-items-center"><p class="m-0"><i class="fa fa-sign-in" aria-hidden="true"></i></p><h4 class="m-0 ms-2">Sign Up</h4></div>
                    <p>
                        To start the procedure, you need to sign up on our website. There is an easy signup option by which you can do it at a glance. We do not take any charge for signing up in our website. You just need to share your required information and confirm the account from your email.
                    </p>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <p><i class="fa fa-university" aria-hidden="true"></i></p>
                    <p>
                        When you take part in the bidding process, you will need to pay a security deposit. The deposited amount is absolutely refundable if there is any unsuccessful bidding happens. Moreover If you want to bid another car with that amount, you can do it without any farther charge. What will happen to the security deposit with the successful bidding? We do adjust the security deposit with the invoice amount of the vehicle you buy from the auction.
                    </p>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <p><i class="fa fa-gavel" aria-hidden="true"></i></p>
                    <p>
                        You are open to select any vehicle from our list and also can set your bidding range. After that, we will bid your selected vehicle from the auction and win it for you. The good news is, you do not need to pay any amount if the bid, unfortunately, gets unsuccessful.
                    </p>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <p><i class="fa fa-bar-chart" aria-hidden="true"></i></p>
                    <p>
                        From our member area, you will be notified of the result of the auction. Moreover, we will inform you of the result by email. When the bid will be successful, we will provide you the invoice containing the CIF amount of your selected vehicle.
                    </p>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <p><i class="fa fa-cc-paypal" aria-hidden="true"></i></p>
                    <p>
                        iCar Japan offers you the most reliable and flexible payment system. In this option, you have to make the payment as per the invoice sent.
                    </p>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <p><i class="fa fa-ship" aria-hidden="true"></i></p>
                    <p>
                        This process will start instantly when we receive your payment and confirmation. Whenever we receive your money, we will ship your car in your desired destination. We will send you all the papers through DHL for costumes clearance. The sent documents are:
                    </p>
                    <p>Export Certificate</p>

                    <p>Bill of Lading</p>

                    <p>Final Invoice</p>

                    <p>Marine Insurance (if required)</p>

                    <p>Inspection Certificate</p>

                    <p>Vehicle Delivered to the Port</p>

                    <p>The final step is the delivery of the vehicle to the selected port. It will be delivered as per the schedule. Here, we suggest you to bring all the documents provided by us for a smooth clearing process.</p>
                </div>
            </div>
            <div class="col-md-12 my-4 border-bottom border-dark">
                <div class="des">
                    <p><i class="fa fa-truck" aria-hidden="true"></i></p>
                    <p>
                        The final step is the delivery of the vehicle to the selected port. It will be delivered as per the schedule. Here, we suggest you bring all the documents provided by us for a smooth clearing process.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection