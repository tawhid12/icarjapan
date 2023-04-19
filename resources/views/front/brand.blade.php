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
      <div class="col-sm-12 col-md-12 col-lg-10 container-xl-10">
        <!-- mid row 1 -->
        <div class="mid-row-1">
          <div class="input-group mb-3 shadow">
            <span class="input-group-text">Search Car</span>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" />
            <span class="input-group-text"><i class="bi bi-search"></i></span>
          </div>
        </div>
        <!--Heading -->
        <h4 class="cat-heading"><img src="{{asset('uploads/brands/'.$brand->image)}}" alt="{{$brand->name}}" width="40px" height="30px">Used {{$brand->name}} Cars for Sale</h4>
        <p>Here We Need To show Best Selling Product Based On Sale </p>
        <p>Best-selling vehicles of {{$brand->name}}</p>
        <div class="row row-cols-5">
          <!-- Image Single Category-->
          @forelse ($brand->sub_brand as $key => $sub_brand)
          @if($key <10)
          <div class="col">
            <a href="{{route('subBrand',['brand' => strtolower($brand->slug_name),'subBrand' => strtolower($sub_brand->slug_name)])}}">
              <img src="{{asset('uploads/sub_brands/'.$sub_brand->image)}}" class="card-img-top" alt="{{$sub_brand->name}}">

              <p>{{$sub_brand->name}}<span>({{$sub_brand->vtotal}})</span></p>
            </a>
            @for ($i = 1; $i <= 2; $i++) <span><i class="fa-solid fa-star-sharp"></i></span>
              @endfor
              <span>119 Reviews</span>
              <p>Price:</p>
              <strong>USD 760 ~ 29,320</strong>
          </div>
          @endif
          @empty
          @endforelse
        </div>

        <!-- Create content area for each tab -->
        <div class="row">
          <!-- Create alphabetical tabs -->
          <div class="btn-group">
          @forelse ($sub_prefix  as $sp)
            <a class="btn btn-light mx-1" href="#tab-{{$sp->cat}}">{{$sp->cat}}</a></li>
          @empty
          @endforelse
        </div>
          
          @forelse ($sub_prefix  as $sp)
            <div id="tab-{{$sp->cat}}" class="tab-content">
              <h2>{{$sp->cat}}</h2>
              <div class="row">
                @php $subp=\App\Models\Vehicle\SubBrand::where('brand_id', $brand->id)->whereIn('id',explode(',',$sp->ids))->get(); @endphp
                @forelse ($subp as $key => $sub_brand)
                  <!-- Add more content areas for other letters -->
                  <div class="col-md-2">
                    <!-- <h4>{{substr($sub_brand->name, 0, 1)}}</h4> -->
                    <a href="{{route('subBrand',['brand' => strtolower($brand->name),'subBrand' => strtolower($sub_brand->name)])}}"><img src="{{asset('uploads/sub_brands/'.$sub_brand->image)}}" class="card-img-top" alt="{{$sub_brand->name}}"></a>
                    <a href=""><strong>{{$sub_brand->name}}</strong></a>
                    @for ($i = 1; $i <= 2; $i++) <span><i class="fa-solid fa-star-sharp"></i></span>
                      @endfor
                      <span>119 Reviews</span>
                      <p>Price:</p>
                      <strong>USD 760 ~ 29,320</strong>
                  </div>
                @empty
                @endforelse
              </div>
            </div>
          @empty
          @endforelse
        </div>

      </div>
    </div>
  </div>
</main>
@endsection