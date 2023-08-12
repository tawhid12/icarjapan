@extends('layout.app')
@section('pageTitle',trans('Sales Module'))
@section('pageSubTitle',trans('Reserve List'))
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<!-- Bordered table start -->
<section class="section">
    <div class="col-12">
        <div class="card">
            @include('layout.message')
            @if(!empty($reserve_vehicle))
            @forelse($reserve_vehicle as $v)
            <div class="row">


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
                    </div>
                    <div class="heading d-flex justify-content-between">

                        <h6 class="v-heading"><a href="{{route('singleVehicle',['brand'=>$v->b_slug,'subBrand'=>$v->sb_slug,'stock_id'=>$v->stock_id])}}">{{strtoupper($v->fullName)}}</a></h5>
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


            </div>
            @empty
            @endforelse
            @endif
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
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
</script>
@endpush