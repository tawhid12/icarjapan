@extends('layout.landing')
@section('pageTitle','ICARJAPAN')
@section('pageSubTitle','HOME')
@push('styles')
<style>
  .form-select-sm {
    font-size: 12px !important;
    padding-left: 0.32rem;
  }

  .custom-table td {
    padding: 10px !important;
    /* Adjust spacing as needed */
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
                <a href="" style="text-decoration:none;color:#000;"><img src="" alt="" /> {{$inv->name}}</a>
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
      <div class="col-sm-12 col-md-12 col-lg-10 container-xl-7">
        <!-- left row 1 -->
        <div class="search-left-1">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="./index.html">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Serarch
              </li>
            </ol>
          </nav>
        </div>
        <!-- left row 2 -->
        <div class="search-left-2">
          <div class="input-group mb-3 shadow">
            <span class="input-group-text">Search Car</span>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" />
            <span class="input-group-text"><i class="bi bi-search"></i></span>
          </div>
        </div>
        <!-- left row 3 -->
        <div class="search-left-3">
          <p>Used Cars for Sale</p>
          <div class="search-body bg-dark-subtle shadow p-2">
            <div class="row gx-1">
              <div class="col-sm-3 mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Make:</option>
                  @forelse($brands as $b)
                  <option value="{{$b->id}}" @if(!empty($brand)) @if($b->id == $brand->id) selected @endif @endif>{{$b->name}}</option>
                  @empty
                  @endforelse
                </select>
              </div>
              <div class="col-sm-3 mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Model:</option>
                  @forelse($sub_brands as $sb)
                  <option value="{{$sb->id}}" @if(!empty($sub_brand_id)) @if($sb->id == $sub_brand_id->id) selected @endif @endif>{{$sb->name}}</option>
                  @empty
                  @endforelse
                </select>
              </div>
              <div class="col-sm-3 mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Model Code:</option>
                  @forelse($vehicle_models as $vm)
                  <option value="{{$vm->id}}">{{$vm->name}}</option>
                  @empty
                  @endforelse
                </select>
              </div>
              <div class="col-sm-3 mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Steering:</option>
                  <option value="1">Right Hand Drive</option>
                  <option value="2">Left Hand Drive</option>
                </select>
              </div>
              <div class="col-sm-3 mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Body Type</option>
                  @forelse($body_types as $bt)
                  <option value="{{$bt->id}}">{{$bt->name}}</option>
                  @empty
                  @endforelse
                </select>
              </div>
              <div class="col-sm-3 mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Sub Body Type</option>
                  @forelse($sub_body_types as $sb)
                  <option value="{{$sb->id}}">{{$sb->name}}</option>
                  @empty
                  @endforelse
                </select>
              </div>
              <div class="col-sm-3 mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Drive</option>
                  @forelse($drive_types as $dt)
                  <option value="{{$dt->id}}">{{$dt->name}}</option>
                  @empty
                  @endforelse
                </select>
              </div>
              <div class="col-sm-3 mb-3 d-flex">
                <select class="form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Year</option>
                  @php
                  for ($i = $year_range[0]->minyear; $i <= $year_range[0]->maxyear; $i += 1) {
                    @endphp
                    <option value="{{$i}}">{{$i}}</option>
                    @php
                    }
                    @endphp
                </select>
                <select class="form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Mon</option>
                  @php
                  for ($i =1; $i <= 12; $i++) { @endphp <option value="{{$i}}">{{$i}}</option>
                    @php
                    }
                    @endphp
                </select>
                <span>~</span>
                <select class="form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Year</option>
                  @php
                  for ($i = $year_range[0]->minyear; $i <= $year_range[0]->maxyear; $i += 1) {
                    @endphp
                    <option value="{{$i}}">{{$i}}</option>
                    @php
                    }
                    @endphp
                </select>
                <select class="form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Mon</option>
                  @php
                  for ($i =1; $i <= 12; $i++) { @endphp <option value="{{$i}}">{{$i}}</option>
                    @php
                    }
                    @endphp
                </select>
              </div>
              <hr />
              <div class="col-sm-3 mb-3 d-flex">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Price Range</option>
                  @php
                  for ($i = $price_range[0]->minprice; $i <= $price_range[0]->maxprice; $i += 500) {
                    @endphp
                    <option value="{{$i}}">USD {{$i}}</option>
                    @php
                    }
                    @endphp
                </select>

                <span>~</span>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Price Range</option>
                  @php
                  for ($i = $price_range[0]->minprice; $i <= $price_range[0]->maxprice; $i += 500) {
                    @endphp
                    <option value="{{$i}}">USD {{$i}}</option>
                    @php
                    }
                    @endphp
                </select>
              </div>
              <div class="col-sm-3 mb-3 d-flex">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value>Engine CC:</option>
                  @php
                  for ($i = $cc_range[0]->mincc; $i <= $cc_range[0]->maxcc; $i += 500) {
                    @endphp
                    <option value="{{$i+1}}">{{$i+1}}</option>
                    @php
                    }
                    @endphp
                </select>
                <span>~</span>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value>Engine CC:</option>
                  @php
                  for ($i = $cc_range[0]->mincc; $i <= $cc_range[0]->maxcc; $i += 500) {
                    @endphp
                    <option value="{{$i}}">{{$i}}</option>
                    @php
                    }
                    @endphp
                </select>
              </div>
              <div class="col-sm-3 mb-3 d-flex">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Milege</option>
                  @php
                  for ($i = $mileage_range[0]->min_mileage; $i <= $mileage_range[0]->max_mileage; $i += 10000) {
                    @endphp
                    <option value="{{$i+1}}">{{$i+1}}</option>
                    @php
                    }
                    @endphp
                </select>

                <span>~</span>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Milege</option>
                  @php
                  for ($i = $mileage_range[0]->min_mileage; $i <= $mileage_range[0]->max_mileage; $i += 10000) {
                    @endphp
                    <option value="{{$i}}">{{$i}}</option>
                    @php
                    }
                    @endphp
                </select>
              </div>
              <div class="col-sm-3 mb-3 d-flex">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Transmission:</option>
                  @forelse($trans as $t)
                  <option value="{{$t->id}}">{{$t->name}}</option>
                  @empty
                  @endforelse
                </select>
              </div>
              <div class="col-sm-3 mb-3 d-flex">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value>Discount</option>
                  <option value="1">1%</option>
                  @php
                  for ($i = $discount_range[0]->mindis; $i <= $discount_range[0]->maxdis; $i += 10) {
                    @endphp
                    <option value="{{$i}}">{{$i}}%</option>
                    @php
                    }
                    @endphp
                </select>

                <span>~</span>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value>Discount</option>
                  @php
                  for ($i = $discount_range[0]->mindis; $i <= $discount_range[0]->maxdis; $i += 10) {
                    @endphp
                    <option value="{{$i-1}}">{{$i-1}}%</option>
                    @php
                    }
                    @endphp
                </select>
              </div>

              <div class="col-sm-3 mb-3 d-flex">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option vale="">Fuel</option>
                  @forelse($fuel as $f)
                  <option value="{{$f->id}}">{{$f->name}}</option>
                  @empty
                  @endforelse
                </select>
              </div>
              <div class="col-sm-3 mb-3 d-flex">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="">Color</option>
                  @forelse($colors as $c)
                  <option value="{{$c->id}}">{{$c->name}}</option>
                  @empty
                  @endforelse
                </select>
              </div>
              <div class="col-sm-3 mb-3 d-flex more-details">
                <a href="#myCollapsible" data-bs-toggle="collapse">+ More Details</a>
              </div>
              <!-- Collapsible section that is initially collapsed -->
              <div class="collapse" id="myCollapsible">
                <div class="row gx-1">
                  <div class="col-sm-3 mb-3 d-flex">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option value="">Body Length</option>
                      @php
                      for ($i = $b_length_range[0]->b_length_min; $i <= $b_length_range[0]->b_length_max; $i += 500) {
                        @endphp
                        <option value="{{$i-1}}">{{$i}}</option>
                        @php
                        }
                        @endphp
                    </select>
                  </div>
                  <div class="col-sm-3 mb-3 d-flex">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option value="">Max Loading Cepacity</option>
                      @php
                      for ($i = $max_loading_range[0]->loading_min; $i <= $max_loading_range[0]->loading_max; $i += 500) {
                        @endphp
                        <option value="{{$i}}">{{$i}}</option>
                        @php
                        }
                        @endphp
                    </select>
                  </div>
                  <div class="col-sm-3 mb-3 d-flex">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option value="">Engine Type</option>
                      @forelse($engine_types as $e)
                      <option value="{{$e->e_type}}">{{$e->e_type}}</option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                  @if($max_manu_Year && $min_manu_Year)
                  <div class="col-sm-3 mb-3 d-flex">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option value="">Priod Year</option>
                      @php
                      for ($i = $max_manu_Year; $i >= $min_manu_Year; $i --) {
                      @endphp
                      <option value="{{$i}}">{{$i}}</option>
                      @php
                      }
                      @endphp
                    </select>
                    <span>~</span>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option value="">Priod Year</option>
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
                  <hr />
                  <div class="col-sm-3 mb-3 d-flex">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option value="">Truck Size</option>
                      <option value="1">Large Truck</option>
                      <option value="2">Medium Truck</option>
                      <option value="3">Small Truck</option>
                      <option value="4">Multicab</option>
                    </select>
                  </div>
                  <div class="col-sm-3 mb-3 d-flex">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option selected>Inventory Location</option>
                      @forelse($inv_loc as $inv)
                      <option value="{{$inv->id}}">{{$inv->name}}</option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                  <div class="col-sm-3 mb-3 d-flex">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                      <option selected>Port</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                  <hr />
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Air Bag</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Anti-Lock Brake System</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Air Conditioner</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Alloy Wheels</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Back Tire</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Fog Lights</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Grill Guard</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Leather Seats</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Navigation</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Power Steering</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Power Windows</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Roof Rails</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Rear Spoiler</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Sun Roof</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">TV</label>
                    </div>
                  </div>
                  <div class="col-sm-2 mb-3 d-flex">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                      <label class="form-check-label" for="exampleCheck1">Dual Air Bags</label>
                    </div>
                  </div>
                  <hr />
                  <div class="col-sm-12 mb-3">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                    <label class="form-check-label me-3" for="exampleCheck1">New Arrival</label>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                    <label class="form-check-label me-3" for="exampleCheck1">3 Emission Code</label>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                    <label class="form-check-label me-3" for="exampleCheck1">360° Image</label>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <button type="button" class="btn btn-primary btn-sm">
                      Submit
                    </button>
                    <button type="button" class="btn btn-dark btn-sm">
                      Reset
                    </button>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
        <!-- left row 4-->
        <div class="search-left-4 my-3">
          <div class="search-body bg-dark-subtle shadow p-2">
            <div class="row">
              <div class="col-sm-12 mb-3">
                <span>Total Price Calculator</span>
              </div>
              <div class="col-sm-6 mb-3 note">
                <span>Estimate the price of the vehicle(s) based on your
                  destination.</span>
              </div>
              <div class="col-sm-6 mb-3 note">
                <span>Note: In some cases the total price cannot be estimated.
                </span>
              </div>
              <div class="col-sm-3 mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option selected>Destination Country</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-sm-3 mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option selected>Destination Port</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-sm-3 mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option selected>Shipment</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-sm-3 mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" disabled>
                  <option selected>Freight ( Included )</option>
                </select>
              </div>
              <div class="col-sm-3 mb-3 d-flex">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option selected>Currency</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-sm-3 mb-3 d-flex">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option selected>Inspection</option>
                  <option value="1">YES</option>
                  <option value="2">NO</option>
                </select>
              </div>
              <div class="col-sm-3 mb-3 d-flex">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option selected>Insurance</option>
                  <option value="1">YES</option>
                  <option value="2">NO</option>
                </select>
              </div>
              <div class="col-sm-3 mb-3">
                <button type="button" class="btn btn-primary btn-sm">
                  Submit
                </button>
                <button type="button" class="btn btn-dark btn-sm">
                  Reset
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- Vehicles -->
        @forelse($vehicles as $v)
        <div class="single-vehicle my-3">
          <div class="row d-flex align-items-center">
            <div class="col-md-12 d-flex justify-content-end"><a href=""><i class="fa fa-heart"></i>Add to Favorites</a></div>

            <div class="col-md-2">
              <img src="{{asset('front/img/product-img.png')}}" alt="" />
              <p>Stock ID : {{$v->stock_id}}</p>
            </div>
            <div class="col-md-10">
              <div class="heading d-flex justify-content-between">
                <h6><a href="">{{$v->fullName}}</a></h5>
                  @if($v->inv_locatin_id)
                  @php $inventory_loc = \DB::table('countries')->where('id',$v->inv_locatin_id)->first();@endphp
                  <p>Inventory Location <i class="fa fa-flag"></i><span>{{$inventory_loc->name}}</span></p>
                  @endif
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="d-flex align-items-center">
                    @php
                    $actual_price = $v->price;
                    $dis_price = $v->price*$v->discount/100;
                    $price_after_dis = ($actual_price-$dis_price);
                    @endphp
                    <p>Price</p>
                    <div>
                      @if($v->discount > 0)
                      <del>USD {{$actual_price}}</del>
                      @endif
                      <p>USD {{$price_after_dis}}</p>
                    </div>
                  </div>
                  @if($v->discount > 0)
                  <p>Save: $v->discount/100%</p>
                  @endif
                  <p>Total Price: USD 2,238</p>
                </div>
                <div class="col-md-9">
                  <table class="table table-bordered">
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
                        <td>{{$v->transmission_id}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table custom-table">
                    <tr class="table-secondary">
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
                      <td>{{$v->door}}</td>
                    </tr>
                  </table>
                </div>
              </div>

              <p>
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
            <div class="col-md-12 d-flex justify-content-end"><a href="">
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
</main>
@endsection