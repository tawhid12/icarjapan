@extends('layout.landing')
@section('pageTitle','ICARJAPAN')
@section('pageSubTitle','HOME')
@section('content')
<!-- main section -->
<main class="my-4">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-2 container-xl-2 left-col">
        <!-- left row 1 -->
        <div class="left-row-1 mb-3">
          <a href="#">
            <img class="img-fluid" src="{{asset('front/img/left-top-catagory-banner.png')}}" alt="" />
          </a>
        </div>
        <!-- left row 2 -->
        <div class="left-row-2 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-brand text-white">
              ICarJapan Bangladesh
            </h5>
            <div class="card-body">
              <p class="card-text">
                <i class="bi bi-geo-alt-fill"></i> Dhaka
              </p>
              <p class="card-text">
                <i class="bi bi-telephone-fill"></i> +880 123 4567809
              </p>
            </div>
          </div>
        </div>
        <!-- left row 3 -->
        <div class="left-row left-row-3 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-brand text-white">Search by Brands</h5>
            <div class="card-body">
              @forelse($brands as $b)
              <p class="card-text">
                <a href="{{route('brand',strtolower($b->name))}}" style="text-decoration:none;color:#000;"><img src="{{asset('uploads/brands/'.$b->image)}}" alt="" /> {{$b->name}}</a>
              </p>
              @empty
              @endforelse
            </div>
          </div>
        </div>
        <!-- left row 4 -->
        <div class="left-row left-row-4 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-brand text-white">
              Search By Inventory Location
            </h5>
            <div class="card-body">
              <p class="card-text">
                @forelse($inv_loc as $inv)
              <p class="card-text">
                <a href="" style="text-decoration:none;color:#000;"><img src="{{asset('uploads/brands/'.$inv->image)}}" alt="" /> {{$inv->name}}</a>
              </p>
              @empty
              @endforelse
              </p>
            </div>
          </div>
        </div>
        <!-- left row 5 -->
        <div class="left-row left-row-5 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-brand text-white">Search By Price</h5>
            <div class="card-body">
              @php
              for ($i = $price_range[0]->minprice; $i <= $price_range[0]->maxprice; $i += 500) {
                @endphp
                <p class="card-text">
                  <i class="bi bi-currency-dollar"></i> Under USD {{$i}}
                </p>
                @php
                }
                @endphp
            </div>
          </div>
        </div>
        <!-- left row 6 -->
        <div class="left-row left-row-6 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-brand text-white">
              Search By Discount
            </h5>
            <div class="card-body">
              @php
              for ($i = $discount_range[0]->mindis; $i <= $discount_range[0]->maxdis; $i += 10) {
                @endphp
                <p class="card-text">
                  <i class="bi bi-funnel"></i> Up to {{$i}}%
                </p>
                @php
                }
                @endphp
            </div>
          </div>
        </div>
        <!-- left row 7 -->
        <div class="left-row left-row-7 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-brand text-white">Search By Type</h5>
            <div class="card-body">
              @forelse($body_types as $bt)
              <p class="card-text">
                <a href="" style="text-decoration:none;color:#000;"><i class="bi bi-car-front-fill"></i>{{$bt->name}} (2798)</a>
              </p>
              @empty
              @endforelse
            </div>
          </div>
        </div>
        <!-- left row 8 -->
        <div class="left-row left-row-8 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-brand text-white">
              Search By Category
            </h5>
            <div class="card-body">
              @forelse($trans as $t)
              <p class="card-text">
                <i class="bi bi-arrows-move"></i>{{$t->name}} (2798)
              </p>
              @empty
              @endforelse
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-12 col-lg-8 container-xl-8">

        <h6>Vehicle Images</h6>
        <div class="row">
          @forelse($v_images as $v_img)
          <div class="col-4">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{asset('uploads/vehicle_images/'.$v_img->image)}}" alt="Card image cap">
            </div>
          </div>
          @empty
          @endforelse
        </div>

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

        <!-- review section start -->
        <div class="review">
          <div class="review-header">
            <div class="row">
              <div class="col-sm-4 d-flex">
                <i class="bi bi-brightness-high"></i>
                <p>Customer Review</p>
              </div>
              <div class="col-sm-4 d-flex justify-content-center">
                <p>2,337 Reviews</p>
              </div>
              <div class="col-sm-4 d-flex justify-content-end">
                <a href="#">See More <i class="bi bi-arrow-right-circle"></i></a>
              </div>
            </div>
          </div>
          <div class="review-user-body my-3">
            <div class="row">
              <div class="col-sm-3 review-user-p-img">
                <img class="img-fluid" src="{{asset('front/img/review.png')}}" alt="" />
              </div>
              <div class="col-sm-6 review-user">
                <div class="d-flex">
                  <img class="img-fluid" src="{{asset('front/img/bdf.png')}}" alt="" />
                  <div>
                    <p>Shibly S.</p>
                    <p>Nov 14, 2020</p>
                  </div>
                </div>
                <p>2018 Premio F EX grade 5</p>
                <p>Wonderful car and amazing price. Thanks SBT</p>
              </div>
              <div class="col-sm-3 review-status d-flex justify-content-end">
                <div>
                  <p>Review on -</p>
                  <p>Toyota Premio</p>
                </div>
              </div>
            </div>
          </div>
          <div class="review-user-body my-3">
            <div class="row">
              <div class="col-sm-3 review-user-p-img">
                <img class="img-fluid" src="{{asset('front/img/review.png')}}" alt="" />
              </div>
              <div class="col-sm-6 review-user">
                <div class="d-flex">
                  <img class="img-fluid" src="{{asset('front/img/bdf.png')}}" alt="" />
                  <div>
                    <p>Shibly S.</p>
                    <p>Nov 14, 2020</p>
                  </div>
                </div>
                <p>2018 Premio F EX grade 5</p>
                <p>Wonderful car and amazing price. Thanks SBT</p>
              </div>
              <div class="col-sm-3 review-status d-flex justify-content-end">
                <div>
                  <p>Review on -</p>
                  <p>Toyota Premio</p>
                </div>
              </div>
            </div>
          </div>
          <div class="review-user-body my-3">
            <div class="row">
              <div class="col-sm-3 review-user-p-img">
                <img class="img-fluid" src="{{asset('front/img/review.png')}}" alt="" />
              </div>
              <div class="col-sm-6 review-user">
                <div class="d-flex">
                  <img class="img-fluid" src="{{asset('front/img/bdf.png')}}" alt="" />
                  <div>
                    <p>Shibly S.</p>
                    <p>Nov 14, 2020</p>
                  </div>
                </div>
                <p>2018 Premio F EX grade 5</p>
                <p>Wonderful car and amazing price. Thanks SBT</p>
              </div>
              <div class="col-sm-3 review-status d-flex justify-content-end">
                <div>
                  <p>Review on -</p>
                  <p>Toyota Premio</p>
                </div>
              </div>
            </div>
          </div>
          <div class="review-user-body my-3">
            <div class="row">
              <div class="col-sm-3 review-user-p-img">
                <img class="img-fluid" src="{{asset('front/img/review.png')}}" alt="" />
              </div>
              <div class="col-sm-6 review-user">
                <div class="d-flex">
                  <img class="img-fluid" src="{{asset('front/img/bdf.png')}}" alt="" />
                  <div>
                    <p>Shibly S.</p>
                    <p>Nov 14, 2020</p>
                  </div>
                </div>
                <p>2018 Premio F EX grade 5</p>
                <p>Wonderful car and amazing price. Thanks SBT</p>
              </div>
              <div class="col-sm-3 review-status d-flex justify-content-end">
                <div>
                  <p>Review on -</p>
                  <p>Toyota Premio</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</main>
@endsection
@push('scripts')
<script>
  $(document).ready(function() {
    var lang_id = $('#lang_id option:selected').val();
    var country_id = $('#country_id option:selected').val();
    var currency_opt = $('#currency_opt option:selected').val();
    /*$('#country_id').on('change',function(){
        alert($(this).val())
        $.ajax({
					url: "",
					method: 'GET',
					dataType: 'json',
					data: {
						currency: currency_opt,
						language:lang_id,
						country:1
					},
					success: function(data) {
						console.log(data);
          //alert(window.location.href = '{{url('/')}}?currency='+res.currency+'&language='+res.language+'&country='+res.country);

					},
					error: function(e) {
						console.log(e);
					}
				});
      });*/

  });
</script>
@endpush