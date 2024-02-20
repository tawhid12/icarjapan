@extends('layout.landing')
@section('pageTitle', 'Customer Review')
@section('pageSubTitle', 'Customer Review')
@push('styles')
    <style>
        .slick-slider {
            position: relative;
            display: block;
            box-sizing: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -khtml-user-select: none;
            -ms-touch-action: pan-y;
            touch-action: pan-y;
            -webkit-tap-highlight-color: transparent
        }

        .slick-list {
            position: relative;
            display: block;
            overflow: hidden;
            margin: 0;
            padding: 0
        }

        .slick-list:focus {
            outline: none
        }

        .slick-list.dragging {
            cursor: pointer;
            cursor: hand
        }

        .slick-slider .slick-track,
        .slick-slider .slick-list {
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0)
        }

        .slick-track {
            position: relative;
            top: 0;
            left: 0;
            display: block;
            margin-left: auto;
            margin-right: auto
        }

        .slick-track:before,
        .slick-track:after {
            display: table;
            content: ''
        }

        .slick-track:after {
            clear: both
        }

        .slick-loading .slick-track {
            visibility: hidden
        }

        .slick-slide {
            display: none;
            float: left;
            height: 50%;
            min-height: 1px
        }

        [dir='rtl'] .slick-slide {
            float: right
        }

        .slick-slide img {
            display: block
        }

        .slick-slide.slick-loading img {
            display: none
        }

        .slick-slide.dragging img {
            pointer-events: none
        }

        .slick-initialized .slick-slide {
            display: block
        }

        .slick-loading .slick-slide {
            visibility: hidden
        }

        .slick-vertical .slick-slide {
            display: block;
            height: auto;
            border: 1px solid transparent
        }

        .review {
            font-size: 24px;
            /* Adjust size as needed */
        }

        .review .bi-star {
            color: #FFD700;
            /* Gold color */
        }
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
                        <div class="row my-1 border-bottom">
                            @forelse ($reviews as $review)
                                <div class="col-sm-2 review-user-p-img">
                                    <div class="slider">
                                        @forelse ($review->review_images as $rimg)
                                            <img class="img-thumbnail" src="{{ asset('uploads/review/' . $rimg->upload) }}"
                                                alt="" />

                                        @empty
                                            <img class="img-thumbnail"
                                                src="https://ui-avatars.com/api/?name={{ $review->user?->name }}"
                                                alt="" />
                                        @endforelse
                                    </div>
                                </div>
                                <div class="col-sm-10 review-user">
                                    <div class="d-flex">
                                        @if ($review->cimage)
                                            <img class="img-thumbnail"
                                                src="{{ asset('uploads/reviews/' . $review->cimage) }}" alt="" />
                                        @endif
                                        <div>
                                            <p>{{ $review->user->name }}
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
                                    <p>{{ $review->comment }}</p>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
