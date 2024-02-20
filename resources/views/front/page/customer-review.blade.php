@extends('layout.landing')
@section('pageTitle', 'Customer Review')
@section('pageSubTitle', 'Customer Review')
@push('styles')
    <style>

    </style>
@endpush
@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <!-- review section start -->
                <div class="review">
                    <div class="review-header">
                        <div class="row">
                            <div class="col-sm-4 d-flex">
                                <i class="bi bi-brightness-high"></i>
                                <p>Customer Review</p>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-center">
                                <p>{{ $review_count }} Reviews</p>
                            </div>
                            {{-- <div class="col-sm-4 d-flex justify-content-end">
                                <a href="#">See More <i class="bi bi-arrow-right-circle"></i></a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="review-user-body my-3">
                        {{-- <div id='yotpo-testimonials-custom-tab'></div> --}}
                        @forelse ($reviews as $review)
                            <div class="row my-1 border-bottom">
                               
                            </div>
                        @empty
                        @endforelse

                    </div>
                </div>
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
@endsection
