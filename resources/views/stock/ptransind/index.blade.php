@extends('layout.app')
@section('pageTitle','Transfer To Indent List')
@section('pageSubTitle','Transfer To Indent List')
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
                                        <input type="text" name="indent_id" value="{{isset($_GET['indent_id'])?$_GET['indent_id']:''}}" placeholder="{{__('Indent No (From)')}}" class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" name="indent_to_id" value="{{isset($_GET['indent_to_id'])?$_GET['indent_to_id']:''}}" placeholder="{{__('Indent No (To)')}}" class="form-control">
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <button class="btn btn-sm btn-info" type="submit">Search</button>
                                        <a class="btn btn-sm btn-warning" href="{{route(currentUser().'.stocktransferind.index')}}">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-2">
                            <a class="btn btn-sm btn-primary float-end ms-3" href="{{route(currentUser().'.stocktransferind.create')}}"><i class="bi bi-plus-square"></i> Add New</a>
                        </div>
                    </div>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Company')}}</th>
                                    <th scope="col">{{__('Indent No (From)')}}</th>
                                    <th scope="col">{{__('Indent No (To)')}}</th>
                                    <th scope="col">{{__('Quantity ')}}</th>
                                    <th scope="col">{{__('Transfer Date')}}</th>
                                    <th scope="col">{{__('Prod Date')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $location=Config::get('storedata.location'); @endphp
                                @forelse($ptransfer_indents as $data)
                                <tr>
                                    <td>{{$data->company?->name}}</td>
                                    <td>{{$data->indent?->indent_no}}</td>
                                    <td>{{$data->indentTo?->indent_no}}</td>
                                    <td>{{(float) $data->qty}}</td>
                                    <td>{{ $data->stock_date?\Carbon\Carbon::parse($data->stock_date)->format('d-M-y'):""}}</td>
                                    <td>{{ $data->production_date?\Carbon\Carbon::parse($data->production_date)->format('d-M-y'):""}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.stocktransferind.show',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$data->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a> -->
                                        <form id="form{{$data->id}}" action="{{route(currentUser().'.stockout.destroy',encryptor('encrypt',$data->id))}}" method="post">
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
                            {{$ptransfer_indents->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

