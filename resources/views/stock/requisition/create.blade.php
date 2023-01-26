@extends('layout.app')
@section('pageTitle','Create Requisition')
@section('pageSubTitle','Create Requisition')
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
                            <form class="form" method="post" action="{{route(currentUser().'.requisition.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-12">
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
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="indent_id">Indent <span class="text-danger">*</span></label>
                                            <select id="indent_id" onchange="get_style(this)" class="form-control" name="indent_id">
                                                <option value="">Select Indent</option>
                                                @forelse($indents as $ind)
                                                    <option data-style="{{$ind->product_style_id}}" data-qty="{{$ind->qty}}" class="indent indent{{$ind->company_id}}" {{old('indent_id')==$ind->id?"selected":""}} value="{{$ind->id}}">{{$ind->indent_no}}</option>
                                                @empty
                                                    <option value="">No Data Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has('indent_id'))
                                            <span class="text-danger"> {{ $errors->first('indent_id') }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="product_style ">Product Style <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="product_style">
                                            <input type="hidden" name="product_style_id" id="product_style_id">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="slip_no">Slip No <span class="text-danger">*</span></label>
                                            <input type="text" id="slip_no" value="{{old('slip_no')}}" class="form-control" name="slip_no">
                                        </div>
                                        @if($errors->has('slip_no'))
                                            <span class="text-danger"> {{ $errors->first('slip_no') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="req_date">Requisition Date <span class="text-danger">*</span></label>
                                            <input type="date" id="req_date" value="{{old('req_date')}}" class="form-control" name="req_date">
                                        </div>
                                        @if($errors->has('req_date'))
                                            <span class="text-danger"> {{ $errors->first('req_date') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="line_no">Line NO <span class="text-danger">*</span></label>
                                            <input type="text" id="line_no" value="{{old('line_no')}}" class="form-control" name="line_no">
                                        </div>
                                        @if($errors->has('line_no'))
                                            <span class="text-danger"> {{ $errors->first('line_no') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="qty_total">Quantity <span class="text-danger">*</span></label>
                                            <input type="text" id="qty_total" value="{{old('qty_total')}}" class="form-control" name="qty_total">
                                        </div>
                                        @if($errors->has('qty_total'))
                                            <span class="text-danger"> {{ $errors->first('qty_total') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="issue_by">Issue By <span class="text-danger">*</span></label>
                                            <input type="text" id="issue_by" value="{{old('issue_by')}}" class="form-control" name="issue_by">
                                        </div>
                                        @if($errors->has('issue_by'))
                                            <span class="text-danger"> {{ $errors->first('issue_by') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="received_by">Received By</label>
                                            <input type="text" id="received_by" value="{{old('received_by')}}" class="form-control" name="received_by">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="delivary_by">delivary By</label>
                                            <input type="text" id="delivary_by" value="{{old('delivary_by')}}" class="form-control" name="delivary_by">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="remarks_r">Remarks</label>
                                            <input type="text" id="remarks_r" value="{{old('remarks_r')}}" class="form-control" name="remarks_r">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-4 col-12 mt-2">
                                        <button type="button" onclick="get_product()" class="btn btn-primary btn-sm me-1 mb-1">Get Products</button>
                                    </div>
                                    
                                    
                                    <div class="col-12">
                                        <table class="table mb-2">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>Product Name</th>
                                                    <th width="100px">Unit</th>
                                                    <th width="90px">Spec</th>
                                                    <th width="90px">Color</th>
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
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script src="{{ asset('assets/js/pages/jquery-ui.min.js') }}"></script>
<script>
    function change_company(e){
        $('.indent').hide();
        $('.indent'+e).show();
    }
    function get_style(e){
        let style=$(e).find(':selected').data('style');
        $.ajax({
            url: "{{route(currentUser().'.requisitionstyle')}}",
            method: 'GET',
            dataType: 'json',
            data: {
                style:style
            },
            success: function(res){
                $('#product_style').val(res.item_code+'-'+res.name)
                $('#product_style_id').val(res.id)
            },error: function(e){
                return false;
                console.log(e);
            }
        });
    }
    function get_product(){
        var indent_id=$('#indent_id').val();
        var qty_total=$('#qty_total').val();
        if(!indent_id){
            $('#indent_id').focus();
            Toastify({text: "Select a Indent id first."}).showToast();
        }else{
            $('#details_data').html('<tr><td colspan="10" class="text-center"><div class="loader my-5"></div></td></tr>');
            $.ajax({
                autoFocus:true,
                url: "{{route(currentUser().'.requisitionproduct')}}",
                method: 'GET',
                dataType: 'json',
                data: {
                    indent_id: indent_id,ind_qty:qty_total
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