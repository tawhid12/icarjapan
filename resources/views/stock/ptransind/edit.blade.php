@extends('layout.app')
@section('pageTitle','Transfer To Indent Show')
@section('pageSubTitle','Slip')
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        @if($data->status!=2)
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{route(currentUser().'.stocktransferind.show',encryptor('encrypt',$data->id))}}" title="Back to Show Screen">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        <form class="form" method="post" action="{{route(currentUser().'.stocktransferind.update',encryptor('encrypt',$data->id))}}">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                        <span class="fw-bold">Company: </span>{{$data->company->name}}
                                    </div>
                                
                                    <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                        <span class="fw-bold">Indent From: </span>{{$data->indent->indent_no}}
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                        <span class="fw-bold">Indent To: </span>{{$data->indentTo->indent_no}}
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                        <span class="fw-bold">Quantity: </span>{{(float) $data->qty}}
                                    </div>
                                </div>
                                
                                <div class="row">
                                
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="stock_date">Transfer Date</label>
                                            <input type="date" id="stock_date" class="form-control" name="stock_date">
                                        </div>
                                        @if($errors->has('stock_date'))
                                            <span class="text-danger"> {{ $errors->first('stock_date') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="production_date">Production Date</label>
                                            <input type="date" id="production_date" class="form-control" name="production_date">
                                        </div>
                                        @if($errors->has('production_date'))
                                            <span class="text-danger"> {{ $errors->first('production_date') }}</span>
                                        @endif
                                    </div>
                                </div>
                                    
                                
                                <div class="row mt-2">
                                    <table class="table table-bordered">
                                        <table class="table mb-2">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>Product Name</th>
                                                    <th>Warehouse</th>
                                                    <th>Board No</th>
                                                    <th width="100px">Unit</th>
                                                    <th width="90px">Origin</th>
                                                    <th width="90px">Prod Date</th>
                                                    <th width="90px">Price</th>
                                                    <th width="90px">Qty</th>
                                                    <th width="90px">Remarks</th>
                                                    <th><input onchange="checkall(this)" type="checkbox" id="check_all" value="1"></th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            {!! $details['data'] !!}
                                        </tbody>
                                    </table>
                                </div>
                                    
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1 btn-sm">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection