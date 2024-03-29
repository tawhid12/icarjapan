<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bootstrap demo</title>
  <!-- css -->
  <link rel="stylesheet" href="{{asset('front/css/main.css')}}" />
  <!-- Bootsrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <!-- Bootstrap icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
</head>

<body>
  <!-- Header top start -->
  <header class="container my-3 fw-bold header-top text-center">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-4 logo">
        <img class="img-fluid" src="{{asset('front/img/header-logo.png')}}" alt="" />
      </div>

      <div class="col-sm-12 col-md-12 col-lg-8 header-top-secound mt-3 d-flex justify-content-end">
        <div class="container">
          <div class="row text-brand">
            <div class="col-sm-6 col-lg-3 mb-3 p-0">
              <p>Japan Time: Dec, 26, 18:42(JST)</p>
              <p>Total Cars: 247,455</p>
            </div>
            <div class="col-sm-6 col-lg-2 mb-3 p-0">
              <p>Dec 25, 00:00(JST)</p>
              <p>BDT/USD 106.09</p>
            </div>
            <div class="col-sm-5 col-lg-4 mb-3">
              <select class="form-select" aria-label="Default select example">
                <option selected>Home currency display ON</option>
                <option value="1">Home currency display Off</option>
              </select>
            </div>
            <div class="col-sm-5 col-lg-2 mb-3">
              <select class="form-select" aria-label="Default select example">
                <option selected>English</option>
                <option value="1">Japan</option>
                <option value="2">Bengoli</option>
                <option value="3">Chaina</option>
              </select>
            </div>
            <div class="col-sm-2 col-lg-1 mb-3">
              <i class="bi bi-person-fill"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Header top end -->
  <!-- nav start -->
  <nav class="navbar navbar-expand-lg bg-brand sticky-top shadow-lg">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Search Car </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Why Choose ICarJapan?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"> How to Buy</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Services</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Customer Reviews</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">About Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- nav end -->
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
                ICarJapan Bangladesh
              </h5>
              <div class="card-body">
                <p class="card-text">
                  <i class="bi bi-geo-alt-fill"></i> Dhaka
                </p>
                <p class="card-text">
                  <i class="bi bi-telephone-fill"></i> +880 123 4567809
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
              <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" />
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
              <p><i class="bi bi-binoculars"></i>Most Viewed in Bangladesh</p>
              <div class="ms-auto">
                <a href="#">See More <i class="bi bi-arrow-right-circle"></i></a>
              </div>
            </div>
            <!-- product card -->
            <div class="row row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
              @forelse($vehicles as $v)
              <div class="col">
                <div class="product-card my-3">
                  <img class="img-fluid" src="{{asset('front/img/product-img.png')}}" alt="" />
                  <div class="product-card-body">
                    <p>{{$v->name}}</p>
                    <p>{{optional($v->vehicle_model)->name}}</p>
                    <p>Price :</p>
                    <p>USD {{$v->price}}</p>
                    <div class="product-card-currency">
                      <p>Approx.</p>
                      <p>BDT 1,13,000.00</p>
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
                <i class="bi bi-binoculars"></i>New Arrival for Bangladesh
              </p>
              <div class="ms-auto">
                <a href="#">See More <i class="bi bi-arrow-right-circle"></i></a>
              </div>
            </div>
            <!-- product card -->
            <div class="row row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
          <!-- mid row 6 product row 3 -->
          <div class="mid-row-6 my-4">
            <!-- product row title -->
            <div class="d-flex product-row-title">
              <p>
                <i class="bi bi-binoculars"></i>Most Affordable for Bangladesh
              </p>
              <div class="ms-auto">
                <a href="#">See More <i class="bi bi-arrow-right-circle"></i></a>
              </div>
            </div>
            <!-- product card -->
            <div class="row row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
          <!-- mid row 7 product row 4 -->
          <div class="mid-row-7 my-4">
            <!-- product row title -->
            <div class="d-flex product-row-title">
              <p><i class="bi bi-binoculars"></i>High Grade for Bangladesh</p>
              <div class="ms-auto">
                <a href="#">See More <i class="bi bi-arrow-right-circle"></i></a>
              </div>
            </div>
            <!-- product card -->
            <div class="row row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
              <div class="col">
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
          <!-- right row 1 -->
          <div class="right-row-1 mb-3">
            <div class="right-row-serarch card shadow rounded">
              <h5 class="right-row-1-title">Search By Category</h5>
              <div class="p-2">
                <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                  <option selected>Brands</option>
                  @forelse($brands as $b)
                  <option value="{{$b->id}}">{{$b->name}}</option>
                  @empty
                  @endforelse
                </select>
                <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                  <option selected>Car Name</option>
                  @forelse($vehicles as $v)
                  <option value="{{$v->id}}">{{$v->name}}</option>
                  @empty
                  @endforelse
                </select>
                <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                  <option selected>Body Type</option>
                  @forelse($body_types as $bt)
                  <option value="{{$bt->id}}">{{$bt->id}}</option>
                  @empty
                  @endforelse
                </select>
                <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                  <option selected>RHL / LHS</option>
                  <option value="1">LHS</option>
                  <option value="2">RHL</option>
                </select>
                <div class="d-flex search-to">
                  <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
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
                  <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                    <option selected>Year</option>
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
                  <a class="search-btn shadow" href="#">Search Car</a>
                </div>
              </div>
            </div>
          </div>
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
                <p class="card-text">
                  <img src="{{asset('front/img/japan2.png')}}" alt="" /> Japan
                </p>
                <p class="card-text">
                  <img src="{{asset('front/img/japan.png')}}" alt="" /> Thailand
                </p>
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
  <!-- main seciton end -->
  <!-- footer start -->
  <footer class="footer">
    <div class="container py-4">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-3 footer-logo">
          <img class="img-fluid" src="{{asset('front/img/header-logo.png')}}" alt="" />
          <div class="footer-title my-3">
            <p>Headquarters</p>
          </div>
          <div class="address">
            <p>
              934-0027 Toyama-Ken,imizu-shi, Nakashinminato 17-1, Japan <br />
              TEL : +81 50 5539 4712 (Hotline) <br />
              whatsapp : +81 90-8099-1615 <br />
              Corporate Site : www.icarjapan.com <br />
              E-mail : csd@sbtjapan.com
            </p>
          </div>
          <div class="improtant-lint mt-5 color-first-letter">
            <ul>
              <li>
                <a class="nav-link" href="#">Terms of Use</a>
              </li>
              <li>
                <a class="nav-link" href="#">Privacy Policy</a>
              </li>
              <li>
                <a class="nav-link" href="#">Cookie Policy </a>
              </li>
              <li>
                <a class="nav-link" href="#">Security export control </a>
              </li>
              <li>
                <a class="nav-link" href="#">Basic Policy Against Anti-Social Forces</a>
              </li>
              <li>
                <a class="nav-link" href="#">Security export control</a>
              </li>
              <li>
                <a class="nav-link" href="#">Sitemap</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2 footer-col-2">
          <div class="footer-title">
            <p>Today’s Deals</p>
          </div>
          <div class="my-3">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Year end offer 2022</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">ICJ Outlet Mall</a>
              </li>
            </ul>
          </div>
          <div class="footer-title">
            <p>By Brands</p>
          </div>
          <div class="my-3">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Toyota </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Honda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Nissan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Mazda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Suzuki</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Mitsubishi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Daihatsu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Subaru</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
          <div class="footer-title">
            <p>By Prices</p>
          </div>
          <div class="my-3 improtant-lint">
            <ul>
              <li class="nav-item">
                <a class="nav-link" href="#">Under USD 500 </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Under USD 1,000</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Under USD 2,000</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Under USD 3,000</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Under USD 4,000</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Under USD 5,000</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Over USD 5,000</a>
              </li>
            </ul>
          </div>
          <div class="footer-title">
            <p>By Discount</p>
          </div>
          <div class="my-3 improtant-lint">
            <ul>
              <li class="nav-item">
                <a class="nav-link" href="#">90%~ OFF </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">80%~89% OFF</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">70%~79% OFF</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">60%~69% OFF</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">50%~59% OFF</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">30%~49% OFF</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">1%~29% OFF </a>
              </li>
            </ul>
          </div>
          <div class="footer-title">
            <p>Inventory Location</p>
          </div>
          <div class="my-3 improtant-lint">
            <ul>
              <li class="nav-item">
                <a class="nav-link" href="#">Japan Inventory </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Korea Inventory</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Singapore Inventory</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Thailand Inventory</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">China Inventory</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">UK Inventory</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Germany Inventory </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">USA Inventory</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">UAE Inventory</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2">
          <div class="footer-title">
            <p>By Type</p>
          </div>
          <div class="my-3 improtant-lint">
            <ul>
              <li class="nav-item">
                <a class="nav-link" href="#">Sedan </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Coupe</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Hatchback</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Station Wagon</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">SUV</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pick up</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Van</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Heavy Equipment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Truck</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Mini Van</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Wagon</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Convertible</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Bus</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Other</a>
              </li>
            </ul>
          </div>
          <div class="footer-title">
            <p>By Category</p>
          </div>
          <div class="my-3 improtant-lint">
            <ul>
              <li class="nav-item">
                <a class="nav-link" href="#">Left Hand Drive </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Manual</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Hybrid</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Electric</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Diesel</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">4WD</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Leather Seats</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Sun Roof</a>
              </li>
            </ul>
          </div>
          <div class="footer-title">
            <p>Car Contents</p>
          </div>
          <div class="my-3 improtant-lint">
            <ul>
              <li class="nav-item">
                <a class="nav-link" href="#">Customer Reviews </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Car Reviews</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
          <div class="footer-title">
            <p>Global Office</p>
          </div>
          <div class="my-3">
            <ul>
              <li class="nav-item">
                <a class="nav-link" href="#">Asia
                  <ul>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Bangladesh - Dhaka </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Kyrgyzstan - Bishkek</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Mongolia - Ulaanbaatar</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Myanmar - Yangon</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Philippines - Manila</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Sri Lanka - Colombo</a>
                    </li>
                  </ul>
                </a>
              </li>
            </ul>
          </div>
          <div class="footer-title">
            <p>Authorized Retailer:</p>
          </div>
          <div class="my-3">
            <ul>
              <li class="nav-item">
                <a class="nav-link" href="#">Asia
                  <ul>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Bangladesh - Dhaka </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Kyrgyzstan - Bishkek</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Mongolia - Ulaanbaatar</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Myanmar - Yangon</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Philippines - Manila</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Sri Lanka - Colombo</a>
                    </li>
                  </ul>
                </a>
              </li>
            </ul>
          </div>
          <div class="footer-title mt-5 pt-5">
            <p>Connect with us</p>
          </div>
          <div class="social-icon">
            <i class="bi bi-facebook"></i>
            <i class="bi bi-youtube"></i>
            <i class="bi bi-twitter"></i>
          </div>
        </div>
      </div>
    </div>
    <!-- Signature & Copywrite -->
    <div class="copywrite text-white">
      <div class="container">
        <p>&copy I CAR JAPAN LTD.</p>
      </div>
    </div>
  </footer>
  <!-- footer end -->
  <!-- Top Scroll -->
  <div class="top-scroll">
    <a href="#"><i class="bi bi-caret-up"></i></a>
  </div>
  <!-- Bootstrap 5.3 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!-- JS -->
  <script src="./resource/js/app.js"></script>
  <!-- fb page js -->
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0&appId=425979584449354&autoLogAppEvents=1" nonce="lQcO9Eh9"></script>
</body>

</html>
@endsection