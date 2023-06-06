@extends('layout.app')
@section('pageTitle','Vehicle Show')
@section('pageSubTitle','Show')
@push('styles')
<style>
th,td{
    padding:2px !important;
    border: 1px solid #d6d6d6 !important;
}
.bg{
    background-color: #f8f8f8 !important; 
}
.bg-danger-subtle {
    border: 1px solid #d6d6d6;
    font-size: 14px;
    text-align: center;
    height: 30px;
}
</style>
@endpush
@section('content')
<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="col-md-12">
                    @if(currentUser() != 'salesexecutive')
                    <a class="btn btn-sm btn-info float-start" href="{{route(currentUser().'.vehicle.edit',encryptor('encrypt',$v->id))}}"><i class="bi bi-pencil-square"></i> Edit Vehicle</a>
                    @endif
                    <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.vehicle.index')}}"><i class="bi bi-plus-square"></i> All Vehicle</a>
                </div>
                <!-- table bordered -->
                <div class="row p-3">
                    <div class="col-md-8 offset-md-2">

                    <table class="table table-sm table-bordered text-center" style="font-size: smaill;">
                        <thead>
                            <tr>
                                <th colspan="4" scope="col">
                                    {{$v->fullName}} - Details
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="bg" scope="row">STOCK ID</th>
                                <td>{{$v->stock_id}}</td>
                                <th class="bg" scope="row">Engine Size (CC)</th>
                                <td>{{$v->e_size}}</td>
                            </tr>
                            <tr>
                                <th class="bg" scope="row">Maker</th>
                                <td>{{ optional($v->brand)->name }}</td>
                                <th class="bg" scope="row">Engine Info</th>
                                <td>{{$v->e_info}}</td>
                            </tr>
                            <tr>
                                <th class="bg" scope="row">Model</th>
                                <td>{{ optional($v->sub_brand)->name }}</td>
                                <th class="bg" scope="row">Engine Code</th>
                                <td>{{$v->e_code}}</td>
                            </tr>
                            <tr>
                                <th class="bg" scope="row">Package</th>
                                <td>{{ $v->package }}</td>
                                <th class="bg" scope="row">Location</th>
                                <td>{{ optional($v->inv_loc)->name }} | {{ optional($v->inv_port)->name }}</td>
                            </tr>
                            <tr>
                                <th class="bg" scope="row">Chassis</th>
                                <td>{{ $v->chassis_no }}</td>
                                <th class="bg" scope="row">Drive</th>
                                <td>{{ optional($v->drive_type)->name }}</td>
                            </tr>
                            <tr>
                                <th class="bg" scope="row">Manufacture Year</th>
                                <td>{{$v->manu_year}}</td>
                                <th class="bg" scope="row">Registration Year</th>
                                <td>
                                    @if($v->reg_year)
                                    {{\Carbon\Carbon::createFromTimestamp(strtotime($v->reg_year))->format('Y')}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg" scope="row">Mileage (KM)</th>
                                <td>{{ $v->mileage }}</td>
                                <th class="bg" scope="row">Transmission</th>
                                <td>{{ optional($v->trans)->name }}</td>
                            </tr>
                            <tr>
                                <th class="bg" scope="row">Ext. Color</th>
                                <td>{{ optional($v->ext_color)->name }}</td>
                                <th class="bg" scope="row">Steering</th>
                                <td>@if($v->steering == 1) RHD @else LHD @endif</td>
                            </tr>
                            <tr>
                                <th class="bg" scope="row">Door</th>
                                <td>{{ optional($v->door)->name }}</td>
                                <th class="bg" scope="row">Weight</th>
                                <td>{{ $v->weight }}</td>
                            </tr>
                            <tr>
                                <th class="bg" scope="row">Seats</th>
                                <td>{{ optional($v->seat)->name }}</td>
                                <th class="bg" scope="row">Capacity</th>
                                <td>{{ $v->max_loading_capacity }}</td>
                            </tr>
                            <tr>
                                <th class="bg" scope="row">Body Type</th>
                                <td>{{ optional($v->body_type)->name }}</td>
                                <th class="bg" scope="row">Dimention (L*H*W)</th>
                                <td>
                                @if($v->b_length && $v->b_height && $v->b_width)
                                {{ $v->b_length }} x {{ $v->b_height }} x {{ $v->b_width }}
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg" scope="row">Fuel Type</th>
                                <td>{{ optional($v->fuel)->name }}</td>
                                <th class="bg" scope="row">M3</th>
                                <td>{{ $v->m3 }}</td>
                            </tr>
                            <tr>
                                {{--<th class="bg" scope="row">Int. Color</th>
                                <td>{{ optional($v->int_color)->name }}</td>--}}
                                <th class="bg" scope="row">Condition</th>
                                <td>{{ optional($v->condition)->name }}</td>
                            </tr>
                        </tbody>
                    </table>

                    
           
                  <!--Accessories  -->
                  <div class="mt-2">
                    <table class="m-0 table table-sm">
                      <thead>
                        <tr class="">
                          <th class="text-center" colspan="4" scope="col">
                            Features
                          </th>
                        </tr>
                      </thead>
                    </table>
                    <div class="row gx-0">
                
                        @if($v->cd_player ==1) <div class="col-md-3 bg-danger-subtle">CD Player</div> @endif
                        @if($v->sun_roof ==1) <div class="col-md-3 bg-danger-subtle">Sun Roof</div> @endif
                        @if($v->leather_seat ==1)<div class="col-md-3 bg-danger-subtle">Leather Seat</div>@endif
                        @if($v->alloy_wheels ==1)<div class="col-md-3 bg-danger-subtle">Alloy Wheels</div> @endif
                      
                        @if($v->power_steering ==1)<div class="col-md-3 bg-danger-subtle">Power Steering</div> @endif
                        @if($v->power_windows ==1)<div class="col-md-3 bg-danger-subtle">Power Windows</div> @endif
                        @if($v->air_con ==1)<div class="col-md-3 bg-danger-subtle">Air Con</div> @endif
                        @if($v->anti_lock_brake_system ==1)<div class="col-md-3 bg-danger-subtle">Anti lock Brake System</div> @endif
                     
                        @if($v->air_bag ==1)<div class="col-md-3 bg-danger-subtle">Air Bag</div> @endif
                        @if($v->radio ==1)<div class="col-md-3 bg-danger-subtle">Radio</div> @endif
                        @if($v->cd_changer ==1)<div class="col-md-3 bg-danger-subtle">Cd Changer</div> @endif
                        @if($v->dvd ==1)<div class="col-md-3 bg-danger-subtle">DVD</div>@endif
                     
                        @if($v->tv ==1)<div class="bg-danger-subtle">TV</div> @endif
                        @if($v->power_seat ==1)<div class="bg-danger-subtle">Power Seat</div> @endif
                        @if($v->back_tire ==1)<div class="bg-danger-subtle">Back Tire @endif
                          @if($v->grill_guard ==1)
                        <div class="bg-danger-subtle">Grill Guard</div> @endif
                     
                        @if($v->rear_spoiler ==1)<div class="bg-danger-subtle">Rear Spoiler</div> @endif
                        @if($v->central_locking ==1)<div class="bg-danger-subtle">Central Locking</div> @endif
                        @if($v->jack ==1)<div>Jack</div class="bg-danger-subtle"> @endif
                        @if($v->spare_tire ==1)<div class="bg-danger-subtle">Spare Tire</div> @endif
                      
                        @if($v->wheel_spanner ==1)<div class="bg-danger-subtle">Wheel Spanner</div> @endif
                        @if($v->fog_lights ==1)<div class="bg-danger-subtle">Fog Lights</div> @endif
                        @if($v->back_camera ==1)<div class="bg-danger-subtle">Back Camera</div> @endif
                        @if($v->push_start ==1)<div class="bg-danger-subtle">Push Start</div> @endif
                      
                        @if($v->keyless_entry ==1)<div>Keyless Entry</div> @endif
                        @if($v->esc ==1)<div>ESC</div> @endif
                        @if($v->deg_360_cam ==1)<div>360 Degree Camera</div> @endif
                        @if($v->body_kit ==1)<div>Body Kit</div> @endif
                    
                        @if($v->side_airbag ==1)<div class="bg-danger-subtle">Side Airbag</div>@endif
                        @if($v->power_mirror ==1)<div class="bg-danger-subtle">Power Mirror</div> @endif
                        @if($v->side_skirts ==1)<div class="bg-danger-subtle">Side Skirts</div> @endif
                        @if($v->front_lip_spoiler ==1)<div class="bg-danger-subtle">Front Lip Spoiler</div> @endif
                      
                        @if($v->navigation ==1)<div class="bg-danger-subtle">Navigation</div> @endif
                        @if($v->turbo ==1)<div class="bg-danger-subtle">Turbo</div> @endif
                     
               

                  </div>
                
                <div class="col-md-12">
                    <h6>Vehicle Images</h6>
                    <div class="row gx-1">
                        @forelse($v_images as $v_img)
                        <div class="col-md-2 mt-1">
                            <img class="img-fluid" src="{{asset('uploads/vehicle_images/'.$v_img->image)}}" alt="Card image cap">
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</section>
<!-- Bordered table end -->
</div>

@endsection