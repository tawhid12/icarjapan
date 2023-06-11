@extends('layout.landing')
@section('pageTitle','ICARJAPAN')
@section('pageSubTitle','HOME')
@push('styles')
<style>
  .cat-heading img {
    margin-right: 15px;
  }

  .cat-heading {
    color: red;
    font-size: 22px;
    font-weight: 900;
    margin: 0;
  }

  .cat-heading+p {
    font-size: 18px;
    color: #7a7979;
    font-weight: 700;
  }

  .brand-heading {
    color: #36c;
    text-decoration: none;
    font-weight: 900;
  }

  .rating i.fa {
    color: #f9cc00;
  }

  .rating-count {
    font-size: 12px;
    color: red;
    font-weight: 700;
  }

  .rating-count+p {
    font-size: 14px;
  }

  .rating-count+p+strong {
    color: var(--brand-color);
    font-size: 15px;
  }

  li.cat-item {
    list-style: none;
    display: inline-block;
    background: linear-gradient(to bottom, #fff 0, #eee 100%), #fff;
    margin-bottom: 4px;
    width: 67px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    color: #666;
    font-weight: 600;
    font-size: 17px;

  }

  .cat-nav {
    padding: 0;
    margin: 0;
  }

  .cat-item i.fa {
    margin-left: 7px;
    color: #3974e2;
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
              @if($t->vehicles_count > 0)
              <p class="card-text">
                <i class="bi bi-arrows-move"></i>{{$t->name}} ({{$t->vehicles_count}})
              </p>
              @endif
              @empty
              @endforelse
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-12 col-lg-10 container-xl-10">
        @include('front.search-box')
        <h4 class="cat-heading">{{$country->name}} Cars for Sale</h4>
        <div class="row">
        @forelse ($country_wise_vehicles as $n)
        


          <div class="col-md-4 my-2">
            

            <a href="{{route('singleVehicle',['brand'=>$n->b_slug,'subBrand'=>$n->sb_slug,'stock_id'=>$n->stock_id])}}">
            @php $cover_img = \DB::table('vehicle_images')->where('vehicle_id',$n->vid)->where('is_cover_img',1)->first(); @endphp
            @if($cover_img)
            <img class="img-fluid" src="{{asset('uploads/vehicle_images/'.$cover_img->image)}}" alt="" />
            @else
            <img class="img-fluid" src="{{asset('uploads/default/comingsoon_l.png')}}" alt="" />
            @endif
            </a>



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

      


        @empty
        @endforelse
        </div>

      </div>
    </div>
</main>
@endsection