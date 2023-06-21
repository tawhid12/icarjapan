@extends('layout.landing')

@section('pageSubTitle','ICAR JAPAN')
@section('meta')
@if(!empty($v->name))
<meta property="og:title" content="{{$v->name}}">
@endif
@if(!empty($v->description))
<meta property="og:description" content="{{$v->description}}">
@endif
<meta property="og:site_name" content="ICAR JAPAN">
<meta property="fb:app_id" content="800032724610621" />
<meta property="og:type" content="website" />
@if(!empty($cover_img->image))
<meta property="og:image" content="{{asset('uploads/vehicle_images/'.$cover_img->image)}}">
@endif
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="640" />
<meta property="og:image:height" content="480" />
@if(!empty($v->name))
<meta property="og:image:alt" content="{{$v->name}}" />
@endif
<meta name="keywords" content="">
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />



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



  .slick-slider {
    position: relative;
    display: block;
    box-sizing: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-touch-callout: none;
    -khtml-user-select: none;
    -ms-touch-action: pan-y;
    touch-action: pan-y;
    -webkit-tap-highlight-color: transparent
  }

  .slick-list {
    position: relative;
    display: block;
    overflow: hidden;
    margin: 0;
    padding: 0
  }

  .slick-list:focus {
    outline: none
  }

  .slick-list.dragging {
    cursor: pointer;
    cursor: hand
  }

  .slick-slider .slick-track,
  .slick-slider .slick-list {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }

  .slick-track {
    position: relative;
    top: 0;
    left: 0;
    display: block;
    margin-left: auto;
    margin-right: auto
  }

  .slick-track:before,
  .slick-track:after {
    display: table;
    content: ''
  }

  .slick-track:after {
    clear: both
  }

  .slick-loading .slick-track {
    visibility: hidden
  }

  .slick-slide {
    display: none;
    float: left;
    height: 100%;
    min-height: 1px
  }

  [dir='rtl'] .slick-slide {
    float: right
  }

  .slick-slide img {
    display: block
  }

  .slick-slide.slick-loading img {
    display: none
  }

  .slick-slide.dragging img {
    pointer-events: none
  }

  .slick-initialized .slick-slide {
    display: block
  }

  .slick-loading .slick-slide {
    visibility: hidden
  }

  .slick-vertical .slick-slide {
    display: block;
    height: auto;
    border: 1px solid transparent
  }

  .slick-arrow.slick-hidden {
    display: none;
  }

  .slick-loading .slick-list {
    background: #fff url({{url('public/assets/images/ajax-loader.gif')}}) center center no-repeat;
  }

  @font-face {
    font-family: 'slick';
    font-weight: normal;
    font-style: normal;
    src: url("./fonts/slick.eot");
    src: url("./fonts/slick.eot?#iefix") format("embedded-opentype"), url("./fonts/slick.woff") format("woff"), url("./fonts/slick.ttf") format("truetype"), url("./fonts/slick.svg#slick") format("svg")
  }

  .slick-prev,
  .slick-next {
    font-size: 0;
    line-height: 0;
    position: absolute;
    top: 50%;
    display: block;
    width: 20px;
    height: 20px;
    margin-top: -10px;
    padding: 0;
    cursor: pointer;
    color: transparent;
    border: 0;
    outline: 0;
    background: transparent
  }

  .slick-prev:hover,
  .slick-prev:focus,
  .slick-next:hover,
  .slick-next:focus {
    color: transparent;
    outline: 0;
    background: transparent
  }

  .slick-prev:hover:before,
  .slick-prev:focus:before,
  .slick-next:hover:before,
  .slick-next:focus:before {
    opacity: 1
  }

  .slick-prev.slick-disabled:before,
  .slick-next.slick-disabled:before {
    opacity: 0.25
  }

  .slick-prev:before,
  .slick-next:before {
    font-family: 'slick';
    font-size: 20px;
    line-height: 1;
    opacity: 0.75;
    color: white;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale
  }



  .slick-dots {
    position: absolute;
    bottom: -45px;
    display: block;
    width: 100%;
    padding: 0;
    list-style: none;
    text-align: center
  }

  .slick-dots li {
    position: relative;
    display: inline-block;
    width: 20px;
    height: 20px;
    margin: 0 5px;
    padding: 0;
    cursor: pointer
  }

  .slick-dots li button {
    font-size: 0;
    line-height: 39px;
    display: block;
    width: 30px;
    height: 30px;
    padding: 5px;
    cursor: pointer;
    color: transparent;
    border: 0;
    outline: 0;
    background: transparent
  }

  .slick-dots li button:hover,
  .slick-dots li button:focus {
    outline: 0
  }

  .slick-dots li button:hover:before,
  .slick-dots li button:focus:before {
    opacity: 1
  }

  .slick-dots li button:before {
    font-family: 'slick';
    position: absolute;
    top: -10px;
    left: 0;
    width: 30px;
    height: 30px;
    content: "•";
    text-align: center;
    opacity: .25;
    color: #000;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale
  }

  @media screen and (min-width: 1024px) {
    .slick-dots li button:before {
      font-size: 79px
    }
  }

  @media screen and (max-width: 1023px) {
    .slick-dots li button:before {
      font-size: 45px !important
    }
  }

  .slick-dots li.slick-active button:before {
    opacity: 0.75;
    color: black;
  }


  #contents_detail .car_detail_car_navigation li {
    display: block
  }

  #contents_detail .car_display_area {
    position: relative;
  }

  #contents_detail .car_display_area #pager_display {
    position: absolute;
    width: 58px;
    font-size: 12px;
    background-color: rgba(0, 0, 0, .4);
    color: #fff;
    line-height: 1.5405;
    text-align: center;
    bottom: 17px;
    left: 50%;
    border-radius: 4px;
    margin-left: -29px !important;
    z-index: 3;
  }
  #contents_detail .car_display_area .img_inner_sold_disp_text {
    position: absolute;
    bottom: 0px;
    left: 0;
    width: 100%;
    color: #f03;
    text-shadow: 2px 2px 0 #fff, 0 0 4px #fff;
    font-weight: 700;
    line-height: 2;
    z-index: 3;
    font-size:18px;
}

  #contents_detail .car_display_area #car_MainIMG_car_display {
    margin-bottom: 6px;
  }


  #contents_detail #car_MainIMG_car_display:not(.slick-slider) {
    width: 640px;
    height: 480px;
    overflow: hidden;
  }

  #contents_detail #car_MainIMG_car_display button.slick-arrow {
    position: absolute;
    width: 7.94259375%;
    height: 100%;
    bottom: 0;
    top: 0;
    border: none;
    cursor: pointer;
    outline: 0;
    padding: 0;
    box-shadow: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: transparent;
    z-index: 2
  }

  #contents_detail #car_MainIMG_car_display.playingYoutube button.slick-arrow {
    bottom: 164px;
    height: 316px
  }

  #contents_detail #car_MainIMG_car_display.playingVR button.slick-arrow {
    position: absolute;
    top: 50%;
    margin: -21px auto;
    z-index: 10;
    height: 42px;
    width: 44px
  }

  #contents_detail #car_MainIMG_car_display button.slick-arrow.slick-disabled {
    opacity: .2;
    cursor: default
  }

  #contents_detail #car_MainIMG_car_display button.slick-arrow i {
    display: block;
    font-size: 41px;
    width: .4544em;
    height: .4544em;
    border-width: 0 0 .2em .2em;
    border-color: transparent transparent rgba(255, 255, 255, .8) rgba(255, 255, 255, .8);
    border-radius: 1.5px;
    border-style: none none solid solid;
    position: absolute;
    top: 50%;
    margin-top: -.2272em
  }

  #contents_detail #car_MainIMG_car_display button.slick-arrow i {
    margin-top: 13px
  }

  #contents_detail #car_MainIMG_car_display button.slick-arrow:not(.slick-disabled):hover i {
    border-color: transparent transparent #fff #fff
  }

  #contents_detail #car_MainIMG_car_display button.slick-arrow.main_slide_prevbutton {
    left: 0
  }

  #contents_detail #car_MainIMG_car_display button.slick-arrow.main_slide_prevbutton i {
    -moz-transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    left: 16px
  }

  #contents_detail #car_MainIMG_car_display button.slick-arrow.main_slide_nextbutton {
    right: 0
  }

  #contents_detail #car_MainIMG_car_display button.slick-arrow.main_slide_nextbutton i {
    -moz-transform: rotate(-135deg);
    -webkit-transform: rotate(-135deg);
    -o-transform: rotate(-135deg);
    -ms-transform: rotate(-135deg);
    transform: rotate(-135deg);
    right: 16px
  }

  #contents_detail #car_thumbnail_car_navigation:not(.slick-slider) {
    width: 590px;
    margin: auto
  }

  #contents_detail #car_thumbnail_car_navigation:not(.slick-slider) div {
    width: 75px !important;
    height: 56.25px;
    float: left;
    margin-left: 8px;
    margin-bottom: 5px
  }

  #contents_detail #car_thumbnail_car_navigation {
    overflow: hidden;
    padding-top: 4px
  }

  #contents_detail #car_thumbnail_car_navigation:after,
  #contents_detail #car_thumbnail_car_navigation:before {
    content: "";
    display: block;
    background-color: #fff;
    height: 127px;
    width: 31px;
    position: absolute;
    top: -1px;
    z-index: 1;
    visibility: visible
  }

  #contents_detail #car_thumbnail_car_navigation:before {
    background: -moz-linear-gradient(left, #fff 0, rgba(255, 255, 255, 0) 100%);
    background: -webkit-gradient(linear, left top, right top, color-stop(0, #fff), color-stop(100%, rgba(255, 255, 255, 0)));
    background: -webkit-linear-gradient(left, #fff 0, rgba(255, 255, 255, 0) 100%);
    background: -o-linear-gradient(left, #fff 0, rgba(255, 255, 255, 0) 100%);
    background: -ms-linear-gradient(left, #fff 0, rgba(255, 255, 255, 0) 100%);
    background: linear-gradient(to right, #fff 0, rgba(255, 255, 255, 0) 100%);
    left: 0
  }

  #contents_detail #car_thumbnail_car_navigation:after {
    background: -moz-linear-gradient(left, rgba(255, 255, 255, 0) 0, #fff 100%);
    background: -webkit-gradient(linear, left top, right top, color-stop(0, rgba(255, 255, 255, 0)), color-stop(100%, #fff));
    background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0, #fff 100%);
    background: -o-linear-gradient(left, rgba(255, 255, 255, 0) 0, #fff 100%);
    background: -ms-linear-gradient(left, rgba(255, 255, 255, 0) 0, #fff 100%);
    background: linear-gradient(to right, rgba(255, 255, 255, 0) 0, #fff 100%);
    right: 0
  }

  #contents_detail #car_thumbnail_car_navigation button.original_slick-arrow {
    width: 25px;
    height: 66px;
    background-color: rgba(0, 0, 0, .5);
    position: absolute;
    top: 50%;
    margin-top: -33px;
    border: none;
    cursor: pointer;
    outline: 0;
    padding: 0;
    box-shadow: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    z-index: 2
  }

  #contents_detail #car_thumbnail_car_navigation button.original_slick-arrow.slick-disabled {
    background-color: rgba(0, 0, 0, .2);
    cursor: default
  }

  #contents_detail #car_thumbnail_car_navigation .original_slick-arrow i {
    font-size: 25px;
    display: block;
    width: .34512em;
    height: .34512em;
    border-width: 0 0 2px 2px;
    border-style: none none solid solid;
    border-color: transparent transparent #fff #fff;
    border-radius: .5px;
    line-height: 33px
  }

  #contents_detail #car_thumbnail_car_navigation button.original_slick-arrow.slick-disabled i {
    opacity: .54
  }

  #contents_detail #car_thumbnail_car_navigation #thum_slide_prevbutton.original_slick-arrow {
    left: 0
  }

  #contents_detail #car_thumbnail_car_navigation #thum_slide_prevbutton.original_slick-arrow i {
    -moz-transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    float: left;
    margin-left: 8px
  }

  #contents_detail #car_thumbnail_car_navigation #thum_slide_nextbutton.original_slick-arrow {
    right: 0
  }

  #contents_detail #car_thumbnail_car_navigation #thum_slide_nextbutton.original_slick-arrow i {
    -moz-transform: rotate(-135deg);
    -webkit-transform: rotate(-135deg);
    -o-transform: rotate(-135deg);
    -ms-transform: rotate(-135deg);
    transform: rotate(-135deg);
    float: right;
    margin-right: 8px
  }

  #contents_detail #car_thumbnail_car_navigation .slick-list {
    width: 590px;
    margin: auto;
    overflow: visible
  }

  @media all and (-ms-high-contrast:none) {
    #contents_detail #car_thumbnail_car_navigation .slick-list {
      overflow: hidden;
      padding-top: 2px
    }
  }

  #contents_detail #car_thumbnail_car_navigation div.slick-slide>div>div {
    width: 75px !important;
    height: 56.25px;
    float: left;
    margin-left: 8px;
    margin-bottom: 5px;
    cursor: pointer
  }

  #contents_detail #car_thumbnail_car_navigation div.slick-slide>div>div.now_imgDisplay img {
    outline: 1px solid #e60012;
    -moz-box-shadow: 0 0 2px #e60012;
    -webkit-box-shadow: 0 0 2px #e60012;
    -o-box-shadow: 0 0 2px #e60012;
    -ms-box-shadow: 0 0 2px #e60012;
    box-shadow: 0 0 2px #e60012
  }

  #contents_detail #car_thumbnail_car_navigation div img {
    max-height: 56.25px;
    width: auto;
    max-width: 100%;
    margin: auto;
    display: block
  }

  #contents_detail .car_display_area {
    position: relative;
  }

  #contents_detail .car_display_area #pager_display {
    position: absolute;
    width: 58px;
    font-size: 12px;
    background-color: rgba(0, 0, 0, .4);
    color: #fff;
    line-height: 1.5405;
    text-align: center;
    bottom: 17px;
    left: 50%;
    border-radius: 4px;
    margin-left: -29px !important;
    z-index: 3;
  }

  /*Share */
  div#social-links ul {
    margin: 0;
  }

  div#social-links ul li {
    display: inline-block;
  }

  div#social-links ul li a {
    color: #fff;
    font-size: 18px;
    margin: 0 2px;
    padding: 0px 22px;
    display: block;

  }

  div#social-links ul li:nth-child(1) a {
    background-color: #32529f;
  }

  div#social-links ul li:nth-child(2) a {
    background-color: #1da1f2;
  }

  div#social-links ul li:nth-child(3) a {
    background-color: #25d366;
  }

  .bg-danger-subtle {
    border: 1px solid #d6d6d6;
    font-size: 14px;
    text-align: center;
    height: 30px;
  }

  .detl th,
  td {
    background-color: #f8f8f8;
  }

  .detl th,
  td {
    border: 1px solid #d6d6d6;
  }

  .bg-button {
    font-weight: 700;
    font-size: 20px;
    text-decoration: none;
    background-color: red;
    color: #fff;
    padding: 6px 42px;
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
    <div class="row gx-3">
      <div class="col-md-12">
        <!-- breadcrumb -->
        @include('partials.breadcrumbs',['model' => $brand])
      </div>
      <div class="col-md-10 offset-md-1">
        <!-- Product Search -->
        @include('front.search-box')
      </div>
      <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2 container-xl-2 left-col">
          <!-- left row  -->
          <div class="left-row-2 mb-3">
            <div class="card shadow radious-10">
              <h5 class="card-title bg-brand text-white">Recommend Car</h5>
              <div class="p-2">
                <!-- product card -->
                <div class="row justify-content-center">
                  @forelse($recomended as $r)
                  <div class="col-12">
                    <div class="product-card my-3">
                      @php $cover_img = \DB::table('vehicle_images')->where('vehicle_id',$r->vid)->where('is_cover_img',1)->first(); @endphp
                      @if($cover_img)
                      <img class="img-fluid" src="{{asset('uploads/vehicle_images/'.$cover_img->image)}}" alt="" />
                      @else
                      <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                      @endif
                      <div class="product-card-body">
                        <p clss="m-0"><a href="{{route('singleVehicle',['brand'=>$r->b_slug,'subBrand'=>$r->sb_slug,'stock_id'=>$r->stock_id])}}" style="text-decoration:none!important;">{{ str_replace('-', ' ', $r->name) }}</a></p>
                        <p class="m-0">{{$r->chassis_no}}</p>
                        @php
                        $actual_price = $v->price;
                        $dis_price = $v->price*$v->discount/100;
                        $price = $actual_price - $dis_price;
                        @endphp
                        @if($price > 0)
                        <p>Price :</p>
                        <p>USD {{$price}}</p>
                        <div class="product-card-currency">
                          <p>Approx.</p>
                          <p>{{$location['geoplugin_currencyCode']}} {{number_format($location['geoplugin_currencyConverter']*$price, 2, ',', ',')}}</p>
                        </div>
                        @else
                        <p>Ask</p>
                        @endif
                      </div>
                    </div>
                  </div>
                  @empty
                  @endforelse
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-10 col-md-10 col-lg-10 container-xl-7">
          <!-- mid row 1 -->
          <div class="sg-mid-row-1">

            <div class="d-flex justify-content-between align-items-center">
              <!-- Status -->
              <div class="d-flex status">
                <div class="hg-box inv">
                  <p>
                    <span>
                      @if($v->inv_loc)
                      @if($v->inv_loc->image)
                      <img src="{{asset('uploads/country/'.$v->inv_loc->image)}}" alt="" />
                      @endif
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
              {!! $shareComponent !!}
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
                  <div id="contents_detail" class="single">
                    <div class="car_display_area">
                      <div id="car_MainIMG_car_display">
                        @forelse($v_images as $v_img)
                        <div>
                          <!--<img class="lazy" src="{{url('public/uploads/default/comingsoon_l.png')}}" data-original="{{asset('uploads/vehicle_images/'.$v_img->image)}}" alt="" width="592" height="480" />-->
                          <img src="{{asset('uploads/vehicle_images/'.$v_img->image)}}" alt="" width="592" height="480" />
                          
                        </div>
                        @empty
                        @endforelse




                      </div><!-- #car_MainIMG_car_display -->
                      @if($v->r_status)
                          <p class="img_inner_sold_disp_text">Reserved</p>
                          @endif
                      <p id="pager_display" class="nopointer_event nowrap_txt"><span id="currentPage_display">1</span>&nbsp;/&nbsp;<span id="totalPages_display">00</span></p>
                    </div>
                    <div>
                      <span class="centre bluecolor">Click on thumbnails to enlarge</span>
                    </div>


                    <div id="car_thumbnail_car_navigation" class="clearfix car_detail_car_navigation">
                      @forelse($v_images as $key => $v_img)
                      @if($key == 0)


                      <div id="imgdisp_select{{$key}}" class="now_imgDisplay">
                        <!--<img class="lazy" src="{{url('public/uploads/default/comingsoon_l.png')}}" data-original="{{route('resizeImage',[$v_img->image,75,75])}}" alt="" />-->
                        <img src="{{route('resizeImage',[$v_img->image,75,75])}}" alt="" />
                      </div>
                      @else
                      <div id="imgdisp_select{{$key}}">
                        <img src="{{route('resizeImage',[$v_img->image,75,75])}}" alt="" />
                      </div>
                      @endif

                      @empty
                      @endforelse
                    </div><!-- #car_thumbnail_car_navigation -->
                  </div>
                  <!--Car Details  -->
                  <div class="">
                    <table class="table table-sm detl">
                      <thead>
                        <tr>
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
                          <td>{{ optional($v->inv_loc)->name }} | {{ optional($v->inv_port)->name }}</td>
                        </tr>
                        <tr>
                          <th scope="row">Chassis</th>
                          <td>{{ $v->chassis_no }}</td>
                          <th scope="row">Drive</th>
                          <td>{{ optional($v->drive_type)->name }}</td>
                        </tr>
                        <tr>
                          <th scope="row">Manufacture Year</th>
                          <td>{{$v->manu_year}}</td>
                          <th scope="row">Registration Year</th>
                          <td>
                            @if($v->reg_year)
                              {{\Carbon\Carbon::createFromTimestamp(strtotime($v->reg_year))->format('Y')}}
                            @endif
                          </td>
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
                          <td>
                            @if($v->b_length && $v->b_height && $v->b_width)
                            {{ $v->b_length }} x {{ $v->b_height }} x {{ $v->b_width }}
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Fuel Type</th>
                          <td>{{ optional($v->fuel)->name }}</td>
                          <th scope="row">M3</th>
                          <td>{{ $v->m3 }}</td>
                        </tr>
                        <tr>
                          {{--<th scope="row">Int. Color</th>
                          <td>{{ optional($v->int_color)->name }}</td>--}}
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

                  <!--Accessories  -->
                  <div class="mt-2">
                    <table class="m-0 table table-hover table-sm table-bordered boder border-danger-subtle">
                      <thead>
                        <tr class="table-dark">
                          <th class="text-center" colspan="4" scope="col">
                            Features
                          </th>
                        </tr>
                      </thead>
                    </table>
                    <div class="row gx-0">

                      @if($v->cd_player ==1) <div class="col-md-3 bg-danger-subtle">CD Player</div> @endif
                      @if($v->sun_roof ==1) <div class="col-md-3 bg-danger-subtle">Sun Roof</div> @endif
                      @if($v->leather_seat ==1)<div class="col-md-3 bg-danger-subtle">Leather Seat</div>@endif
                      @if($v->alloy_wheels ==1)<div class="col-md-3 bg-danger-subtle">Alloy Wheels</div> @endif

                      @if($v->power_steering ==1)<div class="col-md-3 bg-danger-subtle">Power Steering</div> @endif
                      @if($v->power_windows ==1)<div class="col-md-3 bg-danger-subtle">Power Windows</div> @endif
                      @if($v->air_con ==1)<div class="col-md-3 bg-danger-subtle">Air Con</div> @endif
                      @if($v->anti_lock_brake_system ==1)<div class="col-md-3 bg-danger-subtle">Anti lock Brake System</div> @endif

                      @if($v->air_bag ==1)<div class="col-md-3 bg-danger-subtle">Air Bag</div> @endif
                      @if($v->radio ==1)<div class="col-md-3 bg-danger-subtle">Radio</div> @endif
                      @if($v->cd_changer ==1)<div class="col-md-3 bg-danger-subtle">Cd Changer</div> @endif
                      @if($v->dvd ==1)<div class="col-md-3 bg-danger-subtle">DVD</div>@endif

                      @if($v->tv ==1)<div class="col-md-3 bg-danger-subtle">TV</div> @endif
                      @if($v->power_seat ==1)<div class="col-md-3 bg-danger-subtle">Power Seat</div> @endif
                      @if($v->back_tire ==1)<div class="col-md-3 bg-danger-subtle">Back Tire </div>@endif
                      @if($v->grill_guard ==1)<div class="col-md-3 bg-danger-subtle">Grill Guard</div> @endif

                      @if($v->rear_spoiler ==1)<div class="col-md-3 bg-danger-subtle">Rear Spoiler</div> @endif
                      @if($v->central_locking ==1)<div class="col-md-3 bg-danger-subtle">Central Locking</div> @endif
                      @if($v->jack ==1)<div class="col-md-3 bg-danger-subtle">Jack</div>@endif
                      @if($v->spare_tire ==1)<div class="col-md-3 bg-danger-subtle">Spare Tire</div> @endif

                    @if($v->wheel_spanner ==1)<div class="col-md-3 bg-danger-subtle">Wheel Spanner</div> @endif
                    @if($v->fog_lights ==1)<div class="col-md-3 bg-danger-subtle">Fog Lights</div> @endif
                    @if($v->back_camera ==1)<div class="col-md-3 bg-danger-subtle">Back Camera</div> @endif
                    @if($v->push_start ==1)<div class="col-md-3 bg-danger-subtle">Push Start</div> @endif

                    @if($v->keyless_entry ==1)<div class="col-md-3 bg-danger-subtle">Keyless Entry</div> @endif
                    @if($v->esc ==1)<div class="col-md-3 bg-danger-subtle">ESC</div> @endif
                    @if($v->deg_360_cam ==1)<div class="col-md-3 bg-danger-subtle">360 Degree Camera</div> @endif
                    @if($v->body_kit ==1)<div class="col-md-3 bg-danger-subtle">Body Kit</div> @endif

                    @if($v->side_airbag ==1)<div class="col-md-3 bg-danger-subtle">Side Airbag</div>@endif
                    @if($v->power_mirror ==1)<div class="col-md-3 bg-danger-subtle">Power Mirror</div> @endif
                    @if($v->side_skirts ==1)<div class="col-md-3 bg-danger-subtle">Side Skirts</div> @endif
                    @if($v->front_lip_spoiler ==1)<div class="col-md-3 bg-danger-subtle">Front Lip Spoiler</div> @endif

                    @if($v->navigation ==1)<div class="col-md-3 bg-danger-subtle">Navigation</div> @endif
                    @if($v->turbo ==1)<div class="col-md-3 bg-danger-subtle">Turbo</div> @endif


                  </div>
                </div>

                <!-- Customer's Photo Gallery  -->
                <div class="card shadow radious-10 my-3">
                  <h5 class="card-title bg-black text-white">
                    Customer's Photo Gallery
                  </h5>
                  <div class="p-2 customer-gallery">
                    <div class="row">
                      <div class="col-sm-4">
                        <a href="">
                          <!--<img src="./resource/img/client-galary.png" alt="" />-->
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- REVIEW HIGHLIGHTS  -->
                <!-- <div class="card shadow radious-10 my-3">
                  <h5 class="card-title bg-black text-white">
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
                </div> -->
                <!-- Review Section -->
                <!-- <div class="card shadow radious-10 my-3">
                  <h5 class="card-title bg-black text-white">REVIEWS</h5>
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
                </div> -->
                <!-- REVIEW HIGHLIGHTS  -->
                <div class="card shadow radious-10 my-3">
                  <h5 class="card-title bg-black text-white">
                    Recently Viewed Cars
                  </h5>
                  <div class="p-2 customer-highlights text-center">
                    <div class="row">
                      {{--<div class="col-sm-4">
                        <div class="product-card my-3">
                          <!--<img class="img-fluid" src="./resource/img/product-img.png" alt="" />-->
                          <div class="product-card-body">
                            <p>TOYOTA ALLION 2018TOYOTA ALLION 2018</p>
                            <p>DBA-NZT260</p>
                            <p>Price :</p>
                            <p>USD 13,000.00</p>
                            <div class="product-card-currency">
                              <p>Approx.</p>
                              <p>{{$location['geoplugin_currencyCode']}} 1,13,000.00</p>
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
                          @if($price_after_dis > 0)
                          <tr>
                            <th scope="row" class="fs-6">Vehicle Price</th>
                            <td><strong class="fs-5 veh-pr"></strong></td>
                          </tr>
                          @endif
                          @if($dis_price > 0)
                          <tr>
                            <th scope="row"></th>
                            <td><del>USD {{$actual_price}}</del></td>
                          </tr>
                          <tr>
                            <th scope="row">Save</th>
                            <td>USD {{$dis_price}} ({{$v->discount}}%)</td>
                          </tr>
                          @endif
                          @if($price_after_dis > 0)
                          <tr>
                            <th scope="row">Approx.</th>
                            <td>{{$location['geoplugin_currencyCode']}} {{number_format(round($location['geoplugin_currencyConverter']*$price_after_dis), 2, '.', ',')}}</td>
                            <input type="hidden" class="convert_price" value="{{round($location['geoplugin_currencyConverter']*$price_after_dis)}}">
                          </tr>
                          @endif
                          <tr>
                            <th scope="row">Destination Country</th>
                            <td>
                              <select class="form-select form-select-sm country" name="country_id">
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
                          {{--<tr>
                              <th colspan="2" id="table-bg" scope="row">
                                {{$v->note}}
                          </th>
                          </tr>--}}
                          <tr>
                            <th scope="row">Destination Port</th>
                            <td>
                              @php
                              if(\Session::get('country_id') && empty(request('country_id'))){
                              $des_port = \DB::table('ports')->where('inv_loc_id',\Session::get('country_id'))->get();
                              $des_country = \DB::table('countries')->where('id',\Session::get('country_id'))->first();
                              }elseif(!empty(request('country_id'))){

                              $des_port = \DB::table('ports')->where('inv_loc_id',request('country_id'))->get();
                              $des_country = \DB::table('countries')->where('id',request('country_id'))->first();
                              }else{
                              $des_port = \DB::table('ports')->where('inv_loc_id',$countryName->id)->get();
                              $des_country = \DB::table('countries')->where('id',$countryName->id)->first();
                              }

                              @endphp
                              <select class="des_port form-select form-select-sm" aria-label=".form-select-sm example">
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
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="chk1" value="1" checked name="shipment">
                                <label class="form-check-label" for="chk1">RoRo</label>

                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="chk2" value="2" name="shipment">
                                <label class="form-check-label" for="chk2">Container</label>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">Freight</th>
                            <td class="fr_txt"></td>
                            <input type="hidden" class="fr_val">
                          </tr>
                          <tr>
                            <th scope="row">Vanning</th>
                            <td class="van_txt">N/A</td>
                          </tr>
                          <tr>
                            <th scope="row">Inspection<input type="checkbox" class="mx-2 chk" value="{{$des_country->inspection}}"></th>
                            <td class="ins_txt">USD {{$des_country->inspection}}</td>
                          </tr>
                          <tr class="tr-hide">
                            <th scope="row"></th>
                            <td>Approx. {{$location['geoplugin_currencyCode']}} {{round($location['geoplugin_currencyConverter']*$des_country->inspection)}}</td>
                          </tr>
                          <tr>
                            <th scope="row">Insurance<input type="checkbox" class="mx-2 chk" value="{{$des_country->insurance}}"></th>
                            <td class="insu_txt">USD {{$des_country->insurance}}</td>
                          </tr>
                          <tr class="tr-hide">
                            <th scope="row"></th>
                            <td>Approx. {{$location['geoplugin_currencyCode']}} {{round($location['geoplugin_currencyConverter']*$des_country->insurance)}}</td>
                          </tr>
                          <tr>
                            <th scope="row"></th>
                            <td class="total"></td>
                            <input type="hidden" class="con_total">
                            <input type="hidden" class="non_con_total">
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
                            <td class="fw-bold h-t-price" style="font-size:large"></td>
                          </tr>
                        </tbody>
                      </table>
                      <!-- Contact Us  -->
                    </div>
                  </form>
                </div>
                {{--@if(currentUser() == 'user')--}}
                <div class="card shadow radious-10 my-3 contact-us-section">
                  <h5 class="card-title bg-brand text-white">Contact Us</h5>
                  <div class="p-2 customer-highlights text-center">
                    <a class="bg-button" href="#" data-bs-toggle="modal" data-bs-target="#inquiry"><i class="bi bi-envelope-at-fill"></i> inquiry
                    </a>

                    <p class="">OR</p>
                    <form id="active-form" method="POST" action="{{route('user.reservevehicle.store')}}" style="display: inline;">
                      @csrf
                      <input name="vehicle_id" type="hidden" value="{{$v->id}}">
                      @if(currentUserId())
                      <a href="javascript:void(0)" data-name="{{$v->fullName}}" class="confirm mr-2 bg-button" data-toggle="tooltip" title="Reserve now"><i class="bi bi-cart-check-fill"></i> Reserve Now</a>
                      @else
                      <a class="bg-button" href="#" data-bs-toggle="modal" data-bs-target="#buy_now"><i class="bi bi-cart-check-fill"></i> Reserve Now</a>
                      @endif
                    </form>
                    
                    <div class="my-3">
                      <!--<img src="./resource/img/atm.jpg" alt="" />-->
                    </div>
                  </div>
                </div>
                {{--@endif--}}
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
                              <!-- <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember-me">
                                <label class="form-check-label" for="remember-me">Remember me</label>
                              </div> -->


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
                        <p class="m-0 text-center">
                        Login is required before making a reservation.(Login >>)
                        Please sign up if you don't have an account yet.(Create Account >>)
                        </p>
                        <div class="d-flex justify-content-center mt-2">
                       
                          <a href="{{route('login')}}" class="btn btn-primary me-2">Login</a>
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
  </div>
</main>
<!-- main seciton end -->
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js" integrity="sha512-An4a3FEMyR5BbO9CRQQqgsBscxjM7uNNmccUSESNVtWn53EWx5B9oO7RVnPvPG6EcYcYPp0Gv3i/QQ4KUzB5WA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(document).ready(function() {
    $(function() {
        "use strict";
        var e = $("#car_MainIMG_car_display > .ytslide").length;
        $("#car_MainIMG_car_display").on("init", function(e, t) {
          $("#currentPage_display").text(t.currentSlide + 1), $("#totalPages_display").text(t.slideCount)
        }).slick({
          adaptiveHeight: !0,
          edgeFriction: .2,
          infinite: !1,
          initialSlide: e,
          lazyLoad: "progressive",
          prevArrow: '<button class="main_slide_prevbutton"><i class="fa-chevron-originecssleft" aria-hidden="true"></i></button>',
          nextArrow: '<button class="main_slide_nextbutton"><i class="fa-chevron-originecssright" aria-hidden="true"></i></button>',
          speed: 330,
          zIndex: 100
        }).on("afterChange", function(e, t, r) {
          ($("#currentPage_display").text(r + 1), $('#car_thumbnail_car_navigation div[id^="imgdisp_select"]').removeClass("now_imgDisplay"), $("div#imgdisp_select" + r).addClass("now_imgDisplay"), $(".slick-current").hasClass("ytonly")) ? ($("#car_MainIMG_car_display .ytslide.slick-current > iframe")[0].contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', "*"), $("#car_MainIMG_car_display, #car_MainIMG_car_display .ytslide.slick-current > iframe").addClass("playingYoutube")) : $("#car_MainIMG_car_display .ytslide > iframe").hasClass("playingYoutube") && ($("#car_MainIMG_car_display .ytslide > iframe")[0].contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', "*"), $("#car_MainIMG_car_display, #car_MainIMG_car_display .ytslide > iframe").removeClass("playingYoutube")), $(".slick-current").hasClass("vronly") ? $("#car_MainIMG_car_display").addClass("playingVR") : $("#car_MainIMG_car_display").removeClass("playingVR")
        })
      }), $(function() {
        "use strict";
        $("#car_thumbnail_car_navigation").slick({
          edgeFriction: .2,
          infinite: !1,
          prevArrow: '<button id="thum_slide_prevbutton" class="original_slick-arrow"><i class="fa-chevron-originecssleft" aria-hidden="true">&nbsp;</i></button>',
          nextArrow: '<button id="thum_slide_nextbutton" class="original_slick-arrow"><i class="fa-chevron-originecssright" aria-hidden="true">&nbsp;</i></button>',
          rows: 2,
          slidesPerRow: 7,
          speed: 330,
          touchMove: !1,
          cssEase: "linear",
          focusOnSelect: !0,
          zIndex: 100
        }), $('#car_thumbnail_car_navigation div[id^="imgdisp_select"]').on("click", function() {
          var e = $(this).attr("id").replace("imgdisp_select", "");
          $('#car_thumbnail_car_navigation div[id^="imgdisp_select"]').removeClass("now_imgDisplay"), $(this).addClass("now_imgDisplay"), $("#car_MainIMG_car_display").slick("slickSetOption", "lazyLoad", "ondemand", !0).slick("slickGoTo", e)
        })
      }), $(function() {
        "use strict";
        $("#also_viewed_car_list").slick({
          adaptiveHeight: !0,
          edgeFriction: .2,
          infinite: !1,
          prevArrow: '<button class="main_slide_prevbutton"><i class="fa-chevron-originecssleft" aria-hidden="true"></i></button>',
          nextArrow: '<button class="main_slide_nextbutton"><i class="fa-chevron-originecssright" aria-hidden="true"></i></button>',
          speed: 330,
          zIndex: 100,
          slidesToShow: 3,
          slidesToScroll: 3
        })
      }),
      $(function() {
        "use strict";
        $("#recently_viewed_car_list").slick({
          adaptiveHeight: !0,
          edgeFriction: .2,
          infinite: !1,
          prevArrow: '<button class="main_slide_prevbutton"><i class="fa-chevron-originecssleft" aria-hidden="true"></i></button>',
          nextArrow: '<button class="main_slide_nextbutton"><i class="fa-chevron-originecssright" aria-hidden="true"></i></button>',
          speed: 330,
          zIndex: 100,
          slidesToShow: 3,
          slidesToScroll: 3
        })
      });

    jQuery(function($) {
      $("#contents_detail img.lazy").lazyload({
        effect: 'fadeIn',
        effectspeed: 1000
      });
      $(".car_detail_car_navigation img.lazy").lazyload({
        effect: 'fadeIn',
        effectspeed: 1000
      });
      /*$("#car_MainIMG_car_display img.lazy").lazyload({
        effect: 'fadeIn',
      });*/
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

    /*===Country Wise Port  */
      $('.country').on('change', function() {
      $('#my-form').submit();
    });

    var convert_price = parseFloat($('.convert_price').val())?parseFloat($('.convert_price').val()):0;
    var insurance = "{{$des_country->insurance}}"?"{{$des_country->insurance}}":0;
    var inspection = "{{$des_country->inspection}}"?"{{$des_country->inspection}}":0;
    var m3_value  = "{{ $v->m3 }}";
    var currency_rate = parseFloat("{{$location['geoplugin_currencyConverter']}}").toFixed(2);

    function roro(){
      $('.tr-hide').show();
      $('.van_txt').text('N/A');
      $('.ins_txt').text('USD '+inspection);
      $('.insu_txt').text('USD '+insurance);
      m3Charge();
    }
    function container(){
      $('.tr-hide').hide();
      $('.fr_txt').text('Ask');
      $('.van_txt').text('Ask');
      $('.ins_txt').text('Ask');
      $('.insu_txt').text('Ask');
      if(convert_price >0){
        $('.total').text('Approx.  '+"{{$location['geoplugin_currencyCode']}} " + (convert_price));
      }else{
        $('.total').text('Ask');
      }
      
    }

    var shipment = $('input[name="shipment"]:checked').val();
    if (shipment == 1) {
      roro();
    } else {
      container();
    }

    $('input[name="shipment"]').change(function() {
      var shipment = $('input[name="shipment"]:checked').val();
      if (shipment == 1) {
        roro();
      } else {
        container();
      }
    });
    /**/
    $('.des_port').change(function() {
      m3Charge()
    });
    function m3Charge() {
      /*Destination port*/
      var des_port_id = $('.des_port option:selected').val();
      if (des_port_id) {
        $.ajax({
          url: "{{route('m3Charge')}}",
          type: 'GET',
          dataType: 'json',
          data: {
            id: des_port_id,
          },
          success: function(res) {
            console.log(res)
            if (res) {
              /*M3 Calculation */
              var charge = res.m3
              var value = "{{ $v->m3 }}";
              var ad_cost = parseFloat(res.aditional_cost);
              $('.fr_txt').text('USD ' + (charge * value +ad_cost).toFixed(2));
              $('.fr_val').val((charge * value + ad_cost).toFixed(2));
              $('.total').text('Approx.  '+"{{$location['geoplugin_currencyCode']}} " +(Math.round((charge * value * currency_rate) + convert_price + (ad_cost* currency_rate))));
              $('.con_total').val((Math.round((charge * value * currency_rate) + convert_price + (ad_cost* currency_rate))));
              
              /* To Show Vehicle Price */
              var v_price = parseFloat("{{$price_after_dis}}");
              $('.veh-pr').text('USD '+v_price);
              if((Math.round((charge * value) + v_price + ad_cost)) > 0){
              $('.h-t-price').text('USD '+(Math.round((charge * value) + v_price + ad_cost)));
              }else{
                $('.h-t-price').text('Ask');
              }
              $('.non_con_total').val((Math.round((charge * value) + v_price + ad_cost)));
            }else{
              $('.fr_val').val(0);
              $('.fr_txt').text('USD 0');
              $('.total').text('Approx.  '+"{{$location['geoplugin_currencyCode']}} " + convert_price + arseFloat(ad_cost* currency_rate));
              $('.con_total').val(convert_price + parseFloat(ad_cost* currency_rate));
             
              /* To Show Vehicle Price */
              var v_price = "{{$price_after_dis}}";
              $('.veh-pr').text('USD '+(v_price));
              if((v_price + ad_cost) > 0){
              $('.h-t-price').text('USD '+(Math.round((charge * value) + v_price + ad_cost)));
              }else{
                $('.h-t-price').text('Ask');
              }
              $('.non_con_total').val(v_price + ad_cost);
            }
          }
        });
      }
    }

    $('.chk').on('change', function() {
      var sum = parseFloat($('.con_total').val());
      var non_con_sum = parseFloat($('.non_con_total').val())?parseFloat($('.non_con_total').val()):0;
      var checkboxValue = parseFloat($(this).val())?parseFloat($(this).val()):0;
      if ($(this).is(':checked')) {
      // Checkbox is checked, add its value to the total
      sum += checkboxValue;
      non_con_sum += checkboxValue;
      $('.con_total').val(sum);
      $('.non_con_total').val(non_con_sum);
      } else {
      // Checkbox is unchecked, subtract its value from the total
      sum -= checkboxValue;
      non_con_sum -= checkboxValue;
      $('.con_total').val(sum);
      $('.non_con_total').val(non_con_sum);
    }
      $('.total').text(sum);
     
      if(non_con_sum > 0){
        $('.h-t-price').text('USD '+non_con_sum);
      }else{
        $('.h-t-price').text('Ask');
      }
      
      
    })
  });
</script>
@endpush