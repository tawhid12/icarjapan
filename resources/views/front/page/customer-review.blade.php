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
            height: 100%;
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

        .slick-arrow.slick-hidden {
            display: none;
        }

        .slick-loading .slick-list {
            background: #fff url({{ url('public/assets/images/ajax-loader.gif') }}) center center no-repeat;
        }

        @font-face {
            font-family: 'slick';
            font-weight: normal;
            font-style: normal;
            src: url("./fonts/slick.eot");
            src: url("./fonts/slick.eot?#iefix") format("embedded-opentype"), url("./fonts/slick.woff") format("woff"), url("./fonts/slick.ttf") format("truetype"), url("./fonts/slick.svg#slick") format("svg")
        }

        .slick-prev,
        .slick-next {
            font-size: 0;
            line-height: 0;
            position: absolute;
            top: 50%;
            display: block;
            width: 20px;
            height: 20px;
            margin-top: -10px;
            padding: 0;
            cursor: pointer;
            color: transparent;
            border: 0;
            outline: 0;
            background: transparent
        }

        .slick-prev:hover,
        .slick-prev:focus,
        .slick-next:hover,
        .slick-next:focus {
            color: transparent;
            outline: 0;
            background: transparent
        }

        .slick-prev:hover:before,
        .slick-prev:focus:before,
        .slick-next:hover:before,
        .slick-next:focus:before {
            opacity: 1
        }

        .slick-prev.slick-disabled:before,
        .slick-next.slick-disabled:before {
            opacity: 0.25
        }

        .slick-prev:before,
        .slick-next:before {
            font-family: 'slick';
            font-size: 20px;
            line-height: 1;
            opacity: 0.75;
            color: white;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }



        .slick-dots {
            position: absolute;
            bottom: -45px;
            display: block;
            width: 100%;
            padding: 0;
            list-style: none;
            text-align: center
        }

        .slick-dots li {
            position: relative;
            display: inline-block;
            width: 20px;
            height: 20px;
            margin: 0 5px;
            padding: 0;
            cursor: pointer
        }

        .slick-dots li button {
            font-size: 0;
            line-height: 39px;
            display: block;
            width: 30px;
            height: 30px;
            padding: 5px;
            cursor: pointer;
            color: transparent;
            border: 0;
            outline: 0;
            background: transparent
        }

        .slick-dots li button:hover,
        .slick-dots li button:focus {
            outline: 0
        }

        .slick-dots li button:hover:before,
        .slick-dots li button:focus:before {
            opacity: 1
        }

        .slick-dots li button:before {
            font-family: 'slick';
            position: absolute;
            top: -10px;
            left: 0;
            width: 30px;
            height: 30px;
            content: "•";
            text-align: center;
            opacity: .25;
            color: #000;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        @media screen and (min-width: 1024px) {
            .slick-dots li button:before {
                font-size: 79px
            }
        }

        @media screen and (max-width: 1023px) {
            .slick-dots li button:before {
                font-size: 45px !important
            }
        }

        .slick-dots li.slick-active button:before {
            opacity: 0.75;
            color: black;
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
                                <div class="col-sm-4 review-user-p-img">
                                    <div class="slider">
                                        @forelse ($review->review_images as $rimg)
                                            <img class="img-fluid" src="{{ asset('uploads/review/' . $rimg->upload) }}"
                                                alt="" />

                                        @empty
                                            <img class="img-fluid"
                                                src="https://ui-avatars.com/api/?name={{ $review->user?->name }}"
                                                alt="" />
                                        @endforelse
                                    </div>
                                </div>
                                <div class="col-sm-8 review-user">
                                    <div class="d-flex">
                                        @if ($review->cimage)
                                            <img class="img-fluid" src="{{ asset('uploads/reviews/' . $review->cimage) }}"
                                                alt="" />
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
    @endsection
