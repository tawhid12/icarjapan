<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICARJAPAN | @yield('siteTitle', 'Vehicle')</title>
    
<link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
<link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
<link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
{{--<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">--}}
<link rel="stylesheet" href="{{ asset('/assets/extensions/laravel-toster/toastr.min.css') }}">
<style>
.loader {
    margin: 0 auto;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
@stack('styles')
<script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-1">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="{{route(currentUser().'.dashboard')}}"><img src="{{ asset('assets/images/logo/header-logo.png')}}" alt="Logo"></a>
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="text">
                                        <h6 class="user-dropdown-name">{{encryptor('decrypt', request()->session()->get('userName'))}} <span class="user-dropdown-status text-sm text-muted">{{currentUser()}}</span></h6>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                  <li><a class="dropdown-item" href="#">{{__('My Account') }}</a></li>
                                  <li><a class="dropdown-item" href="#">Settings</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="{{route('logOut')}}">{{__('Logout') }}</a></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        @include('layout.nav.'.currentUser())
                    </div>
                </nav>
            </header>
			
			<div class="content-wrapper container">
				<div class="page-heading m-0">
					<div class="page-title">
						<div class="row">
							<div class="col-12 col-md-6 order-md-1 order-last">
								<div class="fs-5 fw-bold">@yield('pageTitle')</div>
							</div>
							<div class="col-12 col-md-6 order-md-2 order-first">
								<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
									<ol class="breadcrumb mb-0">
                                        @hasSection('pageSubTitle')
										    <li class="breadcrumb-item"><a href="{{route(currentUser().'.dashboard')}}">{{__('dashboard') }}</a></li>
										    <li class="breadcrumb-item active" aria-current="page">@yield('pageSubTitle')</li>
                                        @else
                                            <li class="breadcrumb-item active">{{__('dashboard') }}</li>
                                        @endif
									</ol>
								</nav>
							</div>
                            
						</div>
					</div>
				</div>
				<div class="page-content">
					@yield('content')
				</div>
			</div>
            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Vehicle</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="#"></a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
<script src="{{ asset('/assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('/assets/js/app.js') }}"></script>
<script src="{{ asset('/assets/js/pages/horizontal-layout.js') }}"></script>
{{--<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>--}}
<script src="{{ asset('/assets/extensions/laravel-toster/toastr.min.js') }}"></script>
@stack('scripts')
{!! Toastr::message() !!}
</body>

</html>
