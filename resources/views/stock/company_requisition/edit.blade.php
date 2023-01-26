@extends('layout.app')
@section('pageTitle','Edit C2C Requisition')
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
                          <form class="form" method="post" action="{{route(currentUser().'.c_to_c_transfer.update',encryptor('encrypt',$data->id))}}">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Company From: </span>{{$data->company->name}}
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Company To: </span>{{$data->companyTo->name}}
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                            <span class="fw-bold">Quantity: </span>{{(float) $data->qty}}
                                        
                                            <span class="fw-bold ps-3">Date: </span>{{$data->creq_date}}
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="slip_no">Slip No <span class="text-danger">*</span></label>
                                            <input type="text" id="slip_no" value="{{old('slip_no',$data->slip_no)}}" class="form-control" name="slip_no">
                                        </div>
                                        @if($errors->has('slip_no'))
                                            <span class="text-danger"> {{ $errors->first('slip_no') }}</span>
                                        @endif
                                    </div>
                                   
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="issue_by">Issue By <span class="text-danger">*</span></label>
                                            <input type="text" id="issue_by" value="{{old('issue_by',$data->issue_by)}}" class="form-control" name="issue_by">
                                        </div>
                                        @if($errors->has('issue_by'))
                                            <span class="text-danger"> {{ $errors->first('issue_by') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="received_by">Received By</label>
                                            <input type="text" id="received_by" value="{{old('received_by',$data->received_by)}}" class="form-control" name="received_by">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="delivary_by">delivary By</label>
                                            <input type="text" id="delivary_by" value="{{old('delivary_by',$data->delivary_by)}}" class="form-control" name="delivary_by">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="remarks_r">Remarks</label>
                                            <input type="text" id="remarks_r" value="{{old('remarks_r',$data->remarks_r)}}" class="form-control" name="remarks_r">
                                        </div>
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
                                    <div class="row mt-2">
                                        <div class="col-md-2 col-12 pb-2 text-end">Search Product</div>
                                    <div class="col-md-8 col-12 pb-3">
                                        <input type="text" name="" id="item_search" class="form-control  ui-autocomplete-input" placeholder="Search Product">
                                    </div>
                                    
                                    <div class="col-12">
                                        <table class="table mb-2">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>Product Name</th>
                                                    <th>Indent</th>
                                                    <th>Warehouse</th>
                                                    <th>Board No</th>
                                                    <th width="100px">Unit</th>
                                                    <th width="90px">Origin</th>
                                                    <th width="90px">Prod Date</th>
                                                    <th width="90px">Price</th>
                                                    <th width="90px">Qty</th>
                                                    <th width="90px">Remarks</th>
                                                    <th>Del</th>
                                                </tr>
                                            </thead>
                                            <tbody id="details_data">
                                                @php $location=\Config::get('storedata.location'); @endphp
                                                @forelse($detailsData as $d)
                                                    @php /*$dsd=array_search($d->product_id  , array_column($detailsDataSort, 'product_id'));*/ @endphp
                                                <tr class="productlist">
                                                    <td>
                                                        {{$d->product->name}}
                                                        <input type="hidden" value="{{$d->product_id}}" class="product_id_list">
                                                    </td>
                                                    <td>{{$d->indent?->indent_no}}</td>
                                                    <td>{{$d->warehouse?->name}}</td>
                                                    <td>{{$d->warehouseboard?->board_no}}</td>
                                                    <td>{{$d->unitstyle?->name}}</td>
                                                    <td>{{$location[$d->location]}}</td>
                                                    <td>{{$d->production_date}}</td>
                                                    <td>{{(float) $d->unit_price}}</td>
                                                    <td>
                                                        Req: {{(float) $d->qty}}<br/>
                                                        Rec: {{(float) $d->del_qty}}<br/>
                                                        S/O: {{(float) ($d->qty - $d->del_qty)}}<br/>
                                                    </td>
                                                    <td>{{$d->remarks}}</td>
                                                    <td></td>
                                                </tr>
                                                @empty
                                                
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
<script src="{{ asset('assets/js/pages/jquery-ui.min.js') }}"></script>
<script>
    
    $(function() {
        $("#item_search").bind("paste", function(e){
            $("#item_search").autocomplete('search');
        } );
        $("#item_search").autocomplete({
            source: function(data, cb){
                let company_id="{{$data->company_id}}";
                let oldpro="";
                $(".productlist").each(function(){
                    oldpro+=$(this).find(".product_id_list").val()+",";
                })

                $.ajax({
                    autoFocus:true,
                    url: "{{route(currentUser().'.ctcrequisitionprosearch')}}",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        name: data.term,company_id:company_id,oldpro:oldpro
                    },
                    success: function(res){
                        //console.log(res)//2176137
                        var result;
                        result = {label: 'No Records Found or Already in List',value: ''};
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
                    if(isNaN(ui.content[0].id)){return;}
                    var item_id=ui.content[0].id;
                }else{var item_id=ui.item.id;}
                return_row_with_data(item_id);
                $("#item_search").val('');
            },
            //loader end
        });
    });
    function return_row_with_data(item_id){
        $("#item_search").addClass('ui-autocomplete-loader-center');
        let company_id="{{$data->company_id}}";
        $.ajax({
            autoFocus:true,
            url: "{{route(currentUser().'.ctcrequisitionprosearchrs')}}",
            method: 'GET',
            dataType: 'json',
            data: {item_id: item_id,company_id:company_id},
            success: function(res){
                if(res.data==""){
                    Toastify({text: res.msg}).showToast();
                }
                $('#details_data').append(res.data);
                $("#item_search").val('');
                $("#item_search").removeClass('ui-autocomplete-loader-center');
                //initchoice(res.choice);
            },error: function(e){
                console.log(e);
            }
        });
        
    }

    //INCREMENT ITEM
    function removerow(e){
        $(e).parents('tr').remove();
    }
    
    function check_qty(e){
        var available=$(e).parents('tr').find('.avaiableqty').val();

        if(parseFloat($(e).val()) > parseFloat(available)){
            $(e).val(available)
            Toastify({text: "You cannot transfer more than "+available+""}).showToast();
        }
    }
</script>

@endpush