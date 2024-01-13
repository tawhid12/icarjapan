@include('layout.message')
@if(!empty($reserve_vehicle))
<div class="border">
    <div class="p-2">
        <h5 class="text-center my-2 pb-2">Reserved Units</h5>
        @forelse($reserve_vehicle as $v)


        <div class="border p-2 mb-3">
            <div class="row gx-2">
                <div class="col-md-6">
                    <div class="border p-2">
                        <div class="row gx-1">
                            <h6 class="border-bottom">{{ ++$loop->index }}.Reserved Details</h6>
                            <div class="col-md-3">
                                @php $cover_img = \DB::table('vehicle_images')->where('vehicle_id',$v->id)->where('is_cover_img',1)->first(); @endphp
                                @if($cover_img)
                                <img src="{{asset('uploads/vehicle_images/'.$cover_img->image)}}" alt="" class="img-fluid" />
                                @else
                                <img src="{{asset('uploads/default/comingsoon_l.png')}}" alt="" alt="" class="img-fluid" />
                                @endif

                                <small class="stock-text m-0">Stock ID : {{$v->stock_id}}</small>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12 d-flex justify-content-between align-items-center">
                                    <span class="v-tag"><a href="">New Arival</a></span>
                                </div>
                                <div class="heading d-flex justify-content-between">

                                    <h6 class="v-heading"><a target="_blank" href="{{route(currentUser().'.vehicle.show',encryptor('encrypt',$v->id))}}">{{strtoupper($v->fullName)}}</a></h5>
                                        @if($v->inv_locatin_id)
                                        @php $inventory_loc = \DB::table('countries')->where('id',$v->inv_locatin_id)->first();@endphp
                                        <p class="m-0 stock-text" style="font-size:medium">Inventory Location <i class="fa fa-flag"></i><span>{{$inventory_loc->name}}</span></p>
                                        @endif
                                </div>
                                <div class="row gx-1">
                                    <div class="col-md-12">
                                        <table class="table table-bordered m-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Production Year</th>
                                                    <th>Mileage</th>
                                                    <th>Engine</th>
                                                    <th>Trans</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$v->manu_year}}</td>
                                                    <td>{{$v->mileage}}</td>
                                                    <td>{{$v->e_code}}</td>
                                                    <td>{{$v->tname}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table mt-2 custom-table">
                                            <tr>
                                                <td>{{$v->chassis_no}}</td>
                                                <td>
                                                    @if($v->fuel_id)
                                                    @php $fuel = \DB::table('fuels')->where('id',$v->fuel_id)->first();@endphp
                                                    {{$fuel->name}}
                                                    @endif
                                                </td>
                                                <td>@if($v->steering == 1) RHD @else LHD @endif</td>
                                                <td>
                                                    @if($v->drive_id)
                                                    @php $drive = \DB::table('drive_types')->where('id',$v->drive_id)->first();@endphp
                                                    {{$drive->name}}
                                                    @endif
                                                </td>
                                                <td>4 Seats</td>
                                                <td>5 Doors</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="d-flex justify-content-between">
                                    @php
                                    $actual_price = $v->price;
                                    $dis_price = $v->price*$v->discount/100;
                                    $price_after_dis = ($actual_price-$dis_price);
                                    @endphp
                                    {{--<p class="price-text m-0">Vehicle Price:


                                    <span>USD {{$price_after_dis}}</span>
                                    </p>--}}
                                    @if($v->discount > 0)
                                    {{--<del>USD {{$actual_price}}</del>--}}
                                    @endif


                                    <p class="price-text m-0">FOB: <span>${{number_format($price_after_dis, 2, ',', ',')}}</span></p>
                                    @if($v->discount > 0)
                                    <p>Save: {{$v->discount}}</p>
                                    @endif

                                    <!-- Shipemnt Detail and Payment -->
                                    @if($v->reserveId)
                                    @php
                                    $shipment_detail = \App\Models\ShipmentDetail::where('reserve_id', $v->reserveId)->first();
                                    $payment = \App\Models\Payment::where('reserve_id', $v->reserveId)->sum('amount');
                                    $consignee = \App\Models\ConsigneeDetail::where('user_id', $client_details->user_id)->first();
                                    //var_dump($consignee);
                                    //print_r($shipment_detail);
                                    @endphp
                                    @endif
                                    @if($v->reserve_status == 1)
                                    <p><i class="badge bg-warning">Reserved</i></p>
                                    @if(currentUser() == 'salesexecutive' && $payment == 0)
                                    <form id="approve-form" action="{{route(currentUser().'.reservecancel')}}" style="display: inline;">
                                        @csrf
                                        <input name="id" type="hidden" value="{{$v->id}}">
                                        <input name="reserveId" type="hidden" value="{{$v->reserveId}}">
                                        <a href="javascript:void(0)" data-title="{{strtoupper($v->fullName)}}" class="approve btn btn-warning btn-sm" data-toggle="tooltip" title="Approve">Cancel Reserve</a>
                                    </form>
                                    @endif
                                    @elseif($v->reserve_status == 2)
                                    <p><i class="badge bg-success">Confirmed</i></p>
                                    @if(currentUser() == 'salesexecutive' && $payment == 0)
                                    <form id="approve-form" action="{{route(currentUser().'.reservecancel')}}" style="display: inline;">
                                        @csrf
                                        <input name="id" type="hidden" value="{{$v->id}}">
                                        <input name="reserveId" type="hidden" value="{{$v->reserveId}}">
                                        <a href="javascript:void(0)" data-title="{{strtoupper($v->fullName)}}" class="approve btn btn-warning btn-sm" data-toggle="tooltip" title="Approve">Cancel Reserve</a>
                                    </form>
                                    @endif
                                    @else
                                    <p><i class="badge bg-danger">Cancelled</i></p>
                                    @endif
                                    @if($v->reserve_status == 1 && $v->shipment_type)
                                    @if(currentUser() != 'accountant')
                                    <form method="post" action="{{route(currentUser().'.reservevehicle.update',encryptor('encrypt',$v->reserveId))}}">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$v->reserveId)}}">
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn btn-primary btn-sm">Confirm Order</button>
                                    </form>
                                    @endif
                                    @endif
                                </div>



                            </div>
                            <div class="col-md-12">
                                <p class="m-0 feature-text">
                                    @if($v->power_steering ==1)
                                    <span class="px-1" style="border-right:1px solid #ddd;">Power Steering</span>
                                    @endif
                                    @if($v->air_con ==1)
                                    <span class="px-1" style="border-right:1px solid #ddd;">Air Conditioner</span>
                                    @endif
                                    <span class="px-1" style="border-right:1px solid #ddd;">Alloy Wheels</span>
                                    @if($v->navigation ==1)
                                    <span class="px-1" style="border-right:1px solid #ddd;">Navigation</span>
                                    @endif
                                    @if($v->air_bag ==1)
                                    <span class="px-1" style="border-right:1px solid #ddd;">Air Bag</span>
                                    @endif
                                    @if($v->anti_lock_brake_system ==1)
                                    <span class="px-1" style="border-right:1px solid #ddd;">Anti Lock Brake System</span>
                                    @endif
                                    @if($v->power_windows ==1)
                                    <span class="px-1" style="border-right:1px solid #ddd;">Power Windows</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border p-2">
                        <h6 class="border-bottom">Shipment Details/ Prepaid</h6>
                        <table class="table table-bordered m-0">
                            <tr>
                                <th>ETD</th>
                                <td></td>
                                <th>ETA</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Consignee name</th>
                                <td>{{$consignee?->c_name}}</td>
                                @if(currentUser() != 'accountant')
                                <th>Shipment Type</th>
                                <td>
                                    <form action="{{route(currentUser().'.reserve_calculate')}}" method="post" class="d-flex">
                                        @csrf
                                    <input type="hidden" name="vehicle_id" value="{{$v->id}}">
                                    <input type="hidden" name="reserve_id" value="{{$v->reserveId}}">
                                    <input type="hidden" name="client_id" value="{{$client_data->id}}">
                                    <select class="form-control" name="shipment_type" style="width:150px;" required>
                                        <option value="">Select</option>
                                        <option value="1" @if($v->shipment_type == 1) selected @endif>Roro</option>
                                        <option value="2" @if($v->shipment_type == 2) selected @endif>Container</option>
                                    </select>
                                    @if(currentUser() != 'accountant' && !$v->shipment_type)
                                    <button type="submit" class="ms-2 btn btn-sm btn-primary">Submit</button>
                                    @endif
                                    </form>
                                </td>
                                @endif
                            </tr>
                            <tr>
                                <th>Consignee Address</th>
                                <td>{{$consignee?->c_address}}</td>
                            </tr>
                            <tr>
                                <th>Notify Name</th>
                                <td>{{$consignee?->c_name}}</td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <th>Allocate Amount</th>
                                <th>{{$v->allocated}}</th>
                                @if(currentUser() == 'accountant')
                                <th>Allocate</th>
                                <td>
                                    <form action="{{route(currentUser().'.reservevehicle.update',encryptor('encrypt',$v->reserveId))}}" method="post" class="d-flex">
                                        @csrf
                                        @method('patch')
                                        <input type="text" name="allocate" class="form-control">
                                        <button type="submit" class="ms-2 btn btn-sm btn-primary">Submit</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        </table>
                        <div class="d-flex justify-content-between my-2">
                            <h6>Documents</h6>
                            @if(currentUser() != 'accountant')
                            @php $shipment_data = \DB::table('shipment_details')->where('reserve_id',$v->reserveId)->first(); //print_r($shipment_data);@endphp
                            @if(!$shipment_data)
                            <a class="btn btn-sm btn-primary" href="{{route(currentUser().'.shipment.show',encryptor('encrypt',$v->reserveId))}}">Add Shipment Details</a>
                            @else
                            <a class="btn btn-sm btn-primary" href="{{route(currentUser().'.shipment.edit',encryptor('encrypt',$shipment_data->id))}}">Update Shipment Details</a>
                            @endif
                            @else
                            @endif
                        </div>
                        <table class="table table-bordered m-0">
                            <tr>
                                <th>Ins Certificate</th>
                                <th>Ex. Cer. (JP)</th>
                                <th>Ex. Cer. (ENG)</th>
                                <th>P. Invoice</th>
                                <th>B/L</th>
                                <th>Final In.</th>
                            </tr>
                            <tr>
                                <td>@if($shipment_detail)<a href="{{asset('uploads/bill_of_land_1_url/'.$shipment_detail?->bill_of_land_1_url)}}"><i class="bi bi-file-earmark-pdf"></i></a>@endif</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
</div>
@endif
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
    /*=========== Approve ============*/
    $('.approve').on('click', function(event) {
        var title = $(this).data("title");

        var text = `Are want to  Cancel  this Reserve of ${title}?`;
        var icon = 'error';
        var mode = true;

        event.preventDefault();
        swal({
                title: text,
                icon: icon,
                buttons: true,
                dangerMode: mode,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).parent().submit();
                }
            });
    });
</script>
@endpush