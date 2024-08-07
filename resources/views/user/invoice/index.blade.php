@extends('layout.landing')

@section('pageTitle','Invoice List')
@section('pageSubTitle','List')

@section('content')
@include('layout.nav.user')

<!-- Bordered table start -->
<section class="section mb-3">
    <div class="container">
    <div class="row" id="table-bordered" style="background-color: #eee">
        <div class="col-12">
        <h4>All Invoice</h4>
                <!-- table bordered -->
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mb-0">
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
                                    {{-- <p class="m-0">Price : USD {{optional($inv->vehicle)->price}}</p> --}}
                                </td>
                                <td>USD {{$inv->inv_amount}}</td>
                                @php  $shipment_detail = \App\Models\ShipmentDetail::where('reserve_id', $inv->reserve_id)->first();@endphp
                                <td>
                                    <p class="m-0">{{$shipment_detail?->ship_name}}</p>
                                    <p class="m-0">{{$shipment_detail?->voyage_no}}</p>
                                    <p class="m-0">@if($shipment_detail?->est_arival_date) {{\Carbon\Carbon::createFromTimestamp(strtotime($shipment_detail?->est_arival_date))->format('d/m/Y')}} @endif</p>
                                    <p class="m-0">@if($shipment_detail?->shipping_date) {{\Carbon\Carbon::createFromTimestamp(strtotime($shipment_detail?->shipping_date))->format('d/m/Y')}} @endif</p>
                                </td>
                                <td>
                                    <p class="m-0">@if($shipment_detail?->ins_req_date) {{\Carbon\Carbon::createFromTimestamp(strtotime($shipment_detail?->ins_req_date))->format('d/m/Y')}} @endif</p>
                                    <p class="m-0">@if($shipment_detail?->ins_pass_date) {{\Carbon\Carbon::createFromTimestamp(strtotime($shipment_detail?->ins_pass_date))->format('d/m/Y')}} @endif</p>
                                </td>
                                <td>
                                    <p class="m-0">{{$shipment_detail?->tracking_no}}</p>
                                    <p class="m-0">{{$shipment_detail?-> shipping_date}}</p>
                                </td>

                                <td>
                                    @if(isset($shipment_detail->consignee_id))
                                    @php  $consignee = \App\Models\ConsigneeDetail::where('id', $shipment_detail->consignee_id)->first();@endphp
                                    <p class="m-0">{{$consignee->c_name}}</p>
                                    @endif
                                    
                                </td>
                                {{--<td>@if($inv->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td>--}}
                                <td class="white-space-nowrap">
                                    @if (currentUser() == 'salesexecutive' || currentUser() == 'superadmin')
                                    <a title="payment" href="{{route(currentUser().'.payment.create')}}?id={{$inv->id}}"><i class="bi bi-box-arrow-in-right"></i></a>
                                    <a href="{{route(currentUser().'.invoice.edit',encryptor('encrypt',$inv->id))}}"><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{route(currentUser().'.invoice.show',encryptor('encrypt',$inv->id))}}"><i class="bi bi-eye"></i></a>
                                    @endif
                                    @if(currentUser() == 'user' && $inv->client_id == currentUserId())
                                    <form action="{{ route(currentUser().'.download-pdf',encryptor('encrypt',$inv->reserve_id)) }}" method="get">
                                        <button type="submit">Download PDF</button>
                                    </form>   
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