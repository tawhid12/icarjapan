@extends('layout.landing')
@section('pageTitle','Company Profile')
@section('pageSubTitle','Company Profile')
@push('styles')
<style>

</style>
@endpush
@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-8">
            <h3>Company Profile</h3>
            <p>
                Icarjapan is a reliable auto-trading company based in Toyoma, Japan; collaborating with TMT Corporation. We are experienced in providing high-quality auction cars at a very reasonable price and delivering them to almost all the countries in the world. We offer a good amount of inspected and maintained vehicles from several models. We are promised to our clients to provide a smooth online car buying experience with flexible payment methods and world-class shipping methods. Providing such quality services, Icarjapan has become a reliable name in the auto-trading industry.
            </p>
            <p>
                We understand the emotion of all individual customers. Thus, we have listed a variety of cars from almost all the brands to provide our customers with a smooth way to choose their dream cars. We are proud to share that, providing such quality service, we have 80% repeat customers with love and satisfaction.
            </p>
            <p>
                There are several aspects we are offering our clients. From them, our 24/7 customer service is one of the most. With this option, all of our customers feel comfortable dealing with us and purchasing their required vehicle in seven easy steps. Yes, we are always ready to receive your call and to solve your problem as well as answer your questions.
            </p>
            <p>
                Icarjapan is promised to gain the highest customer satisfaction and trying every day to upgrade their service according to their client’s needs. And, the process will continue!
            </p>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-12">
            @php $com_info = \DB::table('company_account_infos')->first();@endphp

            <h6>Company Info</h6>
            @if($com_info)
            <table class="table table-bordered">
                <tr>
                    <th>Company</th>
                    <td>{{$com_info->c_name}}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{$com_info->c_address}}</td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td>
                        <p class="m-0">Telephone: {{$com_info->tel}}</p>
                        <p class="m-0">Fax: {{$com_info->fax}}</p>
                        <p class="m-0">Email: {{$com_info->email}}</p>
                        <p class="m-0">Whatsup: {{$com_info->whatsup}}</p>
                    </td>
                </tr>
            </table>
            @endif

        </div>
    </div>
</div>
@endsection