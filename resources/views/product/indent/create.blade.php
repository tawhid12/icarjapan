@extends('layout.app')
@section('pageTitle','Create Indent')
@section('pageSubTitle','Create')
@push('styles')
    <link rel="stylesheet" href="{{ asset('/assets/extensions/choices.js/public/assets/styles/choices.min.css') }}">
@endpush
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">@if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form class="form" method="post" action="{{route(currentUser().'.indent.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="company_id">Company</label>
                                            <select id="company_id" class="form-control" name="company_id">
                                                @forelse($companies as $com)
                                                    <option {{old('company_id')==$com->id?"selected":""}} value="{{$com->id}}">{{$com->name}} - {{$com->contact}}</option>
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
                                            <label for="buyer_id">Buyer <span class="text-danger">*</span></label>
                                            <select class="form-control choices" name="buyer_id" id="buyer_id">
                                                <option value="">Select Buyer</option>
                                                @forelse($buyers as $data)
                                                    <option value="{{$data->id}}" {{ old('buyer_id')==$data->id?"selected":""}}> {{ $data->buyer_code}} - {{ $data->name}}</option>
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
                                            <label for="product_style_id ">Product Style <span class="text-danger">*</span></label>
                                            <select class="form-control choices" name="product_style_id" id="product_style_id ">
                                                <option value="">Select Product Style</option>
                                                @forelse($prostyles as $ps)
                                                    <option value="{{$ps->id}}" {{ old('product_style_id ')==$ps->id?"selected":""}}> {{ $ps->item_code}} - {{ $ps->name}}</option>
                                                @empty
                                                    <option value="">No Product Style found</option>
                                                @endforelse
                                            </select>
                                            @if($errors->has('product_style_id '))
                                            <span class="text-danger"> {{ $errors->first('product_style_id ') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="unit_style_id">Unit <span class="text-danger">*</span></label>
                                            <select  class="form-control choices" name="unit_style_id" id="unit_style_id">
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
                                            <label for="indent_no">Indent No <span class="text-danger">*</span></label>
                                            <input type="text" id="indent_no" value="{{old('indent_no')}}" class="form-control" placeholder="Indent No" name="indent_no">
                                        </div>
                                        @if($errors->has('indent_no'))
                                            <span class="text-danger"> {{ $errors->first('indent_no') }}</span>
                                        @endif
                                    </div> 
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="qty">Quantity <span class="text-danger">*</span></label>
                                            <input type="text" id="qty" value="{{old('qty')}}" class="form-control" placeholder="Quantity" name="qty">
                                        </div>
                                        @if($errors->has('qty'))
                                            <span class="text-danger"> {{ $errors->first('qty') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="weight">Weight </label>
                                            <input type="text" id="weight" value="{{old('weight')}}" class="form-control" placeholder="Weight" name="weight">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="unit_price">Unit Price</label>
                                            <input type="text" id="unit_price" value="{{old('unit_price')}}" class="form-control" placeholder="0.00" name="unit_price">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="order_date">Order Date</label>
                                            <input type="date" id="order_date" value="{{old('order_date')}}" class="form-control" name="order_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="start_date">Production Start Date</label>
                                            <input type="date" id="start_date" value="{{old('start_date')}}" class="form-control" name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="finish_date">Production Finish Date</label>
                                            <input type="date" id="finish_date" value="{{old('finish_date')}}" class="form-control" name="finish_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="actual_finish_date">Production Finish Date (Actual)</label>
                                            <input type="date" id="actual_finish_date" value="{{old('actual_finish_date')}}" class="form-control" name="actual_finish_date">
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea id="description" class="form-control" name="description">{{old('description')}}</textarea>
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

@push('scripts')

<script src="{{ asset('/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script src="{{ asset('/assets/js/pages/form-element-select.js') }}"></script>
    
@endpush