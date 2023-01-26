@extends('layout.app')
@section('pageTitle','Edit Requisition')
@section('pageSubTitle','Edit')
@push('styles')
<link rel="stylesheet" href="{{ asset('/assets/extensions/toastify-js/src/toastify.css') }}">
<link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/jquery-ui.css') }}">
@endpush
@section('content')
  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" action="{{route(currentUser().'.req.accept_product_edit',encryptor('encrypt',$data->id))}}">
                                @csrf
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Company: </span>{{$data->company->name}}
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Indent No: </span>{{$data->indent->indent_no}}
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Style: </span>{{$data->productstyle->item_code}}
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Quantity: </span>{{(float) $data->qty}}
                                        
                                            <span class="fw-bold ps-3">Date: </span>{{$data->req_date}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Line NO: </span>{{$data->line_no}}
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Issue By: </span>{{$data->issue_by}}
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Received By: </span>{{$data->received_by}}
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Delivary By: </span>{{$data->delivary_by}}
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Remarks: </span>{{$data->remarks_r}}
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select id="status" class="form-control" name="status">
                                                    <option value="0" {{old('status',$data->status)=="0"?"selected":""}} >Pending</option>
                                                    <option value="1" {{old('status',$data->status)=="1"?"selected":""}} >Partial accepted</option>
                                                    <option value="2" {{old('status',$data->status)=="2"?"selected":""}} >Finish</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="production_date">Production Date <span class="text-danger">*</span></label>
                                                <input type="date" required id="production_date" value="{{old('production_date')}}" class="form-control" name="production_date">
                                            </div>
                                            @if($errors->has('production_date'))
                                                <span class="text-danger"> {{ $errors->first('production_date') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        @php $location=Config::get('storedata.location'); @endphp
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="text-center p-0">#sl</th>
                                                    <th rowspan="2" class="text-center p-0">Material</th>
                                                    <th rowspan="2" class="text-center p-0">Spec</th>
                                                    <th rowspan="2" class="text-center p-0">Color</th>
                                                    <th rowspan="2" class="text-center p-0">Unit</th>
                                                    <th rowspan="2" class="text-center p-0">Origin</th>
                                                    <th rowspan="2" class="text-center p-0">Warehouse</th>
                                                    <th rowspan="2" class="text-center p-0">Board No</th>
                                                    <th colspan="3" class="text-center p-0">Quantity</th>
                                                    <th rowspan="2" class="text-center p-0">Remarks</th>
                                                    {{-- <th rowspan="2" class="text-center p-0">Del</th> --}}
                                                </tr>
                                                <tr>
                                                    <th class="text-center p-0">Req</th>
                                                    <th width="100px" class="text-center p-0">Received</th>
                                                    <th class="text-center p-0">S/O</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($data->details as $d)
                                                <tr id="product_details{{$d->id}}">
                                                    <td class="p-0">{{++$loop->index}}</td>
                                                    <td class="p-0">
                                                        {{$d->product->item_code}} - {{$d->product->name}}
                                                        <input type="hidden" value="{{$d->product_id}}" class="product_id">
                                                    </td>
                                                    <td class="p-0">{{$d->spec}}</td>
                                                    <td class="p-0">{{$d->color}}</td>
                                                    <td class="p-0">{{$d->product?->unitstyle?->name}}</td>
                                                    <td class="p-0">
                                                        <select onchange="blank_rec({{$d->id}})" class="form-control location" name="location[]">
                                                            <option value="">Select</option>
                                                            @forelse($location as $i=>$l)
                                                                <option {{old('location')=="$i"?"selected":""}} value="{{$i}}">{{$l}}</option>
                                                            @empty
                                                                <option value="">No Location Found</option>
                                                            @endforelse
                                                        </select>
                                                    </td>
                                                    <td class="p-0">
                                                        <select onchange="blank_rec({{$d->id}})" id="warehouse_id" class="form-control warehouse_id" name="warehouse_id[]">
                                                            <option value="">Select</option>
                                                            @forelse($warehouses as $w)
                                                                <option {{old('warehouse_id')==$w->id?"selected":""}} value="{{$w->id}}">{{$w->name}}</option>
                                                            @empty
                                                                <option value="">No Data Found</option>
                                                            @endforelse
                                                        </select>
                                                    </td>
                                                    <td class="p-0">
                                                        <select onchange="blank_rec({{$d->id}})" id="warehouse_board_id" class="form-control choices warehouse_board_id" name="warehouse_board_id[]">
                                                            <option value="">Select</option>
                                                            @forelse($boardno as $w)
                                                                <option class="warehouse warehouse{{$w->warehouse_id}}" {{old('warehouse_board_id')==$w->id?"selected":""}} value="{{$w->id}}">{{$w->board_no}}</option>
                                                            @empty
                                                                <option value="">No Data Found</option>
                                                            @endforelse
                                                        </select>
                                                    </td>
                                                    <td class="p-0">{{(float) $d->qty}}</td>
                                                    <td class="p-0">
                                                        <input onkeyup="check_qty({{$d->id}})" class="form-control del_qty_new" type="text" name="del_qty[]" value="">
                                                        <input type="hidden" value="{{(float) $d->del_qty}}" class="old_qty" name="old_qty[]">
                                                        <input type="hidden" value="{{(float) ($d->qty - $d->del_qty)}}" class="so_qty">
                                                        <input type="hidden" name="req_det_id[]" value="{{encryptor('encrypt',$d->id)}}">
                                                    </td>
                                                    <td class=" sonew">{{(float) ($d->qty - $d->del_qty)}}</td>
                                                    <td class="p-0"><input type="text" value="{{$d->remarks}}" class="form-control" name="remarks[]"></td>
                                                    {{-- <td class="white-space-nowrap">
                                                        @if($data->status!=2)
                                                        <a class="text-danger" onclick="return confirm('Are you sure to delete this product?')" href="{{route(currentUser().'.req.delete_product',encryptor('encrypt',$d->id))}}">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                        @endif 
                                                    </td>--}}
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="9" class="text-center"> No Data Found</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
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
<script src="{{ asset('/assets/extensions/toastify-js/src/toastify.js') }}"></script>
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script>
    
    function blank_rec(e){
        $('#product_details'+e).find('.del_qty_new').val('');
    }
    //INCREMENT ITEM
    function check_qty(e){
        let product_id=$('#product_details'+e).find('.product_id').val();
        let board_no=$('#product_details'+e).find('.warehouse_board_id').val();
        let indent_id="{{$data->indent->id}}";
        let location=$('#product_details'+e).find('.location').val();
        let old_qty=$('#product_details'+e).find('.old_qty').val();// Received before this time
        let del_qty_new=$('#product_details'+e).find('.del_qty_new').val(); // Received 
        let so_qty=parseFloat($('#product_details'+e).find('.so_qty').val()); // S/O 
        let dqn=Math.abs(del_qty_new);

        if(so_qty < del_qty_new ){
            $('#product_details'+e).find('.del_qty_new').val('');
            Toastify({text: "You cannot received more than your S/O"}).showToast();
            return false;
        }else if(del_qty_new < 0 && dqn > old_qty){
            $('#product_details'+e).find('.del_qty_new').val('-'+old_qty);
            Toastify({text: "You cannot back more than your received"}).showToast();
            return false;
        }else if(!location){
            $('#product_details'+e).find('.del_qty_new').val('');
            Toastify({text: "Select a Origin."}).showToast();
            return false;
        }else if(!board_no){
            $('#product_details'+e).find('.del_qty_new').val('');
            Toastify({text: "Select a Board."}).showToast();
            return false;
        }else if(del_qty_new < 0){
            $('#product_details'+e).find('.sonew').text(so_qty + Math.abs(del_qty_new));
            Toastify({text: "sdfsdf."}).showToast();
        }else if(Math.abs(del_qty_new) > 0){
            $.ajax({
                url: "{{route(currentUser().'.req.accept_product_check')}}",
                method: 'GET',
                dataType: 'json',
                data: { product_id:product_id,board_no:board_no,indent_id:indent_id,location:location,del_qty_new:del_qty_new },
                success: function(res){
                    if(res.error_no > 0){
                        $('#product_details'+e).find('.del_qty_new').val('');
                        Toastify({text: res.error}).showToast();
                    }else{
                        Toastify({text: so_qty}).showToast();
                            $('#product_details'+e).find('.sonew').text(so_qty - (del_qty_new));
                        }
                },error: function(e){
                    return false;
                    console.log(e);
                }
            });
        }else if(del_qty_new == 0){
            $('#product_details'+e).find('.sonew').text(so_qty - (del_qty_new));
        }
    }
    
    $('document').ready(function(){
        for(i=0;i<=document.querySelectorAll(".choices").length; i++){
            new Choices(document.querySelectorAll(".choices")[i],{itemSelectText: ''});
        }
    })
</script>

@endpush