@extends('layout.app')
@section('pageTitle','Indent Details List')
@section('pageSubTitle','List')
@section('content')
    <section class="section"><!-- Bordered table start -->
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="">
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.ind.createscreen')}}?indent_id={{$indent_id}}"><i class="bi bi-plus-square"></i> Add New</a>
                    </div>
                    <div class="table-responsive"><!-- table bordered -->
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Product Name')}}</th>
                                    <th scope="col">{{__('Unit')}}</th>
                                    <th scope="col">{{__('Quantity')}}</th>
                                    <th scope="col">{{__('Price')}}</th>
                                    <th scope="col">{{__('Weight')}}</th>
                                    <th scope="col">{{__('Description')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($psd as $index=>$data)
                                <tr>
                                    <th scope="row">{{++$index}}</th>
                                    <td>({{$data->product?->item_code}}) {{$data->product?->name}}</td>
                                    <td>{{$data->unitstyle?->name}}</td>
                                    <td>{{(float)$data->qty}}</td>
                                    <td>{{(float)$data->price}}</td>
                                    <td>{{$data->weight}}</td>
                                    <td>{{$data->description}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.indentdetails.edit',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="javascript:void()" onclick="$('#form{{$data->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$data->id}}" action="{{route(currentUser().'.indentdetails.destroy',encryptor('encrypt',$data->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="8" class="text-center">No Data Found</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

