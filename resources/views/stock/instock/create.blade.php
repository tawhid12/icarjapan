@extends('layout.app')
@section('pageTitle','Receive Stock')
@section('pageSubTitle','Receive Stock')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/extensions/toastify-js/src/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/jquery-ui.css') }}">
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
                                            <label for="warehouse_id">Warehouse <span class="text-danger">*</span></label>
                                            <select id="warehouse_id" class="form-control" name="warehouse_id">
                                                <option value="">Select Warehouse</option>
                                                @forelse($warehouses as $w)
                                                    <option class="warehouse warehouse{{$w->company_id}}" {{old('warehouse_id')==$w->id?"selected":""}} value="{{$w->id}}">{{$w->name}}</option>
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
                                            <label for="indent_id">Indent</label>
                                            <select id="indent_id" class="form-control" name="indent_id">
                                                <option value="">Select Indent</option>
                                                @forelse($indents as $ind)
                                                    <option class="indent indent{{$ind->company_id}}" {{old('indent_id')==$ind->id?"selected":""}} value="{{$ind->id}}">{{$ind->indent_no}}</option>
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
                                                    <option {{old('location')=="$i"?"selected":""}} value="{{$i}}">{{$l}}</option>
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
                                            <select id="supplier_id" class="form-control" name="supplier_id">
                                                <option value="">Select Supplier</option>
                                                @forelse($suppliers as $ind)
                                                    <option class="origin origin{{$ind->location}}" {{old('supplier_id')==$ind->id?"selected":""}} value="{{$ind->id}}">{{$ind->sup_code}} - {{$ind->name}} ({{$ind->contact}})</option>
                                                @empty
                                                    <option value="">No Data Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="purchase_order">Invoice NO</label>
                                            <input type="text" onblur="checkforduplicate()" id="purchase_order" value="{{old('purchase_order')}}" class="form-control" name="purchase_order">
                                        </div>
                                        @if($errors->has('purchase_order'))
                                            <span class="text-danger"> {{ $errors->first('purchase_order') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="slip_no">Slip No</label>
                                            <input type="text" id="slip_no" value="{{old('slip_no')}}" class="form-control" name="slip_no">
                                        </div>
                                        @if($errors->has('slip_no'))
                                            <span class="text-danger"> {{ $errors->first('slip_no') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="stock_date">Stock Date</label>
                                            <input type="date" id="stock_date" value="{{old('stock_date')}}" class="form-control" name="stock_date">
                                        </div>
                                        @if($errors->has('stock_date'))
                                            <span class="text-danger"> {{ $errors->first('stock_date') }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="col-md-8 offset-2 col-12 py-1">
                                        <input type="text" name="" onfocus="checkforduplicate()" id="item_search" class="form-control  ui-autocomplete-input" placeholder="Search Product">
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
<script src="{{ asset('/assets/extensions/toastify-js/src/toastify.js') }}"></script>
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script src="{{ asset('assets/js/pages/jquery-ui.min.js') }}"></script>
<script>
    function change_company(e){
        $('.warehouse').hide();
        $('.warehouse'+e).show();
        
        $('.indent').hide();
        $('.indent'+e).show();
    }
    function change_origin(e){
        $('.origin').hide();
        $('.origin'+e).show();
    }
    function checkforduplicate(){
        let supplier_id=$('#supplier_id').val();
        let indent_id=$('#indent_id').val();
        let purchase_order=$('#purchase_order').val();
        if(!indent_id){
            $('#indent_id').focus();
            Toastify({text: "Select a Indent id first."}).showToast();
            $('#item_search').val('');
            return false;
        }else if(!supplier_id){
            $('#supplier_id').focus();
            Toastify({text: "Select a supplier id first."}).showToast();
            $('#item_search').val('');
            return false;
        }else if(!purchase_order){
            $('#purchase_order').focus();
            Toastify({text: "Select a invoice id first."}).showToast();
            $('#item_search').val('');
            return false;
        }else{
            $.ajax({
                url: "{{route(currentUser().'.stockincheckinv')}}",
                method: 'GET',
                dataType: 'json',
                data: {
                    sup:supplier_id,ind:indent_id,inv:purchase_order
                },
                success: function(res){
                    if(res==true){
                        $('#purchase_order').focus();
                        Toastify({text: "You have already upload this invoice data."}).showToast();
                        $('#item_search').val('');
                        return false;
                    }
                    return res;
                },error: function(e){
                    Toastify({text: "You have already upload this invoice data."}).showToast();
                        $('#item_search').val('');
                        return false;
                    console.log(e);
                }
            });
        }
    }
    $(function() {

        $('.warehouse').hide();
        $('.indent').hide();
        $('.origin').hide();

        $("#item_search").bind("paste", function(e){
            $("#item_search").autocomplete('search');
        } );
        $("#item_search").autocomplete({
            
            source: function(data, cb){
               
                var indent_id=$('#indent_id').val();
                $.ajax({
                    autoFocus:true,
                    url: "{{route(currentUser().'.stockinprosearch')}}",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        name: data.term,indent_id:indent_id
                    },
                    success: function(res){
                        var result;
                        result = {label: 'No Records Found ',value: ''};
                        if (res.length) {
                            result = $.map(res, function(el){
                                return {
                                    label: '('+el.item_code+') '+el.name,
                                    value: '',
                                    id: el.id,
                                    item_name: el.name
                                };
                            });
                        }
                        cb(result);
                    },error: function(e){
                        console.log(e);
                    }
                });
            },
            response:function(e,ui){
                if(ui.content.length==1){
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete("close");
                }
                //console.log(ui.content[0].id);
            },
                //loader start
            search: function (e, ui) {},
            select: function (e, ui) { 
                if(typeof ui.content!='undefined'){
                    if(isNaN(ui.content[0].id)){
                        return;
                    }
                    var item_id=ui.content[0].id;
                }
                else{
                    var item_id=ui.item.id;
                }
                return_row_with_data(item_id);
                $("#item_search").val('');
            },   
            //loader end
        });
    });
    function return_row_with_data(item_id){
        $("#item_search").addClass('ui-autocomplete-loader-center');
        var warehouse_id=$('#warehouse_id').val();
        $.ajax({
            autoFocus:true,
            url: "{{route(currentUser().'.stockinprosearchrs')}}",
            method: 'GET',
            dataType: 'json',
            data: {
                item_id: item_id,warehouse_id:warehouse_id
            },
            success: function(res){
                $('#details_data').append(res.data);
                $("#item_search").val('');
                $("#item_search").removeClass('ui-autocomplete-loader-center');
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