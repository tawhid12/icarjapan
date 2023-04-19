@extends('layout.app')
@section('pageTitle','Vehicle Show')
@section('pageSubTitle','Show')
@section('content')
<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="col-md-12">
                    <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.vehicle.index')}}"><i class="bi bi-plus-square"></i> All Vehicle</a>
                </div>
                <!-- table bordered -->
                <div class="row p-3">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <th colspan="4" class="text-center">
                                            <h5>{{__('Vehicle Name')}}</h5>
                                            <h6>{{$v->fullName}}</h6>
                                            <p><strong>{{__('Vehicle Price')}} :- {{$v->price}}</strong></p>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td width="200px">
                                            <p clss="m-0"><strong>{{__('Brand')}} :- </strong>{{$v->brand->name}}</p>
                                            <p clss="m-0"><strong>{{__('Version')}} :- </strong>{{$v->version}}</p>
                                            <p clss="m-0"><strong>{{__('M2')}} :- </strong>{{$v->m3}}</p>
                                            <p clss="m-0"><strong>{{__('Model')}} :- </strong>{{optional($v->vehicle_model)->name}}</p>
                                            <p clss="m-0"><strong>{{__('Model code')}} :- </strong>{{$v->model_code}}</p>
                                            <p clss="m-0"><strong>{{__('Chasis')}} :- </strong>{{$v->chassis_no}}</p>
                                            <p clss="m-0"><strong>{{__('fob')}} :- </strong>{{$v->fob}}</p>
                                            <p clss="m-0"><strong>{{__('Manufacture Year')}} :- </strong>{{$v->manu_year}}</p>
                                        </td>
                                        <td>
                                            <p clss="m-0"><strong>{{__('Sub Brand')}} :- </strong>{{optional($v->sub_brand)->name}}</p>
                                            <p clss="m-0"><strong>{{__('Steering')}} :- </strong>@if($v->steering ==1) Left @else Right @endif</p>
                                            <p clss="m-0"><strong>{{__('Body Type')}} :- </strong>{{optional($v->body_type)->name}}</p>
                                            <p clss="m-0"><strong>{{__('Sub Body Type')}} :- </strong>{{optional($v->sub_body_type)->name}}</p>
                                            <p clss="m-0"><strong>{{__('Door')}} :- </strong>{{$v->door}}</p>
                                            <p clss="m-0"><strong>{{__('Weight')}} :- </strong>{{$v->weight}}</p>
                                            <p clss="m-0"><strong>{{__('Drive Type')}} :- </strong>{{optional($v->drive_type)->name}}</p>
                                            <p clss="m-0"><strong>{{__('Inventory Location')}} :- </strong>{{optional($v->inv_loc)->name}}</p>
                                        </td>
                                        <td>
                                            <p clss="m-0"><strong>{{__('Stock Id')}} :- </strong>{{$v->stock_id}}</p>
                                            <p clss="m-0"><strong>{{__('CC')}} :- </strong>{{$v->cc}}</p>
                                            <p clss="m-0"><strong>{{__('Mileage')}} :- </strong>{{$v->mileage}}</p>
                                            <p clss="m-0"><strong>{{__('Transmission')}} :- </strong>{{$v->transmission_id}}</p>
                                            <p clss="m-0"><strong>{{__('Discount')}} :- </strong>{{$v->discount}}</p>
                                            <p clss="m-0"><strong>{{__('Color')}} :- </strong>{{optional($v->color)->name}}</p>
                                            <p clss="m-0"><strong>{{__('Body Length')}} :- </strong>{{$v->b_length}}</p>
                                        </td>
                                        <td>
                                            <p clss="m-0"><strong>{{__('Package')}} :- </strong>{{$v->package}}</p>
                                            @php $truck_size = array(1 => 'Large Truck', 2 => '>Medium Truck', 3 => 'Small Truck', 4 => 'Multicab'); @endphp
                                            <p clss="m-0"><strong>
                                                {{__('Truck Size')}} :- </strong>@php if (array_key_exists(1, $truck_size)) 
                                                {
                                                echo $truck_size[1]; // Output: bar
                                                } @endphp
                                            </p>
                                            <p clss="m-0"><strong>{{__('Max Loading Capacity')}} :- </strong>{{$v->max_loading_capacity}}</p>
                                            <p clss="m-0"><strong>{{__('Engine Capacity')}} :- </strong>{{$v->e_type}}</p>
                                            <p clss="m-0"><strong>{{__('Engine Code')}} :- </strong>{{$v->e_code}}</p>
                                            <p clss="m-0"><strong>{{__('Year')}} :- </strong>{{$v->year}}</p>
                                            <p clss="m-0"><strong>{{__('Reg Year')}} :- </strong>{{$v->reg_year}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">{{__('Description')}}</th>
                                        <th colspan="2">{{__('Note')}}</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">{{$v->description}}</td>
                                        <td colspan="2">{{$v->note}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Additional Information
                                        </td>
                                        <td colspan="3">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="air_bag" placeholder="air_bag" name="air_bag" value="1" @if($v->air_bag ==1) checked @endif>
                                                <label for="air_bag" class="form-check-label">Air Bag</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="anti_lock_brake_system" placeholder="anti_lock_brake_system" name="anti_lock_brake_system" value="1" @if($v->anti_lock_brake_system ==1) checked @endif>
                                                <label for="anti_lock_brake_system" class="form-check-label">Anti Lock Brake System</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="air_con" placeholder="air_con" name="air_con" value="1" @if($v->air_con ==1) checked @endif>
                                                <label for="air_con" class="form-check-label">Air Condition</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="back_tire" placeholder="back_tire" name="back_tire" value="1" @if($v->back_tire ==1) checked @endif>
                                                <label for="back_tire" class="form-check-label">Back Tire</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="fog_lights" placeholder="fog_lights" name="fog_lights" value="1" @if($v->fog_lights ==1) checked @endif>
                                                <label for="fog_lights" class="form-check-label">Fog Lights</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="grill_guard" placeholder="grill_guard" name="grill_guard" value="1" @if($v->grill_guard ==1) checked @endif>
                                                <label for="grill_guard" class="form-check-label">Grill Guard</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="leather_seats" placeholder="leather_seats" name="leather_seats" value="1" @if($v->leather_seats ==1) checked @endif>
                                                <label for="leather_seats" class="form-check-label">Leather Seats</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="navigation" placeholder="navigation" name="navigation" value="1" @if($v->navigation ==1) checked @endif>
                                                <label for="navigation" class="form-check-label">Navigation</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="power_steering" name="power_steering" value="1" @if($v->power_steering ==1) checked @endif>
                                                <label for="power_steering" class="form-check-label">Power Steering</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="power_windows" name="power_windows" value="1" @if($v->power_windows ==1) checked @endif>
                                                <label for="power_windows" class="form-check-label">Power Windows</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="roof_rails" name="roof_rails" value="1" @if($v->roof_rails ==1) checked @endif>
                                                <label for="roof_rails" class="form-check-label">Roof Rails</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="rear_spoiler" name="rear_spoiler" value="1" @if($v->rear_spoiler ==1) checked @endif>
                                                <label for="rear_spoiler" class="form-check-label">Rea Spoiler</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="sun_roof" name="sun_roof" value="1" @if($v->sun_roof ==1) checked @endif>
                                                <label for="sun_roof" class="form-check-label">Sun Roof</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="tv" name="tv" value="1" @if($v->tv ==1) checked @endif>
                                                <label for="tv" class="form-check-label">Tv</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="dual_air_bags" name="dual_air_bags" value="1" @if($v->dual_air_bags ==1) checked @endif>
                                                <label for="tv" class="form-check-label">Dual Air Bags</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <p clss="m-0"><strong>{{__('Video Link')}} :- </strong>{{$v->v_link}}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h6>Vehicle Images</h6>
                        <div class="row">
                            @forelse($v_images as $v_img)
                            <div class="col-12">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{asset('uploads/vehicle_images/'.$v_img->image)}}" alt="Card image cap">
                                </div>
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