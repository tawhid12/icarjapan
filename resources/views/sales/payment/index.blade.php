@extends('layout.app')

@section('pageTitle','Payment List')
@section('pageSubTitle','List')

@section('content')


<!-- Bordered table start -->
<section class="section">
    <div class="container">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            @if(currentUser() == 'superadmin' || currentUser() == 'salesexecutive')
                            {{--<a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.payment.create')}}"><i class="bi bi-pencil-square"></i></a>--}}
                            @endif
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Payment Id')}}</th>
                                    @if(currentUser() == 'superadmin' || currentUser() == 'salesexecutive')
                                    <th scope="col">{{__('Customer')}}</th>
                                    @endif
                                    <th>Receive Date</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <!-- <th>Allocated</th> -->
                                    <th>Deposit</th>
                                    <!-- <th>Security Deposit</th> -->
                                    @if(currentUser() == 'superadmin' || currentUser() == 'salesexecutive')
                                    <th class="white-space-nowrap" rowspan="2">{{__('ACTION')}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $p)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{$p->id}}</td>
                                    @if(currentUser() == 'superadmin' || currentUser() == 'salesexecutive')
                                    <td>
                                        <p class="m-0"><strong>Customer Id : </strong>{{optional($p->user)->id}}</p>
                                        <p class="m-0"><strong>Customer Name : </strong>{{optional($p->user)->name}}</p>
                                    </td>
                                    @endif
                                    <td>{{$p->receive_date}}</td>
                                    <td>USD</td>
                                    <td>{{$p->amount}}</td>
                                    <!-- <td>{{$p->allocated}}</td> -->
                                    <td>{{$p->deposit}}</td>
                                    <!-- <td>{{$p->security_deposit}}</td> -->
                                    @if(currentUser() == 'superadmin' || currentUser() == 'salesexecutive')
                                    <td class="white-space-nowrap">
                                        <!-- <a href="{{route(currentUser().'.payment.edit',encryptor('encrypt',$p->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a> -->
                                        <!-- <a href="javascript:void()" onclick="$('#form{{$p->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                        <form id="form{{$p->id}}" action="{{route(currentUser().'.payment.destroy',encryptor('encrypt',$p->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                    @endif
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
    </div>

</section>
<!-- Bordered table end -->
</div>

@endsection