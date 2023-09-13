@include('layout.message')
@if(!empty($resrv))
<div class="border">
    <div class="p-2">
        <h5 class="text-center my-2 pb-2">Process Proforma Invoice</h5>
        @forelse($resrv as $v)


        <div class="border p-2 mb-3">
            <div class="row gx-2">
                <div class="col-md-6">
                    <div class="border p-2">
                        <div class="row gx-1">
                            <h6 class="border-bottom">{{ ++$loop->index }}.Reserved Details</h6>
                            <div class="col-md-3">
                                @php $cover_img = \DB::table('vehicle_images')->where('vehicle_id',$v->id)->where('is_cover_img',1)->first(); @endphp
                                @if($cover_img)
                                <img src="{{asset('uploads/vehicle_images/'.$cover_img->image)}}" alt="" class="img-fluid" />
                                @else
                                <img src="{{asset('uploads/default/comingsoon_l.png')}}" alt="" alt="" class="img-fluid" />
                                @endif

                                <small class="stock-text m-0">Stock ID : {{$v->stock_id}}</small>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12 d-flex justify-content-between align-items-center">
                                    <span class="v-tag"><a href="">New Arival</a></span>
                                </div>
                                <div class="heading d-flex justify-content-between">

                                    <h6 class="v-heading"><a target="_blank" href="{{route(currentUser().'.vehicle.show',encryptor('encrypt',$v->id))}}">{{strtoupper($v->fullName)}}</a></h5>
                                        @if($v->inv_locatin_id)
                                        @php $inventory_loc = \DB::table('countries')->where('id',$v->inv_locatin_id)->first();@endphp
                                        <p class="m-0 stock-text" style="font-size:medium">Inventory Location <i class="fa fa-flag"></i><span>{{$inventory_loc->name}}</span></p>
                                        @endif
                                </div>
                                <div class="row gx-1">
                                    <div class="col-md-12">
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
                            </div>
                            <div class="col-md-12">

                                <div class="d-flex justify-content-between">
                                    @php
                                    $actual_price = $v->price;
                                    $dis_price = $v->price*$v->discount/100;
                                    $price_after_dis = ($actual_price-$dis_price);
                                    @endphp




                                    @if($v->reserve_status == 1)
                                    <p><i class="badge bg-warning">Reserved</i></p>
                                    @elseif($v->reserve_status == 2)
                                    <p><i class="badge bg-success">Confirmed</i></p>
                                    @else
                                    <p><i class="badge bg-danger">Cancelled</i></p>
                                    @endif
                                    @if($v->reserve_status == 1)
                                    @if(currentUser() != 'accountant')
                                    <form method="post" action="{{route(currentUser().'.reservevehicle.update',encryptor('encrypt',$v->reserveId))}}">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$v->reserveId)}}">
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn btn-primary btn-sm">Confirm Order</button>
                                    </form>
                                    @endif
                                    @endif
                                </div>



                            </div>
                            <div class="col-md-12">
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
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border p-2">
                        <h6 class="border-bottom">Prepare Final Invoice</h6>
                        <table class="table table-bordered m-0">

                            
                                @php

                                if($client_data->country_id && empty(request('country_id'))){
                                $des_port = \DB::table('ports')->where('inv_loc_id',$client_data->country_id)->get();
                                $des_country = \DB::table('countries')->where('id',$client_data->country_id)->first();
                                }elseif(!empty(request('country_id'))){

                                $des_port = \DB::table('ports')->where('inv_loc_id',request('country_id'))->get();
                                $des_country = \DB::table('countries')->where('id',request('country_id'))->first();
                                }

                                @endphp
                                @if(currentUser() != 'accountant')
                                <form method="post" action="{{route(currentUser().'.invoice.store')}}">
                                    @endif
                                    @csrf

                                    <input type="hidden" name="reserve_id" value="{{$v->reserveId}}">
                                    <input type="hidden" name="vehicle_id" value="{{$v->id}}">
                                    <input type="hidden" name="client_id" value="{{$client_data->id}}">
                                    <input type="hidden" name="inv_amount" value="{{$v->total}}">
                            <tr>
                                <th>FOB Amount:</th>
                                <td>USD</td>
                                <td colspan="2">
                                    @if($v->shipment_type == 1)
                                    {{$price_after_dis}}
                                    @else
                                    <input type="text" name="fob_amt" value="{{$v->fob_amt}}">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Freight Amount:</th>
                                <td>USD</td>
                                <td colspan="2">
                                    @if($v->shipment_type == 1)
                                    {{$v->freight_amt}}
                                    @else
                                    <input type="text" name="freight_amt" value="{{$v->freight_amt}}">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Insurance Amount:</th>
                                <td>USD</td>
                                <td colspan="2">
                                    @if($v->shipment_type == 1)
                                    {{$v->insu_amt}}
                                    @else
                                    <input type="text" name="insu_amt" value="{{$v->insu_amt}}">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Inspection Amount:</th>
                                <td>USD</td>
                                <td colspan="2">
                                    @if($v->shipment_type == 1)
                                    {{$v->insp_amt}}
                                    @else
                                    <input type="text" name="insp_amt" value="{{$v->insp_amt}}">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>M3 Value</th>
                                <td>USD</td>
                                <td colspan="2">
                                    @if($v->shipment_type == 1)
                                    {{$v->m3_value}}
                                    @else
                                    <input type="text" name="m3_value" value="{{$v->m3_value}}">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>M3 Charge</th>
                                <td>USD</td>
                                <td colspan="2">
                                    @if($v->shipment_type == 1)
                                    {{$v->m3_charge}}
                                    @else
                                    <input type="text" name="m3_charge" value="{{$v->m3_charge}}">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Other Cost:</th>
                                <td>USD</td>
                                <td colspan="2">
                                    @if($v->shipment_type == 1)
                                    {{$v->aditional_cost}}
                                    @else
                                    <input type="text" name="aditional_cost" value="{{$v->aditional_cost}}">
                                    @endif
                                </td>
                            </tr>
                            <!-- <tr>
                                <th>Discount:</th>
                                <td>USD</td>
                                <td colspan="2">
                                    @if($v->shipment_type == 1)
                                    @if($v->dis > 0) {{$v->dis}} @else 0.00 @endif
                                    @else
                                    <input type="hidden" name="discount" value="{{$v->dis}}">
                                    @endif
                                </td>
                            </tr> -->
                            <tr>
                                <th>Total:</th>
                                <td>USD</td>
                                <td colspan="2">{{$v->total}}</td>
                            </tr>
                            <tr>
                                <th>Total Paid:</th>
                                <td>USD</td>
                                <td colspan="2">{{\DB::table('payments')->where('reserve_id',$v->reserveId)->sum('amount')}}</td>
                            </tr>
                            <tr>
                                <th>Total Due:</th>
                                <td>USD</td>
                                <td colspan="2">{{$v->total-\DB::table('payments')->where('reserve_id',$v->reserveId)->sum('amount')}}</td>
                            </tr>
                            @php $final_invoice_id = \DB::table('invoices')->where('invoice_type',4)->where('reserve_id',$v->reserveId)->first(); @endphp
                            @if(!$final_invoice_id)
                            <tr>
                                <td> <button class="btn btn-sm btn-success" type="submit">Submit</button></td>
                            </tr>
                            @endif

                            </form>
                        </table>
                        <div class="d-flex justify-content-between my-2">
                            @if(currentUser() != 'accountant')
                            <a class="btn btn-sm btn-success" href="{{route(currentUser().'.invoice.show',encryptor('encrypt',$v->reserveId))}}">Send Final Invoice To Customer</a>
                            @endif
                            @if(currentUser() == 'accountant')
                                @php 
                                $total_payable = \DB::table('invoices')->where('reserve_id',$v->reserveId)->first(); 
                               // print_r($total_payable);die;
                                $total_paid = DB::table('payments')
                                ->join('invoices','payments.reserve_id','invoices.reserve_id')
                                ->where('payments.reserve_id',$v->reserveId)
                                ->sum('payments.amount');
                                @endphp
                                @php 
                                
                                //print_r($final_invoice_id);die; 
                                @endphp
                                @if(!empty($final_invoice_id) && $total_paid < $total_payable->inv_amount)
                                <a class="btn btn-sm btn-warning" href="{{route(currentUser().'.payment.show',$final_invoice_id->id)}}">Paid</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
</div>
@endif