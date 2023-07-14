@extends('layout.app')

@section('pageTitle','Reserved Vehicle List')
@section('pageSubTitle','List')

@section('content')


    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>{{__('#SL')}}</th>
                                        <th>{{__('CM ID')}}</th>
                                        <th>{{__('CM Name')}}</th>
                                        <th>{{__('CM Country')}}</th>
                                        <th>{{__('Vehicle Info')}}</th>
                                        <th>{{__('Purchased Units')}}</th>
                                        <th>{{__('CM Status')}}</th>
                                        <th>{{__('Assign to')}}</th>
                                        <th>{{__('Previous Assign')}}</th>
                                        <th>{{__('Reserved On')}}</th>
                                        <th>{{__('Confirmed On')}}</th>
                                        <th>{{__('Confirm Note')}}</th>
                                        <th class="white-space-nowrap">{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($resrv as $rsv)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{$rsv->user_id}}</td>
                                        <td>{{optional($rsv->res_user)->name}}</td>
                                        <td>{{optional($rsv->res_user)->country_id}}</td>
                                        <td>
                                            <p class="m-0">{{optional($rsv->vehicle)->fullName}}</p>
                                            <p class="m-0">StockId : {{optional($rsv->vehicle)->stock_id}}</p>
                                            <p class="m-0">Price : USD {{optional($rsv->vehicle)->price}}</p>
                                        </td>
                                        <td>  
                                            <a class="btn btn-sm btn-primary" target="_blank" href="{{route(currentUser().'.vehicle.show',encryptor('encrypt',$rsv->vehicle_id))}}" title="Vehicle Details">
                                                <strong>Detail</strong>
                                            </a>
                                        </td>
                                        <td>@if($rsv->status == 1) {{__('Reserved') }} @elseif($rsv->status == 2) {{__('Confirmed') }} @else {{__('Cancelled') }}@endif</td>
                                        <td>
                                            @if($rsv->assign_user_id)
                                            <p class="m-0"><strong>Executive Id: </strong>{{$rsv->assign_user_id}}</p>
                                            <p class="m-0">{{optional($rsv->assign_user)->name}}</p>
                                            @else
                                            <p>Pending</p>
                                            @endif
                                        </td>
                                        <td></td>
                                        <td>{{\Carbon\Carbon::createFromTimestamp(strtotime($rsv->created_at))->format('j M, Y')}}</td>
                                        <td>
                                            @if($rsv->confirm_on)
                                            {{\Carbon\Carbon::createFromTimestamp(strtotime($rsv->confirm_on))->format('j M, Y')}}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{$rsv->note}}</td>
                                        
                                        <td class="white-space-nowrap d-flex">
                                            @if($rsv->assign_user == null && $rsv->status == 1 && currentUser() == 'superadmin')
                                            <a class="btn btn-sm btn-warning" href="{{route(currentUser().'.reservevehicle.edit',$rsv->id)}}">Assign</a>
                                            <form id="form{{$rsv->id}}" action="{{route(currentUser().'.reservevehicle.destroy',$rsv->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            @endif
                                            @if(currentUser() == 'salesexecutive' && $rsv->status == 1)
                                            <a class="btn btn-sm btn-warning" href="{{route(currentUser().'.reservevehicle.edit',$rsv->id)}}">Confirm</a>
                                            @endif
                                            @if( $rsv->status == 2)
                                           
                                            @endif
                                            <a data-vehicke-id="" data-vehicle-name="" href="#" data-toggle="modal" data-target="#addNoteModal" class="mx-1 btn btn-sm btn-primary text-white" title="note"><strong>Note</strong></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No Reserved Found</th>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="pt-2">
                            {{ $resrv->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

