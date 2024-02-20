@extends('layout.app')

@section('pageTitle', 'Review List')
@section('pageSubTitle', 'List')

@section('content')


    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('#SL') }}</th>
                                    <th scope="col">{{ __('Uploaded Photo') }}</th>
                                    <th scope="col">{{ __('Information') }}</th>
                                    <th scope="col">{{ __('Comment') }}</th>
                                    <th scope="col">{{ __('Review On') }}</th>
                                    <th class="white-space-nowrap">{{ __('ACTION') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $review)
                                    <tr>
                                        <td>
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
                                                <div class="col-sm-3 review-status d-flex justify-content-end">
                                                    <div>
                                                        <p>Review on -</p>
                                                        <p style="line-height:1.5">{{ $review->vehilce?->vehicle_name }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <form id="form{{ $review->id }}"
                                                action="{{ route('superadmin.review.destroy', encryptor('encrypt', $review->id)) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>

                         


                    </div>

                    <div class="pt-2">
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
    <!-- Bordered table end -->
    </div>

@endsection
