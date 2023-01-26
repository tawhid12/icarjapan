@extends('layout.app')
@section('pageTitle','Product List')
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
                                        <input type="text" name="name" value="{{isset($_GET['name'])?$_GET['name']:''}}" placeholder="Product Name" class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" name="item_code" value="{{isset($_GET['item_code'])?$_GET['item_code']:''}}" placeholder="Product Code" class="form-control">
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            @php $itemtype=array("Select Product Type","finish","Semi-Finished","Sub Material","Raw Material"); @endphp
                                            <select  class="form-control" name="item_type" id="item_type">
                                                @foreach($itemtype as $k=>$data)
                                                    <option value="{{$k}}" {{ isset($_GET['item_type']) && $_GET['item_type']==$k?"selected":""}}> {{ $data}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <button class="btn btn-sm btn-info" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-2"><a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.product.create')}}"><i class="bi bi-plus-square"></i> Add New</a></div>
                    </div>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Code')}}</th>
                                    <th scope="col">{{__('Type')}}</th>
                                    <th scope="col">{{__('Category')}}</th>
                                    <th scope="col">{{__('Unit')}}</th>
                                    <th scope="col">{{__('Price')}}</th>
                                    <th scope="col">{{__('Color')}}</th>
                                    <th scope="col">{{__('Size')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $itemtype=array("","finish","Semi-Finished","Sub Material","Raw Material"); @endphp
                                @forelse($products as $data)
                                <tr>
                                    <th scope="row">{{$data->id}}</th>
                                    <td>{!!$data->name!!}</td>
                                    <td>{{$data->item_code}}</td>
                                    <td>{{$itemtype[$data->item_type]}}</td>
                                    <td>{{$data->category?->name}}</td>
                                    <td>{{$data->unitstyle?->name}}</td>
                                    <td>{{$data->unit_price}}</td>
                                    <td>{{$data->color}}</td>
                                    <td>{{$data->size}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.product.edit',encryptor('encrypt',$data->id))}}">
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
                            {{$products->withQueryString()->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

