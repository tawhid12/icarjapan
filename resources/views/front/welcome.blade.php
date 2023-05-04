@extends('layout.landing')
@section('pageTitle','ICARJAPAN')
@section('pageSubTitle','HOME')
@push('styles')
<link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
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
        <!-- left row 2 -->
        <div class="left-row-2 mb-3">
          <div class="card shadow radious-10">
            <h5 class="card-title bg-brand text-white">
            {{$com_acc_info->c_name}} {{--$countryName->name--}}
            </h5>
            <div class="card-body">
              <p class="card-text">
                <i class="bi bi-geo-alt-fill"></i> {{$location['geoplugin_city']}}
              </p>
              <p class="card-text">
                <i class="bi bi-telephone-fill"></i> {{$com_acc_info->tel}}
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
                <a href="{{route('brand',strtolower($b->slug_name))}}" style="text-decoration:none;color:#000;"><img src="{{asset('uploads/brands/'.$b->image)}}" alt="" /> {{$b->name}} ({{$b->vehicles_count}})</a>
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
      <div class="col-sm-12 col-md-12 col-lg-7 container-xl-7">
        <!-- mid row 1 -->
        <div class="mid-row-1">
          <div class="input-group mb-3 shadow">
            <span class="input-group-text">Search Car</span>
            <input type="text" id="item_search" class="form-control ui-autocomplete-input" aria-label="Amount (to the nearest dollar)" />
            <span class="input-group-text"><i class="bi bi-search"></i></span>
          </div>
        </div>
        <!-- mid row 2 -->
        <div class="mid-row-2">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 mid-md-banner mb-3 d-flex justify-content-center">
              <img class="img-fluid shadow" src="{{asset('front/img/slide3.png')}}" alt="" />
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 mid-sm-banner mb-3">
              <img class="img-fluid mb-3 shadow mb-3" src="{{asset('front/img/slide1.png')}}" alt="" />
              <img class="img-fluid shadow" src="{{asset('front/img/image_3.png')}}" alt="" />
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 mid-sm-banner mb-3 justify-content-center">
              <img class="img-fluid mb-3 shadow" src="{{asset('front/img/image_3.png')}}" alt="" />
              <img class="img-fluid" src="{{asset('front/img/slide1.png')}}" alt="" />
            </div>
          </div>
        </div>
        <!-- mid row 3 -->
        <div class="my-4 d-flex justify-content-center">
          <div class="d-flex mid-row-3">
            <a class="shadow" href="#">My Accounts Status</a>
            <a class="shadow" href="#"><i class="bi bi-heart-fill"></i>My Favorites</a>
            <a class="shadow" href="#"><i class="bi bi-binoculars"></i>My Recent Views</a>
            <a class="shadow" href="#"><i class="bi bi-search"></i>My Search History</a>
          </div>
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
          <div class="row row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
            @php //echo '<pre>'; print_r($most_views->toArray());die;@endphp
              @forelse($most_views as $v)
              <div class="col">
                <div class="product-card my-3">
                  <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                  <div class="product-card-body">
                  <p><a href="{{route('singleVehicle',['brand'=>$v->b_slug,'subBrand'=>$v->sb_slug,'stock_id'=>$v->stock_id])}}" style="text-decoration:none!important;">{{ str_replace('-', ' ', $v->name) }}</a></p>
                    @php $vmodel = \DB::table('vehicle_models')->where('id',$v->v_model_id)->first(); @endphp
                    @if($vmodel)
                    <p>{{$vmodel->name}}</p>
                    @endif
                    @php
                      $actual_price = $v->price;
                      $dis_price = $v->price*$v->discount/100;
                      $price = $actual_price - $dis_price;
                    @endphp
                    <p>Price :</p>
                    <p>USD {{$price}}</p>
                    <div class="product-card-currency">
                      <p>Approx.</p>
                      <p>BDT {{number_format($location['geoplugin_currencyConverter']*$price, 2, ',', ',')}}</p>
                    </div>
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
            <div class="row row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
              @forelse($new_arivals as $n)
             
              <div class="col">
                <div class="product-card my-3">
                  <a href="">
                  <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                  </a>
                  <div class="product-card-body">
                    <p><a href="{{route('singleVehicle',['brand'=>$n->b_slug,'subBrand'=>$n->sb_slug,'stock_id'=>$n->stock_id])}}" style="text-decoration:none!important;">{{ str_replace('-', ' ', $n->name) }}</a></p>
                    @php $vmodel = \DB::table('vehicle_models')->where('id',$n->v_model_id)->first(); @endphp
                    @if($vmodel)
                    <p>{{$vmodel->name}}</p>
                    @endif
                    @php
                      $actual_price = $n->price;
                      $dis_price = $n->price*$n->discount/100;
                      $price = $actual_price - $dis_price;
                    @endphp
                    <p>Price :</p>
                    <p>USD {{$price}}</p>
                    <div class="product-card-currency">
                      <p>Approx.</p>
                      <p>BDT {{number_format($location['geoplugin_currencyConverter']*$price, 2, ',', ',')}}</p>
                    </div>
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
            <div class="row row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
              @forelse($afford_by_country as $af)
              <div class="col">
                <div class="product-card my-3">
                  <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                  <div class="product-card-body">
                    <p><a href="{{route('singleVehicle',['brand'=>$af->b_slug,'subBrand'=>$af->sb_slug,'stock_id'=>$af->stock_id])}}" style="text-decoration:none!important;">{{ str_replace('-', ' ', $v->name) }}</a></p>
                    @php $vmodel = \DB::table('vehicle_models')->where('id',$af->v_model_id)->first(); @endphp
                    @if($vmodel)
                    <p>{{$vmodel->name}}</p>
                    @endif
                    @php
                      $actual_price = $af->price;
                      $dis_price = $af->price*$af->discount/100;
                      $price = $actual_price - $dis_price;
                    @endphp
                    <p>Price :</p>
                    <p>USD {{$price}}</p>
                    <div class="product-card-currency">
                      <p>Approx.</p>
                      <p>BDT {{number_format($location['geoplugin_currencyConverter']*$price, 2, ',', ',')}}</p>
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
            <div class="row row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
            @forelse($high_grade_by_country as $hg)
              <div class="col">
                <div class="product-card my-3">
                  <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                  <div class="product-card-body">
                    <p><a href="{{route('singleVehicle',['brand'=>$hg->b_slug,'subBrand'=>$hg->sb_slug,'stock_id'=>$hg->stock_id])}}" style="text-decoration:none!important;">{{ str_replace('-', ' ', $v->name) }}</a></p>
                    @php $vmodel = \DB::table('vehicle_models')->where('id',$hg->v_model_id)->first(); @endphp
                    @if($vmodel)
                    <p>{{$vmodel->name}}</p>
                    @endif
                    @php
                      $actual_price = $hg->price;
                      $dis_price = $hg->price*$hg->discount/100;
                      $price = $actual_price - $dis_price;
                    @endphp
                    <p>Price :</p>
                    <p>USD {{$price}}</p>
                    <div class="product-card-currency">
                      <p>Approx.</p>
                      <p>BDT {{number_format($location['geoplugin_currencyConverter']*$price, 2, ',', ',')}}</p>
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
                  <option value="1">LHS</option>
                  <option value="2">RHL</option>
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
              <img class="img-fluid" src="{{asset('front/img/Shipping-Shedule.png')}}" alt="" />
            </a>
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
  @endpush