@extends('layout.app')
@section('pageTitle',trans('Search'))
@section('pageSubTitle',trans('Vehicle Search'))
@push('styles')
<link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .form-control:focus {
        box-shadow: none;
    }

    .ui-widget {
        font-size: 0.8em;
    }
</style>
@endpush
@section('content')
<!-- Bordered table start -->
<section class="section">
    <div class="col-12">
        <div class="card">
            @include('layout.message')
            <form action="{{route('search_by_data')}}">
                @csrf()
                <!-- mid row 1 -->
                <div class="mid-row-1">
                    <div class="input-group d-flex align-items-center mb-2">
                        <span class="input-group-text">Search Car</span>
                        <input type="hidden" name="sales_search" value="search">
                        <input name="sdata" type="text" id="item_search" class="form-control ui-autocomplete-input" style="padding:6px .75rem" />
                        <button type="submit" class="input-group-text"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>
            <div class="container">
                @if(!empty($vehicles) && !empty($countries))
                <h4>Search Results</h4>
                <div class="single-vehicle p-2 my-3">
                    <div class="row">
                        @forelse($vehicles as $v)

                        <div class="col-md-2">
                            @php $cover_img = \DB::table('vehicle_images')->where('vehicle_id',$v->id)->where('is_cover_img',1)->first(); @endphp
                            @if($cover_img)
                            <img src="{{asset('uploads/vehicle_images/'.$cover_img->image)}}" alt="" width="210px" height="140px" />
                            @else
                            <img src="{{asset('uploads/default/comingsoon_l.png')}}" alt="" alt="" width="210px" height="140px" />
                            @endif

                            <p class="stock-text m-0">Stock ID : {{$v->stock_id}}</p>
                        </div>
                        <div class="col-md-10">
                            <div class="col-md-12 d-flex justify-content-between align-items-center">
                                <span class="v-tag"><a href="">New Arival</a></span>
                                <div class="d-flex justify-content-end align-items-center">
                                    <!-- Add | Check Favourite -->
                                    @php $fav_exixts = \DB::table('favourite_vehicles')->where('vehicle_id',$v->id)->where('user_id',currentUserId())->first(); @endphp
                                    @if(!$fav_exixts)
                                    <form method="post" id="withdraw-active-form" action="{{route(currentUser().'.favourvehicle.store')}}" style="display: inline;">
                                        @csrf
                                        <input name="vehicle_id" type="hidden" value="{{$v->id}}">
                                        <a href="javascript:void(0)" data-name="{{$v->fullName}}" class="fav btn btn-secondary btn-sm" data-toggle="tooltip" title="favourite"><i class="fa fa-heart"></i>Add to Favorites</a>
                                    </form>
                                    @else
                                    <button class="btn btn-sm btn-success">Already In Favourite List</button>
                                    @endif

                                    <!-- Add | Cehck Reserve -->
                                    @if($v->r_status == null)
                                    <a data-vehicle-id="{{ $v->id }}" data-fullName="{{ $v->fullName }}" href="#" data-bs-toggle="modal" data-bs-target="#reserveModal" class="ms-2 d-inline-block btn btn-primary btn-sm" title="Reserve">Reserve</a>
                                    @endif
                                </div>


                            </div>
                            <div class="heading d-flex justify-content-between">

                                <h6 class="v-heading">{{--<a href="{{route('singleVehicle',['brand'=>$v->b_slug,'subBrand'=>$v->sb_slug,'stock_id'=>$v->stock_id])}}">--}}{{strtoupper($v->fullName)}}{{--</a>--}}</h5>
                                    @if($v->inv_locatin_id)
                                    @php $inventory_loc = \DB::table('countries')->where('id',$v->inv_locatin_id)->first();@endphp
                                    <p class="m-0 stock-text" style="font-size:medium">Inventory Location <i class="fa fa-flag"></i><span>{{$inventory_loc->name}}</span></p>
                                    @endif
                            </div>
                            <div class="row gx-1">
                                <div class="col-md-3">
                                    <div class="">
                                        @php
                                        $actual_price = $v->price;
                                        $dis_price = $v->price*$v->discount/100;
                                        $price_after_dis = ($actual_price-$dis_price);
                                        @endphp
                                        <p class="price-text m-0">Vehicle Price:


                                            <span>USD {{$price_after_dis}}</span>
                                        </p>
                                        @if($v->discount > 0)
                                        <del>USD {{$actual_price}}</del>
                                        @endif

                                    </div>
                                    <p class="price-text m-0">Total Price: <span>${{number_format($price_after_dis, 2, ',', ',')}}</span></p>
                                    @if($v->discount > 0)
                                    <p>Save: {{$v->discount}}</p>
                                    @endif

                                </div>
                                <div class="col-md-9">
                                    <table class="table table-bordered m-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Production Year</th>
                                                <th>Mileage</th>
                                                <th>Engine</th>
                                                <th>Trans</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$v->manu_year}}</td>
                                                <td>{{$v->mileage}}</td>
                                                <td>{{$v->e_code}}</td>
                                                <td>{{$v->tname}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table mt-2 custom-table">
                                        <tr>
                                            <td>DBA-L175S</td>
                                            <td>
                                                @if($v->fuel_id)
                                                @php $fuel = \DB::table('fuels')->where('id',$v->fuel_id)->first();@endphp
                                                {{$fuel->name}}
                                                @endif
                                            </td>
                                            <td>@if($v->steering == 1) RHD @else LHD @endif</td>
                                            <td>
                                                @if($v->drive_id)
                                                @php $drive = \DB::table('drive_types')->where('id',$v->drive_id)->first();@endphp
                                                {{$drive->name}}
                                                @endif
                                            </td>
                                            <td>4 Seats</td>
                                            <td>5 Doors</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <p class="m-0 feature-text">
                                @if($v->power_steering ==1)
                                <span class="px-1" style="border-right:1px solid #ddd;">Power Steering</span>
                                @endif
                                @if($v->air_con ==1)
                                <span class="px-1" style="border-right:1px solid #ddd;">Air Conditioner</span>
                                @endif
                                <span class="px-1" style="border-right:1px solid #ddd;">Alloy Wheels</span>
                                @if($v->navigation ==1)
                                <span class="px-1" style="border-right:1px solid #ddd;">Navigation</span>
                                @endif
                                @if($v->air_bag ==1)
                                <span class="px-1" style="border-right:1px solid #ddd;">Air Bag</span>
                                @endif
                                @if($v->anti_lock_brake_system ==1)
                                <span class="px-1" style="border-right:1px solid #ddd;">Anti Lock Brake System</span>
                                @endif
                                @if($v->power_windows ==1)
                                <span class="px-1" style="border-right:1px solid #ddd;">Power Windows</span>
                                @endif
                            </p>

                        </div>
                        @empty
                        @endforelse

                    </div>
                </div>
                <div class="pt-2">
                    {{ $vehicles->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</section>

<div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="reserveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form class="form" method="post" action="{{route(currentUser().'.reservevehicle.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="vehicle_id" id="vehicle_id">
                <div class="modal-header text-center">
                    <h4 class="modal-title" id="addNoteModalLabel"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h5 class="text-primary text-center">Reserve Vehicle :-<span id="fullname"></span></h5>
                <div class="modal-body" id="clientData">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reserve</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="{{ asset('front/js/jquery-ui.min.js') }}"></script>`
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('#reserveModal').on('show.bs.modal', function(event) {
        $('#clientData').empty();
        var button = $(event.relatedTarget);
        var vehicle_id = button.data('vehicle-id');
        var fullname = button.data('fullname');
        var modal = $(this);
        modal.find('#vehicle_id').val(vehicle_id);
        modal.find('#fullname').text(fullname);

        $.ajax({
            url: "{{route(currentUser().'.all_client_list_json')}}",
            method: 'GET',
            dataType: 'json',
            success: function(res) {
                console.log(res.data);
                $('#clientData').append(res.data);
            },
            error: function(e) {
                console.log(e);
            }
        });

    });
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $("#item_search").autocomplete({
            source: function(data, cb) {
                //console.log(data);
                $.ajax({
                    autoFocus: true,
                    url: "{{route('searchStData')}}", //To Get Data
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        sdata: data.term
                    },
                    success: function(res) {
                        console.log(res);
                        var result;
                        result = {
                            label: 'No Records Found ',
                            value: ''
                        };
                        if (res.length) {
                            result = $.map(res, function(el) {
                                console.log(el);
                                return {
                                    label: el,
                                    value: '',
                                    id: el
                                };
                            });
                        }
                        cb(result);
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            },
            response: function(e, ui) {
                /*if (ui.content.length == 1) {
                	$(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                	$(this).autocomplete("close");
                }*/
                //console.log(ui);
            },
            //loader start
            search: function(e, ui) {},
            select: function(e, ui) {
                if (typeof ui.content != 'undefined') {
                    if (isNaN(ui.content[0].id)) {
                        return;
                    }
                    //var student_id = ui.content[0].id;
                } else {
                    //var student_id = ui.item.id;
                }

                //return_row_with_data(student_id);
                $("#item_search").val('');
            },
            //loader end
        });
        $("input[name='created_at']").daterangepicker({
            singleDatePicker: true,
            startDate: new Date(),
            showDropdowns: true,
            autoUpdateInput: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        }).on('apply.daterangepicker', function(e, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY'));
        });


    });
    $('.fav').on('click', function(event) {
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Want to Add this vehicle ${name} As Favourite?`,
                icon: "success",
                buttons: true,
                dangerMode: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).parent().submit();
                }
            });
    });
</script>
@endpush