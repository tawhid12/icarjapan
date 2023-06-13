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
    <h4 class="text-center my-4">Contact Us</h4>
    <form class="form" method="post" enctype="multipart/form-data" action="{{route('contactus.store')}}">
        @csrf
        <div class="row">

            <div class="col-6">
                <div class="form-group mb-3">

                    <input type="text" id="name" class="form-control" value="{{ old('name')}}" name="name" placeholder="name" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mb-3">

                    <input type="text" id="email" class="form-control" value="{{ old('email')}}" placeholder="email" name="email" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mb-3">

                    <input type="text" id="subject" class="form-control" value="{{ old('subject')}}" placeholder="Subject" name="subject" required>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mb-3">

                    <textarea class="form-control" name="message" rows="8" placeholder="Message" required>{{ old('message')}}</textarea>
                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Send Message</button>
            </div>




        </div>

    </form>

</div>
@endsection