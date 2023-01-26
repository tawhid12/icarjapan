@extends('layout.app')
@section('pageTitle','Edit Stock Receive')
@section('pageSubTitle','Edit')
@push('styles')
    <link rel="stylesheet" href="{{ asset('/assets/extensions/choices.js/public/assets/styles/choices.min.css') }}">
@endpush
@section('content')
  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" action="{{route(currentUser().'.stockin.update',encryptor('encrypt',$pis->id))}}">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="company_id">Company  <span class="text-danger">*</span></label>
                                            <select id="company_id" onchange="change_company(this.value)" class="form-control" name="company_id">
                                                @forelse($companies as $com)
                                                    <option {{old('company_id',$pis->company_id)==$com->id?"selected":""}} value="{{$com->id}}">{{$com->name}} - {{$com->contact}}</option>
                                                @empty
                                                    <option value="">No Company Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('company_id'))
                                            <span class="text-danger"> {{ $errors->first('company_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="warehouse_id">Warehouse  <span class="text-danger">*</span></label>
                                            <select id="warehouse_id" onchange="change_warehouse(this.value)" class="form-control" name="warehouse_id">
                                                <option value="">Select Warehouse</option>
                                                @forelse($warehouses as $w)
                                                    <option class="warehouse warehouse{{$w->company_id}}" {{old('warehouse_id',$pis->warehouse_id)==$w->id?"selected":""}} value="{{$w->id}}">{{$w->name}}</option>
                                                @empty
                                                    <option value="">No Data Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('warehouse_id'))
                                            <span class="text-danger"> {{ $errors->first('warehouse_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="warehouse_board_id"> Board No <span class="text-danger">*</span></label>
                                            <select id="warehouse_board_id" class="form-control" name="warehouse_board_id">
                                                <option value="">Select Board No</option>
                                                @forelse($warehouseboards as $w)
                                                    <option class="warehouseb warehouseb{{$w->warehouse_id}}" {{old('warehouse_board_id',$pis->warehouse_board_id)==$w->id?"selected":""}} value="{{$w->id}}">{{$w->board_no}} ({{$w->capacity}})</option>
                                                @empty
                                                    <option value="">No Data Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('warehouse_board_id'))
                                            <span class="text-danger"> {{ $errors->first('warehouse_board_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="indent_id">Indent</label>
                                            <select id="indent_id" class="form-control" name="indent_id">
                                                <option value="">Select Indent</option>
                                                @forelse($indents as $ind)
                                                    <option class="indent indent{{$ind->company_id}}" {{old('indent_id',$pis->indent_id)==$ind->id?"selected":""}} value="{{$ind->id}}">{{$ind->indent_no}}</option>
                                                @empty
                                                    <option value="">No Data Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('indent_id'))
                                            <span class="text-danger"> {{ $errors->first('indent_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="location">Origin <span class="text-danger">*</span></label>
                                            @php $location=Config::get('storedata.location'); @endphp
                                            <select onchange="change_origin(this.value)" id="location" class="form-control" name="location">
                                                <option value="">Select Origin</option>
                                                @forelse($location as $i=>$l)
                                                    <option {{old('location',$pis->location)=="$i"?"selected":""}} value="{{$i}}">{{$l}}</option>
                                                @empty
                                                    <option value="">No Location Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('location'))
                                            <span class="text-danger"> {{ $errors->first('location') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="supplier_id">Supplier</label>
                                            <select id="supplier_id" class="form-control choice" name="supplier_id">
                                                <option value="">Select Supplier</option>
                                                @forelse($suppliers as $ind)
                                                    <option class="origin origin{{$ind->location}}" {{old('supplier_id',$pis->supplier_id)==$ind->id?"selected":""}} value="{{$ind->id}}">{{$ind->sup_code}} - {{$ind->name}} ({{$ind->contact}})</option>
                                                @empty
                                                    <option value="">No Data Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="purchase_order">PO NO</label>
                                            <input type="text" id="purchase_order" value="{{old('purchase_order',$pis->purchase_order)}}" class="form-control" name="purchase_order">
                                        </div>
                                        @if($errors->has('purchase_order'))
                                            <span class="text-danger"> {{ $errors->first('purchase_order') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="unit_style_id">Unit <span class="text-danger">*</span></label>
                                            <select class="form-control choice" name="unit_style_id" id="unit_style_id">
                                                @forelse($unitstyles as $data)
                                                    <option value="{{$data->id}}" {{ old('unit_style_id',$pis->unit_style_id)==$data->id?"selected":""}}> {{ $data->name}}</option>
                                                @empty
                                                    <option value="">No Unit found</option>
                                                @endforelse
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="production_date">Production Date</label>
                                            <input type="date" value="{{old('production_date',$pis->production_date)}}" name="production_date" class="form-control" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" disabled value="{{old('name',$pis->product)}}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-12">
                                        <div class="form-group">
                                            <label for="unit_price">Price </label>
                                            <input type="text" name="unit_price" id="unit_price" value="{{(float) old('price',$pis->unit_price)}}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-12">
                                        <div class="form-group">
                                            <label for="qty">Quantity </label>
                                            <input type="text" name="qty" id="qty" value="{{old('qty',$pis->qty)}}" class="form-control" >
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
<script>
    
    function change_company(e){
        $('.warehouse').hide();
        $('.warehouse'+e).show();
        
        $('.indent').hide();
        $('.indent'+e).show();
    }
    function change_warehouse(e){
        $('.warehouseb').hide();
        $('.warehouseb'+e).show();
    }
    function change_origin(e){
        $('.origin').hide();
        $('.origin'+e).show();
    }
    $(function() {
        //new Choices(document.querySelectorAll(".choice")[0],{itemSelectText: ''});
        new Choices(document.querySelectorAll(".choice")[1],{itemSelectText: ''});
        //new Choices(document.querySelectorAll(".choicessf"+e)[0],{itemSelectText: ''});
        $('.warehouse').hide();
        $('.warehouseb').hide();
        $('.indent').hide();
        $('.origin').hide();
        change_company({{$pis->company_id}});
        change_warehouse({{$pis->warehouse_id}});
        change_origin({{$pis->location}})
    });
</script>
@endpush