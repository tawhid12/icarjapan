@extends('layout.app')
@section('pageTitle','Stock Out')
@section('pageSubTitle','Stock Out')
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
                            <form class="form" method="post" action="{{route(currentUser().'.stockin.store')}}">
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
                                            <label for="indent_id">Indent</label>
                                            <select id="indent_id" onchange="get_indent_details()" class="form-control" name="indent_id">
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
                                            <label for="ind_qty">Required Quantity</label>
                                            <input type="number" id="ind_qty" onchange="get_indent_details()" class="form-control" name="ind_qty">
                                                
                                        </div>
                                        @if($errors->has('indent_id'))
                                            <span class="text-danger"> {{ $errors->first('indent_id') }}</span>
                                        @endif
                                    </div>
                                    
                                    
                                    <div class="col-12">
                                        <table class="table mb-2">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>Product Name</th>
                                                    <th>Board No</th>
                                                    <th width="100px">Unit</th>
                                                    <th width="90px">Qty</th>
                                                    <th width="90px">Price</th>
                                                    <th width="90px">Prod Date</th>
                                                    <th width="90px">Remarks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="details_data">
                                                
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
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script>

    function change_company(e){
        $('.indent').hide();
        $('.indent'+e).show();
    }
    
    function get_indent_details(){
        var indent_id=$('#indent_id').val();
        var ind_qty=$('#ind_qty').val();
        $.ajax({
            autoFocus:true,
            url: "{{route(currentUser().'.stockoutprosearchrs')}}",
            method: 'GET',
            dataType: 'json',
            data: {
                indent_id: indent_id,ind_qty:ind_qty
            },
            success: function(res){
                $('#details_data').append(res.data);
                initchoice(res.choice);
            },error: function(e){
                console.log(e);
            }
        });
        
    }
    //INCREMENT ITEM
    function removerow(e){
        $(e).parents('tr').remove();
    }
    
    function initchoice(e){
        new Choices(document.querySelectorAll(".choices"+e)[0],{itemSelectText: ''});
        new Choices(document.querySelectorAll(".choicessf"+e)[0],{itemSelectText: ''});
    }
</script>

@endpush