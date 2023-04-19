@extends('layout.app')

@section('pageTitle','Payment List')
@section('pageSubTitle','List')

@section('content')


<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <!-- table bordered -->
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.invoice.create')}}"><i class="bi bi-pencil-square"></i></a>
                        <thead>
                            <tr>
                                <th scope="col">{{__('#SL')}}</th>
                                <th scope="col">{{__('Payment Id')}}</th>
                                <th scope="col">{{__('Customer')}}</th>
                                <th>Receive Date</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Allocated</th>
                                <th>Deposit</th>
                                <th>Security Deposit</th>
                                <th class="white-space-nowrap" rowspan="2">{{__('ACTION')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $p)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{$p->id}}</td>
                                <td>
                                    <p class="m-0"><strong>Customer Id : </strong>{{optional($p->user)->id}}</p>
                                    <p class="m-0"><strong>Customer Id : </strong>{{optional($p->user)->name}}</p>
                                </td>
                                <td>{{$p->receive_date}}</td>
                                <td>USD</td>
                                <td>{{$p->amount}}</td>
                                <td>{{$p->allocated}}</td>
                                <td>{{$p->deposit}}</td>
                                <td>{{$p->security_deposit}}</td>
                                <td class="white-space-nowrap">
                                    <a href="{{route(currentUser().'.payment.edit',encryptor('encrypt',$p->id))}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!-- <a href="javascript:void()" onclick="$('#form{{$p->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                    <form id="form{{$p->id}}" action="{{route(currentUser().'.payment.destroy',encryptor('encrypt',$p->id))}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="21" class="text-center">No Invoice Found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Bordered table end -->
</div>

@endsection