@extends('layout.app')
@section('pageTitle','Edit Indent Details')
@section('pageSubTitle','Edit')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endpush
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.indentdetails.update',encryptor('encrypt',$psd->id))}}">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="fs-4 text-center">
                                            {{$ps->productstyle?->style_code}} - {{$ps->productstyle?->name}}
                                            <b class="fs-5 text-center">
                                                ({{$ps->indent_no}})
                                            </b>
                                            <input type="hidden" name="indent_id" value="{{$ps->id}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" disabled value="{{old('name',$psd->product)}}" class="form-control" >
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="unit_style_id">Unit <span class="text-danger">*</span></label>
                                            <select class="form-control choice" name="unit_style_id" id="unit_style_id">
                                                @forelse($unitstyles as $data)
                                                    <option value="{{$data->id}}" {{ old('unit_style_id',$psd->unit_style_id)==$data->id?"selected":""}}> {{ $data->name}}</option>
                                                @empty
                                                    <option value="">No Unit found</option>
                                                @endforelse
                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="price">Price </label>
                                            <input type="text" name="price" id="price" value="{{old('price',$psd->price)}}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="qty">Quantity </label>
                                            <input type="text" name="qty" id="qty" value="{{old('qty',$psd->qty)}}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="weight">Weight </label>
                                            <input type="text" name="weight" id="weight" value="{{old('weight',$psd->weight)}}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="description">Description </label>
                                            <input type="text" name="description" id="description" value="{{old('description',$psd->description)}}" class="form-control" >
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
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script>
    let choices = document.querySelectorAll(".choice");
    new Choices(choices[0],{itemSelectText: ''});
    
</script>

@endpush