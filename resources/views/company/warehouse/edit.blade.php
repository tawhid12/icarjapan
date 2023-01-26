@extends('layout.app')

@section('pageTitle','Edit Warehouse')
@section('pageSubTitle','Create')

@section('content')

  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" action="{{route(currentUser().'.warehouse.update',encryptor('encrypt',$warehouse->id))}}">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$warehouse->id)}}">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="company_id">Company</label>
                                            <select id="company_id" class="form-control" name="company_id">
                                                @forelse($companies as $com)
                                                    <option {{old('company_id',$warehouse->company_id)==$com->id?"selected":""}} value="{{$com->id}}">{{$com->name}} - {{$com->contact}}</option>
                                                @empty
                                                    <option value="">No Company Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('company_id'))
                                            <span class="text-danger"> {{ $errors->first('company_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" value="{{old('name',$warehouse->name)}}" class="form-control" placeholder="Warehouse Name" name="name">
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="text-danger"> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="contact">Contact No</label>
                                            <input type="text" id="contact" value="{{old('contact',$warehouse->contact)}}" class="form-control" placeholder="Contact No" name="contact">
                                        </div>
                                        @if($errors->has('contact'))
                                            <span class="text-danger"> {{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="text" id="email" class="form-control" value="{{old('email',$warehouse->email)}}" placeholder="Email Address" name="email">
                                        </div>
                                        @if($errors->has('email'))
                                            <span class="text-danger"> {{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text" id="location" class="form-control" value="{{old('location',$warehouse->location)}}" placeholder="Location" name="location">
                                        </div>
                                        @if($errors->has('location'))
                                            <span class="text-danger"> {{ $errors->first('location') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status" class="form-control" name="status">
                                                <option value="1" {{old('status',$warehouse->status)=="1"?"selected":""}} >Active</option>
                                                <option value="0" {{old('status',$warehouse->status)=="0"?"selected":""}} >Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea id="address" class="form-control" name="address">{{old('address',$warehouse->address)}}</textarea>
                                        </div>
                                        @if($errors->has('address'))
                                            <span class="text-danger"> {{ $errors->first('address') }}</span>
                                        @endif
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