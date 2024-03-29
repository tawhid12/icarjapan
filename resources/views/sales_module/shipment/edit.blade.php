@extends('layout.app')

@section('pageTitle','Edit Shipping Details')
@section('pageSubTitle','Shipping Details')

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.shipment.update',encryptor('encrypt',$shipment->id))}}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$shipment->id)}}">
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label><strong>Invoice Details</strong></label><br>
                                        <label><strong>Customer Id : </strong>{{$user->id}}</label><br>
                                        <label><strong>Customer Name : </strong>{{$user->name}}</label><br>
                                        <label><strong>{{$resrv->fullName}}</strong></label><br>
                                        <label>StockId : {{$resrv->stock_id}}</label><br>
                                        <label>Price : USD {{$resrv->total}}</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="auc_country_id">Auction Country</label>
                                        <select name="auc_country_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($countries) > 0)
                                            @foreach($countries as $in)
                                            <option value="{{ $in->id}}" @if($shipment->auc_country_id == $in->id) selected @endif>{{$in->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="des_country_id">Destination Country</label>
                                        <select name="des_country_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($countries) > 0)
                                            @foreach($countries as $in)
                                            <option value="{{ $in->id}}" @if($shipment->des_country_id == $in->id) selected @endif>{{$in->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <h6 class="mt-3">Bill Details</h6>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="tracking_no">Tracking No:</label>
                                        <input type="text" id="tracking_no" class="form-control" placeholder="Tracking Number" name="tracking_no" value="{{old('tracking_no',$shipment->tracking_no)}}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="shipping_date">Shipping Date:</label>
                                        <input type="text" id="shipping_date" class="form-control" name="shipping_date">
                                    </div>
                                </div>

                                <!-- <h6 class="mt-3">Pricing Details</h6>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="fob_amt">FOB Amount</label>
                                        <input type="text" id="fob_amt" class="form-control" placeholder="Fob Amount" name="fob_amt" value="{{old('fob_amt')}}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="freight_amt">Freight Amount</label>
                                        <input type="text" id="freight_amt" class="form-control" placeholder="Freight Amount" name="freight_amt" value="{{old('freight_amt')}}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="insu_amt">Insurance Amount</label>
                                        <input type="text" id="	insu_amt" class="form-control" placeholder="Insurance Amount" name="insu_amt" value="{{old('insu_amt')}}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="insp_amt">Inspection Amount</label>
                                        <input type="text" id="	insp_amt" class="form-control" placeholder="Insurance Amount" name="insp_amt" value="{{old('insp_amt')}}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="insp_amt">Vanning Amount:</label>
                                        <input type="text" id="	van_amt" class="form-control" placeholder="Vanning Amount" name="van_amt" value="{{old('van_amt')}}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="insp_amt">Virus Busters Amount:</label>
                                        <input type="text" id="	v_bus_amt" class="form-control" placeholder="Virus Busters Amount" name="v_bus_amt" value="{{old('v_bus_amt')}}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="other_cost">Other Cost</label>
                                        <input type="text" id="other_cost" class="form-control" placeholder="Other Cost" name="other_cost" value="{{old('other_cost')}}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="text" id="discount" class="form-control" placeholder="Discount" name="discount" value="{{old('discount')}}">
                                    </div>
                                </div> -->
                                <h6 class="mt-3">Inspection Details</h6>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="ins_req_date">Request Date</label>
                                        <input type="text" id="ins_req_date" class="form-control" name="ins_req_date">
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="ins_pass_date">Pass Date</label>
                                        <input type="text" id="ins_pass_date" class="form-control" name="ins_pass_date">
                                    </div>
                                </div>

                                <h6 class="mt-3">Select Consignee</h6>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="des_country_id">Select Consignee</label>
                                        <select name="consignee_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($consignee) > 0)
                                            @foreach($consignee as $c)
                                            <option value="{{ $c->id}}" @if($shipment->consignee_id == $c->id) selected @endif>{{$c->c_name}}-{{$c->n_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <h6 class="mt-3">Shipping Details</h6>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="dep_port_id">Departure Port:</label>
                                        <!-- <input type="text" id="dep_port_id" class="form-control" placeholder="Departure Port" name="dep_port_id"> -->
                                        <select name="dep_port_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($ports) > 0)
                                            @foreach($ports as $p)
                                            @php $port_country = \DB::table('countries')->where('id',$p->inv_loc_id)->first(); @endphp
                                            <option value="{{ $p->id}}" @if($shipment->dep_port_id == $p->id) selected @endif>{{$p->name}}-{{$port_country->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="des_port_id">Destination Port:</label>
                                        <!-- <input type="text" id="des_port_id" class="form-control" placeholder="Destination Port" name="des_port_id"> -->
                                        <select name="des_port_id" class="form-control">
                                            <option value="">Select</option>
                                            @if(count($ports) > 0)
                                            @foreach($ports as $p)
                                            @php $port_country = \DB::table('countries')->where('id',$p->inv_loc_id)->first(); @endphp
                                            <option value="{{ $p->id}}" @if($shipment->des_port_id == $p->id) selected @endif>{{$p->name}}-{{$port_country->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="ship_name">Ship Name</label>
                                        <input type="text" id="ship_name" class="form-control" placeholder="Ship Name" name="ship_name" value="{{old('ship_name',$shipment->ship_name)}}">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="voyage_no">Voyage No</label>
                                        <input type="text" id="voyage_no" class="form-control" placeholder="Voyage No" name="voyage_no" value="{{old('voyage_no',$shipment->voyage_no)}}">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="est_arival_date">Est. Arrival Date</label>
                                        <input type="text" id="est_arival_date" class="form-control" name="est_arival_date">
                                    </div>
                                </div>
                                <h6 class="mt-3">Documents Details</h6>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="bill_of_land_1_url"><!--Bill of Lading (Copy)-->Proforma Invoice</label>
                                        <input type="file" id="bill_of_land_1_url" class="form-control" name="bill_of_land_1_url">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="bill_of_land_2_url"><!--Bill of Lading (Release)-->Final Invoice</label>
                                        <input type="file" id="bill_of_land_2_url" class="form-control" name="bill_of_land_2_url">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="exp_can_cer_url_1">Export Cancellation Certificate (English)</label>
                                        <input type="file" id="exp_can_cer_url_1" class="form-control" name="exp_can_cer_url_1">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="exp_can_cer_url_2">Export Cancellation Certificate (Japanese)</label>
                                        <input type="file" id="exp_can_cer_url_2" class="form-control" name="exp_can_cer_url_2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- // Basic multiple Column Form section end -->
</div>
@endsection
@push('scripts')
<script>
    if ('{{$shipment->est_arival_date}}')
            date = '{{$shipment->est_arival_date}}'
        else
            date = new Date();
        $('#est_arival_date').daterangepicker({
            singleDatePicker: true,
            startDate: moment(date).format('DD/MM/YYYY'),
            showDropdowns: true,
            autoUpdateInput: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        }).on('changeDate', function(e) {
            var date = moment(e.date).format('DD/MM/YYYY');
            $(this).val(date);
        }).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $(this).trigger('change');
        });
        
        if ('{{$shipment->shipping_date}}')
            date = '{{$shipment->shipping_date}}'
        else
            date = new Date();
        $('#shipping_date').daterangepicker({
            singleDatePicker: true,
            startDate: moment(date).format('DD/MM/YYYY'),
            showDropdowns: true,
            autoUpdateInput: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        }).on('changeDate', function(e) {
            var date = moment(e.date).format('DD/MM/YYYY');
            $(this).val(date);
        }).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $(this).trigger('change');
        });


        if ('{{$shipment->ins_req_date}}')
            date = '{{$shipment->ins_req_date}}'
        else
            date = new Date();
        $('#ins_req_date').daterangepicker({
            singleDatePicker: true,
            startDate: moment(date).format('DD/MM/YYYY'),
            showDropdowns: true,
            autoUpdateInput: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        }).on('changeDate', function(e) {
            var date = moment(e.date).format('DD/MM/YYYY');
            $(this).val(date);
        }).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $(this).trigger('change');
        });

        if ('{{$shipment->ins_pass_date}}')
            date = '{{$shipment->ins_pass_date}}'
        else
            date = new Date();
        $('#ins_pass_date').daterangepicker({
            singleDatePicker: true,
            startDate: moment(date).format('DD/MM/YYYY'),
            showDropdowns: true,
            autoUpdateInput: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        }).on('changeDate', function(e) {
            var date = moment(e.date).format('DD/MM/YYYY');
            $(this).val(date);
        }).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $(this).trigger('change');
        });
        
        
</script>
@endpush
