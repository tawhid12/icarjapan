@extends('layout.app')
@section('pageTitle',trans('Proforma'))
@section('pageSubTitle',trans('Invoice'))
@push('styles')

@endpush
@section('content')
<div class="section">
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <table class="table text-center table-bordered mb-0">
                    <thead>
                        <tr>
                            <td colspan="4">
                                <img src="{{ asset('assets/images/logo/header-logo.png')}}" alt="Logo">
                                <p>(WORLD WIDE USED VECHICLES AND PARTS SUPPLIER)</p>
                                <p>{{$com_info->c_address}} <span><i class="fa fa-phone"></i>{{$com_info->tel}}</span></p>
                                <p>
                                    <span><i class="fa fa-phone"></i>{{$com_info->whatsup}}</span>
                                    <span><i class="fa fa-phone"></i>{{$com_info->email}}</span>
                                    <span><i class="fa fa-phone"></i>{{$com_info->website}}</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">PROFORMA  INVOICE</td>
                        </tr>
                        <tr>
                            <td>CUSTOMER / BUSINESS NAME:</td>
                            <td>{{$client_data->name}}</td>
                            <td>DATE :</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>CUSTOMER ADDRESS:</td>
                            <td>{{$client_details->address1}}</td>
                            <td>INVOICE NO :</td>
                            <td>{{$inv->id}}</td>
                        </tr>
                        <tr>
                            <td>CONSIGNEE NAME :</td>
                            <td>{{$client_details->address1}}</td>
                            <td>PORT OF LOADING :</td>
                            <td>{{$inv->id}}</td>
                        </tr>
                        <tr>
                            <td>CONSIGNEE ADDRESS:</td>
                            <td>{{$client_details->address1}}</td>
                            <td>PORT OF DISCHARGE:</td>
                            <td>{{$inv->id}}</td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td>{{$client_details->address1}}</td>
                            <td>Agent Name:</td>
                            <td>{{$inv->id}}</td>
                        </tr>
                        <tr>
                            <td><h5>IMPORTANT NOTICE</h5></td>
                            <td>
                                <h5><small> MENTION BELOW INFORMATION ON THE TT SLIP</small>
                                    <span><i class="fa fa-phone"></i>INVOICE NO</span>
                                    <span><i class="fa fa-phone"></i>REMITTER NAME</span>
                                    <span><i class="fa fa-phone"></i>CUSTOMER NAME</span>
                                </h5>
                            </td>
                        </tr>
                        <tr>
                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {});
</script>
@endpush