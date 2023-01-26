@extends('layout.app')
@section('pageTitle','Transfer To Indent')
@section('pageSubTitle','Transfer To Indent')

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.stocktransferind.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="company_id">Company <span class="text-danger">*</span></label>
                                            <select id="company_id" onchange="change_company(this.value)" class="form-control" name="company_id">
                                                <option value="">Select Company</option>
                                                @forelse($companies as $comp)
                                                    <option {{old('company_id')==$comp->id?"selected":""}} value="{{$comp->id}}">{{$comp->name}}</option>
                                                @empty
                                                    <option value="">No Data Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('company_id'))
                                            <span class="text-danger"> {{ $errors->first('company_id') }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="indent_id">Indent From </label>
                                            <select id="indent_id" class="form-control" name="indent_id">
                                                <option value="">Select Indent</option>
                                                @forelse($indents as $ind)
                                                    <option class="indent indent{{$ind->company_id}}" {{old('indent_id')==$ind->id?"selected":""}} value="{{$ind->id}}">{{$ind->indent_no}} - {{ (float) $ind->qty}}</option>
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
                                            <label for="indent_to_id">Indent To</label>
                                            <select id="indent_to_id" class="form-control" name="indent_to_id">
                                                <option value="">Select Indent</option>
                                                @forelse($indents as $ind)
                                                    <option class="indent indent{{$ind->company_id}}" {{old('indent_to_id')==$ind->id?"selected":""}} value="{{$ind->id}}">{{$ind->indent_no}} - {{ (float) $ind->qty}}</option>
                                                @empty
                                                    <option value="">No Data Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('indent_to_id'))
                                            <span class="text-danger"> {{ $errors->first('indent_to_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="ind_qty">Required Quantity</label>
                                            <input type="number" id="ind_qty" class="form-control" name="ind_qty">
                                        </div>
                                        @if($errors->has('indent_id'))
                                            <span class="text-danger"> {{ $errors->first('indent_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="stock_date">Transfer Date</label>
                                            <input type="date" id="stock_date" class="form-control" name="stock_date">
                                        </div>
                                        @if($errors->has('stock_date'))
                                            <span class="text-danger"> {{ $errors->first('stock_date') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="production_date">Production Date</label>
                                            <input type="date" id="production_date" class="form-control" name="production_date">
                                        </div>
                                        @if($errors->has('production_date'))
                                            <span class="text-danger"> {{ $errors->first('production_date') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12 pt-4">
                                        <button type="button" onclick="get_product()" class="btn btn-primary btn-sm">Get Products</button>
                                    </div>
                                    
                                    <div class="col-12 pt-2">
                                        <table class="table mb-2">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>Product Name</th>
                                                    <th>Warehouse</th>
                                                    <th>Board No</th>
                                                    <th width="100px">Unit</th>
                                                    <th width="90px">Origin</th>
                                                    <th width="90px">Prod Date</th>
                                                    <th width="90px">Price</th>
                                                    <th width="90px">Qty</th>
                                                    <th width="90px">Remarks</th>
                                                    <th><input onchange="checkall(this)" type="checkbox" id="check_all" value="1"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="details_data">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1 btn-sm">Save</button>
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
<script>
    function change_company(e){
        $('.indent').hide();
        $('.indent'+e).show();
    }
    function checkall(e){
        if($(e).prop('checked')){
            $('.stock_id').prop('checked',true)
        }else{
            $('.stock_id').prop('checked',false)
        }
    }
    function get_product(){
        var indent_id=$('#indent_id').val();
        var ind_qty=$('#ind_qty').val();
        if(!indent_id){
            $('#indent_id').focus();
            Toastify({text: "Select a Indent id first."}).showToast();
        }else{
            $('#details_data').html('<tr><td colspan="10" class="text-center"><div class="loader my-5"></div></td></tr>');
            $.ajax({
                autoFocus:true,
                url: "{{route(currentUser().'.pti.get_product')}}",
                method: 'GET',
                dataType: 'json',
                data: {
                    indent_id: indent_id,ind_qty:ind_qty
                },
                success: function(res){
                    if(res.data){
                        $('#details_data').html(res.data);
                    }else{
                        Toastify({text: "No Stock found under this indent"}).showToast();
                    }
                },error: function(e){
                    console.log(e);
                }
            });
        }
        
    }
    
</script>

@endpush