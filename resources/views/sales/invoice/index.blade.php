@extends('layout.app')

@section('pageTitle','Invoice List')
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
                                <th scope="col" rowspan="2">{{__('#SL')}}</th>
                                <th scope="col" rowspan="2">{{__('Invoice')}}</th>
                                <th>Reservation Details</th>
                                <th>Settle|Confirmed Price</th>
                                <th>Shipping Detl</th>
                                <th>Inspection Detl</th>
                                <th>BL Detl</th>
                                <th>Consignee</th>
                                {{--<th>{{__('Status')}}</th>--}}
                                <th class="white-space-nowrap" rowspan="2">{{__('ACTION')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $inv)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>
                                    <strong>ID: </strong>{{$inv->id}}
                                </td>
                                <td>
                                    <p class="m-0"><strong>Customer Id : </strong>{{optional($inv->user)->id}}</p>
                                    <p class="m-0"><strong>Customer Name : </strong>{{optional($inv->user)->name}}</p>
                                    <p class="m-0"><strong>Vehicle Name : </strong>{{optional($inv->vehicle)->fullName}}</p>
                                    <p class="m-0">StockId : {{optional($inv->vehicle)->stock_id}}</p>
                                    <p class="m-0">Price : USD {{optional($inv->vehicle)->price}}</p>
                                </td>
                                <td>{{optional($inv->res_vehicle)->settle_price}}</td>
                                <td>
                                    <p class="m-0">{{$inv->ship_name}}</p>
                                    <p class="m-0">{{$inv->voyage_no}}</p>
                                    <p class="m-0">{{$inv->est_arival_date}}</p>
                                    <p class="m-0">{{$inv->shipping_date}}</p>
                                </td>
                                <td>
                                    <p class="m-0">{{$inv->ins_req_date}}</p>
                                    <p class="m-0">{{$inv->ins_pass_date}}</p>
                                </td>
                                <td>
                                    <p class="m-0">{{$inv->tracking_no}}</p>
                                    <p class="m-0">{{$inv-> shipping_date}}</p>
                                </td>
                                <td>
                                    <p class="m-0">{{optional($inv->consignee)->c_name}}</p>
                                </td>
                                {{--<td>@if($inv->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td>--}}
                                <td class="white-space-nowrap">
                                    @if (currentUser() == 'salesexecutive' || currentUser() == 'superadmin')
                                    @php $vehicle = \DB::table('vehicles')->where('id',$inv->vehicle_id)->first(); @endphp
                                    @if(!$vehicle->sold_status)
                                        <a title="payment" href="{{route(currentUser().'.payment.create')}}?id={{$inv->id}}"><i class="bi bi-box-arrow-in-right"></i></a>
                                    @else
                                    <strong>Paid</strong>    
                                    @endif
                                    <a href="{{route(currentUser().'.invoice.edit',encryptor('encrypt',$inv->id))}}"><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{route(currentUser().'.invoice.show',encryptor('encrypt',$inv->id))}}"><i class="bi bi-eye"></i></a>
                                    @endif
                                    <!-- <a href="javascript:void()" onclick="$('#form{{$inv->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                    <form id="form{{$inv->id}}" action="{{route(currentUser().'.invoice.destroy',encryptor('encrypt',$inv->id))}}" method="post">
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