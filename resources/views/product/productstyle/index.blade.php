@extends('layout.app')
@section('pageTitle','Product Style List')
@section('pageSubTitle','List')
@section('content')
    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="row pb-1">
                        <div class="col-12">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <input type="text" name="name" value="{{isset($_GET['name'])?$_GET['name']:''}}" placeholder="Style Name" class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name="item_code" value="{{isset($_GET['item_code'])?$_GET['item_code']:''}}" placeholder="Style Code" class="form-control">
                                    </div>
                                    <div class="col-md-3 col-12">
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
                                    <div class="col-sm-3">
                                        <button class="btn btn-sm btn-info" type="submit">Search</button>
                                        <a class="btn btn-sm btn-warning" href="{{route(currentUser().'.productstyle.index')}}">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--<div class="col-2"><a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.productstyle.create')}}"><i class="bi bi-plus-square"></i> Add New</a></div>--}}
                    </div>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Code')}}</th>
                                    <th scope="col">{{__('Size')}}</th>
                                    <th scope="col">{{__('Buyer')}}</th>
                                    <th scope="col">{{__('Unit')}}</th>
                                    <th scope="col">{{__('Price')}}</th>
                                    <th scope="col">{{__('Color')}}</th>
                                    <th scope="col">{{__('Description')}}</th>
                                    <th class="white-space-nowrap">{{__('Details')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($productstyles as $data)
                                <tr>
                                    <th scope="row">{{$data->id}}</th>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->item_code}}</td>
                                    <td>{{$data->size}}</td>
                                    <td>{{$data->buyer?->name}}</td>
                                    <td>{{$data->unitstyle?->name}}</td>
                                    <td>{{$data->unit_price}}</td>
                                    <td>{{$data->color}}</td>
                                    <td>{{$data->description}}</td>
                                    <td class="white-space-nowrap text-center">
                                        <a href="{{route(currentUser().'.productstyledetails.index')}}?styleid={{encryptor('encrypt',$data->id)}}">
                                            <i class="bi bi-list-ol"></i> 
                                        </a>
                                        {{-- <a href="{{route(currentUser().'.productstyle.edit',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="javascript:void()" onclick="$('#form{{$data->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$data->id}}" action="{{route(currentUser().'.productstyle.destroy',encryptor('encrypt',$data->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>--}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="10" class="text-center">No Data Found</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pt-2">
                            {{$productstyles->withQueryString()->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

