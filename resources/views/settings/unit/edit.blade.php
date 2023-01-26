@extends('layout.app')

@section('pageTitle','Edit Unit')
@section('pageSubTitle','Create')

@section('content')

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.unit.update',encryptor('encrypt',$unit->id))}}">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="unit_style_id">Unit Style</label>
                                            <select id="unit_style_id" class="form-control" name="unit_style_id">
                                                <option value="">Select Unit Style</option>
                                                @forelse($unitstyles as $us)
                                                    <option {{old('unit_style_id',$unit->unit_style_id)==$us->id?"selected":""}} value="{{$us->id}}">{{$us->name}}</option>
                                                @empty
                                                    <option value="">No Data Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('unit_style_id'))
                                            <span class="text-danger"> {{ $errors->first('unit_style_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" value="{{old('name',$unit->name)}}" class="form-control" placeholder="Unit Name" name="name">
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="text-danger"> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="qty">Quantity</label>
                                            <input type="text" id="qty" value="{{old('qty',$unit->qty)}}" class="form-control" placeholder="0.00" name="qty">
                                        </div>
                                        @if($errors->has('qty'))
                                            <span class="text-danger"> {{ $errors->first('qty') }}</span>
                                        @endif
                                    </div>
                                   
                                   <div class="col-md-4 col-12">
                                       <div class="form-group">
                                           <label for="status">Status</label>
                                           <select id="status" class="form-control" name="status">
                                               <option value="1" {{old('status',$unit->status)=="1"?"selected":""}} >Active</option>
                                               <option value="0" {{old('status',$unit->status)=="0"?"selected":""}} >Inactive</option>
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