@extends('layout.app')
@section('pageTitle','Material Requisition Slip')
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
                                    <a href="{{route(currentUser().'.requisition.edit',encryptor('encrypt',$data->id))}}" title="Update">
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
                                    <span class="fw-bold">Company: </span>{{$data->company->name}}
                                </div>
                                <div class="col-md-3 offset-md-6 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Slip No: </span>{{$data->slip_no}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Indent No: </span>{{$data->indent->indent_no}}
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Style: </span>{{$data->productstyle->item_code}}
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Quantity: </span>{{(float) $data->qty}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Date: </span>{{$data->req_date}}
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Line NO: </span>{{$data->line_no}}
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
                                            <th rowspan="2" class="text-center p-0">#sl</th>
                                            <th rowspan="2" class="text-center p-0">Material</th>
                                            <th rowspan="2" class="text-center p-0">Spec</th>
                                            <th rowspan="2" class="text-center p-0">Code</th>
                                            <th rowspan="2" class="text-center p-0">Color</th>
                                            <th rowspan="2" class="text-center p-0">Unit</th>
                                            <th colspan="3" class="text-center p-0">Quantity</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center p-0">Required</th>
                                            <th class="text-center p-0">Received</th>
                                            <th class="text-center p-0">Short/Over</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($data->details as $d)
                                        <tr class="p-0">
                                            <td class="p-0">{{++$loop->index}}</td>
                                            <td class="p-0">{{$d->product->item_code}} - {{$d->product->name}}</td>
                                            <td class="p-0">{{$d->spec}}</td>
                                            <td class="p-0">{{$d->product->item_code}}</td>
                                            <td class="p-0">{{$d->color}}</td>
                                            <td class="p-0">{{$d->product?->unitstyle?->name}}</td>
                                            <td class="p-0">{{(float) $d->qty}}</td>
                                            <td class="p-0">{{(float) $d->del_qty}}</td>
                                            <td class="p-0">{{(float) ($d->qty - $d->del_qty)}}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center"> No Data Found</td>
                                        </tr>
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