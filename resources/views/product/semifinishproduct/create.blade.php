@extends('layout.app')
@section('pageTitle','Create Semi Finish Product')
@section('pageSubTitle','Create')
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.semifinishproduct.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="category_id">Category <span class="text-danger">*</span></label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option value="">Select Category</option>
                                                @forelse($categories as $cat)
                                                    <option value="{{$cat->id}}" {{ old('category_id')==$cat->id?"selected":""}}> {{ $cat->name}}</option>
                                                @empty
                                                    <option value="">No Category found</option>
                                                @endforelse
                                                
                                            </select>
                                            @if($errors->has('category_id'))
                                            <span class="text-danger"> {{ $errors->first('category_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="unit_style_id">Unit <span class="text-danger">*</span></label>
                                            <select  class="form-control" name="unit_style_id" id="unit_style_id">
                                                <option value="">Select Unit</option>
                                                @forelse($unitstyles as $data)
                                                    <option value="{{$data->id}}" {{ old('unit_style_id')==$data->id?"selected":""}}> {{ $data->name}}</option>
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
                                            <label for="unit_price">Unit Price</label>
                                            <input type="text" id="unit_price" value="{{old('unit_price')}}" class="form-control" placeholder="0.00" name="unit_price">
                                        </div>
                                        @if($errors->has('unit_price'))
                                            <span class="text-danger"> {{ $errors->first('unit_price') }}</span>
                                        @endif
                                    </div>
                                   
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" id="name" value="{{old('name')}}" class="form-control" placeholder="Product Name" name="name">
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="text-danger"> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="item_code">Code (From ERP) <span class="text-danger">*</span></label>
                                            <input type="text" id="item_code" value="{{old('item_code')}}" class="form-control" placeholder="Product Code" name="item_code">
                                        </div>
                                        @if($errors->has('item_code'))
                                            <span class="text-danger"> {{ $errors->first('item_code') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="color">Color</label>
                                            <input type="text" id="color" value="{{old('color')}}" class="form-control" placeholder="Product Color" name="color">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea id="description" class="form-control" placeholder="Description" name="description">{{old('description')}}</textarea>
                                        </div>
                                        @if($errors->has('description'))
                                            <span class="text-danger"> {{ $errors->first('description') }}</span>
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