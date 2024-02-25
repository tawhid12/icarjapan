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
                    <h4>Review</h4>
                    <form id="reviewForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="review_type" id="review-type" value="2">
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
    </section>


@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#reviewModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var review_type = button.data('review-type'); // Extract info from data-* attributes
                var modal = $(this);
                modal.find('.modal-body #review_type').val(review_type);
            });

            $('#reviewForm').on('submit', function(e) {
                e.preventDefault();
                var submitButton = $(this).find(':submit');
                submitButton.prop('disabled', true); // Disable submit button
                submitButton.html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );

                // Get the uploaded files
                var files = $(this).find('input[name="upload[]"]')[0].files;

                // Check if files are selected
                /*if (files.length === 0) {
                    toastr.error('Please select at least one image to upload.');
                    submitButton.prop('disabled', false); // Re-enable submit button
                    submitButton.html('Submit Review');
                    return;
                }*/
                // Check if all files are images
                for (var i = 0; i < files.length; i++) {
                    if (!files[i].type.match('image.*')) {
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
                        window.location.href = "{{ route('user.review.index') }}";
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
