@extends('layout.app')
@section('pageTitle','Create Company')
@section('pageSubTitle','Create')
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.company.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" value="{{old('name')}}" class="form-control" placeholder="Company Name" name="name">
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="text-danger"> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="contact">Contact No</label>
                                            <input type="text" id="contact" value="{{old('contact')}}" class="form-control" placeholder="Contact No" name="contact">
                                        </div>
                                        @if($errors->has('contact'))
                                            <span class="text-danger"> {{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="text" id="email" class="form-control" value="{{old('email')}}" placeholder="Email Address" name="email">
                                        </div>
                                        @if($errors->has('email'))
                                            <span class="text-danger"> {{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text" id="location" class="form-control" value="{{old('location')}}" placeholder="Location" name="location">
                                        </div>
                                        @if($errors->has('location'))
                                            <span class="text-danger"> {{ $errors->first('location') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea id="address" class="form-control" name="address">{{old('address')}}</textarea>
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
@endsection