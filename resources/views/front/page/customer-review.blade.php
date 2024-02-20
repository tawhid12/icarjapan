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


        #contents_detail .car_detail_car_navigation li {
            display: block
        }

        #contents_detail .car_display_area {
            position: relative;
        }

        #contents_detail .car_display_area #pager_display {
            position: absolute;
            width: 58px;
            font-size: 12px;
            background-color: rgba(0, 0, 0, .4);
            color: #fff;
            line-height: 1.5405;
            text-align: center;
            bottom: 17px;
            left: 50%;
            border-radius: 4px;
            margin-left: -29px !important;
            z-index: 3;
        }

        #contents_detail .car_display_area .img_inner_sold_disp_text {
            position: absolute;
            bottom: 0px;
            left: 0;
            width: 100%;
            color: #f03;
            text-shadow: 2px 2px 0 #fff, 0 0 4px #fff;
            font-weight: 700;
            line-height: 2;
            z-index: 3;
            font-size: 18px;
        }

        #contents_detail .car_display_area #car_MainIMG_car_display {
            margin-bottom: 6px;
        }


        #contents_detail #car_MainIMG_car_display:not(.slick-slider) {
            width: 640px;
            height: 480px;
            overflow: hidden;
        }

        #contents_detail #car_MainIMG_car_display button.slick-arrow {
            position: absolute;
            width: 7.94259375%;
            height: 100%;
            bottom: 0;
            top: 0;
            border: none;
            cursor: pointer;
            outline: 0;
            padding: 0;
            box-shadow: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: transparent;
            z-index: 2
        }

        #contents_detail #car_MainIMG_car_display.playingYoutube button.slick-arrow {
            bottom: 164px;
            height: 316px
        }

        #contents_detail #car_MainIMG_car_display.playingVR button.slick-arrow {
            position: absolute;
            top: 50%;
            margin: -21px auto;
            z-index: 10;
            height: 42px;
            width: 44px
        }

        #contents_detail #car_MainIMG_car_display button.slick-arrow.slick-disabled {
            opacity: .2;
            cursor: default
        }

        #contents_detail #car_MainIMG_car_display button.slick-arrow i {
            display: block;
            font-size: 41px;
            width: .4544em;
            height: .4544em;
            border-width: 0 0 .2em .2em;
            border-color: transparent transparent rgba(255, 255, 255, .8) rgba(255, 255, 255, .8);
            border-radius: 1.5px;
            border-style: none none solid solid;
            position: absolute;
            top: 50%;
            margin-top: -.2272em
        }

        #contents_detail #car_MainIMG_car_display button.slick-arrow i {
            margin-top: 13px
        }

        #contents_detail #car_MainIMG_car_display button.slick-arrow:not(.slick-disabled):hover i {
            border-color: transparent transparent #fff #fff
        }

        #contents_detail #car_MainIMG_car_display button.slick-arrow.main_slide_prevbutton {
            left: 0
        }

        #contents_detail #car_MainIMG_car_display button.slick-arrow.main_slide_prevbutton i {
            -moz-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
            left: 16px
        }

        #contents_detail #car_MainIMG_car_display button.slick-arrow.main_slide_nextbutton {
            right: 0
        }

        #contents_detail #car_MainIMG_car_display button.slick-arrow.main_slide_nextbutton i {
            -moz-transform: rotate(-135deg);
            -webkit-transform: rotate(-135deg);
            -o-transform: rotate(-135deg);
            -ms-transform: rotate(-135deg);
            transform: rotate(-135deg);
            right: 16px
        }

        #contents_detail #car_thumbnail_car_navigation:not(.slick-slider) {
            width: 590px;
            margin: auto
        }

        #contents_detail #car_thumbnail_car_navigation:not(.slick-slider) div {
            width: 75px !important;
            height: 56.25px;
            float: left;
            margin-left: 8px;
            margin-bottom: 5px
        }

        #contents_detail #car_thumbnail_car_navigation {
            overflow: hidden;
            padding-top: 4px
        }

        #contents_detail #car_thumbnail_car_navigation:after,
        #contents_detail #car_thumbnail_car_navigation:before {
            content: "";
            display: block;
            background-color: #fff;
            height: 127px;
            width: 31px;
            position: absolute;
            top: -1px;
            z-index: 1;
            visibility: visible
        }

        #contents_detail #car_thumbnail_car_navigation:before {
            background: -moz-linear-gradient(left, #fff 0, rgba(255, 255, 255, 0) 100%);
            background: -webkit-gradient(linear, left top, right top, color-stop(0, #fff), color-stop(100%, rgba(255, 255, 255, 0)));
            background: -webkit-linear-gradient(left, #fff 0, rgba(255, 255, 255, 0) 100%);
            background: -o-linear-gradient(left, #fff 0, rgba(255, 255, 255, 0) 100%);
            background: -ms-linear-gradient(left, #fff 0, rgba(255, 255, 255, 0) 100%);
            background: linear-gradient(to right, #fff 0, rgba(255, 255, 255, 0) 100%);
            left: 0
        }

        #contents_detail #car_thumbnail_car_navigation:after {
            background: -moz-linear-gradient(left, rgba(255, 255, 255, 0) 0, #fff 100%);
            background: -webkit-gradient(linear, left top, right top, color-stop(0, rgba(255, 255, 255, 0)), color-stop(100%, #fff));
            background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0, #fff 100%);
            background: -o-linear-gradient(left, rgba(255, 255, 255, 0) 0, #fff 100%);
            background: -ms-linear-gradient(left, rgba(255, 255, 255, 0) 0, #fff 100%);
            background: linear-gradient(to right, rgba(255, 255, 255, 0) 0, #fff 100%);
            right: 0
        }

        #contents_detail #car_thumbnail_car_navigation button.original_slick-arrow {
            width: 25px;
            height: 66px;
            background-color: rgba(0, 0, 0, .5);
            position: absolute;
            top: 50%;
            margin-top: -33px;
            border: none;
            cursor: pointer;
            outline: 0;
            padding: 0;
            box-shadow: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            z-index: 2
        }

        #contents_detail #car_thumbnail_car_navigation button.original_slick-arrow.slick-disabled {
            background-color: rgba(0, 0, 0, .2);
            cursor: default
        }

        #contents_detail #car_thumbnail_car_navigation .original_slick-arrow i {
            font-size: 25px;
            display: block;
            width: .34512em;
            height: .34512em;
            border-width: 0 0 2px 2px;
            border-style: none none solid solid;
            border-color: transparent transparent #fff #fff;
            border-radius: .5px;
            line-height: 33px
        }

        #contents_detail #car_thumbnail_car_navigation button.original_slick-arrow.slick-disabled i {
            opacity: .54
        }

        #contents_detail #car_thumbnail_car_navigation #thum_slide_prevbutton.original_slick-arrow {
            left: 0
        }

        #contents_detail #car_thumbnail_car_navigation #thum_slide_prevbutton.original_slick-arrow i {
            -moz-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
            float: left;
            margin-left: 8px
        }

        #contents_detail #car_thumbnail_car_navigation #thum_slide_nextbutton.original_slick-arrow {
            right: 0
        }

        #contents_detail #car_thumbnail_car_navigation #thum_slide_nextbutton.original_slick-arrow i {
            -moz-transform: rotate(-135deg);
            -webkit-transform: rotate(-135deg);
            -o-transform: rotate(-135deg);
            -ms-transform: rotate(-135deg);
            transform: rotate(-135deg);
            float: right;
            margin-right: 8px
        }

        #contents_detail #car_thumbnail_car_navigation .slick-list {
            width: 590px;
            margin: auto;
            overflow: visible
        }

        @media all and (-ms-high-contrast:none) {
            #contents_detail #car_thumbnail_car_navigation .slick-list {
                overflow: hidden;
                padding-top: 2px
            }
        }

        #contents_detail #car_thumbnail_car_navigation div.slick-slide>div>div {
            width: 75px !important;
            height: 56.25px;
            float: left;
            margin-left: 8px;
            margin-bottom: 5px;
            cursor: pointer
        }

        #contents_detail #car_thumbnail_car_navigation div.slick-slide>div>div.now_imgDisplay img {
            outline: 1px solid #e60012;
            -moz-box-shadow: 0 0 2px #e60012;
            -webkit-box-shadow: 0 0 2px #e60012;
            -o-box-shadow: 0 0 2px #e60012;
            -ms-box-shadow: 0 0 2px #e60012;
            box-shadow: 0 0 2px #e60012
        }

        #contents_detail #car_thumbnail_car_navigation div img {
            max-height: 56.25px;
            width: auto;
            max-width: 100%;
            margin: auto;
            display: block
        }

        #contents_detail .car_display_area {
            position: relative;
        }

        #contents_detail .car_display_area #pager_display {
            position: absolute;
            width: 58px;
            font-size: 12px;
            background-color: rgba(0, 0, 0, .4);
            color: #fff;
            line-height: 1.5405;
            text-align: center;
            bottom: 17px;
            left: 50%;
            border-radius: 4px;
            margin-left: -29px !important;
            z-index: 3;
        }

        /*Share */
        div#social-links ul {
            margin: 0;
        }

        div#social-links ul li {
            display: inline-block;
        }

        div#social-links ul li a {
            color: #fff;
            font-size: 18px;
            margin: 0 2px;
            padding: 0px 22px;
            display: block;

        }

        div#social-links ul li:nth-child(1) a {
            background-color: #32529f;
        }

        div#social-links ul li:nth-child(2) a {
            background-color: #1da1f2;
        }

        div#social-links ul li:nth-child(3) a {
            background-color: #25d366;
        }

        .bg-danger-subtle {
            border: 1px solid #d6d6d6;
            font-size: 14px;
            text-align: center;
            height: 30px;
        }

        .detl th,
        td {
            background-color: #f8f8f8;
        }

        .detl th,
        td {
            border: 1px solid #d6d6d6;
        }

        .bg-button {
            font-weight: 700;
            font-size: 20px;
            text-decoration: none;
            background-color: red;
            color: #fff;
            padding: 6px 42px;
        }

        .bg-button:hover {
            outline: 1px solid red;
            color: #fff;
            background-color: red;
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
