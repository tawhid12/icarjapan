@extends('layout.landing')

@section('pageTitle', 'Purchase Vehicle List')
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
                    <h4>All Purchased</h4>
                    <div id="toastr-messages"></div>

                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('#SL') }}</th>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Reserved By') }}</th>
                                    <th scope="col">{{ __('Assign to') }}</th>
                                    <th scope="col">{{ __('Reserved On') }}</th>
                                    <th scope="col">{{ __('Note') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th class="white-space-nowrap">{{ __('Review') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pur as $rsv)
                                    <tr>
                                        <th scope="row">{{ ++$loop->index }}</th>
                                        <td>
                                            <p class="m-0"><strong>Vehicle Name :
                                                </strong>{{ optional($rsv->vehicle)->fullName }}</p>
                                            <p class="m-0">StockId : {{ optional($rsv->vehicle)->stock_id }}</p>
                                            <p class="m-0">Price : USD {{ optional($rsv->vehicle)->price }}</p>
                                        </td>
                                        <td>
                                            <p class="m-0"><strong>Customer Id: </strong>{{ $rsv->customer_id }}</p>
                                            <p class="m-0"><strong>Name: </strong>{{ optional($rsv->res_user)->name }}
                                            </p>
                                        </td>
                                        <td>
                                            @if ($rsv->assign_user_id)
                                                <p class="m-0"><strong>Sales Executive Id:
                                                    </strong>{{ $rsv->assign_user_id }}</p>
                                                <p class="m-0"><strong>Name:
                                                    </strong>{{ optional($rsv->assign_user)->name }}</p>
                                            @else
                                                <p>No Sales Executive Assigned</p>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($rsv->created_at))->format('j M, Y') }}
                                        </td>
                                        <td>{{ $rsv->note }}</td>
                                        <td>Sold</td>
                                        <td class="white-space-nowrap">
                                            @php
                                                $review_count = \DB::table('reviews')
                                                    ->where('purchase_id', $rsv->id)
                                                    ->count();
                                            @endphp
                                            @if ($review_count > 0)
                                            @else
                                                <a href="#" data-bs-toggle="modal"
                                                    data-purchase-id="{{ $rsv->id }}"
                                                    data-bs-target="#reviewModal">Please Review Us</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No Reserved Found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pt-2">
                            {{ $pur->links() }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reviewForm" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div> --}}
                        <input type="hidden" name="purchase_id" id="purchase_id">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select class="form-select" id="rating" name="rating">
                                <option value="" selected disabled>Select a rating</option>
                                <option value="1">1 star</option>
                                <option value="2">2 stars</option>
                                <option value="3">3 stars</option>
                                <option value="4">4 stars</option>
                                <option value="5">5 stars</option>
                            </select>
                            <span id="rating_error" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                            <span id="comment_error" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Upload File</label>
                            <input type="file" class="form-control" name="upload[]" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#reviewModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var purchase_id = button.data('purchase-id'); // Extract info from data-* attributes
                var modal = $(this);
                modal.find('.modal-body #purchase_id').val(purchase_id);
            });

            $('#reviewForm').on('submit', function(e) {
                e.preventDefault();
                var submitButton = $(this).find(':submit');
                submitButton.prop('disabled', true); // Disable submit button
                submitButton.html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );

                // Get the uploaded file
                var fileInput = $(this).find('input[name="upload"]')[0];
                var file = fileInput.files[0];

                // Check if a file is selected
                if (file) {
                    // Check if the file is an image
                    if (!file.type.match('image.*')) {
                        toastr.error('Please upload only image files.');
                        submitButton.prop('disabled', false); // Re-enable submit button
                        submitButton.html('Submit Review');
                        return;
                    }
                }

                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.review.store') }}',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success(response.message);
                        $('#reviewModal').modal('hide');
                        // Optionally, you can show a success message or update the UI
                        // Reload the window
                        window.location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status == 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $("#" + key + "_error").text(value[0]);
                            });
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        submitButton.prop('disabled', false); // Re-enable submit button
                        submitButton.html('Submit Review');
                    }
                });
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endpush
