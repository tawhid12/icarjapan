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
                            <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.port.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Port</label>
                                            <input type="text" id="name" class="form-control" placeholder="Port Name" name="name">
                                        </div>
                                        @if($errors->has('name'))
                                        <span class="text-danger"> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                      <div class="form-group">
                                          <label for="inv_loc_id">Inventory Location</label>
                                          <select name="inv_loc_id" class="form-control">
                                              <option value="">Select</option>
                                              @if(count($inv_loc))
                                              @foreach($inv_loc as $in)
                                              <option value="{{ $in->id}}">{{$in->name}}</option>
                                              @endforeach
                                              @endif
                                          </select>
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