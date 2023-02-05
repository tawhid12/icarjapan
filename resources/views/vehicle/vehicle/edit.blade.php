@extends('layout.app')

@section('pageTitle','Edit Vehicle')
@section('pageSubTitle','Edit')

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
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" value="{{old('name',$v->name)}}" class="form-control" placeholder="Vehicle Name" name="name">
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="text-danger"> {{ $errors->first('name') }}</span>
                                        @endif
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
                                        <label for="brand_id">Vehicle Brand</label>
                                        <select name="brand_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($brands))
                                            @foreach($brands as $b)
                                            <option value="{{ $b->id}}" @if($b->id == $v->brand_id) selected @endif>{{$b->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="v_model_id">Vehicle Model</label>
                                        <select name="v_model_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($vehicle_models))
                                            @foreach($vehicle_models as $vm)
                                            <option value="{{ $vm->id}}" @if($vm->id == $v->v_model_id) selected @endif>{{$vm->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="version">Version</label>
                                        <input type="text" id="version" value="{{old('version',$v->version)}}" class="form-control" placeholder="Vehicle Version" name="version">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="m3">M3</label>
                                        <input type="text" id="m3" value="{{old('m3',$v->m3)}}" class="form-control" placeholder="M3" name="m3">
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
                                        <label for="name">Vehicle Model Code</label>
                                        <input type="text" id="model_code" value="{{old('model_code',$v->model_code)}}" class="form-control" placeholder="Vehicle Model Code" name="model_code">
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
                                        <label for="chassis_no">FOB</label>
                                        <input type="text" id="fob" value="{{old('fob',$v->fob)}}" class="form-control" placeholder="fob" name="fob">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="chassis_no">Steering</label>
                                        <select class="form-control" id="steering" name="steering">
                                            <option value="">Select</option>
                                            <option value="1">Left Hand Steering</option>
                                            <option value="2">Right Hand Steering</option>
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
                                            <option value="{{ $bd->id}}">{{$bd->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="sub_body_type_id">Sub Body Types</label>
                                        <select name="sub_body_type_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($sub_body_types))
                                            @foreach($sub_body_types as $sbd)
                                            <option value="{{ $sbd->id}}">{{$sbd->name}}</option>
                                            @endforeach
                                            @endif
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
                                            <option value="{{ $dt->id}}">{{$dt->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" id="price" value="{{old('price',$v->price)}}" class="form-control" placeholder="price" name="price">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="cc">CC</label>
                                        <input type="text" id="cc" value="{{old('cc',$v->cc)}}" class="form-control" placeholder="cc" name="cc">
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
                                        <label for="transmission_id">Transmission</label>
                                        <select name="transmission_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($trans))
                                            @foreach($trans as $t)
                                            <option value="{{ $t->id}}">{{$t->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="text" id="discount" value="{{old('discount',$v->discount)}}" class="form-control" placeholder="discount" name="discount">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="fuel_id">Fuel</label>
                                        <select name="fuel_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($fuel))
                                            @foreach($fuel as $f)
                                            <option value="{{ $f->id}}">{{$f->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="fuel_id">Color</label>
                                        <select name="color_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($colors))
                                            @foreach($colors as $c)
                                            <option value="{{ $c->id}}">{{$c->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="b_length">Body Length</label>
                                        <input type="text" id="b_length" value="{{old('b_length',$v->b_length)}}" class="form-control" placeholder="b_length" name="b_length">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="max_loading_capacity">Maximum Loading Capacity</label>
                                        <input type="text" id="max_loading_capacity" value="{{old('max_loading_capacity',$v->max_loading_capacity)}}" class="form-control" placeholder="max_loading_capacity" name="max_loading_capacity">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="e_size">Engine Size</label>
                                        <input type="text" id="e_size" value="{{old('e_size',$v->e_size)}}" class="form-control" placeholder="e_size" name="e_size">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <input type="date" id="year" value="{{old('year',$v->year)}}" class="form-control" placeholder="year" name="year">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="reg_year">Registration Year</label>
                                        <input type="date" id="reg_year" value="{{old('reg_year',$v->reg_year)}}" class="form-control" placeholder="reg year" name="reg_year">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="reg_year">Manufacture Year</label>
                                        <input type="date" id="manu_year" value="{{old('manu_year',$v->manu_year)}}" class="form-control" placeholder="manu_year" name="manu_year">
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="fuel_id">Inventory Location</label>
                                        <select name="inv_locatin_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($inv_loc))
                                            @foreach($inv_loc as $inv)
                                            <option value="{{ $inv->id}}">{{$inv->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                    <label for="description">Description</label>
                                        <textarea  class="form-control" rows="8" name="description">{{$v->manu_year}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                    <label for="note">Note</label>
                                        <textarea  class="form-control" rows="8" name="note">{{$v->note}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12 mt-3">
                                    <h4>Additional Vechicle Facility</h4>
                                    <div class="form-group">
                                        <input type="checkbox" id="air_bag"  placeholder="air_bag" name="air_bag" value="1" @if($v->air_bag ==1) checked @endif>
                                        <label for="air_bag">Air Bag</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="anti_lock_brake_system"  placeholder="anti_lock_brake_system" name="anti_lock_brake_system" value="1">
                                        <label for="anti_lock_brake_system">Anti Lock Brake System</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="air_con"  placeholder="air_con" name="air_con" value="1">
                                        <label for="air_con">Air Condition</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="back_tire"  placeholder="back_tire" name="back_tire" value="1">
                                        <label for="back_tire">Back Tire</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="fog_lights"  placeholder="fog_lights" name="fog_lights" value="1">
                                        <label for="fog_lights">Fog Lights</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="grill_guard"  placeholder="grill_guard" name="grill_guard" value="1">
                                        <label for="grill_guard">Grill Guard</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="leather_seats"  placeholder="leather_seats" name="leather_seats" value="1">
                                        <label for="leather_seats">Leather Seats</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="navigation"  placeholder="navigation" name="navigation" value="1">
                                        <label for="navigation">Navigation</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="power_steering"  name="power_steering" value="1">
                                        <label for="power_steering">Power Steering</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="power_windows"  name="power_windows" value="1">
                                        <label for="power_windows">Power Windows</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="roof_rails"  name="roof_rails" value="1">
                                        <label for="roof_rails">Roof Rails</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="rear_spoiler"  name="rear_spoiler" value="1">
                                        <label for="rear_spoiler">Rea Spoiler</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="sun_roof"  name="sun_roof" value="1">
                                        <label for="sun_roof">Sun Roof</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="tv"  name="tv" value="1">
                                        <label for="tv">Tv</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="dual_air_bags"  name="dual_air_bags" value="1">
                                        <label for="tv">Dual Air Bags</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 mt-3">
                                    <div class="form-group">
                                        <h4>Gallery Image</h4>
                                        <input type="file" id="image" class="form-control" name="image[]" multiple>
                                    </div>
                                    @forelse($v_images as $v_img)
                                    <div class="col col-md-3">
                                        <div class="card" style="width: 18rem;">
                                            <img class="card-img-top" src="{{asset('uploads/vehicle_images/'.$v_img->image)}}" alt="Card image cap">
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse
                                    <div class="form-group mt-3">
                                        <label for="name">Video Link</label>
                                        <input type="text" id="v_link" value="{{old('v_link')}}" class="form-control" placeholder="Video Link" name="v_link">
                                    </div>
                                </div>
                                    
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                    </div>
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