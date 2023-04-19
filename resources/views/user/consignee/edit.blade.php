@extends('layout.app')

@section('pageTitle','Edit Brand')
@section('pageSubTitle','Create')

@section('content')

  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.brand.update',encryptor('encrypt',$b->id))}}">
                              @csrf
                              @method('patch')
                              <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$b->id)}}">
                              <div class="row">
                                  <div class="col-md-6 col-12">
                                      <div class="form-group">
                                          <label for="name">Brand</label>
                                          <input type="text" id="name" value="{{ $b->name }}" class="form-control" placeholder="Brand Name" name="name">
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" id="image" class="form-control"
                                                placeholder="Image" name="image">
                                        </div>
                                    </div>
                                  
                                  <div class="col-12 d-flex justify-content-end">
                                        <img width="50px" height="30px" class="float-first m-2" src="{{asset('uploads/brands/'.$b->image)}}" alt="">
                                        <button type="submit" class="btn btn-primary mb-1">Save</button>
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