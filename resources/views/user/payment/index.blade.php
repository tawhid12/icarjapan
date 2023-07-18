@extends('layout.landing')
@section('pageTitle','Payment List')
@section('pageSubTitle','List')

@section('content')
@include('layout.nav.user')

<!-- Bordered table start -->
<section class="section m-5">
<div class="container">
    <div class="row" id="table-bordered" style="background-color: #eee">
        <div class="col-12">
        <h4>All Payments</h4>
                <!-- table bordered -->
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mb-0">
                        @if(currentUser() == 'superadmin' || currentUser() == 'salesexecutive')
                        {{--<a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.payment.create')}}"><i class="bi bi-pencil-square"></i></a>--}}
                        @endif
                        <thead>
                            <tr>
                                <th scope="col">{{__('#SL')}}</th>
                                <th scope="col">{{__('Payment Id')}}</th>
                                <th>Receive Date</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <!-- <th>Allocated</th> -->
                                <th>Deposit</th>
                                <!-- <th>Security Deposit</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $p)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{$p->id}}</td>
                                <td>{{$p->receive_date}}</td>
                                <td>USD</td>
                                <td>{{$p->amount}}</td>
                                <!-- <td>{{$p->allocated}}</td> -->
                                <td>{{$p->deposit}}</td>
                                <!-- <td>{{$p->security_deposit}}</td> -->
                            </tr>
                            @empty
                            <tr>
                                <th colspan="21" class="text-center">No Payments Found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            
        </div>

    </div>
    </div>
</section>

@endsection