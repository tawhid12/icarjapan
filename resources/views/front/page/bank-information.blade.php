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

            <h4>Bank Account information</h4>
            @if($com_info)
            <table class="table table-bordered">
                <tr>
                    <th>Bank Name</th>
                    <td>{{$com_info->bank_name}}</td>
                </tr>
                <tr>
                    <th>Bank Code</th>
                    <td>{{$com_info->bank_code}}</td>
                </tr>
                <tr>
                    <th>Swift Code</th>
                    <td>{{$com_info->swift_code}}</td>
                </tr>
                <tr>
                    <th>Branch Code & Name</th>
                    <td>{{$com_info->bank_code}} {{$com_info->branch_name}}</td>
                </tr>
                <tr>
                    <th>Account Name</th>
                    <td>{{$com_info->account_name}}</td>
                </tr>
                <tr>
                    <th>Account Number</th>
                    <td>{{$com_info->account_number}}</td>
                </tr>
                <tr>
                    <th>Beneficiary’s Name</th>
                    <td>{{$com_info->beni_name}}</td>
                </tr>
                <tr>
                    <th>Company Address</th>
                    <td>{{$com_info->c_address}}</td>
                </tr>
            </table>
            @endif

        </div>
    </div>
</div>
@endsection