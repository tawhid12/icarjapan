@extends('layout.landing')

@section('pageTitle','Reserved Vehicle List')
@section('pageSubTitle','List')

@section('content')

@include('layout.nav.user')
<!-- Bordered table start -->
<section class="section m-5">
    <div class="container">
        <div class="row" id="table-bordered" style="background-color: #eee">
            <div class="col-12">
              <h4>All Reserved</h4>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Reserved By')}}</th>
                                    <th scope="col">{{__('Assign to')}}</th>
                                    <th scope="col">{{__('Reserved On')}}</th>
                                    <th scope="col">{{__('Confirmed On')}}</th>
                                    <th scope="col">{{__('Note')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <!-- <th class="white-space-nowrap">{{__('ACTION')}}</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($resrv as $rsv)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>
                                        <p class="m-0"><strong>Vehicle Name : </strong>{{optional($rsv->vehicle)->fullName}}</p>
                                        <p class="m-0">StockId : {{optional($rsv->vehicle)->stock_id}}</p>
                                        <p class="m-0">Price : USD {{optional($rsv->vehicle)->price}}</p>
                                    </td>
                                    <td>
                                        <p class="m-0"><strong>Customer Id: </strong>{{$rsv->user_id}}</p>
                                        <p class="m-0"><strong>Name: </strong>{{optional($rsv->res_user)->name}}</p>
                                    </td>
                                    <td>
                                        @if($rsv->assign_user_id)
                                        <p class="m-0"><strong>Sales Executive Id: </strong>{{$rsv->assign_user_id}}</p>
                                        <p class="m-0"><strong>Name: </strong>{{optional($rsv->assign_user)->name}}</p>
                                        @else
                                        <p>No Sales Executive Assigned</p>
                                        @endif
                                    </td>
                                    <td>{{\Carbon\Carbon::createFromTimestamp(strtotime($rsv->created_at))->format('j M, Y')}}</td>
                                    <td>
                                        @if($rsv->confirm_on)
                                        {{\Carbon\Carbon::createFromTimestamp(strtotime($rsv->confirm_on))->format('j M, Y')}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>{{$rsv->note}}</td>
                                    <td>@if($rsv->status == 1) {{__('Reserved') }} @elseif($rsv->status == 2) {{__('Confirmed') }} @else {{__('Cancelled') }}@endif</td>
                                    <!--<td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.reservevehicle.edit',$rsv->id)}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>-->
                                        <!-- <a href="javascript:void()" onclick="$('#form{{$rsv->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                        <!--<form id="form{{$rsv->id}}" action="{{route(currentUser().'.reservevehicle.destroy',$rsv->id)}}" method="post">
                                            @csrf
                                            @method('delete')

                                        </form>
                                    </td>-->
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


@endsection