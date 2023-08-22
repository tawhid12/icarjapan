@include('layout.message')
@if(!empty($resrv))
<div class="border">
    <div class="p-2">
        <h5 class="text-center my-2 pb-2">Process Proforma Invoice</h5>
        @forelse($resrv as $v)


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
                                                <td>DBA-L175S</td>
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




                                    @if($v->reserve_status == 1)
                                    <p><i class="badge bg-warning">Reserved</i></p>
                                    @elseif($v->reserve_status == 2)
                                    <p><i class="badge bg-success">Confirmed</i></p>
                                    @else
                                    <p><i class="badge bg-danger">Cancelled</i></p>
                                    @endif
                                    @if($v->reserve_status == 1)
                                    <form method="post" action="{{route(currentUser().'.reservevehicle.update',encryptor('encrypt',$v->reserveId))}}">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$v->reserveId)}}">
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn btn-primary btn-sm">Confirm Order</button>
                                    </form>
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
                        <h6 class="border-bottom">Prepare Proforma Invoice</h6>
                        <table class="table table-bordered m-0">
                            <tr>
                                <th>Destination Country</th>
                                <td>
                                    <select class="form-control" name="country_id" style="width:150px;">
                                        <option value="">Select</option>
                                        @forelse($countries as $c)
                                        <option value="{{$c->id}}" @if($client_data->country_id == $c->id) selected @endif>{{$c->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </td>
                                <th>Port</th>
                                <td>
                                    @php

                                    if($client_data->country_id && empty(request('country_id'))){
                                    $des_port = \DB::table('ports')->where('inv_loc_id',$client_data->country_id)->get();
                                    $des_country = \DB::table('countries')->where('id',$client_data->country_id)->first();
                                    }elseif(!empty(request('country_id'))){

                                    $des_port = \DB::table('ports')->where('inv_loc_id',request('country_id'))->get();
                                    $des_country = \DB::table('countries')->where('id',request('country_id'))->first();
                                    }

                                    @endphp
                                    <select class="des_port form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option value="">Select Port</option>
                                        @if(count($des_port) > 0)
                                        @forelse($des_port as $key => $dp)
                                        <option value="{{$dp->id}}" @if($key==0) selected @endif>{{$dp->name}}</option>
                                        @empty
                                        @endforelse
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>FOB Amount:</th>
                                <td>USD</td>
                                <td colspan="2">{{$price_after_dis}}</td>
                            </tr>
                            <tr>
                                <th>Freight Amount:</th>
                                <td>USD</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <th>Insurance Amount:</th>
                                <td>USD</td>
                                <td colspan="2">{{$des_country->insurance}}</td>
                            </tr>
                            <tr>
                                <th>Inspection Amount:</th>
                                <td>USD</td>
                                <td colspan="2">{{$des_country->inspection}}</td>
                            </tr>
                            <tr>
                                <th>Other Cost:</th>
                                <td>USD</td>
                                <td colspan="2"><input type="text" name="other_cost"></td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td>USD</td>
                                <td colspan="2"> @if($v->discount > 0) {{$v->discount}} @else 0.00 @endif </td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>USD</td>
                                <td colspan="2"></td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-between my-2">
                            <a class="btn btn-sm btn-success" href="">Send Proforma Invoice To Customer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
</div>
@endif