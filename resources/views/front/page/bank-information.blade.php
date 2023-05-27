@extends('layout.landing')
@section('pageTitle','Overview')
@section('pageSubTitle','Overview')
@push('styles')
<style>

</style>
@endpush
@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <h3>Bank Account information</h3>
            <p>
                We aim to provide the most appropriate payment methods to clients across the world for easy business dealings. Our goal has always been to make it easier for clients to use the easiest transaction procedures. They can easily transfer funds to our bank account through the bank information provided for their assistance.
            </p>
        </div>
        <div class="col-md-12">
            @php $com_info = \DB::table('company_account_infos')->first();@endphp

            <h6>Company Info</h6>
            @if($com_info)
            <table class="table table-bordered">
                <tr>
                    <th>Bank</th>
                    <td>
                        <p class="m-0">Bank: {{$com_info->bank_name}}</p>
                        <p class="m-0">Account: {{$com_info->account_name}}</p>
                        <p class="m-0">Branch: {{$com_info->branch_name}}</p>
                        <p class="m-0">Account: {{$com_info->account_number}}</p>
                        <p class="m-0">Swift Code: {{$com_info->swift_code}}</p>
                    </td>
                </tr>
                <tr>
                    <th>Bank Address</th>
                    <td>{{$com_info->bank_address}}</td>
                </tr>
                <tr>
                    <th>Website</th>
                    <td>{{$com_info->website}}</td>
                </tr>
            </table>
            @endif

        </div>
    </div>
</div>
@endsection