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
            <h6 class="m-0">Regional Head Office (Bangladesh)</h6>
            <p class="m-0">Address: Nilachal (1st floor), Plot# 14, Block# B Main Road, Banashree, Dhaka 1219</p>
            <p class="m-0">Contact: +81 50 5539 4712 (Hotline)</p>
        </div>
        <div class="col-md-4 text-center my-3">
            <h6 class="m-0">Regional Office (Russia)</h6>
            <p class="m-0">Primorskij Kraj g. Nakhodka Krasnoarmejskaya 15 n</p>
        </div>
        <div class="col-md-4 text-center my-3">
            <h6 class="m-0">Regional Agent Office (Kiribati)</h6>
            <p class="m-0">Address: Bakarurunao,Temaiku, Tarawa, Kiribati.</p>
            <p class="m-0">Phone: 73048971 / 73081610 / 73050692 </p>
        </div>
        <div class="col-md-4 text-center my-3">
            <h6 class="m-0">Regional Agent Office (Tonga)</h6>
            <p class="m-0">Address: Hala Hihifo, Puke, Tonga </p>
            <p class="m-0">Phone: 7771219 / 8762767</p>
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