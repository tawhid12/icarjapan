@extends('layout.app')
@section('pageTitle','Receive Stock Excel Upload')
@section('pageSubTitle','Receive Stock Excel Upload')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/extensions/toastify-js/src/toastify.css') }}">
@endpush
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                                    <option class="origin origin{{$ind->location}}" {{old('supplier_id')==$ind->id?"selected":""}} value="{{$ind->id}}">{{$ind->name}} ({{$ind->contact}})</option>
                                                @empty
                                                    <option value="">No Data Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="purchase_order">Invoice NO</label>
                                            <input onblur="checkforduplicate()" type="text" id="purchase_order" value="{{old('purchase_order')}}" class="form-control" name="purchase_order">
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
                                    <div class="offset-4 col-4 py-2">
                                        <input type="file" onfocus="checkforduplicate()" name="file" id="file" class="form-control" >
                                    </div>
                                    <div class="col-2 py-2">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="uploadexcel()">Upload</button>
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
                                                    <th width="120px">Prod Date</th>
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
            Toastify({text: "You have already upload this invoice data."}).showToast();
            $('#file').val('');
            return false;
        }else if(!supplier_id){
            $('#supplier_id').focus();
            Toastify({text: "Select a supplier id first."}).showToast();
            Toastify({text: "You have already upload this invoice data."}).showToast();
            $('#file').val('');
            return false;
        }else if(!purchase_order){
            $('#purchase_order').focus();
            Toastify({text: "Select a invoice id first."}).showToast();
            Toastify({text: "You have already upload this invoice data."}).showToast();
            $('#file').val('');
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
                        $('#file').val('');
                        return false;
                    }
                    return res;
                },error: function(e){
                    Toastify({text: "You have already upload this invoice data."}).showToast();
                        $('#file').val('');
                        return false;
                    console.log(e);
                }
            });
        }
    }
  
    function uploadexcel(){
        
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        var warehouse_id = $('#warehouse_id').val();
        // Get the selected file
        var files = $('#file')[0].files;
        if(files.length > 0){
           var fd = new FormData();
  
           // Append data 
           fd.append('file',files[0]);
           fd.append('_token',CSRF_TOKEN);
           fd.append('warehouse_id',warehouse_id);
  
           // Hide alert 
           $('#responseMsg').hide();
  
           // AJAX request 
           $.ajax({
             url: "{{route(currentUser().'.stockin.up_excel')}}",
             method: 'post',
             data: fd,
             contentType: false,
             processData: false,
             dataType: 'json',
             success: function(response){
                $('#details_data').html(response.data);
             },
             error: function(response){
                console.log("error : " + JSON.stringify(response) );
             }
           });
        }else{
            Toastify({text: "Please select a file."}).showToast();
        }
  
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