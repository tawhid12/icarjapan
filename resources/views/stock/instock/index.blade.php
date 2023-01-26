@extends('layout.app')
@section('pageTitle','Stock Receive List')
@section('pageSubTitle','Stock Receive List')
@section('content')
    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="float-end">
                        <a class="btn btn-sm btn-primary float-end ms-3" href="{{route(currentUser().'.stockin.create')}}"><i class="bi bi-plus-square"></i> Add New</a>
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.stockin.createexcel')}}"><i class="bi bi-file-excel"></i> Upload Excel</a>
                    </div>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Supplier')}}</th>
                                    <th scope="col">{{__('Company')}}</th>
                                    <th scope="col">{{__('Warehouse')}}</th>
                                    <th scope="col">{{__('Board No')}}</th>
                                    <th scope="col">{{__('Indent No')}}</th>
                                    <th scope="col">{{__('PO No')}}</th>
                                    <th scope="col">{{__('Product')}}</th>
                                    <th scope="col">{{__('Origin')}}</th>
                                    <th scope="col">{{__('Unit')}}</th>
                                    <th scope="col">{{__('Quantity ')}}</th>
                                    <th scope="col">{{__('Price')}}</th>
                                    <th scope="col">{{__('Prod Date')}}</th>
                                    <th scope="col">{{__('Remarks')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $location=Config::get('storedata.location'); @endphp
                                @forelse($pstockin as $data)
                                <tr>
                                    <td>{{$data->supplier?->sup_code}} - {{$data->supplier?->name}} ({{$data->supplier?->contact}})</td>
                                    <td>{{$data->company?->name}}</td>
                                    <td>{{$data->warehouse?->name}}</td>
                                    <td>{{$data->warehouseboard?->board_no}}</td>
                                    <td>{{$data->indent?->indent_no}}</td>
                                    <td>{{$data->purchase_order}}</td>
                                    <td>{{$data->product?->item_code}} - {{$data->product?->name}}</td>
                                    <td>{{$location[$data->location]}}</td>
                                    <td>{{$data->unitstyle?->name}}</td>
                                    <td>{{(float) $data->qty}}</td>
                                    <td>{{(float) $data->unit_price}}</td>
                                    <td>{{ $data->production_date?\Carbon\Carbon::parse($data->production_date)->format('d-M-y'):""}}</td>
                                    <td>{{$data->remarks}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.stockin.edit',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$data->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a> -->
                                        <form id="form{{$data->id}}" action="{{route(currentUser().'.product.destroy',encryptor('encrypt',$data->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>--}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="8" class="text-center">No Data Found</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pt-2">
                            {{$pstockin->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

