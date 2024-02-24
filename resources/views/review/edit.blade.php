@extends('layout.app')

@section('pageTitle', 'Reply Review')
@section('pageSubTitle', 'Reply')
@section('content')
    <section class="section">
        <div class="card">
            @include('layout.message')
            <form method="post" action="{{route(currentUser().'.review.update',encryptor('encrypt',$review->id))}}">
                <div class="row" id="table-bordered">
                    <div class="col-md-12">
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('Uploaded Photo') }}</th>
                                        <th scope="col">{{ __('Information') }}</th>
                                        <th scope="col">{{ __('Comment') }}</th>
                                        <th scope="col">{{ __('Type') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td>
                                            <div class="slider">
                                                @forelse ($review->review_images as $rimg)
                                                    <img width="100px" height="80" class="img-thumbnail"
                                                        src="{{ asset('uploads/review/' . $rimg->upload) }}"
                                                        alt="" />

                                                @empty
                                                    <img width="100px" height="80" class="img-thumbnail"
                                                        src="https://ui-avatars.com/api/?name={{ $review->user?->name }}"
                                                        alt="" />
                                                @endforelse
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div>
                                                    <p>{{ $review->user?->user_name }}
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
                                                    <p>{{ \Carbon\Carbon::parse($review->created_at)->format('F j, Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $review->comment }}</td>
                                        <td>
                                            @if ($review->review_type == 1)
                                                Purchased
                                            @elseif($review->review_type == 2)
                                                Company Review
                                            @else
                                                Vehicle Review
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <textarea class="form-control" rows="4"></textarea>
                                            <button type="submit" class="btn btn-primary">Reply</button>
                                        </td>
                                    </tr>
                                </tbody>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </section>
@endsection
