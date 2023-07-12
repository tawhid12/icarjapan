@extends('layout.app')

@section('pageTitle','Show Invoice')
@section('pageSubTitle','List')

@section('content')


<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="row d-flex align-items-center">
                    <div class="col-md-1">
                        <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                    </div>
                    <div class="col-md-11">
                        <div class="row p-2">
                            <div class="col-md-3">
                                <h6>Invoice Details</h6>
                                <a href="">{{optional($inv->vehicle)->fullName}}</a>
                                <p class="my-0"><strong>Stock ID : </strong>{{optional($inv->vehicle)->stock_id}}</p>
                                <p class="my-0"><strong>Chasis No : </strong>{{optional($inv->vehicle)->chassis_no}}</p>
                                <p class="my-0"><strong>Auction Country : </strong></p>
                                <p class="my-0"><strong>Destination Country : </strong></p>
                            </div>
                            <div class="col-md-3">
                                <h6>Pricing Details</h6>
                                <table class="table">
                                    <tr>
                                        <td><strong>FOB Amount: </strong></td>
                                        <td>USD</td>
                                        <td>{{$inv->fob_amt}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Freight Amount: </strong></td>
                                        <td>USD</td>
                                        <td>{{$inv->freight_amt}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Insurance Amount: </strong></td>
                                        <td>USD</td>
                                        <td>{{$inv->insu_amt}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Inspection Amount: </strong></td>
                                        <td>USD</td>
                                        <td>{{$inv->insp_amt}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Vanning Amount: </strong></td>
                                        <td>USD</td>
                                        <td>{{$inv->van_amt}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Virus Busters Amount: </strong></td>
                                        <td>USD</td>
                                        <td>{{$inv->v_bus_amt}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Other Cost: </strong></td>
                                        <td>USD</td>
                                        <td>{{$inv->other_cost}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Discount: </strong></td>
                                        <td>USD</td>
                                        <td>{{$inv->discount}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Amount: </strong></td>
                                        <td>USD</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Paid Amount: </strong></td>
                                        <td>USD</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3">
                                <h6>Shipping Details</h6>
                                <p class="my-0"><strong>Departure Port : </strong>{{optional($inv->dep_port)->name}}</p>
                                <p class="my-0"><strong>Destination Port : </strong>{{optional($inv->des_port)->name}}</p>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <h6>Invoice Details</h6>
                                    <p class="my-0"><strong>Invoice No: </strong>{{$inv->id}}</p>
                                    <p class="my-0"><strong>Invoice Date: </strong>{{$inv->invoice_date}}</p>
                                    <p class="my-0"><strong>Ship Name: </strong>{{$inv->ship_name}}</p>
                                    <p class="my-0"><strong>Ship Date: </strong>{{$inv->voyage_no}}</p>
                                    <p class="my-0"><strong>Est. Arrival Date: </strong>{{$inv->est_arival_date}}</p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="d-flex align-items-center">
                                    <h6>Documents <span>Bill of Lading</span></h6>
                                    <a class="ms-3" href="{{asset('uploads/bill_of_land_1_url/'.$inv->bill_of_land_1_url)}}">Copy</a>
                                    <a class="ms-3" href="{{asset('uploads/bill_of_land_2_url/'.$inv->bill_of_land_2_url)}}">Release</a>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h6>Export Cancellation Certificate</h6>
                                    <a class="ms-3" href="{{asset('uploads/exp_can_cer_url_1/'.$inv->exp_can_cer_url_1)}}">English</a>
                                    <a class="ms-3" href="{{asset('uploads/exp_can_cer_url_1/'.$inv->exp_can_cer_url_1)}}">Japanese</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <h6>Inspection Details</h6>
                                    <p class="my-0"><strong>Request Date : </strong>{{$inv->ins_req_date}}</p>
                                    <p class="my-0"><strong>Pass Date: </strong>{{$inv->ins_pass_date}}</p>
                                </div>
                                <div class="card">
                                    <h6>Consignee Details</h6>
                                    <p class="my-0"><strong>Name: </strong>{{optional($inv->consignee)->c_name}}</p>
                                    <p class="my-0"><strong>Address: </strong>{{optional($inv->consignee)->c_address}}</p>
                                    <p class="my-0"><strong>Phone:</strong>{{optional($inv->consignee)->c_phone}}</p>
                                    <p class="my-0"><strong>Country:</strong>{{optional($inv->consignee)->c_country_id}}</p>
                                    <p class="my-0"><strong>City:</strong>{{optional($inv->consignee)->c_city}}</p>
                                    <p class="my-0"><strong>Email:</strong>{{optional($inv->consignee)->c_email}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Bordered table end -->
</div>

@endsection