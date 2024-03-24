@extends('layout.app')

@section('pageTitle','Create Brand')
@section('pageSubTitle','Create')

@section('content')
  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.page.store')}}">
                              @csrf
                              <div class="row">
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label for="name">Page Title</label>
                                          <input type="text" id="title" class="form-control" placeholder="Page Title" name="title">
                                      </div>
                                      @if($errors->has('title'))
                                      <span class="text-danger"> {{ $errors->first('title') }}</span>
                                      @endif
                                  </div>
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label for="details">Page Details</label>
                                          <div id="toolbar-container"></div>
                                          <textarea class="form-control content" placeholder="Enter the Sisal Rope Breaking Strength chart" rows="5"
                                              name="details"></textarea>
                                      </div>
                                  </div>
                                  
                                  <div class="col-12 d-flex justify-content-end">
                                      <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                      
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- // Basic multiple Column Form section end -->
</div>
@endsection
@push('scripts')
    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>


    <script>
        // Select all textarea elements with the specified class name
        const textareas = document.querySelectorAll('.content');

        // Loop through each textarea element
        textareas.forEach(textarea => {
            // Apply ClassicEditor.create to each textarea
            ClassicEditor.create(textarea)
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endpush