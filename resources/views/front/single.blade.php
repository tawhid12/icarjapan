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
</style>


@endpush
@section('content')
<!-- main section -->
<main class="my-4">
  <div class="container-fluid">
    <div class="row">
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
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#"></a></li>
              <li class="breadcrumb-item active" aria-current="page">
                Data
              </li>
            </ol>
          </nav>
          <!-- Product Search -->
          <div class="input-group mb-3 shadow">
            <span class="input-group-text">Search Car</span>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" />
            <span class="input-group-text"><i class="bi bi-search"></i></span>
          </div>
          <!-- Status -->
          <div class="d-flex status">
            <div class="shadow">
              <p>
                <span>
                  @if($v->inv_loc)
                  <img src="{{asset('uploads/country/'.$v->inv_loc->image)}}" alt="" />
                  @endif
                </span>
                Inventory
              </p>
            </div>
            <div class="shadow">
              <p>
                <span>
                  <img src="{{asset('uploads/default/360.png')}}" alt="" />
                </span>
                360 <sup>o</sup> Images
              </p>
            </div>
            <div class="shadow">
              <p>New Arrival</p>
            </div>
          </div>
          <!-- Product Title -->
          <div class="prodcut-title my-3">
            <span>Stock Id: {{$v->stock_id}} </span>
            <p>{{$v->fullName}}</p>
            <span>4 Review <i class="bi bi-star-half"></i> </span> <br />
            <span>{{$v->description}}</span>
          </div>
          <!-- Product Galary & View  -->
          <div class="product-view">
            <div class="row">
              <div class="col-sm-8">
                <div class="prductgalary">
                  <div class="main-img owl-carousel owl-theme">
                    @forelse($v_images as $v_img)
                    <img class="img-fluid w-100 single-image" src="{{asset('uploads/vehicle_images/'.$v_img->image)}}" alt="" />
                    @empty
                    @endforelse
                  </div>


                  <div class="product-galary my-3">
                    <div id="">

                      <?php $index = 0; ?>
                      <?php foreach ($v_images->chunk(8) as $chunk) : ?>
                        <div class="nav owl-carousel owl-theme">

                          <?php foreach ($chunk as $vimg) : ?>

                            <div>
                              <img data-src="{{asset('uploads/vehicle_images/'.$vimg->image)}}" src="{{asset('uploads/vehicle_images/'.$vimg->image)}}" class="d-block sm-product-img gallery-img" alt="..." />
                            </div>
                          <?php endforeach; ?>

                        </div>
                        <?php $index++; ?>
                      <?php endforeach; ?>



                    </div>
                  </div>
                </div>
                <!--Car Details  -->
                <div class="bg-light shadow my-4">
                  <table class="table table-hover table-sm table-bordered boder border-danger-subtle">
                    <thead>
                      <tr class="table-dark">
                        <th class="text-center" colspan="4" scope="col">
                          {{optional($v->brand)->name}} {{optional($v->sub_brand)->name}} - Car Details
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Stock Id:</th>
                        <td>{{$v->stock_id}}</td>
                        <th scope="row">Inventory Location:</th>
                        <td>{{ optional($v->inv_loc)->name }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Model Code:</th>
                        <td>{{ optional($v->vehicle_model)->name }}</td>
                        <th scope="row">Registration Year:</th>
                        <td>{{\Carbon\Carbon::createFromTimestamp(strtotime($v->reg_year))->format('Y/m')}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Production Year:</th>
                        <td>{{\Carbon\Carbon::createFromTimestamp(strtotime($v->reg_year))->format('Y')}}</td>
                        <th scope="row">Transmission:</th>
                        <td>{{ optional($v->trans)->name }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Color:</th>
                        <td>{{ optional($v->color)->name }}</td>
                        <th scope="row">Drive:</th>
                        <td>{{ optional($v->drive_type)->name }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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
                <!--Accessories  -->
                <div class="bg-light shadow my-4">
                  <table class="table table-hover table-sm table-bordered boder border-danger-subtle">
                    <thead>
                      <tr class="table-dark">
                        <th class="text-center" colspan="4" scope="col">
                          Accessories
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="@if($v->air_bag ==1) bg-danger-subtle @endif">Air Bag</td>
                        <td class="@if($v->anti_lock_brake_system ==1) bg-danger-subtle @endif">Anti-Lock Brake System</td>
                        <td class="@if($v->air_con ==1) bg-danger-subtle @endif">Air Conditioner</td>
                        <td class="@if($v->back_tire ==1) bg-danger-subtle @endif">Back Tire</td>
                      </tr>
                      <tr>
                        <td class="@if($v->fog_lights ==1) bg-danger-subtle @endif">Fog Lights</td>
                        <td class="@if($v->grill_guard ==1) bg-danger-subtle @endif">Grill Guard</td>
                        <td class="@if($v->leather_seats ==1) bg-danger-subtle @endif">Leather Seats</td>
                        <td class="@if($v->navigation ==1) bg-danger-subtle @endif">Navigation</td>
                      </tr>
                      <tr>
                        <td class="@if($v->power_steering ==1) bg-danger-subtle @endif">Power Steering</td>
                        <td class="@if($v->power_windows ==1) bg-danger-subtle @endif">Power Windows</td>
                        <td class="@if($v->roof_rails ==1) bg-danger-subtle @endif">Roof Rails</td>
                        <td class="@if($v->rear_spoiler ==1) bg-danger-subtle @endif">Rea Spoiler</td>
                      </tr>
                      <tr>
                        <td class="@if($v->sun_roof ==1) bg-danger-subtle @endif">Sun Roof</td>
                        <td class="@if($v->tv ==1) bg-danger-subtle @endif">Tv</td>
                        <td class="@if($v->dual_air_bags ==1) bg-danger-subtle @endif">Dual Air Bags</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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
                <div class="row view-port shadow">
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
                <div class="my-4 price-table bg-light p-2 shadow">
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
                          <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="">Selet Country</option>
                            @if(count($countries) > 0)
                            @forelse($countries as $c)

                            @if(\Session::get('country_id'))
                            <option value="{{$c->id}}" @if(\Session::get('country_id')==$c->id) selected @endif>{{$c->name}}</option>
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
                          if(\Session::get('country_id')){
                            $des_port = \DB::table('ports')->where('inv_loc_id',\Session::get('country_id'))->get();
                          }else{
                            $des_port = \DB::table('ports')->where('inv_loc_id',$countryName->id)->get();
                          }
                          
                          @endphp
                          <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="">Select Port</option>
                            @if(count($des_port) > 0)
                            @forelse($des_port as $key => $dp)
                            <option value="{{$dp->id}}" @if($key == 0) selected @endif>{{$dp->name}}</option>
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
      navigation: true,
      pagination: false,
      margin: 6
    });

    $('.main-img').owlCarousel({
      items: 1,
      nav: true,
      dots: false,
      navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
    });
    $('.gallery-img').on('click', function() {
      var src = $(this).data('src');
      $('.single-image').attr('src', src);
    });

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



  });
</script>
@endpush