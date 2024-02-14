@extends('layout.landing')

@section('pageTitle', 'Review')
@section('pageSubTitle', 'List')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush
@section('content')
    @include('layout.nav.user')
    <!-- Bordered table start -->
    <section class="section m-5">
        <div class="container">
            <div class="row" id="table-bordered" style="background-color: #eee">
                <div class="col-12">
                    <h4>All Review</h4>
                    <div class="review-user-body my-3">
                        {{-- <div id='yotpo-testimonials-custom-tab'></div> --}}
                        @forelse ($reviews as $review)
                            <div class="row">
                                <div class="col-sm-3 review-user-p-img">
                                    {{-- @if ($review->upload)
                                        <img class="img-fluid" src="{{ asset($review->upload) }}"
                                            alt="" />
                                    @else
                                        <img class="img-fluid"
                                            src="https://ui-avatars.com/api/?name={{ $review->user_name }}"
                                            alt="" />
                                    @endif --}}
                                </div>
                                <div class="col-sm-6 review-user">
                                    <div class="d-flex">
                                        @if ($review->cimage)
                                            <img class="img-fluid" src="{{ asset('uploads/reviews/' . $review->cimage) }}"
                                                alt="" />
                                        @endif
                                        <div>
                                            <p>{{ $review->user_name }}
                                                @if ($review->rating > 0)
                                                    <span class="review">
                                                        @php
                                                            for ($i = 1; $i <= $review->rating; $i++) {
                                                                echo '<i class="bi bi-star" style=""></i>';
                                                            }
                                                        @endphp
                                                    </span>
                                                @endif
                                            </p>
                                            <p>{{ \Carbon\Carbon::parse($review->created_at)->format('F j, Y') }}</p>
                                        </div>
                                    </div>
                                    {{-- <p>2018 Premio F EX grade 5</p> --}}
                                    <p>{{ $review->comment }}</p>
                                </div>
                                @if ($review->review_type == 1)
                                    <div class="col-sm-3 review-status d-flex justify-content-end">
                                        <div>
                                            <p>Review on -</p>
                                            <p style="line-height:1.5">{{ $review->vehicle_name }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @empty
                        @endforelse

                    </div>
                </div>
            </div>
    </section>
@endsection
