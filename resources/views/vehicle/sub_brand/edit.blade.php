@extends('layout.app')

@section('pageTitle','Edit Sub Brand')
@section('pageSubTitle','Create')

@section('content')

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.subBrand.update',encryptor('encrypt',$sb->id))}}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$sb->id)}}">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="name">Brand</label>
                                        <input type="text" id="name" value="{{ $sb->name }}" class="form-control" placeholder="Brand Name" name="name">
                                        @if($errors->has('name'))
                                        <span class="text-danger"> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="fuel_id">Brand</label>
                                        <select name="brand_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($brands))
                                            @foreach($brands as $b)
                                            <option value="{{ $b->id}}" @if($sb->brand_id == $b->id) selected @endif>{{$b->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if($errors->has('brand_id'))
                                        <span class="text-danger"> {{ $errors->first('brand_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" id="image" class="form-control" placeholder="Image" name="image">
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <img width="50px" height="30px" class="float-first m-2" src="{{asset('uploads/brands/'.$sb->image)}}" alt="">
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