@extends('layout.landing')
@section('pageTitle','ICARJAPAN')
@section('pageSubTitle','Contact US')
@push('styles')
<style>

</style>
@endpush
@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h4>CONTACT DETAILS - JAPAN HEADQUARTER</h4>
                @php $com_info = \DB::table('company_account_infos')->first();@endphp
                <p class="m-0"><span class="me-2"><i class="fa fa-home"></i></span>{{$com_info->c_address}}</p>
                <p class="m-0"><span class="me-2"><i class="fa fa-phone"></i></span>{{$com_info->tel}}</p>
                <p class="m-0"><span class="me-2"><i class="fa fa-phone"></i></span>{{$com_info->whatsup}}</p>
                <p class="m-0"><span class="me-2"><i class="fa fa-envelope"></i></span>{{$com_info->email}}</p>
                <p class="m-0"><span class="me-2"><i class="fa fa-globe"></i></span>{{$com_info->website}}</p>
            </div>
        </div>
        <div class="col-md-4 text-center my-3">
            <h6 class="m-0">Customer Service Department (Japan)</h6>
            <p class="m-0">934-0025 Toyama-Ken, Imizu-Shi</p>
            <p class="m-0">Hachimanmachi 3-5-22 3F Japan</p>
        </div>
        <div class="col-md-4 text-center my-3">
            <h6 class="m-0">Customer Service Department (Japan)</h6>
            <p class="m-0">934-0025 Toyama-Ken, Imizu-Shi</p>
            <p class="m-0">Hachimanmachi 3-5-22 3F Japan</p>
        </div>
        <div class="col-md-4 text-center my-3">
            <h6 class="m-0">Customer Service Department (Japan)</h6>
            <p class="m-0">934-0025 Toyama-Ken, Imizu-Shi</p>
            <p class="m-0">Hachimanmachi 3-5-22 3F Japan</p>
        </div>
        <div class="col-md-4 text-center my-3">
            <h6 class="m-0">Customer Service Department (Japan)</h6>
            <p class="m-0">934-0025 Toyama-Ken, Imizu-Shi</p>
            <p class="m-0">Hachimanmachi 3-5-22 3F Japan</p>
        </div>
        <div class="col-md-4 text-center my-3">
            <h6 class="m-0">Customer Service Department (Japan)</h6>
            <p class="m-0">934-0025 Toyama-Ken, Imizu-Shi</p>
            <p class="m-0">Hachimanmachi 3-5-22 3F Japan</p>
        </div>
        <div class="col-md-4 text-center my-3">
            <h6 class="m-0">Customer Service Department (Japan)</h6>
            <p class="m-0">934-0025 Toyama-Ken, Imizu-Shi</p>
            <p class="m-0">Hachimanmachi 3-5-22 3F Japan</p>
        </div>
    </div>
</div>
@endsection