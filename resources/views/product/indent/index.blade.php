@extends('layout.app')
@section('pageTitle','Indent List')
@section('pageSubTitle','List')
@section('content')
    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="row pb-1">
                        <div class="col-10">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="text" name="style_name" value="{{isset($_GET['style_name'])?$_GET['style_name']:''}}" placeholder="Style Name / Code" class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name="indent_no" value="{{isset($_GET['indent_no'])?$_GET['indent_no']:''}}" placeholder="Indent No" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control" name="buyer_id" id="buyer_id">
                                                <option value="">Select Buyer</option>
                                                @forelse($buyers as $data)
                                                    <option value="{{$data->id}}" {{ isset($_GET['buyer_id']) && $_GET['buyer_id']==$data->id?"selected":""}}> {{ $data->name}}</option>
                                                @empty
                                                    <option value="">No Buyer found</option>
                                                @endforelse
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-sm btn-info" type="submit">Search</button>
                                        <a class="btn btn-sm btn-warning" href="{{route(currentUser().'.indent.index')}}">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-2"><a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.indent.create')}}"><i class="bi bi-plus-square"></i> Add New</a></div>
                    </div>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Company')}}</th>
                                    <th scope="col">{{__('CSTMR')}}</th>
                                    <th scope="col">{{__('Product Style')}}</th>
                                    <th scope="col">{{__('Unit')}}</th>
                                    <th scope="col">{{__('Indent No')}}</th>
                                    <th scope="col">{{__('Quantity ')}}</th>
                                    <th scope="col">{{__('Weight')}}</th>
                                    <th scope="col">{{__('Price')}}</th>
                                    <th scope="col">{{__('Date')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $itemtype=array("","finish","Semi-Finished","Sub Material","Raw Material"); @endphp
                                @forelse($indents as $data)
                                <tr>
                                    <th scope="row">{{$data->id}}</th>
                                    <td>{{$data->company?->name}}</td>
                                    <td>{{$data->buyer?->buyer_code}} - {{$data->buyer?->name}}</td>
                                    <td>{{$data->productstyle?->item_code}} - {{$data->productstyle?->name}}</td>
                                    <td>{{$data->unitstyle?->name}}</td>
                                    <td>{{$data->indent_no}}</td>
                                    <td>{{round($data->qty,2)}}</td>
                                    <td>{{round($data->weight,2)}}</td>
                                    <td>{{round($data->unit_price,2)}}</td>
                                    <td>
                                        Order Date: {{ $data->order_date?\Carbon\Carbon::parse($data->order_date)->format('M,d-Y'):""}} <br>
                                        Production Start Date: {{ $data->start_date?\Carbon\Carbon::parse($data->start_date)->format('M,d-Y'):""}} <br>
                                        Production Finish Date: {{ $data->finish_date?\Carbon\Carbon::parse($data->finish_date)->format('M,d-Y'):""}} <br>
                                        Production Finish Date (Actual): {{ $data->actual_finish_date?\Carbon\Carbon::parse($data->actual_finish_date)->format('M,d-Y'):""}} <br>
                                    </td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.indent.edit',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="{{route(currentUser().'.indentdetails.index')}}?indent_id={{encryptor('encrypt',$data->id)}}">
                                            <i class="bi bi-list-ol"></i>
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
                            {{$indents->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

