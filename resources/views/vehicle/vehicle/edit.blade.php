@extends('layout.app')

@section('pageTitle','Edit Vehicle')
@section('pageSubTitle','Edit')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('assets/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
<style>
    .main-img {
        position: relative;
    }

    .cover-img-box {
        content: "";
        position: absolute;
        bottom: 20px;
        left: 10%;
        color: #fff;
        background-color: #3950A2;
        width: 90px;
        height: 20px;
        line-height: 20px;
        border-radius: 37px;
        text-align: center;
        font-weight: 900;
    }
</style>
@endpush
@section('content')

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.vehicle.update',encryptor('encrypt',$v->id))}}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$v->id)}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><Strong>Vehicle :- {{$v->fullName}}</Strong></p>
                                </div>


                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="name">Stock ID</label>
                                        <input type="text" id="stock_id" value="{{old('stock_id',$v->stock_id)}}" class="form-control" placeholder="Vehicle Stock ID" name="stock_id">
                                    </div>
                                    @if($errors->has('stock_id'))
                                    <span class="text-danger"> {{ $errors->first('stock_id') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="brand_id">Maker</label>
                                        <select name="brand_id" class="form-control js-example-basic-single" id="brand_id">
                                            <option value="">Select</option>
                                            @if(count($brands))
                                            @foreach($brands as $b)
                                            <option value="{{ $b->id}}" {{ old('brand_id',$v->brand_id) == $b->id ? "selected" : "" }}>{{$b->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @if($errors->has('brand_id'))
                                    <span class="text-danger"> {{ $errors->first('brand_id') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="sub_brand_id">Model</label>
                                        <select name="sub_brand_id" class="form-control" id="sub_brand">
                                            {{--<option value="">Select</option>
                                            @if(count($sub_brands))
                                            @foreach($sub_brands as $sb)
                                            <option value="{{ $sb->id}}" {{ old('sub_brand_id',$v->sub_brand_id) == $sb->id ? "selected" : "" }}>{{$sb->name}}</option>
                                            @endforeach
                                            @endif--}}
                                        </select>
                                    </div>
                                    @if($errors->has('sub_brand_id'))
                                    <span class="text-danger"> {{ $errors->first('sub_brand_id') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="package">Package</label>
                                        <input type="text" id="package" value="{{old('package',$v->package)}}" class="form-control" placeholder="Package" name="package">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="chassis_no">Chassis No</label>
                                        <input type="text" id="chassis_no" value="{{old('chassis_no',$v->chassis_no)}}" class="form-control" placeholder="Vehicle Chassis No" name="chassis_no">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="manu_year">Manufacture Year</label>
                                        <select name="manu_year" class="form-control js-example-basic-single">
                                            <option value="">Select Manufacture Year</option>
                                            @php
                                            for($i=date('Y');$i>=1980;$i--){
                                            @endphp
                                            <option value="{{$i}}" @if($v->manu_year == $i) selected @endif>{{$i}}</option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="mileage">Mileage</label>
                                        <input type="text" id="mileage" value="{{old('mileage',$v->mileage)}}" class="form-control" placeholder="mileage" name="mileage">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="ext_color_id">Ext. Color</label>
                                        <select name="ext_color_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($colors))
                                            @foreach($colors as $c)
                                            <option value="{{ $c->id}}" @if($v->ext_color_id == $c->id) selected @endif>{{$c->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="door_id">Door</label>
                                        <select name="door_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($doors))
                                            @foreach($doors as $d)
                                            <option value="{{ $d->id}}" @if($v->door_id == $d->id) selected @endif>{{$d->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="seat_id">Seat</label>
                                        <select name="seat_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($seats))
                                            @foreach($seats as $s)
                                            <option value="{{ $s->id}}" @if($v->seat_id == $s->id) selected @endif>{{$s->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="v_model_id">Body Types</label>
                                        <select name="body_type_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($body_types))
                                            @foreach($body_types as $bd)
                                            <option value="{{ $bd->id}}" @if($v->body_type_id == $bd->id) selected @endif>{{$bd->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="fuel_id">Fuel</label>
                                        <select name="fuel_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($fuel))
                                            @foreach($fuel as $f)
                                            <option value="{{ $f->id}}" @if($v->fuel_id == $f->id) selected @endif>{{$f->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="int_color_id">Int. Color</label>
                                        <select name="int_color_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($colors))
                                            @foreach($colors as $c)
                                            <option value="{{ $c->id}}" @if($v->int_color_id == $c->id) selected @endif>{{$c->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="fuel_id">New Arival Country</label>
                                        <select name="arival_country_id[]" class="form-control js-example-basic-multiple" multiple="multiple">

                                            @if(count($countries))
                                            @foreach($countries as $c)
                                            <option value="{{ $c->id}}" @if(in_array($c->id,$new_arivals)) selected @endif>{{$c->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="serach_keyword">Search Keyword</label>
                                        <small>Press Space after every word</small>
                                        <input type="text" id="search_keyword" value="{{ str_replace(',', ' ', $v->search_keyword) }}" class="form-control" placeholder="Search Keyword" name="search_keyword">
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" rows="8" name="description">{{$v->description}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="e_type">Engine Size</label>
                                        <input type="text" id="e_size" value="{{old('e_size',$v->e_size)}}" class="form-control" placeholder="Engine Size" name="e_size">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="e_code">Engine Info</label>
                                        <input type="text" id="e_info" value="{{old('e_info',$v->e_info)}}" class="form-control" placeholder="Engine Code" name="e_info">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="e_code">Engine Code</label>
                                        <input type="text" id="e_code" value="{{old('e_code',$v->e_code)}}" class="form-control" placeholder="Engine Code" name="e_code">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="inv_locatin_id">Inventory Location</label>
                                        <select id="inv_locatin_id" name="inv_locatin_id" class="form-control js-example-basic-single">
                                            <option value="">Select</option>
                                            @if(count($countries))
                                            @foreach($countries as $c)
                                            <option value="{{ $c->id}}" @if($v->inv_locatin_id == $c->id) selected @endif>{{$c->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="inv_port_id">Inventory Location Port</label>
                                        <select name="inv_port_id" class="form-control js-example-basic-single" id="inv_port_id">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="drive_id">Drive Type</label>
                                        <select name="drive_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($drive_types))
                                            @foreach($drive_types as $dt)
                                            <option value="{{ $dt->id}}" @if($v->drive_id == $dt->id) selected @endif>{{$dt->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="reg_year">Registration Year</label>
                                        <select name="reg_year" class="form-control js-example-basic-single">
                                            <option value="">Select Registration Year</option>
                                            @php
                                            for($i=date('Y');$i>=1980;$i--){
                                            @endphp
                                            <option value="{{$i}}" @if($v->reg_year == $i) selected @endif>{{$i}}</option>
                                            @php
                                            }
                                            @endphp
                                        </select>
                                        <!--<input type="text" id="reg_year" class="form-control" placeholder="dd/mm/yyyy" name="reg_year">-->
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="transmission_id">Transmission</label>
                                        <select name="transmission_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($trans))
                                            @foreach($trans as $t)
                                            <option value="{{ $t->id}}" @if($v->transmission_id == $t->id) selected @endif>{{$t->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="chassis_no">Steering</label>
                                        <select class="form-control" id="steering" name="steering">
                                            <option value="">Select</option>
                                            <option value="1" @if($v->steering ==1) selected @endif>Right Hand Drive</option>
                                            <option value="2" @if($v->steering ==2) selected @endif>Left Hand Drive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input type="text" id="weight" value="{{old('weight',$v->weight)}}" class="form-control" placeholder="Weight" name="weight">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="max_loading_capacity">Maximum Loading Capacity</label>
                                        <input type="text" id="max_loading_capacity" value="{{old('max_loading_capacity',$v->max_loading_capacity)}}" class="form-control" placeholder="max loading capacity" name="max_loading_capacity">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="b_length">Dimention (L*H*W)</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="b_length" value="{{old('b_length',$v->b_length)}}" class="form-control" placeholder="Length" name="b_length">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="b_height" value="{{old('b_height',$v->b_height)}}" class="form-control" placeholder="Height" name="b_height">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="b_width" value="{{old('b_width',$v->b_width)}}" class="form-control" placeholder="Width" name="b_width">
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="m3">M3</label>
                                        <input type="text" id="m3" value="{{old('m3',$v->m3)}}" class="form-control" placeholder="M3" name="m3" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="con_id">Condition</label>
                                        <select name="con_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($cons))
                                            @foreach($cons as $c)
                                            <option value="{{ $c->id}}" @if( $c->id == $v->con_id) selected @endif>{{$c->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="discount">Discount (Percentage Value)</label>
                                        <input type="text" id="discount" value="{{old('discount',$v->discount)}}" class="form-control" placeholder="discount" name="discount">
                                    </div>
                                </div>


                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="chassis_no">FOB</label>
                                        <input type="text" id="fob" value="{{old('fob',$v->fob)}}" class="form-control" placeholder="fob" name="fob">
                                    </div>
                                </div>

                                {{--<div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" value="{{old('name',$v->name)}}" class="form-control" placeholder="Vehicle Name" name="name">
                            </div>
                            @if($errors->has('name'))
                            <span class="text-danger"> {{ $errors->first('name') }}</span>
                            @endif
                    </div>--}}


                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="fuel_id">Vehicle Availabe Country</label>
                            <select name="country_id[]" class="form-control js-example-basic-multiple" multiple="multiple">

                                @if(count($countries))
                                @foreach($countries as $c)
                                <option value="{{ $c->id}}" @if(in_array($c->id,$vehicle_avaliable_country)) selected @endif>{{$c->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>


                    {{--<div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" id="price" value="{{old('price',$v->fob)}}" class="form-control" placeholder="price" name="price">
                </div>
            </div>--}}
            <div class="col-md-12 col-12">
                <div class="form-group">
                    <label for="note">Options</label>
                    <textarea class="form-control" rows="3" name="option">{{old('option',$v->option)}}</textarea>
                </div>
            </div>

            <div class="col-md-12 col-12 mt-3">
                <h4>Additional Vechicle Facility</h4>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->cd_player ==1) checked @endif id="cd_player" name="cd_player" value="1">
                    <label class="form-check-label" for="cd_player">CD Player</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->sun_roof ==1) checked @endif id="sun_roof" name="sun_roof" value="1">
                    <label class="form-check-label" for="sun_roof">Sun Roof</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->leather_seat ==1) checked @endif id="leather_seat" name="leather_seat" value="1">
                    <label class="form-check-label" for="leather_seats">Leather Seat</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->alloy_wheels ==1) checked @endif id="alloy_wheels" name="alloy_wheels" value="1">
                    <label class="form-check-label" for="alloy_wheels">Alloy Wheels</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->power_steering ==1) checked @endif id="power_steering" name="power_steering" value="1">
                    <label class="form-check-label" for="power_steering">Power Steering</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->power_windows ==1) checked @endif id="power_windows" name="power_windows" value="1">
                    <label class="form-check-label" for="power_windows">Power Windows</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->air_con ==1) checked @endif id="air_con" name="air_con" value="1">
                    <label class="form-check-label" for="air_con">AC</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->anti_lock_brake_system ==1) checked @endif id="anti_lock_brake_system" name="anti_lock_brake_system" value="1">
                    <label class="form-check-label" for="anti_lock_brake_system">ABS</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->air_bag ==1) checked @endif id="air_bag" name="air_bag" value="1">
                    <label class="form-check-label" for="air_bag">Air Bag</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->radio ==1) checked @endif id="radio" name="radio" value="1">
                    <label class="form-check-label" for="air_bag">Radio</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->cd_changer ==1) checked @endif id="cd_changer" name="cd_changer" value="1">
                    <label class="form-check-label" for="cd_changer">CD Changer</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->dvd ==1) checked @endif id="dvd" name="dvd" value="1">
                    <label class="form-check-label" for="dvd">DVD</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->tv ==1) checked @endif id="tv" name="tv" value="1">
                    <label class="form-check-label" for="tv">Tv</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->power_seat ==1) checked @endif id="power_seat" name="power_seat" value="1">
                    <label class="form-check-label" for="tv">Power Seat</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->back_tire ==1) checked @endif id="back_tire" placeholder="back_tire" name="back_tire" value="1">
                    <label class="form-check-label" for="back_tire">Back Tire</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->grill_guard ==1) checked @endif id="grill_guard" placeholder="grill_guard" name="grill_guard" value="1">
                    <label class="form-check-label" for="grill_guard">Grill Guard</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->rear_spoiler ==1) checked @endif id="rear_spoiler" name="rear_spoiler" value="1">
                    <label class="form-check-label" for="rear_spoiler">Rear Spoiler</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->central_locking ==1) checked @endif id="central_locking" name="central_locking" value="1">
                    <label class="form-check-label" for="central_locking">Central Locking</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->jack ==1) checked @endif id="jack" name="jack" value="1">
                    <label class="form-check-label" for="jack">Jack</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->cd_player ==1) checked @endif id="spare_tire" name="spare_tire" value="1">
                    <label class="form-check-label" for="spare_tire">Spare Tire</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->wheel_spanner ==1) checked @endif id="wheel_spanner" name="wheel_spanner" value="1">
                    <label class="form-check-label" for="wheel_spanner">Wheel Spanner</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->fog_lights ==1) checked @endif id="fog_lights" name="fog_lights" value="1">
                    <label class="form-check-label" for="fog_lights">Fog Lights</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->cd_player ==1) checked @endif id="back_camera" name="back_camera" value="1">
                    <label class="form-check-label" for="back_camera">Back Camera</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->cd_player ==1) checked @endif id="push_start" name="push_start" value="1">
                    <label class="form-check-label" for="push_start">Push Start</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->keyless_entry ==1) checked @endif id="keyless_entry" name="keyless_entry" value="1">
                    <label class="form-check-label" for="keyless_entry">Keyless Entry</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->esc ==1) checked @endif id="esc" name="esc" value="1">
                    <label class="form-check-label" for="esc">ESC</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->deg_360_cam ==1) checked @endif id="deg_360_cam" name="deg_360_cam" value="1">
                    <label class="form-check-label" for="deg_360_cam">360 Degree Camera</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->body_kit ==1) checked @endif id="body_kit" name="body_kit" value="1">
                    <label class="form-check-label" for="body_kit">Body Kit</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->side_airbag ==1) checked @endif id="side_airbag" name="side_airbag" value="1">
                    <label class="form-check-label" for="side_airbag">Side Air Bag</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->power_mirror ==1) checked @endif id="power_mirror" name="power_mirror" value="1">
                    <label class="form-check-label" for="power_mirror">Power Mirror</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->side_skirts ==1) checked @endif id="side_skirts" name="side_skirts" value="1">
                    <label class="form-check-label" for="side_skirts">Side Skirts</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->front_lip_spoiler ==1) checked @endif id="front_lip_spoiler" name="front_lip_spoiler" value="1">
                    <label class="form-check-label" for="front_lip_spoiler">Front Lip Spoiler</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->navigation ==1) checked @endif id="navigation" name="navigation" value="1">
                    <label class="form-check-label" for="navigation">Navigation</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" @if($v->turbo ==1) checked @endif id="turbo" name="turbo" value="1">
                    <label class="form-check-label" for="turbo">Turbo</label>
                </div>

            </div>

            {{--<div class="col-md-6 col-12 mt-3">
                                    <div class="form-group mt-3">
                                        <label for="name">Video Link</label>
                                        <input type="text" id="v_link" value="{{old('v_link',$v->v_link)}}" class="form-control" placeholder="Video Link" name="v_link">
        </div>
    </div>--}}



    @if (session('failedUploads'))
    <h2>Failed Uploads:</h2>

    <ul class="list-unstyled">
        @foreach (session('failedUploads') as $failedUpload)
        <li class="text-danger">{{ $failedUpload['file'] }}: {{ $failedUpload['error'] }}</li>
        @endforeach
    </ul>
    @endif

    <!-- Additional content or form for retrying the failed uploads -->


    <div class="col-md-12 col-12 mt-3">
        <div class="form-group">
            <h4>Gallery Image</h4>
            <!-- <input type="file" id="image" class="form-control" name="image[]" multiple accept="image/*"> -->

            <div class="row add_image">
                <div class="col-3 mb-3">
                    <input type="file" class="dropify" data-height="300" name="image[]"/>
                </div> <!-- end col -->
                <div class="col-3 mb-3">
                    <input type="file" class="dropify" data-height="300" name="image[]"/>
                </div>
                <div class="col-3 mb-3">
                    <input type="file" class="dropify" data-height="300" name="image[]"/>
                </div> <!-- end col -->
                <div class="col-3 mb-3">
                    <input type="file" class="dropify" data-height="300" name="image[]"/>
                </div>  <!-- end col -->
            </div> <!-- end row -->
            </div>
            <button class="btn btn-info" onclick="add_image()" type="button">Add More</button>

       
    </div>


    <div class="col-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary m-1">Update</button>
    </div>
    </div>
    </form>
    <div class="col-md-12 col-12 mt-3">
        <form action="{{ route('gallery.delete') }}" method="post">
            @csrf
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary m-1">Delete selected images</button>
            </div>
            <div class="row gx-1">
                @forelse($v_images as $v_img)
                <div class="col col-md-1 mt-1 main-img">
                    <img class="img-fluid" src="{{asset('uploads/vehicle_images/'.$v_img->image)}}" alt="Card image cap">
                    @if(!$v_img->is_cover_img)
                    <a href="{{ route('gallery.cover',$v_img->id) }}" class="cover-img-box">Make Cover</a>
                    @else
                    <a href="" class="cover-img-box">Selected</a>
                    @endif
                    <input type="checkbox" name="delete[]" value="{{ $v_img->id }}">
                </div>
                @empty
                @endforelse
            </div>
        </form>
    </div>

    </div>
    </div>
    </div>
    </div>
</section>
<!-- // Basic multiple Column Form section end -->
</div>
@endsection
@push('scripts')
<script src="{{ asset('/assets/dropify/dropify.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $('.js-example-basic-multiple').select2({
            placeholder: "Select Country Arival"
        });
        /*if ('{{$v->reg_year}}')
            date = '{{$v->reg_year}}'
        else
            date = new Date();
        $('#reg_year').daterangepicker({
            singleDatePicker: true,
            startDate: moment(date).format('DD/MM/YYYY'),
            showDropdowns: true,
            autoUpdateInput: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        }).on('changeDate', function(e) {
            var date = moment(e.date).format('YYYY/MM/DD');
            $(this).val(date);
        }).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $(this).trigger('change');
        });*/


        /*Brand|Subbrand */
        $('#brand_id').on('change', function() {
            var brand_id = $(this).val();
            if (brand_id) {
                $.ajax({
                    url: "{{route('subBrandbyId')}}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        id: brand_id,
                    },
                    success: function(data) {
                        //console.log(data);
                        $('#sub_brand').empty();
                        $('#sub_brand').append('<option value="">Select a Sub Brand</option>');
                        $.each(data, function(key, value) {
                            $('#sub_brand').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#sub_brand').empty();
            }
        });
        var brand_id = $('#brand_id option:selected').val();
        var sub_brand_id = '{{$v->sub_brand_id}}';
        if (brand_id) {
            $.ajax({
                url: "{{route('subBrandbyId')}}",
                type: 'GET',
                dataType: 'json',
                data: {
                    id: brand_id,
                },
                success: function(data) {
                    //console.log(data);
                    $.each(data, function(key, value) {
                        if (sub_brand_id == value.id) {
                            $('#sub_brand').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
                        } else {
                            $('#sub_brand').append('<option value="' + value.id + '">' + value.name + '</option>');
                        }

                    });
                }
            });
        }

        $('#inv_locatin_id').on('change', function() {
            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    url: "{{route('portById')}}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        id: country_id,
                    },
                    success: function(data) {
                        //console.log(data);
                        $('#inv_port_id').empty();
                        $('#inv_port_id').append('<option value="">Select a Port</option>');
                        $.each(data, function(key, value) {
                            $('#inv_port_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#inv_port_id').empty();
            }
        });

        var country_id = $('#inv_locatin_id option:selected').val();
        var inv_port_id = '{{$v->inv_port_id}}';
        if (country_id) {
            $.ajax({
                url: "{{route('portById')}}",
                type: 'GET',
                dataType: 'json',
                data: {
                    id: country_id,
                },
                success: function(data) {
                    //console.log(data);
                    $.each(data, function(key, value) {
                        if (inv_port_id == value.id) {
                            $('#inv_port_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
                        } else {
                            $('#inv_port_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        }

                    });
                }
            });
        }
    });

    $(".dropify").dropify({messages:{default:"Drag and drop a file here or click",replace:"Drag and drop or click to replace",remove:"Remove",error:"Ooops, something wrong appended."},error:{fileSize:"The file size is too big (1M max)."}});
    function add_image(){
        $('.add_image').append('<div class="col-3 mb-3">\
                    <input type="file" class="dropify" data-height="300" name="image[]"/>\
                </div>');
                $(".dropify").dropify({messages:{default:"Drag and drop a file here or click",replace:"Drag and drop or click to replace",remove:"Remove",error:"Ooops, something wrong appended."},error:{fileSize:"The file size is too big (1M max)."}});
    }
</script>
@endpush