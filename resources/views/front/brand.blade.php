@extends('layout.landing')
@section('pageTitle','Icarjapan - ')
@section('pageSubTitle',"{$brand->name}")
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
        {{--<div class="left-row-1 mb-3">
          <a href="#">
            <img class="img-fluid" src="{{asset('front/img/left-top-catagory-banner.png')}}" alt="" />
          </a>
        </div>--}}
        @include('front.partial.brand-side-bar')
        @include('front.partial.inventory-side-bar')
        @include('front.partial.price-side-bar')
        @include('front.partial.discount-side-bar')
        @include('front.partial.type-side-bar')
        <!-- left row 8 -->
        @php $trans = \App\Models\Vehicle\Transmission::withCount('vehicles')->get();@endphp
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
        <!--Heading -->
        @include('partials.breadcrumbs',['model' => $brand])
        <h4 class="cat-heading"><img src="{{asset('uploads/brands/'.$brand->image)}}" alt="{{$brand->name}}" width="40px" height="30px">Used {{$brand->name}} Cars for Sale</h4>
        <!--<p>Here We Need To show Best Selling Product Based On Sale </p>-->
        <p>Best-selling vehicles of {{$brand->name}}</p>
        <div class="row row-cols-5">
          <!-- Image Single Category-->
          @forelse ($brand->sub_brand as $key => $sub_brand)
          @if($key <10) 
          {{--<div class="col mt-1">
            <a class="brand-heading" href="{{route('subBrand',['brand' => strtolower($brand->slug_name),'subBrand' => strtolower($sub_brand->slug_name)])}}">
              @if(empty($sub_brand->image))
              <img src="{{asset('uploads/default/comingsoon_l.png')}}" class="card-img-top" alt="{{$sub_brand->name}}">
              @else
              <img src="{{asset('uploads/sub_brands/'.$sub_brand->image)}}" class="card-img-top" alt="{{$sub_brand->name}}">
              @endif


              {{$sub_brand->name}}<span>({{$sub_brand->vtotal}})</span>
            </a>
            <div class="rating">
              <span><i class="fa fa-star"></i></span>
              <span><i class="fa fa-star"></i></span>
              <span><i class="fa fa-star"></i></span>
              <span><i class="fa fa-star"></i></span>
              <span><i class="fa fa-star"></i></span>
            </div>
            <div class="rating-count">25 Reviews</div>

            <p class="m-0">Price:</p>
            <strong>USD 760 ~ 29,320</strong>
        </div>--}}
        @endif
        @empty
        @endforelse
      </div>

      <!-- Create content area for each tab -->

      <div class="col-md-12 mt-4">
        <!-- Create alphabetical tabs -->
        <ul class="cat-nav">
          @forelse ($sub_prefix as $sp)
          <li class="cat-item nav-item">
            <a class="nav-link" href="#tab-{{$sp->cat}}">{{$sp->cat}}<i class="fa fa-sort-desc" aria-hidden="true"></i></a>
          </li>
          @empty
          @endforelse
        </ul>
      </div>



      @forelse ($sub_prefix as $sp)
      @if($sp->vehicles_count)
      <div id="tab-{{$sp->cat}}" class="tab-content">
        <h2>{{$sp->cat}}</h2>
        <div class="row">
          @php 
            $subp=\App\Models\Vehicle\SubBrand::where('brand_id', $brand->id)->whereIn('id',explode(',',$sp->ids))->withCount('vehicles')->get(); 
          @endphp
          @forelse ($subp as $key => $sub_brand)
          <!-- Add more content areas for other letters -->
          @if($sub_brand->vehicles_count > 0)
          <div class="col-md-2">
            <!-- <h4>{{substr($sub_brand->name, 0, 1)}}</h4> -->
            <a class="brand-heading" href="{{route('subBrand',['brand' => strtolower($brand->slug_name),'subBrand' => strtolower($sub_brand->slug_name)])}}">
              @if(empty($sub_brand->image))
              <img src="{{asset('uploads/default/comingsoon_l.png')}}" class="card-img-top" alt="{{$sub_brand->name}}">
              @else
              <img src="{{asset('uploads/sub_brands/'.$sub_brand->image)}}" class="card-img-top" alt="{{$sub_brand->name}}">
              @endif
              {{$sub_brand->name}}<span>({{$sub_brand->vehicles_count}})</span>
            </a>
            <div class="rating">
              <span><i class="fa fa-star"></i></span>
              <span><i class="fa fa-star"></i></span>
              <span><i class="fa fa-star"></i></span>
              <span><i class="fa fa-star"></i></span>
              <span><i class="fa fa-star"></i></span>
            </div>
            <div class="rating-count">25 Reviews</div>

            <p class="m-0">Price:</p>
            <!-- <strong>USD 760 ~ 29,320</strong> -->
          </div>
         @endif
          @empty
          @endforelse
        </div>
      </div>
      @endif
      @empty
      @endforelse


    </div>
  </div>
  </div>
</main>
@endsection