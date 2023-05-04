  <!-- Header top start -->
  <header class="container mt-3 fw-bold header-top text-center">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-3 logo">
        <img class="img-fluid" src="{{asset('front/img/header-logo.png')}}" alt="" />
      </div>

      <div class="col-sm-12 col-md-12 col-lg-9 header-top-secound mt-3 d-flex justify-content-end">
        <div class="container">
          <div class="row text-brand gx-1">
            <div class="col-md-3 mb-3 p-0">
              <p>{{$japan_locale_data->format('M, d, H:i (T)')}} {{--Japan Time: Dec, 26, 18:42(JST)--}}</p>
              <p>Total Cars: {{$total_cars}}</p>
            </div>
            @php //print_r($location);die;@endphp
            <div class="col-md-3 mb-3 p-0">
              <p>{{$current_locale_data->format('M, d, H:i (T)')}}</p>
              @php
              //echo '<pre>';
              //print_r($location);
              @endphp
              <p>{{$location['geoplugin_currencyCode']}}/USD {{number_format($location['geoplugin_currencyConverter'], 2, '.', ',')}}</p>
            </div>

            <!-- <div class="col-md-3 mb-3">
              <select class="form-select" id="currency_opt" aria-label="Default select example">
                <option value="1" selected>Home currency display ON</option>
                <option value="0">Home currency display Off</option>
              </select>
            </div> -->
            <div class="col-md-3 mb-3">
              <select class="form-select" id="lang_id" aria-label="Default select example">
                <option value=""></option>
                <option value="1" selected>EN</option>
                <option value="2">BN</option>
              </select>
            </div>
            <!-- <div class="col-sm-1 col-lg-1 mb-3">
              <select class="form-select" id="country_id" aria-label="Default select example">
                <option value=""></option>
                <option value="1" selected>BD</option>
                <option value="2">USA</option>
                <option value="3">UK</option>
              </select>
            </div> -->
            @if(currentUser())
            <div class="col-md-3 mb-3">
              <!-- Button trigger dropdown -->
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-fill"></i>
              </button>
              <!-- Dropdown menu -->
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="z-index:9999">
                <li><a class="dropdown-item" href="#"><strong>{{encryptor('decrypt', request()->session()->get('userName'))}}</strong></a></li>
                <li><a class="dropdown-item" href="{{route(currentUser().'.profile')}}">{{__('My Account') }}</a></li>
                <li><a class="dropdown-item" href="{{route(currentUser().'.change_password')}}">{{__('Change Password') }}</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{route('logOut')}}">{{__('Logout') }}</a></li>
              </ul>
            </div>
            @else
              <div class="col-md-3 mb-3">
                <a class="fw-bold" href="{{route('login')}}" style="color: var(--brand-color);font-size:13px;margin-right:10px;text-decoration:none;">Login</a>
                <a class="fw-bold" href="{{route('register')}}" style="color: var(--brand-color);font-size:13px;margin-right:10px;text-decoration:none;">Register</a>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Header top end -->