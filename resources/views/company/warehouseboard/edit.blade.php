@extends('layout.app')

@section('pageTitle','Edit Warehouse Board')
@section('pageSubTitle','Create')

@section('content')

  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" action="{{route(currentUser().'.warehouseboard.update',encryptor('encrypt',$warehouseboard->id))}}">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company_id">Company</label>
                                            <select onchange="$('.comp').hide();$('.comp'+this.value).show();" id="company_id" class="form-control" name="company_id">
                                                <option value="">Select Company</option>
                                                @forelse($companies as $com)
                                                    <option {{old('company_id',$warehouseboard->warehouse?->company?->id)==$com->id?"selected":""}} value="{{$com->id}}">{{$com->name}} - {{$com->contact}}</option>
                                                @empty
                                                    <option value="">No Company Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="text-danger"> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="warehouse_id">Warehouse</label>
                                            <select id="warehouse_id" class="form-control" name="warehouse_id">
                                                <option value="">Select Warehouse</option>
                                                @forelse($warehouses as $w)
                                                    <option class="comp comp{{$w->company_id}}" {{old('warehouse_id',$warehouseboard->warehouse_id)==$w->id?"selected":""}} value="{{$w->id}}">{{$w->name}} - {{$w->contact}}</option>
                                                @empty
                                                    <option value="">No Company Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('name'))
                                            <span class="text-danger"> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="board_type">Board Type</label>
                                            <input type="text" id="board_type" value="{{old('board_type',$warehouseboard->board_type)}}" class="form-control" placeholder="Board Type" name="board_type">
                                        </div>
                                        @if($errors->has('board_type'))
                                            <span class="text-danger"> {{ $errors->first('board_type') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="board_no">Board No</label>
                                            <input type="text" id="board_no" value="{{old('board_no',$warehouseboard->board_no)}}" class="form-control" placeholder="Board No" name="board_no">
                                        </div>
                                        @if($errors->has('board_no'))
                                            <span class="text-danger"> {{ $errors->first('board_no') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="capacity">Capacity</label>
                                            <input type="text" id="capacity" value="{{old('capacity',$warehouseboard->capacity)}}" class="form-control" placeholder="Capacity" name="capacity">
                                        </div>
                                        @if($errors->has('capacity'))
                                            <span class="text-danger"> {{ $errors->first('capacity') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text" id="location" class="form-control" value="{{old('location',$warehouseboard->location)}}" placeholder="Location" name="location">
                                        </div>
                                        @if($errors->has('location'))
                                            <span class="text-danger"> {{ $errors->first('location') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status" class="form-control" name="status">
                                                <option value="1" {{old('status',$warehouseboard->status)=="1"?"selected":""}} >Active</option>
                                                <option value="0" {{old('status',$warehouseboard->status)=="0"?"selected":""}} >Inactive</option>
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