@extends('layout.landing')
@section('pageTitle','ICARJAPAN')
@section('pageSubTitle','HOME')
@push('styles')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

<style>
  .container-fluid {
    padding-left: 30px;
    padding-right: 30px;
  }

  @media (min-width: 768px) {
    .container-fluid {
      padding-left: 50px;
      padding-right: 50px;
    }
  }

  .owl-carousel .vehicle-img img {
    height: 480px;
    /* Set the height of the image */
    width: 100%;
    /* Set the width of the image to 100% to make it responsive */
    object-fit: cover;
    /* Use object-fit: cover to make sure the image fills the container */
  }

  .owl-carousel .vehicle-img-gallery img {
    height: 55px;
    /* Set the height of the image */
    width: 74px;
    /* Set the width of the image to 100% to make it responsive */
    object-fit: contain;
    /* Use object-fit: cover to make sure the image fills the container */
  }
  .vehicle-img-gallery{
    margin-bottom: 3px;
  }
  .main-img {
    position: relative;
  }

  .main-img.owl-carousel .owl-nav .owl-prev {
    position: absolute;
    content: "";
    top: 50%;
    left: 0;
    background-color: #fff;
    color: #000;
    display: inline-block;
    width: 30px;
    height: 30px;
  }

  .main-img.owl-carousel .owl-nav .owl-next {
    position: absolute;
    content: "";
    top: 50%;
    right: 0;
    background-color: #fff;
    color: #000;
    display: inline-block;
    width: 30px;
    height: 30px;
  }

  .owl-carousel .vehicle-img-gallery img.active {
    border: 2px solid red;
  }
  .owl-theme .owl-nav.disabled+.owl-dots{
    margin: 0;
  }
</style>


@endpush
@section('content')
<!-- main section -->
<main class="my-4">
  <div class="container">
    <div class="row gx-3">
      <div class="col-sm-2 col-md-2 col-lg-2 container-xl-2 left-col">
        <!-- left row  -->
        <div class="left-row-2 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-brand text-white">Recommend Car</h5>
            <div class="p-2">
              <!-- product card -->
              <div class="row justify-content-center">
                <div class="col-12">
                  <div class="product-card my-3">
                    <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                    <div class="product-card-body">
                      <p>TOYOTA ALLION 2018TOYOTA ALLION 2018</p>
                      <p>DBA-NZT260</p>
                      <p>Price :</p>
                      <p>USD 13,000.00</p>
                      <div class="product-card-currency">
                        <p>Approx.</p>
                        <p>BDT 1,13,000.00</p>
                      </div>
                    </div>
                  </div>
                </div>



              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-10 col-md-10 col-lg-10 container-xl-7">
        <!-- mid row 1 -->
        <div class="sg-mid-row-1">
          <!-- breadcrumb -->
          @include('partials.breadcrumbs',['model' => $brand])
          <!-- Product Search -->
          <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8 container-xl-8">
              @include('front.search-box')
            </div>
          </div>
          <!-- Status -->
          <div class="d-flex status">
            <div class="hg-box inv">
              <p>
                <span>
                  @if($v->inv_loc)
                  <img src="{{asset('uploads/country/'.$v->inv_loc->image)}}" alt="" />
                  @endif
                </span>
                Inventory
              </p>
            </div>
            <div class="hg-box deg mx-2">
              <p>
                <span>
                  <img src="{{asset('uploads/default/360.png')}}" alt="" />
                </span>
                360 <sup>o</sup> Images
              </p>
            </div>
            <div class="hg-box new-arival">
              <p class="text-primary">New Arrival</p>
            </div>
          </div>
          <!-- Product Title -->
          <div class="prodcut-title">
            {{--<span>Stock Id: {{$v->stock_id}} </span>--}}
            <p>{{$v->fullName}}</p>
            <span>4 Review <i class="bi bi-star-half"></i> </span> <br />
            <span>{{$v->description}}</span>
          </div>
          <!-- Product Galary & View  -->
          <div class="product-view">
            <div class="row">
              <div class="col-sm-8">
                <div class="big-gallery">
                  <div class="main-img owl-carousel owl-theme">
                    @forelse($v_images as $v_img)
                    <div class="vehicle-img"><img src="{{asset('uploads/vehicle_images/'.$v_img->image)}}" class="single-image"></div>
                    @empty
                    @endforelse

                  </div>
                  <div class="main-img-number"></div>




                  
                    
                    <div class="nav owl-carousel owl-theme">
                      <?php $index = 0; ?>
                      <?php foreach ($v_images->chunk(8) as $chunk) : ?>
                       

                          <?php foreach ($chunk as $vimg) : ?>

                            <div class="vehicle-img-gallery">
                              <img data-src="{{asset('uploads/vehicle_images/'.$vimg->image)}}" src="{{asset('uploads/vehicle_images/'.$vimg->image)}}" class="d-block sm-product-img gallery-img" alt="..." />
                            </div>
                          <?php endforeach; ?>
                          
                        
                        <?php $index++; ?>
                      <?php endforeach; ?>
                      </div>


                   
                  
                </div>
                <!--Car Details  -->
                <div class="bg-light shadow">
                  <table class="table table-hover table-sm table-bordered boder border-danger-subtle">
                    <thead>
                      <tr class="table-dark">
                        <th class="text-center" colspan="4" scope="col">
                          {{$v->fullName}} - Details
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">STOCK ID</th>
                        <td>{{$v->stock_id}}</td>
                        <th scope="row">Engine Size (CC)</th>
                        <td>{{$v->e_size}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Maker</th>
                        <td>{{ optional($v->brand)->name }}</td>
                        <th scope="row">Engine Info</th>
                        <td>{{$v->e_info}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Model</th>
                        <td>{{ optional($v->sub_brand)->name }}</td>
                        <th scope="row">Engine Code</th>
                        <td>{{$v->e_code}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Package</th>
                        <td>{{ $v->package }}</td>
                        <th scope="row">Location</th>
                        <td>{{ optional($v->inv_loc)->name }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Chassis</th>
                        <td>{{ $v->chassis_no }}</td>
                        <th scope="row">Drive</th>
                        <td>{{ optional($v->drive_type)->name }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Manufacture Year</th>
                        <td>{{\Carbon\Carbon::createFromTimestamp(strtotime($v->manu_year))->format('Y')}}</td>
                        <th scope="row">Registration Year</th>
                        <td>{{\Carbon\Carbon::createFromTimestamp(strtotime($v->reg_year))->format('Y')}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Mileage (KM)</th>
                        <td>{{ $v->mileage }}</td>
                        <th scope="row">Transmission</th>
                        <td>{{ optional($v->trans)->name }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Ext. Color</th>
                        <td>{{ optional($v->ext_color)->name }}</td>
                        <th scope="row">Steering</th>
                        <td>@if($v->steering == 1) RHD @else LHD @endif</td>
                      </tr>
                      <tr>
                        <th scope="row">Door</th>
                        <td>{{ optional($v->door)->name }}</td>
                        <th scope="row">Weight</th>
                        <td>{{ $v->weight }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Seats</th>
                        <td>{{ optional($v->seat)->name }}</td>
                        <th scope="row">Capacity</th>
                        <td>{{ $v->max_loading_capacity }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Body Type</th>
                        <td>{{ optional($v->body_type)->name }}</td>
                        <th scope="row">Dimention (L*H*W)</th>
                        <td>{{ $v->body_length }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Fuel Type</th>
                        <td>{{ optional($v->fuel)->name }}</td>
                        <th scope="row">M3</th>
                        <td>{{ $v->m3 }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Int. Color</th>
                        <td>{{ optional($v->int_color)->name }}</td>
                        <th scope="row">Condition</th>
                        <td>{{ optional($v->condition)->name }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                @if($v->option)
                <!--Options  -->
                <div class="bg-light shadow my-4">
                  <table class="table table-hover table-sm table-bordered boder border-danger-subtle">
                    <thead>
                      <tr class="table-dark">
                        <th class="text-center" colspan="4" scope="col">
                          Options
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="p-2" colspan="4">
                          {{$v->option}}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                @endif
                @if($v->cd_player)
                <!--Accessories  -->
                <div class="bg-light shadow my-4">
                  <table class="table table-hover table-sm table-bordered boder border-danger-subtle">
                    <thead>
                      <tr class="table-dark">
                        <th class="text-center" colspan="4" scope="col">
                          Features
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        @if($v->cd_player ==1)<td>CD Player</td> @else <td></td> @endif
                        @if($v->sun_roof ==1)<td>Sun Roof</td> @else <td></td> @endif
                        @if($v->leather_seat ==1)<td>Leather Seat</td> @else <td></td>@endif
                        @if($v->alloy_wheels ==1)<td>Alloy Wheels</td> @else <td></td> @endif
                      </tr>
                      <tr>
                        @if($v->power_steering ==1)<td>Power Steering</td> @else <td></td> @endif
                        @if($v->power_windows ==1)<td>Power Windows</td> @else <td></td> @endif
                        @if($v->air_con ==1)<td>Air Con</td> @else <td></td> @endif
                        @if($v->anti_lock_brake_system ==1)<td>ABS lock_brake_system</td> @else <td></td> @endif
                      </tr>
                      <tr>
                        @if($v->air_bag ==1)<td>Air Bag</td> @else <td></td> @endif
                        @if($v->radio ==1)<td>Radio</td> @else <td></td> @endif
                        @if($v->cd_changer ==1)<td>Cd Changer</td> @else <td></td> @endif
                        @if($v->dvd ==1)<td>DVD</td> @else <td></td> @endif
                      </tr>
                      <tr>
                        @if($v->tv ==1)<td>TV</td> @else <td></td> @endif
                        @if($v->power_seat ==1)<td>Power Seat</td> @else <td></td> @endif
                        @if($v->back_tire ==1)<td>Back Tire</td>@else <td></td> @endif
                        @if($v->grill_guard ==1)<td>Grill Guard</td> @else <td></td> @endif
                      </tr>
                      <tr>
                        @if($v->rear_spoiler ==1)<td>Rear Spoiler</td> @else <td></td> @endif
                        @if($v->central_locking ==1)<td>Central Locking</td> @else <td></td> @endif
                        @if($v->jack ==1)<td>Jack</td> @else <td></td> @endif
                        @if($v->spare_tire ==1)<td>Spare Tire</td> @else <td></td> @endif
                      </tr>
                      <tr>
                        @if($v->wheel_spanner ==1)<td>Wheel Spanner</td> @else <td></td> @endif
                        @if($v->fog_lights ==1)<td>Fog Lights</td> @else <td></td> @endif
                        @if($v->back_camera ==1)<td>Back Camera</td> @else <td></td> @endif
                        @if($v->push_start ==1)<td>Push Start</td> @else <td></td> @endif
                      </tr>
                      <tr>
                        @if($v->keyless_entry ==1)<td>Keyless Entry</td> @else <td></td> @endif
                        @if($v->esc ==1)<td>ESC</td> @else <td>-</td> @endif
                        @if($v->deg_360_cam ==1)<td>360 Degree Camera</td> @else <td></td> @endif
                        @if($v->body_kit ==1)<td>Body Kit</td> @else <td></td> @endif
                      </tr>
                      <tr>
                        @if($v->side_airbag ==1)<td>Side Airbag</td> @else <td></td> @endif
                        @if($v->power_mirror ==1)<td>Power Mirror</td> @else <td></td> @endif
                        @if($v->side_skirts ==1)<td>Side Skirts</td> @else <td></td> @endif
                        @if($v->front_lip_spoiler ==1)<td>Front Lip Spoiler</td> @else <td>-</td> @endif
                      </tr>
                      <tr>
                        @if($v->navigation ==1)<td>Navigation</td> @else <td></td> @endif
                        @if($v->turbo ==1)<td>Turbo</td> @else <td>-</td> @endif
                      </tr>
                    </tbody>
                  </table>
                </div>
                @endif
                <!-- Customer's Photo Gallery  -->
                <div class="card shadow radious-10 my-3">
                  <h5 class="card-title bg-brand text-white">
                    Customer's Photo Gallery
                  </h5>
                  <div class="p-2 customer-gallery">
                    <div class="row">
                      <div class="col-sm-4">
                        <a href="">
                          <img src="./resource/img/client-galary.png" alt="" />
                        </a>
                      </div>
                      <div class="col-sm-4">
                        <a href="">
                          <img src="./resource/img/client-galary.png" alt="" />
                        </a>
                      </div>
                      <div class="col-sm-4">
                        <a href="">
                          <img src="./resource/img/client-galary.png" alt="" />
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- REVIEW HIGHLIGHTS  -->
                <div class="card shadow radious-10 my-3">
                  <h5 class="card-title bg-brand text-white">
                    REVIEW HIGHLIGHTS
                  </h5>
                  <div class="p-2 customer-highlights text-center">
                    <div class="row">
                      <div class="top-hlights">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <p>"I Ready love this color"</p>
                      </div>
                      <div class="dis-lights">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <p>"Purchase RAB-01"</p>
                        <p>
                          Lorem ipsum dolor, sit amet consectetur
                          adipisicing elit. Blanditiis quibusdam aut
                          corporis velit dolore eum illum dicta, ipsa
                          doloremque possimus facilis odit asperiores odio
                          similique aspernatur, natus, deserunt qui
                          incidunt.
                        </p>
                        <p>Mr. John</p>
                        <a href="">More Review</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Review Section -->
                <div class="card shadow radious-10 my-3">
                  <h5 class="card-title bg-brand text-white">REVIEWS</h5>
                  <div class="p-2 customer-highlights text-center">
                    <div class="row">
                      <div class="col-sm-6">
                        <select class="form-select" aria-label="Default select example">
                          <option selected>Rating</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <select class="form-select" aria-label="Default select example">
                          <option selected>Images & Videos</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </select>
                      </div>
                    </div>
                    <hr />
                    <div class="review-user-body my-3">
                      <div class="row">
                        <div class="col-sm-3 review-user-p-img">
                          <img class="img-fluid" src="{{asset('uploads/default/review.png')}}" alt="" />
                        </div>
                        <div class="col-sm-6 review-user">
                          <div class="d-flex">
                            <img class="img-fluid" src="{{asset('uploads/default/bdf.png')}}" alt="" />
                            <div>
                              <p>Shibly S.</p>
                              <p>Nov 14, 2020</p>
                            </div>
                          </div>
                          <p>2018 Premio F EX grade 5</p>
                          <p>Wonderful car and amazing price. Thanks ICARJAPAN</p>
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
                <!-- REVIEW HIGHLIGHTS  -->
                <div class="card shadow radious-10 my-3">
                  <h5 class="card-title bg-brand text-white">
                    Recently Viewed Cars
                  </h5>
                  <div class="p-2 customer-highlights text-center">
                    <div class="row">
                      {{--<div class="col-sm-4">
                        <div class="product-card my-3">
                          <img class="img-fluid" src="./resource/img/product-img.png" alt="" />
                          <div class="product-card-body">
                            <p>TOYOTA ALLION 2018TOYOTA ALLION 2018</p>
                            <p>DBA-NZT260</p>
                            <p>Price :</p>
                            <p>USD 13,000.00</p>
                            <div class="product-card-currency">
                              <p>Approx.</p>
                              <p>BDT 1,13,000.00</p>
                            </div>
                          </div>
                        </div>
                      </div>--}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <!-- Page View & Icon of The Number of Free QuotesFree Quote Favorites -->
                <div class="row">
                  <div class="d-flex view-port">
                  <div class="col-sm-4">
                    <div class="w-100">
                      <div class="page-view">Page View</div>
                      <div>712</div>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="w-100">
                      <div class="page-view">Free Quote</div>
                      <div>712</div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="w-100">
                      <div class="page-view">Favorites</div>
                      <div>712</div>
                    </div>
                  </div>
                  </div>

                
                <!-- price table -->
                <form class="p-0" id="my-form">
                  <div class="my-2 price-table bg-light">
                    <table class="table table-bordered m-0">
                      <thead>
                        <tr>
                          <th class="table-dark" colspan="2" scope="col">
                            Total Price Calculator
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">Currency</th>
                          <td>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                              <option value="1">USD</option>
                            </select>
                          </td>
                        </tr>
                        @php
                        $actual_price = $v->price;
                        $dis_price = $v->price*$v->discount/100;
                        $price_after_dis = ($actual_price-$dis_price);
                        @endphp
                        <tr>
                          <th scope="row">Vehicle Price</th>
                          <td>USD {{$price_after_dis}}</td>
                        </tr>
                        <tr>
                          <th scope="row"></th>
                          <td><del>USD {{$actual_price}}</del></td>
                        </tr>
                        <tr>
                          <th scope="row">Save</th>
                          <td>USD {{$dis_price}} ({{$v->discount}}%)</td>
                        </tr>
                        <tr>
                          <th scope="row">Approx.</th>
                          <td>BDT {{number_format(round($location['geoplugin_currencyConverter']*$dis_price), 2, '.', ',')}}</td>
                          <input type="hidden" class="convert_price" value="{{round($location['geoplugin_currencyConverter']*$price_after_dis)}}">
                        </tr>
                        <tr>
                          <th scope="row">Destination Country</th>
                          <td>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="country_id">
                              <option value="">Selet Country</option>
                              @if(count($countries) > 0)
                              @forelse($countries as $c)
                              @if(\Session::get('country_id') && empty(request('country_id')))
                              <option value="{{$c->id}}" @if(\Session::get('country_id')==$c->id) selected @endif>{{$c->name}}</option>
                              @elseif(!empty(request('country_id')))
                              <option value="{{$c->id}}" @if(request('country_id')==$c->id) selected @endif>{{$c->name}}</option>
                              @else
                              <option value="{{$c->id}}" @if($countryName->id == $c->id) selected @endif>{{$c->name}}</option>
                              @endif

                              @empty
                              @endforelse
                              @endif
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <th colspan="2" id="table-bg" scope="row">
                            {{$v->note}}
                          </th>
                        </tr>
                        <tr>
                          <th scope="row">Destination Port</th>
                          <td>
                            @php
                            if(\Session::get('country_id') && empty(request('country_id'))){
                            $des_port = \DB::table('ports')->where('inv_loc_id',\Session::get('country_id'))->get();
                            }elseif(!empty(request('country_id'))){
                            $des_port = \DB::table('ports')->where('inv_loc_id',request('country_id'))->get();
                            }else{
                            $des_port = \DB::table('ports')->where('inv_loc_id',$countryName->id)->get();
                            }

                            @endphp
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
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
                          <th scope="row">Shipment</th>
                          <td>
                            <div class="mb-3 form-check">
                              <input type="radio" class="form-check-input" id="exampleCheck1" checked />
                              <label class="form-check-label" for="exampleCheck1">RoRo</label>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Freight</th>
                          <td>Ask</td>
                        </tr>
                        <tr>
                          <th scope="row">Vanning</th>
                          <td>N/A</td>
                        </tr>
                        <tr>
                          <th scope="row">Inspection</th>
                          <td>USD 200.00</td>
                          <input type="hidden" value="{{round($location['geoplugin_currencyConverter']*200)}}" class="ins_val">
                        </tr>
                        <tr>
                          <th scope="row"></th>
                          <td>Approx. BDT {{round($location['geoplugin_currencyConverter']*200)}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Insurance</th>
                          <td>USD 272</td>
                          <input type="hidden" value="{{round($location['geoplugin_currencyConverter']*272)}}" class="insur">
                        </tr>
                        <tr>
                          <th scope="row"></th>
                          <td>Approx. BDT {{round($location['geoplugin_currencyConverter']*272)}}</td>
                        </tr>
                        <tr>
                          <th scope="row"></th>
                          <td class="total"></td>
                        </tr>
                        <tr>
                          <th colspan="2" scope="row">
                            ICARJAPAN ships a car upon receiving Deposit(Down
                            payment agreed). A customer shall pay within 7
                            days after BL copy shown as an evidence of export.
                            Please give us an inquiry if you have any concern.
                          </th>
                        </tr>
                        <tr>
                          <th colspan="2" scope="row">
                            Production Year/month is provided by Suppliers.
                            ICARJAPAN shall not be responsible for any loss, damages
                            and troubles caused by this information.
                          </th>
                        </tr>
                        <tr class="table-dark">
                          <th class="h5 fw-bold" scope="row">Total Price</th>
                          <td class="fw-bold">Ask</td>
                        </tr>
                      </tbody>
                    </table>
                    <!-- Contact Us  -->
                  </div>
                </form>
                </div>
                @if(currentUser() == 'user')
                <div class="card shadow radious-10 my-3 contact-us-section">
                  <h5 class="card-title bg-brand text-white">Contact Us</h5>
                  <div class="p-2 customer-highlights text-center">
                    <a class="bg-button" href="#" data-bs-toggle="modal" data-bs-target="#inquiry"><i class="bi bi-envelope-at-fill"></i> inquiry
                    </a>

                    <p class="">OR</p>
                    <form id="active-form" method="POST" action="{{route('user.reservevehicle.store')}}" style="display: inline;">
                      @csrf
                      <input name="vehicle_id" type="hidden" value="{{$v->id}}">
                      <a href="javascript:void(0)" data-name="{{$v->fullName}}" class="confirm mr-2 bg-button" data-toggle="tooltip" title="Reserve now"><i class="bi bi-cart-check-fill"></i> Reserve Now</a>
                    </form>
                    <!-- <a class="bg-button" href="#" data-bs-toggle="modal" data-bs-target="#buy_now"><i class="bi bi-cart-check-fill"></i> Buy Now</a> -->
                    <div class="my-3">
                      <img src="./resource/img/atm.jpg" alt="" />
                    </div>
                  </div>
                </div>
                @endif
                <!-- Inquiry Form -->
                <div class="modal fade" id="inquiry" tabindex="-1" aria-labelledby="my-modal-label" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="row">
                          @if(count($v_images) > 0)
                          <div class="col-md-2">
                            <img style="max-width:80px;" class="img-fluid single-image" src="{{asset('uploads/vehicle_images/'.$v_images->first()->image)}}" alt="" />
                          </div>
                          @endif
                          <div class="col-md-10">
                            <p>{{$v->fullName}}</p>
                            <p>Stock Id: {{$v->stock_id}} </p>
                          </div>
                          <form class="form" method="post" enctype="multipart/form-data" action="{{route('user.inquiry.store')}}">
                            @csrf
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

                <!-- Buy Now Form -->
                <div class="modal fade" id="buy_now" tabindex="-1" aria-labelledby="my-modal-label" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="d-flex justify-content-center">
                          <a href="{{route('login')}}" class="btn btn-primary">Login</a>
                          <a href="{{route('register')}}" class="btn btn-secondary">Register</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Close Buy Now Form-->


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- main seciton end -->
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
  $('.confirm').on('click', function(event) {
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Are you sure you want to Reserve this ${name}?`,
        icon: "success",
        buttons: true,
        dangerMode: false,
      })
      .then((willDelete) => {
        if (willDelete) {
          $('#active-form').submit();
        }
      });
  });
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
  $(document).ready(function() {
    var itemCount = <?php echo count($v_images); ?>; // Get the number of items from Laravel
    var itemsPerRow = 8; // Set a default value

    if (itemCount <= 8) {
      itemsPerRow = itemCount;
    } else {
      if (itemCount % 2 == 0) {
        itemsPerRow = 2;
      } else {
        itemsPerRow = 3;
      }
    }

    $('.nav').owlCarousel({
      items: 8,
      itemsDesktop: [1199, 8],
      itemsDesktopSmall: [980, itemsPerRow],
      itemsTablet: [768, itemsPerRow],
      itemsMobile: [479, 1],
      navigation: false,
      pagination: false,
      mouseDrag:false,
    });

    $('.main-img').owlCarousel({
      items: 1,
      nav: true,
      dots: false,
      navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
      onChanged: owlChanged,
      onInitialized: showImageNumber,
      onTranslated: showImageNumber
    });
    $('.nav .owl-item').on('click', function() {
      var src = $(this).data('src');
      var index = $(this).index();
      // Trigger the big image carousel to display the clicked image
      $('.main-img').trigger('to.owl.carousel', index);
      // Remove active class from all images

      $('.nav .owl-item').find('.vehicle-img-gallery').children("img").removeClass('active');
      // Add active class to clicked image
      $(this).find('.vehicle-img-gallery').children("img").addClass('active');

    

    });
    /*$('.main-img .owl-prev').on('click', function() {
      $('.main-img').trigger('prev.owl.carousel');
    });

    $('.main-img .owl-next').on('click', function() {
      $('.main-img').trigger('next.owl.carousel');
    });*/

    function owlChanged(event) {
      // Get the current item index
      var currentItemIndex = event.item.index;
      $('.nav .owl-item').find("img").removeClass('active');
      $('.nav .owl-item').eq(currentItemIndex).find('img').addClass('active');
      // Get the total number of items
      var totalItems = event.item.count;
      // Get the previous item index
      var previousItemIndex = currentItemIndex - event.item.step;
      // Get the next item index
      var nextItemIndex = currentItemIndex + event.item.step;
    }

    function showImageNumber(event) {
      // Get the current image index
      var currentIndex = event.item.index;
      // Get the total number of images
      var totalImages = event.item.count;
      // Display the image number in a separate element
      $('.main-img-number').text((currentIndex + 1) + '/' + totalImages);
    }




    /*==Most Viewed Vehicle Data save with ajax request==*/
    var csrfToken = "{{ csrf_token() }}";
    $.ajax({
      url: '{{ route("mostview.store") }}',
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      data: {
        country_id: '{{$countryName->id}}',
        vehicle_id: '{{$v->id}}'
      },
      success: function(response) {
        console.log('increment');
      },
      error: function() {
        console.log('not saved');
      }
    });

    /*==Payment Calculation==*/
    var actual_price = "{{$v->price}}";
    var dis_price = "{{$v->price*$v->discount/100}}";
    var price_after_dis = "{{$actual_price-$dis_price}}";
    var convert_price = parseFloat($('.convert_price').val());
    var inspection = parseFloat($('.ins_val').val());
    var insurance = parseFloat($('.insur').val());
    console.log(convert_price);
    console.log(inspection);
    console.log(insurance);
    $('.total').text('Approx. BDT ' + (convert_price + inspection + insurance));

    /*===Country Wise Port  */
    $('select[name="country_id"]').on('change', function() {
      $('#my-form').submit();
    });

  });
</script>
@endpush