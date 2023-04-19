@extends('layout.app')
@section('pageTitle',trans('Profile Statistics'))

@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="bi bi-box-seam-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">{{ __('Total Raw Material') }}</h6>
                                    <h6 class="font-extrabold mb-0"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="bi bi-box-seam-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">{{ __('Total Sub Material') }}</h6>
                                    <h6 class="font-extrabold mb-0"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="bi bi-boxes"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">{{ __('Total Vechicle Type') }}</h6>
                                    <h6 class="font-extrabold mb-0"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                    <i class="bi bi-box2-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">{{ __('Total Vehicle') }}</h6>
                                    <h6 class="font-extrabold mb-0"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product Status</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('/assets/images/faces/1.jpg') }}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{currentUser()}}</h5>
                            <h6 class="text-muted mb-0">{{currentUser()}}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header p-2">
                    <h4 class="mb-1 border-bottom">Pending Reserved Vehicle</h4>
                </div>
                <div class="card-content pb-2">
                @forelse(\App\Models\Notification::where('read_status',0)->orderBy('id','desc')->get() as $res)
                    <div class="recent-message d-flex px-2 py-1 rounded-pill border-bottom">
                        <div class="name ms-2 rounded-pill">
                            <a href="{{url($res->click_url)}}">
                                <h6 class="mb-1">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    You have a new Reservation for  {{$res->title}}
                                </h6>
                            </a>
                        </div>
                    </div>
                    @empty
                        <div class="recent-message d-flex px-4 py-1">
                            <div class="name ms-4">
                                <h5 class="mb-1">No Notification</h5>
                            </div>
                        </div>
                    @endforelse
                    
                    <div class="px-4">
                        <a href="{{route(currentUser().'.notification.index')}}" class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>See All Requisition</a>
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