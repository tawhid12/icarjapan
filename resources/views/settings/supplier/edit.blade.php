@extends('layout.app')

@section('pageTitle','Edit Supplier')
@section('pageSubTitle','Create')

@section('content')

  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" action="{{route(currentUser().'.supplier.update',encryptor('encrypt',$supplier->id))}}">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$supplier->id)}}">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="location">Location <span class="text-danger">*</span></label>
                                            <select id="location" class="form-control" name="location">
                                                <?php $location=Config::get('storedata.location'); ?>
                                                @forelse($location as $i=>$l)
                                                    <option {{old('location',$supplier->location)==$i?"selected":""}} value="{{$i}}">{{$l}}</option>
                                                @empty
                                                    <option value="">No Location Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('location'))
                                            <span class="text-danger"> {{ $errors->first('location') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="sup_code">Supplier Code</label>
                                            <input type="text" id="sup_code" value="{{old('sup_code',$supplier->sup_code)}}" class="form-control" placeholder="supplier Code" name="sup_code">
                                        </div>
                                        @if($errors->has('sup_code'))
                                            <span class="text-danger"> {{ $errors->first('sup_code') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" value="{{old('name',$supplier->name)}}" class="form-control" placeholder="supplier Name" name="name">
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="text-danger"> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="contact">Contact No</label>
                                            <input type="text" id="contact" value="{{old('contact',$supplier->contact)}}" class="form-control" placeholder="Contact No" name="contact">
                                        </div>
                                        @if($errors->has('contact'))
                                            <span class="text-danger"> {{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="text" id="email" class="form-control" value="{{old('email',$supplier->email)}}" placeholder="Email Address" name="email">
                                        </div>
                                        @if($errors->has('email'))
                                            <span class="text-danger"> {{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" id="country" class="form-control" value="{{old('country',$supplier->country)}}" placeholder="Country" name="country">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" id="city" class="form-control" value="{{old('city',$supplier->city)}}" placeholder="city" name="city">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status" class="form-control" name="status">
                                                <option value="1" {{old('status',$supplier->status)=="1"?"selected":""}} >Active</option>
                                                <option value="0" {{old('status',$supplier->status)=="0"?"selected":""}} >Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea id="address" class="form-control" name="address">{{old('address',$supplier->address)}}</textarea>
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