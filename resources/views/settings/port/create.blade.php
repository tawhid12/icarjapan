  @extends('layout.app')

@section('pageTitle','Create Port')
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
                                            <label for="name">RORO M3 Charge</label>
                                            <input type="text" id="m3" class="form-control" placeholder="M3 charge" name="m3">
                                        </div>
                                        @if($errors->has('m3'))
                                        <span class="text-danger"> {{ $errors->first('m3') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Aditional Cost</label>
                                            <input type="text" id="aditional_cost" class="form-control" placeholder="Aditional Cost" name="aditional_cost">
                                        </div>
                                        @if($errors->has('aditional_cost'))
                                        <span class="text-danger"> {{ $errors->first('aditional_cost') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                      <div class="form-group">
                                          <label for="inv_loc_id">Select Country</label>
                                          <select name="inv_loc_id" class="form-control">
                                              <option value="">Select</option>
                                              @if(count($countries))
                                              @foreach($countries as $c)
                                              <option value="{{ $c->id}}">{{$c->name}}</option>
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