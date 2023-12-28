@extends('layout.landing')
@php
$trans = \App\Models\Vehicle\Transmission::withCount('vehicles')->get();
$brands = \App\Models\Vehicle\Brand::withCount('vehicles')->get();
$vehicle_models = \App\Models\Vehicle\VehicleModel::all();
$body_types = \App\Models\Settings\BodyType::withCount('vehicles')->get();
$sub_body_types = \App\Models\Settings\SubBodyType::all();
$drive_types = \App\Models\Settings\DriveType::all();
$year_range = DB::table('vehicles')->select(\DB::raw('MIN(manu_year) AS minyear, MAX(manu_year) AS maxyear'))->get()->toArray();
$fuel= \App\Models\Vehicle\Fuel::all();
$colors = \App\Models\Vehicle\Color::all();
/*====Manufacture year====Max===Min*/
$max_manu_Year = DB::table('vehicles')->max(DB::raw('YEAR(manu_year)'));
$min_manu_Year = DB::table('vehicles')->min(DB::raw('YEAR(manu_year)'));

$inv_loc = \App\Models\Settings\InventoryLocation::all();

@endphp
@section('pageTitle','ICARJAPAN')
@section('pageSubTitle','Search')
@push('styles')
<style>
  .form-select-sm {
    font-size: 12px !important;
    padding-left: 0.32rem;
  }

  .custom-table td {
    background-color: #d0f0ed;
    border-right: 2px solid #ddd;
    font-size: 12px;
  }

  .search-body-upper {
    background-color: #EDEDED;
    padding: 3px 5px 6px;
    border: 1px solid #d3d3d3;
    box-shadow: 1px 1px 5px #dfdede, 1px 1px 3px #dfdede;
  }

  .price-calc {
    background-color: #d3d3d3;
    padding: 5px 10px;
    margin-bottom: 5px;
  }

  .price-label {
    font-size: 12px;
  }

  .price-calc p {
    font-size: 12px;
    margin: 0;
  }

  .form-select {
    font-size: 12px;
    padding: 4px;
    background-position: right 4px center;
    background-size: 8px;
    color: #000;
  }

  .form-select-md option {
    font-size: 12px;
  }

  .custom-border-bottom-dark {
    border: 1px #808080 solid;
  }

  .price-heading,
  .more-details a {
    font-size: 16px;
    color: navy;
    font-weight: 700;
  }

  label.form-check-label {
    font-size: 12px;
  }

  .sbt-stock {
    background-color: #e60012;
    color: #ffffff;
  }

  .sbt-checkbox {
    font-weight: 600;
    display: inline-block;
    font-size: 11px !important;
    min-width: 99px;
    vertical-align: 1px;
    text-align: center;
    line-height: 21px;
    border-radius: 4px;
    padding-left: 10px;
    padding-right: 10px;
  }

  .partner {
    background-color: #009de6;
    color: #ffffff;
  }

  .new {
    background-color: #ff9e00;
    color: #ffffff;
  }

  .img-360 {
    background-image:url("{{asset('uploads/default/360.png')}}");
    width: auto;
    padding-left: 5px;
    padding-right: 5px;
    background-color: #e7f40b;
    font-weight: 700;
    -moz-box-shadow: 1px 0 0 #ea8b00 inset, -1px 0 0 #ea8b00 inset, 0 1px 0 #ea8b00 inset, 0 -1px 0 #ea8b00 inset;
    -webkit-box-shadow: 1px 0 0 #ea8b00 inset, -1px 0 0 #ea8b00 inset, 0 1px 0 #ea8b00 inset, 0 -1px 0 #ea8b00 inset;
    -ms-box-shadow: 1px 0 0 #ea8b00 inset, -1px 0 0 #ea8b00 inset, 0 1px 0 #ea8b00 inset, 0 -1px 0 #ea8b00 inset;
    -o-box-shadow: 1px 0 0 #ea8b00 inset, -1px 0 0 #ea8b00 inset, 0 1px 0 #ea8b00 inset, 0 -1px 0 #ea8b00 inset;
    box-shadow: 2px 0 0 #574b4b inset, -2px 0 0 #574b4b inset, 0 2px 0 #574b4b inset, 0 -2px 0 #574b4b inset;
    width: 62px;
    height: 20px;
    background-position: center center;
    background-size: contain;
    background-repeat: no-repeat;
  }


  .single-vehicle {
    border-bottom: 1px solid #dbdbdb;
  }

  .single-vehicle:hover {
    background-color: #ffeddf;
  }

  .v-tag {
    background-color: #ff9e00;
    font-size: 12px !important;
    text-align: center !important;
    padding: 3px 3px 2px;
  }

  .v-tag a {
    color: #1167a8;
    font-weight: 700;
    text-decoration: none;
  }

  .v-heading {
    font-size: 24px;
  }

  .v-heading a {
    color: #1167a8;
    font-weight: 700;
  }

  .stock-text {
    color: #D3D3D3;
    font-size: 14px;
  }

  a.fav {
    text-decoration: none;
    letter-spacing: 1px;
    font-size: 15px;
    font-weight: 700;
  }

  .price-text {
    font-size: 15px;
    font-weight: 900;
  }

  .price-text span {
    color: red;
  }

  .feature-text {
    font-size: 14px;
  }

  .bg-button {
    font-weight: 700;
    font-size: 20px;
    text-decoration: none;
    background-color: red;
    color: #fff;
    padding: 6px 42px;
    border-radius: 0;
  }

  .bg-button:hover {
    outline: 1px solid red;
    color: #fff;
    background-color: red;
  }
</style>
@endpush
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
        @include('front.partial.brand-side-bar')
        @include('front.partial.inventory-side-bar')
        @include('front.partial.price-side-bar')
        @include('front.partial.discount-side-bar')
        @include('front.partial.type-side-bar')
        <!-- left row 8 -->
        <div class="left-row left-row-8 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-black text-white">
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
      <div class="col-sm-12 col-md-12 col-lg-10 container-xl-7">
        <!-- breadcrumb -->
        @include('partials.breadcrumbs')
        @include('front.search-box')
        <form action="{{route('front_adv_search_by_data')}}">
          @csrf
          <input type="hidden" name="adv_search" value="search">
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
                  <input type="checkbox" class="form-check-input" id="air_bag" name="air_bag" />
                  <label class="form-check-label" for="air_bag">Air Bag</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="anti_lock_brake_system" name="anti_lock_brake_system" />
                  <label class="form-check-label" for="anti_lock_brake_system">Anti-Lock Brake System</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="air_con" name="air_con" />
                  <label class="form-check-label" for="air_con">Air Conditioner</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="alloy_wheels" name="alloy_wheels" />
                  <label class="form-check-label" for="alloy_wheels">Alloy Wheels</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="back_tire" name="back_tire" />
                  <label class="form-check-label" for="back_tire">Back Tire</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="fog_lights" name="fog_lights" />
                  <label class="form-check-label" for="fog_lights">Fog Lights</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="grill_guard" name="grill_guard" />
                  <label class="form-check-label" for="grill_guard">Grill Guard</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="leather_seat" name="leather_seat" />
                  <label class="form-check-label" for="leather_seat">Leather Seats</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="navigation" name="navigation" />
                  <label class="form-check-label" for="navigation">Navigation</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="power_steering" name="power_steering" />
                  <label class="form-check-label" for="power_steering">Power Steering</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="power_windows" name="power_windows" />
                  <label class="form-check-label" for="power_windows">Power Windows</label>
                </div>
              </div>
              <!-- <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                  <label class="form-check-label" for="exampleCheck1">Roof Rails</label>
                </div>
              </div> -->
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="rear_spoiler" name="rear_spoiler" />
                  <label class="form-check-label" for="rear_spoiler">Rear Spoiler</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="sun_roof" name="sun_roof" />
                  <label class="form-check-label" for="sun_roof">Sun Roof</label>
                </div>
              </div>
              <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="tv" name="tv" />
                  <label class="form-check-label" for="tv">TV</label>
                </div>
              </div>
              <!-- <div class="col-sm-2 my-1 d-flex">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                  <label class="form-check-label" for="exampleCheck1">Dual Air Bags</label>
                </div>
              </div> -->
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
              <label class="form-check-label me-3 img-360" for="360_img"></label>


            </div>
            <div class="d-flex align-items-center justify-content-end">

              <button type="button" class="col-md-2 btn btn-sm me-2" style="background: linear-gradient(to bottom,#fff 0,#ededed 100%);border: 1px solid #a8a8a8;">
                Reset
              </button>
              <button type="submit" class="col-md-2 btn btn-primary btn-sm">
                Search
              </button>

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


        <!-- Vehicles -->
        @forelse($vehicles as $v)

        <!-- Inquiry Form -->
        <div class="modal fade" id="inquiry" tabindex="-1" aria-labelledby="my-modal-label" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-10">
                    <p>{{$v->fullName}}</p>
                    <p>Stock Id: {{$v->stock_id}} </p>
                  </div>
                  <form class="form" method="post" enctype="multipart/form-data" action="{{route('inquiry.store')}}">
                    @csrf
                    <input type="hidden" name="vehicle_id" value="{{$v->id}}">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="userName">Name <span class="text-danger">*</span></label>
                          <input type="text" id="name" class="form-control" value="{{ old('name')}}" name="name" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="userName">Country <span class="text-danger">*</span></label>
                          <select name="country_id" required class="form-control">
                            <option value="">Select</option>
                            @forelse($countries as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @empty
                            @endforelse
                          </select>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="userName">City <span class="text-danger">*</span></label>
                          <input type="text" id="city" class="form-control" value="{{ old('city')}}" name="city" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="userName">Email <span class="text-danger">*</span></label>
                          <input type="text" id="email" class="form-control" value="{{ old('email')}}" name="email" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="userName">Phone <span class="text-danger">*</span></label>
                          <input type="text" id="phone" class="form-control" value="{{ old('phone')}}" name="phone" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="remarks">Remarks <span class="text-danger">*</span></label>
                          <textarea class="form-control" name="remarks" required>{{ old('remarks')}}</textarea>
                        </div>
                      </div>
                      <small class="text-danger">Please click "Inquiry" to receive your quote from us. You need to provide us with your contact details to receive a free quote.</small>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember-me">
                        <label class="form-check-label" for="remember-me">Remember me</label>
                      </div>


                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Close Inquiry Form-->

        <div class="single-vehicle p-2 2my-3">
          <div class="row">


            <div class="col-md-3">
              @php $cover_img = \DB::table('vehicle_images')->where('vehicle_id',$v->id)->where('is_cover_img',1)->first(); @endphp
              @if($cover_img)
              <img src="{{asset('uploads/vehicle_images/'.$cover_img->image)}}" alt="" width="210px" height="140px" />
              @else
              <img src="{{asset('uploads/default/comingsoon_l.png')}}" alt="" alt="" width="210px" height="140px" />
              @endif

              <p class="stock-text m-0">Stock ID : {{$v->stock_id}}</p>
            </div>
            <div class="col-md-9">
              <div class="col-md-12 d-flex justify-content-between align-items-center">
                <span class="v-tag"><a href="">New Arival</a></span>
                <a href="" class="fav"><i class="fa fa-heart"></i>Add to Favorites</a>
              </div>
              <div class="heading d-flex justify-content-between">

                <h6 class="v-heading"><a href="{{route('singleVehicle',['brand'=>$v->b_slug,'subBrand'=>$v->sb_slug,'stock_id'=>$v->stock_id])}}">{{strtoupper($v->fullName)}}</a></h5>
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
                    <p class="price-text m-0">Price:


                      <span>USD {{$price_after_dis}}</span>
                    </p>
                    @if($v->discount > 0)
                    <del>USD {{$actual_price}}</del>
                    @endif

                  </div>
                  {{-- <p class="price-text m-0">Total Price: <span>{{$location['geoplugin_currencyCode']}} {{number_format($location['geoplugin_currencyConverter']*$price_after_dis, 2, ',', ',')}}</span></p> --}}
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
                        <td>{{ optional($v)->tname ??  ''}}</td>
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
            <div class="col-md-12 d-flex justify-content-end my-2"><a href="">
                <a class="bg-button" href="#" data-bs-toggle="modal" data-bs-target="#inquiry"><i class="bi bi-envelope-at-fill"></i> inquiry
                </a>
            </div>

          </div>
        </div>
        @empty
        @endforelse
        <div class="pt-2">
          {{ $vehicles->links() }}
        </div>
        <!-- Vehicles -->
      </div>
    </div>
  </div>
  </div>
</main>



@endsection