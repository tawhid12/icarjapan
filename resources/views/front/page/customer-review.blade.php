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
                        <div class="row my-1 border-bottom">
                            @forelse ($reviews as $review)
                              <div class="col-sm-4 review-user-p-img">
                                <div class="slider">
                                @forelse ($review->review_images as $rimg)
                                <img class="img-fluid" src="{{asset('uploads/review/'.$rimg->upload)}}" alt="" />
                                @empty
                                <img class="img-fluid" src="https://ui-avatars.com/api/?name={{$review->user?->name}}" alt="" />
                                @endforelse
                              </div>
                              </div>
                              <div class="col-sm-8 review-user">
                                <div class="d-flex">
                                  @if($review->cimage)
                                  <img class="img-fluid" src="{{asset('uploads/reviews/'.$review->cimage)}}" alt="" />
                                  @endif
                                  <div>
                                    <p>{{$review->user->name}}
                                      @if($review->rating > 0)
                                      <span class="review">
                                        @php 
                                        for($i=1; $i<=$review->rating; $i++){
                                          echo '<i class="bi bi-star" style=""></i>';
                                        }
                                        @endphp
                                      </span>
                                      @endif
                                    </p>
                                    <p>{{ \Carbon\Carbon::parse($review->created_at)->format('F j, Y') }}</p>
                                  </div>
                                </div>
                                <p>{{$review->comment}}</p>
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
