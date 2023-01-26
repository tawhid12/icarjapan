@extends('layout.app')
@section('pageTitle','Edit Product Style')
@section('pageSubTitle','Edit')
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.productstyle.update',encryptor('encrypt',$productstyle->id))}}">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-md-8 col-12">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" id="name" value="{{old('name',$productstyle->name)}}" class="form-control" placeholder="Style Name" name="name">
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="text-danger"> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="style_code">Style Code (Number From ERP) <span class="text-danger">*</span></label>
                                            <input type="text" id="style_code" value="{{old('style_code',$productstyle->style_code)}}" class="form-control" placeholder="Style Code" name="style_code">
                                        </div>
                                        @if($errors->has('style_code'))
                                            <span class="text-danger"> {{ $errors->first('style_code') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <div class="form-group">
                                            <label for="size">Size </label>
                                            <input type="text" id="size" value="{{old('size',$productstyle->size)}}" class="form-control" placeholder="Product Size" name="size">
                                        </div>
                                        @if($errors->has('size'))
                                            <span class="text-danger"> {{ $errors->first('size') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="color">Color </label>
                                            <input type="text" id="color" value="{{old('color',$productstyle->color)}}" class="form-control" placeholder="Color" name="color">
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" id="description" value="{{old('description',$productstyle->description)}}" class="form-control" placeholder="Description" name="description">
                                        </div>
                                        @if($errors->has('description'))
                                            <span class="text-danger"> {{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="unit_price">Unit Price</label>
                                            <input type="text" id="unit_price" value="{{old('unit_price',$productstyle->unit_price)}}" class="form-control" placeholder="0.00" name="unit_price">
                                        </div>
                                        @if($errors->has('unit_price'))
                                            <span class="text-danger"> {{ $errors->first('unit_price') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="buyer_id">Buyer <span class="text-danger">*</span></label>
                                            <select class="form-control" name="buyer_id" id="buyer_id">
                                                <option value="">Select Buyer</option>
                                                @forelse($buyers as $data)
                                                    <option value="{{$data->id}}" {{ old('buyer_id',$productstyle->buyer_id)==$data->id?"selected":""}}> {{ $data->name}}</option>
                                                @empty
                                                    <option value="">No Buyer found</option>
                                                @endforelse
                                                
                                            </select>
                                            @if($errors->has('buyer_id'))
                                            <span class="text-danger"> {{ $errors->first('buyer_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="unit_style_id">Unit <span class="text-danger">*</span></label>
                                            <select  class="form-control" name="unit_style_id" id="unit_style_id">
                                                <option value="">Select Unit</option>
                                                @forelse($unitstyles as $data)
                                                    <option value="{{$data->id}}" {{ old('unit_style_id',$productstyle->unit_style_id)==$data->id?"selected":""}}> {{ $data->name}}</option>
                                                @empty
                                                    <option value="">No Unit found</option>
                                                @endforelse
                                                
                                            </select>
                                            @if($errors->has('unit_style_id'))
                                            <span class="text-danger"> {{ $errors->first('unit_style_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status" class="form-control" name="status">
                                                <option value="1" {{old('status',$productstyle->status)=="1"?"selected":""}} >Active</option>
                                                <option value="0" {{old('status',$productstyle->status)=="0"?"selected":""}} >Inactive</option>
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
@endsection