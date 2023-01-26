@extends('layout.app')
@section('pageTitle','Transfer To Indent Show')
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
                                    <a href="{{route(currentUser().'.stocktransferind.edit',encryptor('encrypt',$data->id))}}" title="Back to Indent">
                                        <i class="bi bi-back"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Company: </span>{{$data->company->name}}
                                </div>
                            </div>
                            <div class="row">
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
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Transfer Date: </span>{{ $data->stock_date?\Carbon\Carbon::parse($data->stock_date)->format('d-M-y'):""}}
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 border-bottom">
                                    <span class="fw-bold">Production Date: </span>{{ $data->production_date?\Carbon\Carbon::parse($data->production_date)->format('d-M-y'):""}}
                                </div>
                            </div>
                           <?php print_r($data->id); ?>
                            <div class="row mt-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th>Product Name</th>
                                            <th>Warehouse</th>
                                            <th>Board No</th>
                                            <th width="100px">Unit</th>
                                            <th width="90px">Origin</th>
                                            <th width="90px">Price</th>
                                            <th width="90px">Qty</th>
                                            <th width="90px">Back Qty</th>
                                            <th width="90px">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $location=\Config::get('storedata.location'); @endphp
                                        @forelse($products as $d)
                                            <tr class="p-0">
                                                <td class="p-0">{{$d->product->name}}</td>
                                                <td class="p-0">{{$d->warehouse?->name}}</td>
                                                <td class="p-0">{{$d->warehouseboard?->board_no}}</td>
                                                <td class="p-0">{{$d->unitstyle?->name}}</td>
                                                <td class="p-0">{{$location[$d->location]}}</td>
                                                <td class="p-0">{{(float) $d->remarks}}</td>
                                                <td class="p-0">{{(float) \App\Models\Stock\ProductTransferIndentDetails::where('indent_id',$d->indent_id)->where('product_id',$d->product_id)->where('qty','>','0')->sum('qty')}}</td>
                                                <td class="p-0">{{abs((float) \App\Models\Stock\ProductTransferIndentDetails::where('indent_id',$d->indent_id)->where('product_id',$d->product_id)->where('qty','<','0')->sum('qty'))}}</td>
                                                <td class="p-0">{{$d->remarks}}</td>
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