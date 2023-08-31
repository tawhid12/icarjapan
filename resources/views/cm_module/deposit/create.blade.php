@extends('layout.app')

@section('pageTitle','Make Deposit')
@section('pageSubTitle','Deposit')

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.deposit.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <p class="m-0"><strong>Customer Name : {{$user->name}} <br> Customer ID :{{$user->id}}</strong></p>
                                </div>
                                <div class="col-md-3 col-12">
                                    <p class="m-0"><strong>Total Deopist : {{\DB::table('deposits')->where('client_id',$user->id)->sum('deposit_amt')}}</strong></p>
                                </div>
                                <hr>
                                <input type="hidden" value="{{$user->id}}" name="client_id">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="deposit_type">Type</label>
                                        <select name="deposit_type" class="form-control">
                                            <!-- <option value="">Select</option> -->
                                            <option value="1" selected>Regular</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="currency_type">Currency</label>
                                        <select name="currency_type" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1" selected>USD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="deposit_date">Receive Date</label>
                                        <input type="text" id="deposit_date" class="form-control" name="deposit_date">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="deposit_amt">Amount</label>
                                        <input type="text" id="deposit_amt" class="form-control" placeholder="Amount" name="deposit_amt" required>
                                    </div>
                                </div>
                                {{--value="optional($invoice->res_vehicle)->settle_price"--}}
                                <!-- <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="allocated">Allocated</label>
                                        <input type="text" id="allocated" class="form-control" placeholder="Allocated" name="allocated">
                                    </div>
                                </div> -->
                            </div>
                            <div class="row my-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Deposit</button>
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
    $("input[name='deposit_date']").daterangepicker({
        singleDatePicker: true,
        startDate: new Date(),
        showDropdowns: true,
        autoUpdateInput: true,
        format: 'dd/mm/yyyy',
    }).on('changeDate', function(e) {
        var date = moment(e.date).format('YYYY/MM/DD');
        $(this).val(date);
    });
</script>
@endpush