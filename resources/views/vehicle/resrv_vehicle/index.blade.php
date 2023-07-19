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
                                <th>{{__('Sold Status')}}</th>
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
                                @php 
                                    $inv = \DB::table('invoices')->where('reserve_id',$rsv->id)->first();
                                    $vehicle = \DB::table('vehicles')->where('id',$rsv->vehicle_id)->first();  
                                @endphp
                                <td> 
                                    @if($vehicle->sold_status)
                                        <button class="btn btn-sm btn-success">Sold</button>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="d-flex">
                                {{--$rsv->assign_user == null &&--}}
                                    @if($rsv->status == 1 && currentUser() == 'superadmin')
                                    <a class="btn btn-sm btn-warning" href="{{route(currentUser().'.reservevehicle.edit',$rsv->id)}}">Assign</a>
                                    @endif
                                    @if(currentUser() == 'salesexecutive' && $rsv->status == 1)
                                    <a class="btn btn-sm btn-warning" href="{{route(currentUser().'.reservevehicle.edit',$rsv->id)}}">Confirm</a>
                                    @endif
                                    
                                    @if( $rsv->status == 2 && $inv)
                                        <a class="btn btn-sm btn-danger" href="{{route(currentUser().'.invoice.edit',encryptor('encrypt',$inv->id))}}">Invoice</a>
                                    @endif
                                    @if($rsv->status == 1 && currentUser() == 'superadmin')
                                    <form id="form{{$rsv->id}}" action="{{route(currentUser().'.reservevehicle.destroy',$rsv->vehicle_id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="mx-1 btn btn-sm btn-info">Reserve Cancel</button>
                                    </form>
                                    @endif
                                    <a data-reserve-id="{{$rsv->id}}" data-vehicle-id="{{$rsv->vehicle_id}}" data-vehicle-name="{{optional($rsv->vehicle)->fullName}}" href="#" data-bs-toggle="modal" data-bs-target="#addNoteModal" class="mx-1 btn btn-sm btn-primary text-white" title="note"><strong>Add Note</strong></a>
                                    <!-- <a class="btn btn-sm btn-warning">Payment History</a> -->
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



<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form action="{{ route(currentUser().'.notes.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addNoteModalLabel">Add Note For <span id="vehicleName"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="reserve_id" name="reserve_id" class="form-control">
                    <!-- <div class="form-group">
                        <label for="note">Re Call Date:</label>
                        <input type="text" id="re_call_date" name="re_call_date" class="form-control" placeholder="dd/mm/yyyy">
                    </div> -->
                    <div class="form-group">
                        <label for="note">Note:</label>
                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="disableButton(this)">Add Note</button>
                </div>
            </form>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="page-title">Note History</h5>
                        <table class="mt-3 table table-bordered table-bordered" style="border-collapse: collapse; border-spacing: 0;">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <!-- <th>Recall Date</th> -->
                                    <th>Note</th>
                                    <th>Notes By</th>
                                    <th>Posted On</th>
                                </tr>
                            </thead>
                            <tbody id="note-history">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).on('show.bs.modal', function(event) {
        $('#note-history').empty();
        var button = $(event.relatedTarget);
        var reserve_id = button.data('reserve-id');
        var vehicle_id = button.data('vehicle-id');
        var vehicleName = button.data('vehicle-name');

        var modal = $(this);
        modal.find('#reserve_id').val(reserve_id);
        modal.find('#vehicleName').text(vehicleName);
        $.ajax({
            url: "{{route(currentUser().'.noteHistoryByvehicleId')}}",
            method: 'GET',
            dataType: 'json',
            data: {
                reserve_id: reserve_id,
            },
            success: function(res) {
                console.log(res.data);
                $('#note-history').append(res.data);
            },
            error: function(e) {
                console.log(e);
            }
        });
    });
</script>
@endpush