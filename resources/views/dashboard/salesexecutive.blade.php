@extends('layout.app')
@section('pageTitle',trans('Dashboard'))

@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('/assets/images/faces/1.jpg') }}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">Welcome {{currentUser()}} !</h5>
                            <h6 class="text-muted mb-0">Role :- </h6>
                            <h6 class="text-muted mb-0">Email :- </h6>
                            <h6 class="text-muted mb-0">Contact :- </h6>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="card">
                <div class="card-header p-2">
                    <h4 class="mb-1 border-bottom">Pending Order</h4>
                </div>
                <div class="card-content pb-2">
                   
                    
                    <div class="px-4">
                        <a href="" class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>See All Order</a>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                                    <div class="stats-icon green mb-2">
                                        <i class="bi bi-boxes"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <a href="{{route(currentUser().'.all_client_list')}}">
                                        <h6 class="text-muted text-center font-semibold">{{ __('CM Module') }}</h6>
                                    </a>
                                    <h6 class="font-extrabold mb-0"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="bi bi-box2-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <a href="{{route(currentUser().'.favourite_list')}}">
                                        <h6 class="text-muted text-center font-semibold">{{ __('Favourite') }}</h6>
                                    </a>
                                    <h6 class="font-extrabold mb-0"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="bi bi-box2-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <a href="{{route(currentUser().'.search')}}">
                                        <h6 class="text-muted text-center font-semibold">{{ __('Search') }}</h6>
                                    </a>
                                    <h6 class="font-extrabold mb-0"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="bi bi-box2-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <a href="{{route(currentUser().'.sales_module')}}">
                                        <h6 class="text-muted text-center font-semibold">{{ __('Sales Module') }}</h6>
                                    </a>
                                    <h6 class="font-extrabold mb-0"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection

@push('scripts')

<!-- Need: Apexcharts -->
<script src="{{ asset('/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('/assets/js/pages/dashboard.js') }}"></script>
@endpush