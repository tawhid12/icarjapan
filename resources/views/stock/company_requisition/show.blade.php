@extends('layout.app')
@section('pageTitle','C2C Requisition Slip')
@section('pageSubTitle','Slip')
@push('styles')
    <link rel="stylesheet" href="{{ asset('/assets/extensions/choices.js/public/assets/styles/choices.min.css') }}">
@endpush
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        @if($data->status!=2)
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{route(currentUser().'.c_to_c_transfer.edit',encryptor('encrypt',$data->id))}}" title="Update">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="{{route(currentUser().'.req.accept_product',encryptor('encrypt',$data->id))}}" title="Accept Requisition">
                                        <i class="bi bi-cart"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Company From: </span>{{$data->company->name}}
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Company To: </span>{{$data->companyTo->name}}
                                </div>
                                
                                <div class="col-md-3 offset-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Slip No: </span>{{$data->slip_no}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Quantity: </span>{{(float) $data->qty}}
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Date: </span>{{$data->req_date}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Issue By: </span>{{$data->issue_by}}
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Received By: </span>{{$data->received_by}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Delivary By: </span>{{$data->delivary_by}}
                                </div>
                                <div class="col-md-6 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Remarks: </span>{{$data->remarks_r}}
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Status: </span>@if($data->status==2) Finish @elseif($data->status==1) Partial Accepted @else Pending @endif
                                </div>
                            </div>
                            <div class="row mt-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Product Name</th>
                                            <th rowspan="2">Indent</th>
                                            <th rowspan="2">Warehouse</th>
                                            <th rowspan="2">Board No</th>
                                            <th rowspan="2" width="100px">Unit</th>
                                            <th rowspan="2" width="90px">Origin</th>
                                            <th rowspan="2" width="90px">Prod Date</th>
                                            <th rowspan="2" width="90px">Price</th>
                                            <th colspan="3" class="text-center">Quantity</th>
                                            <th rowspan="2" width="90px">Remarks</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center p-0">Req</th>
                                            <th class="text-center p-0">Rec</th>
                                            <th class="text-center p-0">Back</th>
                                        </tr>
                                    </thead>
                                    <tbody id="details_data">
                                        @php $location=\Config::get('storedata.location'); @endphp
                                        @forelse($detailsData as $d)
                                            @php /*$dsd=array_search($d->product_id  , array_column($detailsDataSort, 'product_id'));*/ @endphp
                                        <tr class="productlist">
                                            <td>
                                                {{$d->name}}
                                            </td>
                                            <td>{{$d->indent}}</td>
                                            <td>{{$d->warehouse}}</td>
                                            <td>{{$d->warehouse_board}}</td>
                                            <td>{{$d->unit_style}}</td>
                                            <td></td>
                                            <td>{{$d->production_date}}</td>
                                            <td>{{(float) $d->unit_price}}</td>
                                            <td>{{(float) $d->qty}}</td>
                                            <td>{{(float) $d->del_qty}}</td>
                                            <td>{{(float) ($d->back_qty)}}</td>
                                            <td>{{$d->remarks}}</td>
                                            <td></td>
                                        </tr>
                                        @empty
                                        
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection