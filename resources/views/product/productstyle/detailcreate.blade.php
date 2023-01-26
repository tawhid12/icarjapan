@extends('layout.app')
@section('pageTitle','Create Product Style Details')
@section('pageSubTitle','Create')
@push('styles')
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
                            <form class="form" method="post" action="{{route(currentUser().'.productstyledetails.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="fs-4 text-center">
                                            {{$ps->name}}
                                            <b class="fs-5 text-center">
                                                ({{$ps->style_code}})
                                            </b>
                                        </div>
                                        <input type="hidden" name="product_style_id" value="{{$ps->id}}">
                                    </div>
                                    <div class="col-md-8 offset-2 col-12 py-1">
                                        <input type="text" name="" id="item_search" class="form-control  ui-autocomplete-input" placeholder="Search Product">
                                    </div>
                                    
                                    <div class="col-12">
                                        <table class="table mb-2">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>Product Name</th>
                                                    <th style="width:100px">Unit</th>
                                                    <th>Qty</th>
                                                    <th>Weight</th>
                                                    <th>Description</th>
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
<script src="{{ asset('assets/js/pages/jquery-ui.min.js') }}"></script>
<script>
    $(function() {
        $("#item_search").bind("paste", function(e){
            $("#item_search").autocomplete('search');
        } );
        $("#item_search").autocomplete({
            source: function(data, cb){
                let oldpro="{{implode(',',$psd)}}";
                $(".productlist").each(function(){
                    oldpro+=","+$(this).find(".product_id_list").val();
                })
            
                $.ajax({
                autoFocus:true,
                    url: "{{route(currentUser().'.prosearch')}}",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        name: data.term,oldpro:oldpro
                    },
                    success: function(res){
                        var result;
                        result = {label: 'No Records Found or already used',value: ''};
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
        $.ajax({
            autoFocus:true,
                url: "{{route(currentUser().'.prosearchrs')}}",
                method: 'GET',
                dataType: 'json',
                data: {
                    item_id: item_id
                },
                success: function(res){
                    $('#details_data').append(res.data);
                    $("#item_search").val('');
                    $("#item_search").removeClass('ui-autocomplete-loader-center');
                    initchoice(res.choice);
                },error: function(e){
                    console.log("error "+e);
                }
            });
	
    }
    //INCREMENT ITEM
    function removerow(e){
        $(e).parents('tr').remove();
    }
    function initchoice(e){
        let choices = document.querySelectorAll("."+e);
        new Choices(choices[0],{itemSelectText: ''});
    }
</script>

@endpush