@extends('layout.landing')
@section('pageTitle','ICARJAPAN')
@section('meta')
<meta name="description" content="iCar Japan is the biggest used car marketplace from Japan. More than 30 brands such as Toyota, Nissan, Honda, any kind of SUV, trucks, buses etc. We ensure high quality Japanese used cars for our customers. Worldwide shipping.">
<meta name="keywords" content="car,used cars,auto,automobile,vehicle,dealer,automotive news,automatic cars, car exporter, buy car, quality car, truck, 
best car, cheap car,high quality car, motor vehicle,saloon, sedan car, hatchback, suv">
<meta property="og:title" content="ICAR JAPAN">
<meta property="og:description" content="iCar Japan is the biggest used car marketplace from Japan. More than 30 brands such as Toyota, Nissan, Honda, any kind of SUV, trucks, buses etc. We ensure high quality Japanese used cars for our customers. Worldwide shipping.">
<meta property="og:site_name" content="ICAR JAPAN">
<meta property="fb:app_id" content="800032724610621" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{asset('front/img/header-logo.png')}}">
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="200" />
<meta property="og:image:height" content="120" />
<meta property="og:image:alt" content="icar japan" />
<meta name="keywords" content="car,used cars,auto,automobile,vehicle,dealer,automotive news,automatic cars, car exporter, buy car, quality car, truck, 
best car, cheap car,high quality car, motor vehicle,saloon, sedan car, hatchback, suv">
@endsection
@section('pageSubTitle','HOME')
@push('styles')
<link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
<style>
  .rating i.fa {
    color: #f9cc00;
  }

  .rating-count {
    font-size: 12px;
    color: red;
    font-weight: 700;
  }
</style>
@endpush
@section('content')

<!-- main section -->
<main class="">
  <div class="container">
    <!-- Messenger Chat plugin Code -->
    <div id="fb-root"></div>
    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat"></div>

    <!-- Mainteance Mode -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            <p class="m-0 text-center text-danger">THE WEBSITE IS UNDER PROCESSING. YOU MAY FACE SOME ERRORS WHEN BROWSING. THANKS FOR VISITING US.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Acknowledge</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Important Notice -->
    <div class="row text-brand">
      <div class="col-sm-12 col-md-7 offset-md-2 col-lg-7 container-xl-7">
        <p class="m-0 notice-text">
          <span class="me-1"><i class="bi bi-exclamation-triangle"></span></i><strong class="me-2">Important Notice : </strong>
          Beware of Scams Advising Fake Money Transfer Instructions! <a class="text-primary font-bold" href="">See Details</a>
        </p>
        <p class="m-0 notice-text">
          <span class="me-1"><i class="bi bi-exclamation-triangle"></span></i><strong class="me-2">Important Notice : </strong>
          About space for vessels. <a class="text-primary font-bold" href="">See Details</a>
        </p>
        <p class="m-0 notice-text">
          <span class="me-1"><i class="bi bi-exclamation-triangle"></span></i><strong class="me-2">Important Notice : </strong>
          About space for vessels. <a class="text-primary font-bold" href="">See Details</a>
        </p>
      </div>
    </div>
    <div class="row gx-4">
      <div class="col-sm-12 col-md-12 col-lg-2 container-xl-2 left-col">
        <!-- left row 1 -->
        <div class="left-row-1 mb-3">
          <a href="#">
            <!--<img class="img-fluid" src="{{asset('front/img/left-top-catagory-banner.png')}}" alt="" />-->
          </a>
        </div>
        <!-- left row 2 -->
        <div class="left-row-2 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-black text-white">
              {{strtoupper($com_acc_info->c_name)}} {{--$countryName->name--}}
            </h5>
            <div class="card-body">
              <p class="card-text">
                <i class="bi bi-geo-alt-fill"></i> JAPAN{{--$location['geoplugin_city']--}}
              </p>
              <p class="card-text">
                <i class="bi bi-telephone-fill"></i> {{$com_acc_info->tel}}
              </p>
              <p class="card-text">
                <i class="bi bi-telephone-fill"></i> {{$com_acc_info->whatsup}}
              </p>
            </div>
          </div>
        </div>
        @include('front.partial.brand-side-bar')
        @include('front.partial.inventory-side-bar')
        @include('front.partial.price-side-bar')
        @include('front.partial.discount-side-bar')
        @include('front.partial.type-side-bar')
        @include('front.partial.category-side-bar')
        <div class="col-sm-12 col-md-12 col-lg-7 container-xl-7">
          @include('front.search-box')
          <!-- mid row 2 -->
          <style>
            .mid-sm-banner img {
              width: 172px;
              aspect-ratio: auto 172 / 104;
              height: 104px;
            }
          </style>
          <div class="mid-row-2 mb-3">
            <div class="row gx-2 d-flex align-items-center">
              <div class="col-sm-12 col-md-12 col-lg-6 mid-md-banner">
                <img class="img-fluid" src="{{asset('front/img/slide3.png')}}" alt="" />
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mid-sm-banner">
                <img class="img-fluid mb-2" src="{{asset('front/img/slide1.png')}}" alt="" />
                <img class="img-fluid" src="{{asset('front/img/image_3.png')}}" alt="" />
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mid-sm-banner">
                <img class="img-fluid mb-2" src="{{asset('front/img/image_3.png')}}" alt="" />
                <img class="img-fluid" src="{{asset('front/img/slide1.png')}}" alt="" />
              </div>
            </div>
          </div>
          <!-- mid row 3 -->

          <div class="mid-row-3">
            <div class="row">
              <div class="col-md-4">
                <a class="" href="#"><i class="bi bi-heart-fill"></i>My Favorites</a>
              </div>
              <div class="col-md-4">
                <a class="" href="#"><i class="bi bi-binoculars"></i>My Recent Views</a>
              </div>
              <div class="col-md-4">
                <a class="" href="#"><i class="bi bi-search"></i>My Search History</a>
              </div>
            </div>
            {{--<a class="shadow" href="#">My Accounts Status</a>--}}
          </div>

          <!-- mid row 4 product row 1 -->
          <div class="mid-row-4 my-4">
            <!-- product row title -->
            <div class="d-flex product-row-title">
              <p><i class="bi bi-binoculars"></i>Most Viewed in {{$countryName->name}}</p>
              <div class="ms-auto">
                <a href="#">See More <i class="bi bi-arrow-right-circle"></i></a>
              </div>
            </div>
            <!-- product card -->
            <div class="row gx-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
              @php //echo '
              <pre>'; print_r($most_views->toArray());die;@endphp
              @forelse($most_views as $v)
              <div class="col">
                <div class="product-card mb-3">
                  @php $cover_img = \DB::table('vehicle_images')->where('vehicle_id',$v->vid)->where('is_cover_img',1)->first(); @endphp
                  @if($cover_img)
                  <img class="img-fluid" src="{{asset('uploads/vehicle_images/'.$cover_img->image)}}" alt="" />
                  @else
                  <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                  @endif
                  <div class="product-card-body">
                  <p clss="m-0"><a href="{{route('singleVehicle',['brand'=>$v->b_slug,'subBrand'=>$v->sb_slug,'stock_id'=>$v->stock_id])}}" style="text-decoration:none!important;">{{ str_replace('-', ' ', $v->name) }}</a></p>
                    <p class="m-0">{{$v->chassis_no}}</p>
                    <div class="rating">
                      <span><i class="fa fa-star"></i></span>
                      <span><i class="fa fa-star"></i></span>
                      <span><i class="fa fa-star"></i></span>
                      <span><i class="fa fa-star"></i></span>
                      <span><i class="fa fa-star"></i></span>
                    </div>
                    <div class="rating-count">25 Reviews</div>
                    @php
                      $actual_price = $v->price;
                      $dis_price = $v->price*$v->discount/100;
                      $price = $actual_price - $dis_price;
                    @endphp
                    @if($price > 0)
                    <p class="m-0">Price :</p>
                    <p class="m-0">USD {{$price}}</p>
                    <div class="product-card-currency">
                      <p class="m-0">Approx.</p>
                      <p class="m-0">{{$location['geoplugin_currencyCode']}} {{number_format($location['geoplugin_currencyConverter']*$price, 2, ',', ',')}}</p>
                    </div>
                    @else
                    <p class="m-0">Ask</p>
                    @endif
                  </div>
                </div>
              </div>
              @empty
              @endforelse
            </div>
          </div>
          <!-- mid row 5 product row 2 -->
          <div class="mid-row-5 my-4">
            <!-- product row title -->
            <div class="d-flex product-row-title">
              <p>
                <i class="bi bi-binoculars"></i>New Arrival for {{$countryName->name}}
              </p>
              <div class="ms-auto">
                <a href="#">See More <i class="bi bi-arrow-right-circle"></i></a>
              </div>
            </div>
            @php
            //print_r($new_arivals);die;
            @endphp
            <!-- product card -->
            <div class="row gx-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center align-items-stretch">
              @forelse($new_arivals as $n)
             {{--$n->vid--}}
              <div class="col">
                <div class="product-card mb-3">
                  <a href="{{route('singleVehicle',['brand'=>$n->b_slug,'subBrand'=>$n->sb_slug,'stock_id'=>$n->stock_id])}}">
                  @php $cover_img = \DB::table('vehicle_images')->where('vehicle_id',$n->vid)->where('is_cover_img',1)->first(); @endphp
                  @if($cover_img)
                  <img class="img-fluid" src="{{asset('uploads/vehicle_images/'.$cover_img->image)}}" alt="" />
                  @else
                  <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                  @endif
                  </a>
                  <div class="product-card-body">
                    <p class="m-0"><a href="{{route('singleVehicle',['brand'=>$n->b_slug,'subBrand'=>$n->sb_slug,'stock_id'=>$n->stock_id])}}" style="text-decoration:none!important;">{{ str_replace('-', ' ', $n->name) }}</a></p>
                    @php //$vmodel = \DB::table('vehicle_models')->where('id',$n->v_model_id)->first(); @endphp
                    {{--@if($vmodel)--}}
                    <p class="m-0">{{$n->chassis_no}}</p>
                    {{--@endif--}}
                    @php
                      $actual_price = $n->price;
                      $dis_price = $n->price*$n->discount/100;
                      $price = $actual_price - $dis_price;
                    @endphp
                    @if($price > 0)
                    <p class="m-0">Price :</p>
                    <p class="m-0">USD {{$price}}</p>
                    <div class="product-card-currency">
                      <p>Approx.</p>
                      <p>{{$location['geoplugin_currencyCode']}} {{number_format($location['geoplugin_currencyConverter']*$price, 2, ',', ',')}}</p>
                    </div>
                    @else
                    <p class="m-0">Ask</p>
                    @endif
                  </div>
                </div>
              </div>
              </a>
              @empty
              @endforelse
            </div>
          </div>
          <!-- mid row 6 product row 3 -->
          <div class="mid-row-6 my-4">
            <!-- product row title -->
            <div class="d-flex product-row-title">
              <p>
                <i class="bi bi-binoculars"></i>Most Affordable for {{$countryName->name}}
              </p>
              <div class="ms-auto">
                <a href="#">See More <i class="bi bi-arrow-right-circle"></i></a>
              </div>
            </div>
            <!-- product card -->
            <div class="row gx-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
              @forelse($afford_by_country as $af)
              <div class="col">
                <div class="product-card my-3">
                  @php $cover_img = \DB::table('vehicle_images')->where('vehicle_id',$af->vid)->where('is_cover_img',1)->first(); @endphp
                  @if($cover_img)
                  <img class="img-fluid" src="{{asset('uploads/vehicle_images/'.$cover_img->image)}}" alt="" />
                  @else
                  <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                  @endif
                  <div class="product-card-body">
                    <p class="m-0"><a href="{{route('singleVehicle',['brand'=>$af->b_slug,'subBrand'=>$af->sb_slug,'stock_id'=>$af->stock_id])}}" style="text-decoration:none!important;">{{ str_replace('-', ' ', $v->name) }}</a></p>
                    <p class="m-0">{{$v->chassis_no}}</p>
                    @php
                      $actual_price = $af->price;
                      $dis_price = $af->price*$af->discount/100;
                      $price = $actual_price - $dis_price;
                    @endphp
                    <p class="m-0">Price :</p>
                    <p class="m-0">USD {{$price}}</p>
                    <div class="product-card-currency">
                      <p>Approx.</p>
                      <p>{{$location['geoplugin_currencyCode']}} {{number_format($location['geoplugin_currencyConverter']*$price, 2, ',', ',')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              @empty
              @endforelse
            </div>
          </div>
          <!-- mid row 7 product row 4 -->
          <div class="mid-row-7 my-4">
            <!-- product row title -->
            <div class="d-flex product-row-title">
              <p><i class="bi bi-binoculars"></i>High Grade for {{$countryName->name}}</p>
              <div class="ms-auto">
                <a href="#">See More <i class="bi bi-arrow-right-circle"></i></a>
              </div>
            </div>
            <!-- product card -->
            <div class="row gx-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
            @forelse($high_grade_by_country as $hg)
              <div class="col">
                <div class="product-card my-3">
                  @php $cover_img = \DB::table('vehicle_images')->where('vehicle_id',$hg->vid)->where('is_cover_img',1)->first(); @endphp
                  @if($cover_img)
                  <img class="img-fluid" src="{{asset('uploads/vehicle_images/'.$cover_img->image)}}" alt="" />
                  @else
                  <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                  @endif
                  <div class="product-card-body">
                    <p class="m-0"><a href="{{route('singleVehicle',['brand'=>$hg->b_slug,'subBrand'=>$hg->sb_slug,'stock_id'=>$hg->stock_id])}}" style="text-decoration:none!important;">{{ str_replace('-', ' ', $v->name) }}</a></p>
                    <p class="m-0">{{$v->chassis_no}}</p>
                    @php
                      $actual_price = $hg->price;
                      $dis_price = $hg->price*$hg->discount/100;
                      $price = $actual_price - $dis_price;
                    @endphp
                    <p class="m-0">Price :</p>
                    <p class="m-0">USD {{$price}}</p>
                    <div class="product-card-currency">
                      <p>Approx.</p>
                      <p>{{$location['geoplugin_currencyCode']}} {{number_format($location['geoplugin_currencyConverter']*$price, 2, ',', ',')}}</p>
                    </div>
                  </div>
                </div>
              </div>
              @empty
              @endforelse
            </div>
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
                  <p><!--2,337--> Reviews</p>
                </div>
                <div class="col-sm-4 d-flex justify-content-end">
                  <a href="#">See More <i class="bi bi-arrow-right-circle"></i></a>
                </div>
              </div>
            </div>
            <div class="review-user-body my-3">
              <div class="row">
                <div class="col-sm-3 review-user-p-img">
                  {{--<img class="img-fluid" src="{{asset('front/img/review.png')}}" alt="" />--}}
                </div>
                {{--<div class="col-sm-6 review-user">
                  <div class="d-flex">
                    <img class="img-fluid" src="{{asset('front/img/bdf.png')}}" alt="" />
                    <div>
                      <p>Shibly S.</p>
                      <p>Nov 14, 2020</p>
                    </div>
                  </div>
                  <p>2018 Premio F EX grade 5</p>
                  <p>Wonderful car and amazing price. Thanks ICAR JAPAN</p>
                </div>--}}
                {{--<div class="col-sm-3 review-status d-flex justify-content-end">
                  <div>
                    <p>Review on -</p>
                    <p>Toyota Premio</p>
                  </div>
                </div>--}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-3 container-xl-3">
          <form action="{{route('search_by_data')}}">
            @csrf
          <!-- right row 1 -->
          <div class="right-row-1 mb-3">
            <div class="right-row-serarch card shadow rounded">
              <h5 class="right-row-1-title">Search By Category</h5>
              <div class="p-2">
                <select name="brand" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                  <option value="" selected>Brands</option>
                  @forelse($brands as $b)
                  <option value="{{$b->id}}">{{$b->name}}</option>
                  @empty
                  @endforelse
                </select>
                <select name="sub_brand" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                  <option value="" selected>Model</option>
                  @php  $sub_brands = \DB::table('sub_brands')->where('brand_id',1)->get(); @endphp
                  @forelse($sub_brands as $v)
                  <option value="{{$v->id}}">{{$v->name}}</option>
                  @empty
                  @endforelse
                </select>
                <select name="body_type" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                  <option value="" selected>Body Type</option>
                  @forelse($body_types as $bt)
                  <option value="{{$bt->id}}">{{$bt->id}}</option>
                  @empty
                  @endforelse
                </select>
                <select name="steering" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                  <option value="" selected>RHL / LHS</option>
                  <option value="1">Right Hand Drive</option>
                  <option value="2">Left Hand Drive</option>
                </select>
                <div class="d-flex search-to">
                  <select value="" name="from_year" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                    <option selected>Year</option>
                    @php 
                    for ($i = $year_range[0]->minyear; $i <= $year_range[0]->maxyear; $i += 1) {
                    @endphp
                    <option value="{{$i}}">{{$i}}</option>   
                    @php    
                    }
                    @endphp
                  </select>
                  <span>To</span>
                  <select name="to_year" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                    <option value="" selected>Year</option>
                    @php 
                    for ($i = $year_range[0]->minyear; $i <= $year_range[0]->maxyear; $i += 1) {
                    @endphp
                    <option value="{{$i}}">{{$i}}</option>   
                    @php    
                    }
                    @endphp
                  </select>
                </div>
                <input class="form-control form-control-sm mb-3" type="text" placeholder="Search ID or Keywords" aria-label=".form-control-sm example" />
                <div class="text-center my-3">
                  <button type="submit" class="search-btn shadow">Search Car</button>
                </div>
              </div>
            </div>
          </div>
          </form>
          <!-- right row 2 -->
          <div class="right-row-2 mb-3">
            <a href="#">
              <!--<img class="img-fluid" src="{{asset('front/img/Shipping-Shedule.png')}}" alt="" />-->
            </a>
          </div>
          <!-- right row 4 -->
          <div class="right-row-4 mb-3">
            <div class="card shadow radious-10">
              <div class="fb-page" data-href="https://www.facebook.com/icarjapanofficial" data-tabs="timeline" data-max-width="300" data-height="130" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/icarjapanofficial" class="fb-xfbml-parse-ignore">
                  <a href="https://www.facebook.com/icarjapanofficial">ICAR JAPAN</a>
                </blockquote>
              </div>
            </div>
          </div>
          <!-- right row 3 -->
          <div class="right-row-3 mb-3">
            <div class="card shadow radious-10">
              <h5 class="right-row-title text-white">
                ICarJapan is <br />
                in your country now
                <i class="bi bi-globe-americas d-flex justify-content-end"></i>
              </h5>
              <div class="card-body">
                @forelse($countries as $c)
                <p class="card-text">
                  <img src="{{asset('front/img/japan2.png')}}" alt="" />{{$c->name}}
                </p>
                @empty
                @endforelse
              </div>
            </div>
          </div>
          <!-- right row 5 -->
          <div class="right-row-5 mb-3">
            <div class="card shadow radious-10">
              <h5 class="card-title text-brand">ICarJapan News</h5>
              <div class="card-body">
                <div class="row right-blog-view mb-3">
                  <div class="col-sm-6">
                    <img class="img-fluid" src="{{asset('front/img/ad-blog1.png')}}" alt="" />
                  </div>
                  <div class="col-sm-6 p-0">
                    <p>Coming Soon New Model TOYOTA</p>
                    <span>12th December, 2022</span>
                  </div>
                </div>
                <div class="row right-blog-view mb-3">
                  <div class="col-sm-6">
                    <img class="img-fluid" src="{{asset('front/img/ad-blog1.png')}}" alt="" />
                  </div>
                  <div class="col-sm-6 p-0">
                    <p>Coming Soon New Model TOYOTA</p>
                    <span>12th December, 2022</span>
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
  <script src="{{ asset('front/js/jquery-ui.min.js') }}"></script>
  <script>
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
					//console.log(res);
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
			if (ui.content.length == 1) {
				$(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
				$(this).autocomplete("close");
			}
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
  </script>

<script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "2464933096867027");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v17.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

      $(document).ready(function() {
        $('#myModal').modal('show');
    });
    </script>
  @endpush