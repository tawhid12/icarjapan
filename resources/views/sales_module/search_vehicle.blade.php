@extends('layout.app')
@section('pageTitle',trans('Search'))
@section('pageSubTitle',trans('Vehicle Search'))
@push('styles')
<link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
  .form-control:focus {
    box-shadow: none;
  }

  .ui-widget {
    font-size: 0.8em;
  }
</style>
@endpush
@section('content')
<!-- Bordered table start -->
<section class="section">
  <div class="col-12">
    <div class="card">
      @include('layout.message')

      <div class="col-md-12">
        <div class="reserve-box p-3">
          <p>Reserve Vehicle</p>
          <form action="{{route(currentUser().'.reserve_list')}}">
            @csrf
            <div class="col-sm-12 d-flex justify-content-between">
              <div>
                <button type="submit" class="btn btn-primary btn-sm me-1"><i class="bi bi-search"></i></button>
                <a href="{{route(currentUser().'.search')}}" class="reset-btn btn btn-warning btn-sm"><i class="bi bi-arrow-repeat"></i></a>
              </div>

            </div>
          </form>
        </div>

      </div>
      {{--<form action="{{route('search_by_data')}}">
      @csrf()
      <!-- mid row 1 -->
      <div class="mid-row-1">
        <div class="input-group d-flex align-items-center mb-2">
          <span class="input-group-text">Search Car</span>
          <input type="hidden" name="sales_search" value="search">
          <input name="sdata" type="text" id="item_search" class="form-control ui-autocomplete-input" style="padding:6px .75rem" />
          <button type="submit" class="input-group-text"><i class="bi bi-search"></i></button>
        </div>
      </div>
      </form>--}}




      <form action="{{route('front_adv_search_by_data')}}">
        @csrf
        <input type="hidden" name="adv_search" value="sale_module_search">
        <div class="search-body-upper shadow p-3">
          <div class="row gx-1">
            <div class="col-sm-3 mb-3">
              <select name="brand" class="form-select form-select-md" id="brand_id" required>
                <option value="">Make:</option>
                @forelse($brands as $b)
                <option value="{{$b->id}}" @if(!empty($brand)) @if($b->id == $brand->id) selected @endif @endif>{{$b->name}}</option>
                @empty
                @endforelse
              </select>
            </div>
            <div class="col-sm-3 mb-3">
              <select name="sub_brand" class="form-select form-select-md" id="sub_brand" required>
                <option value="" selected>Model</option>
                {{--@forelse($sub_brands as $sb)
                <option value="{{$sb->id}}" @if(!empty($sub_brand)) @if($sb->id == $sub_brand->id) selected @endif @endif>{{$sb->name}}</option>
                @empty
                @endforelse--}}
              </select>
            </div>
            <!--<div class="col-sm-3 mb-3">
              <select class="form-select form-select-md">
                <option value="">Model Code:</option>
                @forelse($vehicle_models as $vm)
                <option value="{{$vm->id}}">{{$vm->name}}</option>
                @empty
                @endforelse
              </select>
            </div>-->
            <div class="col-sm-3 mb-3">
              <select name="steering" class="form-select form-select-md">
                <option value="">Steering:</option>
                <option value="1" @if(request()->get('steering') == 1) selected @endif>Right Hand Drive</option>
                <option value="2" @if(request()->get('steering') == 2) selected @endif>Left Hand Drive</option>
              </select>
            </div>
            <div class="col-sm-3 mb-3">
              <select name="body_type" class="form-select form-select-md" aria-label=".form-select-sm example">
                <option value="">Body Type:</option>
                @forelse($body_types as $bt)
                <option value="{{$bt->id}}" @if(request()->get('body_type') == $bt->id) selected @endif>{{$bt->name}}</option>
                @empty
                @endforelse
              </select>
            </div>
            <!--<div class="col-sm-3 mb-3">
              <select class="form-select form-select-md" aria-label=".form-select-sm example">
                <option value="">Sub Body Type:</option>
                @forelse($sub_body_types as $sb)
                <option value="{{$sb->id}}">{{$sb->name}}</option>
                @empty
                @endforelse
              </select>
            </div>-->
            <div class="col-sm-3 mb-3">
              <select name="drive_id" class="form-select form-select-md">
                <option value="">Drive:</option>
                @forelse($drive_types as $dt)
                <option value="{{$dt->id}}" @if(request()->get('drive_id') == $dt->id) selected @endif>{{$dt->name}}</option>
                @empty
                @endforelse
              </select>
            </div>
            <div class="col-sm-3 mb-3 d-flex">
              <select name="to_year" class="date-filter form-select form-select-md">
                <option value="">Year:</option>
                @php
                for ($i = $year_range[0]->minyear; $i <= $year_range[0]->maxyear; $i += 1) {
                  @endphp
                  <option value="{{$i}}" @if(request()->get('to_year') == $i) selected @endif>{{$i}}</option>
                  @php
                  }
                  @endphp
              </select>
              <!-- <select class="form-select form-select-md">
                <option value="">Mon:</option>
                @php
                for ($i =1; $i <= 12; $i++) { @endphp <option value="{{$i}}">{{$i}}</option>
                  @php
                  }
                  @endphp
              </select> -->
              <span>~</span>
              <select name="from_year" class="date-filtler form-select form-select-md">
                <option value="">Year:</option>
                @php
                for ($i = $year_range[0]->minyear; $i <= $year_range[0]->maxyear; $i += 1) {
                  @endphp
                  <option value="{{$i}}" @if(request()->get('from_year') == $i) selected @endif>{{$i}}</option>
                  @php
                  }
                  @endphp
              </select>
              <!-- <select class="date-filtler form-select form-select-md">
                <option value="">Mon:</option>
                @php
                for ($i =1; $i <= 12; $i++) { @endphp <option value="{{$i}}">{{$i}}</option>
                  @php
                  }
                  @endphp -->
              </select>
            </div>

            <div class="col-sm-3 mb-3 d-flex">
              <select name="from_price" class="form-select form-select-md">
                <option value="">Price Range:</option>
                <option value="501">USD 501</option>
                @php
                for ($i = 1001; $i <= 30001; $i +=1000) { @endphp <option value="{{$i}}" @if(request()->get('from_price') == $i) selected @endif>USD {{$i}}</option>
                  @php
                  }
                  @endphp
              </select>

              <span>~</span>
              <select name="to_price" class="form-select form-select-md">
                <option value="">Price Range:</option>
                <option value="500">USD 500</option>
                @php
                for ($i = 1000; $i <= 30000; $i +=1000) { @endphp <option value="{{$i}}" @if(request()->get('to_price') == $i) selected @endif>USD {{$i}}</option>
                  @php
                  }
                  @endphp
              </select>
            </div>

            <div class="col-sm-3 mb-3 d-flex">
              <select name="e_size_from" class="form-select form-select-md">
                <option value="">Engine Size (CC):</option>
                <option value="661" @if(request()->get('e_size_from') == 661) selected @endif>661 CC</option>
                <option value="1001" @if(request()->get('e_size_from') == 1001) selected @endif>1001 CC</option>
                <option value="1501" @if(request()->get('e_size_from') == 1501) selected @endif>1501 CC</option>
                <option value="1801" @if(request()->get('e_size_from') == 1801) selected @endif>1801 CC</option>
                <option value="2001" @if(request()->get('e_size_from') == 2001) selected @endif>2001 CC</option>
                <option value="2501" @if(request()->get('e_size_from') == 2501) selected @endif>2501 CC</option>
                <option value="3001" @if(request()->get('e_size_from') == 3001) selected @endif>3001 CC</option>
                <option value="4001" @if(request()->get('e_size_from') == 4001) selected @endif>4001 CC</option>
              </select>

              <span>~</span>
              <select name="e_size_to" class="form-select form-select-md">
                <option value="">Engine Size (CC):</option>
                <option value="660" @if(request()->get('e_size_to') == 660) selected @endif>660 CC</option>
                <option value="1000" @if(request()->get('e_size_to') == 1000) selected @endif>1000 CC</option>
                <option value="1500" @if(request()->get('e_size_to') == 1500) selected @endif>1500 CC</option>
                <option value="1800" @if(request()->get('e_size_to') == 1800) selected @endif>1800 CC</option>
                <option value="2000" @if(request()->get('e_size_to') == 2000) selected @endif>2000 CC</option>
                <option value="2500" @if(request()->get('e_size_to') == 2500) selected @endif>2500 CC</option>
                <option value="3000" @if(request()->get('e_size_to') == 3000) selected @endif>3000 CC</option>
                <option value="4000" @if(request()->get('e_size_to') == 4000) selected @endif>4000 CC</option>
              </select>
            </div>

            <div class="col-sm-3 mb-3 d-flex">
              <select name="mileage_from" class="form-select form-select-md">
                <option value="">Mileage:</option>
                @php for ($i = 10001; $i <= 100001; $i +=10000) { @endphp <option value="{{$i}}">{{$i}} km</option>
                  @php
                  }
                  @endphp
                  <option value="150001" @if(request()->get('mileage_from') == 150001) selected @endif>150001 km</option>
                  <option value="200001" @if(request()->get('mileage_from') == 200001) selected @endif>200001 km</option>
                  <option value="300001" @if(request()->get('mileage_from') == 300001) selected @endif>300001 km</option>
              </select>

              <span>~</span>
              <select name="mileage_to" class="form-select form-select-md">
                <option value="0">Milege:</option>
                @php for ($i = 10000; $i <= 100000; $i +=10000) { @endphp <option value="{{$i}}">{{$i}} km</option>
                  @php
                  }
                  @endphp
                  <option value="150000" @if(request()->get('mileage_to') == 150001) selected @endif>150000 km</option>
                  <option value="200000" @if(request()->get('mileage_to') == 150001) selected @endif>200000 km</option>
                  <option value="300000" @if(request()->get('mileage_to') == 150001) selected @endif>300000 km</option>
              </select>
            </div>
            <div class="col-sm-3 mb-3 d-flex">
              <select name="transmission_id" class="form-select form-select-md">
                <option value="">Transmission:</option>
                @forelse($trans as $t)
                <option value="{{$t->id}}" @if(request()->get('transmission_id') == $t->id) selected @endif>{{$t->name}}</option>
                @empty
                @endforelse
              </select>
            </div>
            <div class="col-sm-3 mb-3 d-flex">
              <select name="discount_from" class="form-select form-select-md">
                <option value="">Discount:</option>
                <option value="1">1%</option>
                @php for ($i = 10; $i <= 90; $i +=10) { @endphp <option value="{{$i}}" @if(request()->get('discount_from') == $i) selected @endif>{{$i}}%</option>
                  @php
                  }
                  @endphp
              </select>

              <span>~</span>
              <select name="discount_to" class="form-select form-select-md">
                <option value="0">Discount:</option>
                @php for ($i = 9; $i < 100; $i +=10) { @endphp <option value="{{$i}}" @if(request()->get('discount_to') == $i) selected @endif>{{$i}}%</option>
                  @php
                  }
                  @endphp
              </select>
            </div>

            <div class="col-sm-3 mb-3 d-flex">
              <select name="fuel_id" class="form-select form-select-md">
                <option vale="">Fuel:</option>
                @forelse($fuel as $f)
                <option value="{{$f->id}}" @if(request()->get('fuel_id') == $f->id) selected @endif>{{$f->name}}</option>
                @empty
                @endforelse
              </select>
            </div>
            <div class="col-sm-3 mb-3 d-flex">
              <select name="ext_color_id" class="form-select form-select-md">
                <option value="">Exterior Color:</option>
                @forelse($colors as $c)
                <option value="{{$c->id}}" @if(request()->get('ext_color_id') == $c->id) selected @endif>{{$c->name}}</option>
                @empty
                @endforelse
              </select>
            </div>
            <!-- <div class="col-sm-3 mb-3 d-flex more-details">
              <a href="#myCollapsible" data-bs-toggle="collapse">+ More Details</a>
            </div> -->
            <!-- Collapsible section that is initially collapsed -->

            <!-- <div class="collapse" id="myCollapsible">
              <div class="row gx-1"> -->

            <!--<div class="col-sm-3 mb-3 d-flex">
                  <select name="b_length" class="form-select form-select-md">
                    <option value="">Body Length:</option>
                    <option value="1">Under 3400 MM</option>
                    <option value="2">3400 to 4000 MM</option>
                    <option value="3">4500 to 4700 MM</option>
                    <option value="4">4700 to 4950 MM</option>
                    <option value="5">4950 to 5000 MM</option>
                    <option value="6">5000 to 5001 MM</option>
                    <option value="7">Over 5000 MM</option>
                  </select>
                </div>-->
            <div class="col-sm-3 mb-3 d-flex">
              <select name="max_loading_capacity" class="form-select form-select-md">
                <option value="">Max Loading Cepacity:</option>
                <option value="1">Under 1 Ton</option>
                <option value="2">1 to 2 Ton</option>
                <option value="3">2 to 2.5 Ton</option>
                <option value="4">3 to 4 Ton</option>
                <option value="5">4 to 5 Ton</option>
                <option value="6">5 to 6 Ton</option>
                <option value="6">6 to 7 Ton</option>
                <option value="6">7 to 8 Ton</option>
                <option value="6">8 to 9 Ton</option>
                <option value="6">9 to 10 Ton</option>
                <option value="7">Over 10 Ton</option>
              </select>
            </div>
            <!--<div class="col-sm-3 mb-3 d-flex">
                  <select class="form-select form-select-md">
                    <option value="">Engine Type:</option>
                  </select>
                </div>-->
            @if($max_manu_Year && $min_manu_Year)
            <div class="col-sm-3 mb-3 d-flex">
              <select class="form-select form-select-md">
                <option value="">Prod Year:</option>
                @php
                for ($i = $max_manu_Year; $i >= $min_manu_Year; $i --) {
                @endphp
                <option value="{{$i}}">{{$i}}</option>
                @php
                }
                @endphp
              </select>
              <span>~</span>
              <select class="form-select form-select-md">
                <option value="">Prod Year:</option>
                @php
                for ($i = $max_manu_Year; $i >= $min_manu_Year; $i --) {
                @endphp
                <option value="{{$i}}">{{$i}}</option>
                @php
                }
                @endphp
              </select>
            </div>
            @endif
            <!--<div class="col-sm-3 mb-3 d-flex">
                  <select class="form-select form-select-md">
                    <option value="0">Truck Size:</option>
                    <option value="1">Large Truck</option>
                    <option value="2">Medium Truck</option>
                    <option value="3">Small Truck</option>
                    <option value="4">Multicab</option>
                  </select>
                </div>-->
            <div class="col-sm-3 mb-3 d-flex">
              <select name="inv_locatin_id" class="form-select form-select-md">
                <option value="">Inventory Location:</option>
                @forelse($inv_loc as $inv)
                <option value="{{$inv->id}}" @if(request()->get('inv_locatin_id') == $inv->id) selected @endif>
                  {{optional($inv->country)->name}}
                </option>
                @empty
                @endforelse
              </select>
            </div>
            <!--<div class="col-sm-3 mb-3 d-flex">
                  <select class="form-select form-select-md">
                    <option value="0">Port:</option>
                  </select>
                </div>-->
          </div>

          <div class="row gx-1">
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="air_bag" />
                <label class="form-check-label" for="exampleCheck1">Air Bag</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="anti_lock_brake_system" />
                <label class="form-check-label" for="exampleCheck1">Anti-Lock Brake System</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="air_con" />
                <label class="form-check-label" for="exampleCheck1">Air Conditioner</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="alloy_wheels" />
                <label class="form-check-label" for="exampleCheck1">Alloy Wheels</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="back_tire" />
                <label class="form-check-label" for="exampleCheck1">Back Tire</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="fog_lights" />
                <label class="form-check-label" for="exampleCheck1">Fog Lights</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="grill_guard" />
                <label class="form-check-label" for="exampleCheck1">Grill Guard</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="leather_seat" />
                <label class="form-check-label" for="exampleCheck1">Leather Seats</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="navigation" />
                <label class="form-check-label" for="exampleCheck1">Navigation</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="power_steering" />
                <label class="form-check-label" for="exampleCheck1">Power Steering</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="power_windows" />
                <label class="form-check-label" for="exampleCheck1">Power Windows</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                <label class="form-check-label" for="exampleCheck1">Roof Rails</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rear_spoiler" />
                <label class="form-check-label" for="exampleCheck1">Rear Spoiler</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="sun_roof" />
                <label class="form-check-label" for="exampleCheck1">Sun Roof</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="tv" />
                <label class="form-check-label" for="exampleCheck1">TV</label>
              </div>
            </div>
            <div class="col-sm-2 my-1 d-flex">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                <label class="form-check-label" for="exampleCheck1">Dual Air Bags</label>
              </div>
            </div>
          </div>

          <div class="col-sm-12 mb-3">
            <input type="checkbox" class="form-check-input" id="sbt" name="sbt_stocks" />
            <label class="form-check-label me-3 sbt-stock sbt-checkbox" for="sbt">ICAR Stocks</label>

            <input type="checkbox" class="form-check-input" id="partner" name=partner_stocks />
            <label class="form-check-label me-3 partner sbt-checkbox" for="partner">Partner's Stocks</label>

            <input type="checkbox" class="form-check-input" id="new" class="new-arival" />
            <label class="form-check-label me-3 new sbt-checkbox" for="new">New Arrival</label>

            <!-- <label class="form-check-label me-3" for="exampleCheck1">3 Emission Code</label>
                <input type="checkbox" class="form-check-input" id="exampleCheck1" /> -->

            <input type="checkbox" class="form-check-input" id="img-360" name="360_img" />
            <label class="form-check-label me-3 img-360" for="360_img">360Degree</label>


          </div>

          <div class="col-sm-12 d-flex justify-content-end my-1">
            <button type="submit" class="btn btn-primary btn-sm me-1"><i class="bi bi-search"></i></button>
            <a href="{{route(currentUser().'.search')}}" class="reset-btn btn btn-warning btn-sm"><i class="bi bi-arrow-repeat"></i></a>
          </div>
          <!-- </div> -->

        </div>

        <!-- left Total Calculation-->
        <!--<div class="search-left-4 my-3">
            <div class="price-calc search-body shadow p-2">
              <div class="row gx-1">
                <div class="col-3">
                  <div class="col-sm-12">
                    <span class="price-heading">Total Price Calculator</span>
                  </div>
                  <p>
                    Estimate the price of the vehicle(s) based on your destination.
                    <span>Note:</span> In some cases the total price cannot be estimated.
                  </p>
                </div>
                <div class="col-md-4">
                  <div class="row mb-1">
                    <div class="col-md-5">
                      <label class="price-label">Destination Country:</label>
                    </div>
                    <div class="col-md-7">
                      <select class="price-select form-select form-select-sm">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-5">
                      <label class="price-label">Destination Port:</label>
                    </div>
                    <div class="col-md-7">
                      <select class="price-select form-select form-select-sm">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-5">
                      <label class="price-label">Shipment:</label>
                    </div>
                    <div class="col-md-7">
                      <select class="price-select form-select form-select-sm">
                        <option value="">Select</option>
                        <option value="1">Roro</option>
                        <option value="2">Container</option>
                      </select>
                    </div>
                  </div>-->
        <!--<div class="row mb-1">
                    <div class="col-md-5">
                      <label class="price-label">Freight:</label>
                    </div>
                    <div class="col-md-7">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="" value="1">
                        <label class="form-check-label" for="">Roro</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="" value="2">
                        <label class="form-check-label" for="">Container</label>
                      </div>
                    </div>
                  </div>-->
        <!--</div>
                <div class="col-md-4">
                  <div class="row mb-1">
                    <div class="col-md-5">
                      <label class="price-label">Currency:</label>
                    </div>
                    <div class="col-md-7">
                      <select class="price-select form-select form-select-sm">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-5">
                      <label class="price-label">Inspection:</label>
                    </div>
                    <div class="col-md-7">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input checkinp" type="radio" id="" value="1">
                        <label class="form-check-label" for="">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="" value="2">
                        <label class="form-check-label" for="">No</label>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-5">
                      <label class="price-label">Insurance:</label>
                    </div>
                    <div class="col-md-7">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input checkinp" type="radio" id="" value="1">
                        <label class="form-check-label" for="">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="" value="2">
                        <label class="form-check-label" for="">No</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 d-flex justify-content-end">
                  <button type="button" class="btn btn-primary btn-sm">
                    Calculate
                  </button>
                </div>
              </div>
            </div>
          </div>-->


      </form>

      <div class="container">
        @if(!empty($vehicles) && !empty($countries))
        <h4>Search Results</h4>
        <div class="single-vehicle p-2 my-3">
          <div class="row">
            @forelse($vehicles as $v)

            <div class="col-md-2">
              @php $cover_img = \DB::table('vehicle_images')->where('vehicle_id',$v->id)->where('is_cover_img',1)->first(); @endphp
              @if($cover_img)
              <img src="{{asset('uploads/vehicle_images/'.$cover_img->image)}}" alt="" width="210px" height="140px" />
              @else
              <img src="{{asset('uploads/default/comingsoon_l.png')}}" alt="" alt="" width="210px" height="140px" />
              @endif
              <p class="stock-text m-0">Stock ID : {{$v->stock_id}}</p>

            </div>
            <div class="col-md-10">
              <div class="col-md-12 d-flex justify-content-between align-items-center">
                <span class="v-tag"><a href="">New Arival</a></span>
                <div class="d-flex justify-content-end align-items-center">
                  <!-- Add | Check Favourite -->
                  @php $fav_exixts = \DB::table('favourite_vehicles')->where('vehicle_id',$v->id)->where('user_id',currentUserId())->first(); @endphp
                  @if(!$fav_exixts)
                  <form method="post" id="withdraw-active-form" action="{{route(currentUser().'.favourvehicle.store')}}" style="display: inline;">
                    @csrf
                    <input name="vehicle_id" type="hidden" value="{{$v->id}}">
                    <a href="javascript:void(0)" data-name="{{$v->fullName}}" class="fav btn btn-secondary btn-sm" data-toggle="tooltip" title="favourite"><i class="fa fa-heart"></i>Add to Favorites</a>
                  </form>
                  @else
                  <button class="btn btn-sm btn-success">Already In Favourite List</button>
                  @endif
                  @if($v->r_status != null && $v->sold_status == 0)
                  <button class="ms-2 btn btn-sm btn-danger"><strong>Reserved</strong></button>
                  {{--For | CM ID:-\DB::table('reserved_vehicles')->where('vehicle_id',$v->id)->first()->user_id--}}
                  @endif
                  @if($v->sold_status)
                  <button class="ms-2 btn btn-sm btn-success"><strong>SOLD</strong></button>
                  @endif

                  <!-- Add | Cehck Reserve -->
                  @if($v->r_status == null)
                  <a data-vehicle-id="{{ $v->id }}" data-fullName="{{ $v->fullName }}" href="#" data-bs-toggle="modal" data-bs-target="#reserveModal" class="ms-2 d-inline-block btn btn-primary btn-sm" title="Reserve">Reserve</a>
                  @endif
                </div>


              </div>
              <div class="heading d-flex justify-content-between">

                <h6 class="v-heading">{{--<a href="{{route('singleVehicle',['brand'=>$v->b_slug,'subBrand'=>$v->sb_slug,'stock_id'=>$v->stock_id])}}">--}}{{strtoupper($v->fullName)}}{{--</a>--}}</h5>
                  @if($v->inv_locatin_id)
                  @php $inventory_loc = \DB::table('countries')->where('id',$v->inv_locatin_id)->first();@endphp
                  <p class="m-0 stock-text" style="font-size:medium">Inventory Location <i class="fa fa-flag"></i><span>{{$inventory_loc->name}}</span></p>
                  @endif
              </div>
              <div class="row gx-1">
                <div class="col-md-3">
                  <div class="">
                    @php
                    $actual_price = $v->price;
                    $dis_price = $v->price*$v->discount/100;
                    $price_after_dis = ($actual_price-$dis_price);
                    @endphp
                    <p class="price-text m-0">Vehicle Price:


                      <span>USD {{$price_after_dis}}</span>
                    </p>
                    @if($v->discount > 0)
                    <del>USD {{$actual_price}}</del>
                    @endif

                  </div>
                  <p class="price-text m-0">Total Price: <span>${{number_format($price_after_dis, 2, ',', ',')}}</span></p>
                  @if($v->discount > 0)
                  <p>Save: {{$v->discount}}</p>
                  @endif

                </div>
                <div class="col-md-9">
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
            @empty
            @endforelse

          </div>
        </div>
        <div class="pt-2">
          {{ $vehicles->links() }}
        </div>
        @endif
      </div>

    </div>
  </div>
</section>

<div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="reserveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form class="form" method="post" action="{{route(currentUser().'.reservevehicle.store')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="vehicle_id" id="vehicle_id">
        <div class="modal-header text-center">
          <h4 class="modal-title" id="addNoteModalLabel"></h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <h5 class="text-primary text-center">Reserve Vehicle :-<span id="fullname"></span></h5>
        <div class="modal-body" id="clientData">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Reserve</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="{{ asset('front/js/jquery-ui.min.js') }}"></script>`
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $('#reserveModal').on('show.bs.modal', function(event) {
    $('#clientData').empty();
    var button = $(event.relatedTarget);
    var vehicle_id = button.data('vehicle-id');
    var fullname = button.data('fullname');
    var modal = $(this);
    modal.find('#vehicle_id').val(vehicle_id);
    modal.find('#fullname').text(fullname);

    $.ajax({
      url: "{{route(currentUser().'.all_client_list_json')}}",
      method: 'GET',
      dataType: 'json',
      success: function(res) {
        console.log(res.data);
        $('#clientData').append(res.data);
      },
      error: function(e) {
        console.log(e);
      }
    });

  });
  $(document).ready(function() {
    $('.js-example-basic-single').select2();

    $("#item_search").autocomplete({
      source: function(data, cb) {
        //console.log(data);
        $.ajax({
          autoFocus: true,
          url: "{{route('searchStData')}}", //To Get Data
          method: 'GET',
          dataType: 'json',
          data: {
            sdata: data.term
          },
          success: function(res) {
            console.log(res);
            var result;
            result = {
              label: 'No Records Found ',
              value: ''
            };
            if (res.length) {
              result = $.map(res, function(el) {
                console.log(el);
                return {
                  label: el,
                  value: '',
                  id: el
                };
              });
            }
            cb(result);
          },
          error: function(e) {
            console.log(e);
          }
        });
      },
      response: function(e, ui) {
        /*if (ui.content.length == 1) {
        	$(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
        	$(this).autocomplete("close");
        }*/
        //console.log(ui);
      },
      //loader start
      search: function(e, ui) {},
      select: function(e, ui) {
        if (typeof ui.content != 'undefined') {
          if (isNaN(ui.content[0].id)) {
            return;
          }
          //var student_id = ui.content[0].id;
        } else {
          //var student_id = ui.item.id;
        }

        //return_row_with_data(student_id);
        $("#item_search").val('');
      },
      //loader end
    });
    /*$("input[name='created_at']").daterangepicker({
        singleDatePicker: true,
        startDate: new Date(),
        showDropdowns: true,
        autoUpdateInput: true,
        locale: {
            format: 'DD/MM/YYYY'
        }
    }).on('apply.daterangepicker', function(e, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY'));
    });*/


  });
  $('.fav').on('click', function(event) {
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Want to Add this vehicle ${name} As Favourite?`,
        icon: "success",
        buttons: true,
        dangerMode: false,
      })
      .then((willDelete) => {
        if (willDelete) {
          $(this).parent().submit();
        }
      });
  });


  $(document).ready(function() {
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
            $('#sub_brand').append('<option value="">Select a Model</option>');
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
    var sub_brand = "{{request()->get('sub_brand')}}";
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
            if (sub_brand == value.id) {
              $('#sub_brand').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
            } else {
              $('#sub_brand').append('<option value="' + value.id + '">' + value.name + '</option>');
            }

          });
        }
      });
    }
  });
</script>
@endpush