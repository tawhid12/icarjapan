@extends('layout.app')
@section('pageTitle','Product Style Details List')
@section('pageSubTitle','List')
@section('content')
    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="">
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.productstyledetails.create')}}?styleid={{$style_id}}"><i class="bi bi-plus-square"></i> Add New</a>
                    </div>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Product Name')}}</th>
                                    <th scope="col">{{__('Unit')}}</th>
                                    <th scope="col">{{__('Quantity')}}</th>
                                    <th scope="col">{{__('Weight')}}</th>
                                    <th scope="col">{{__('Description')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($psd as $data)
                                <tr>
                                    <th scope="row">{{$data->id}}</th>
                                    <td>{{$data->product?->name}}</td>
                                    <td>{{$data->unitstyle?->name}}</td>
                                    <td>{{$data->qty}}</td>
                                    <td>{{$data->weight}}</td>
                                    <td>{{$data->description}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.productstyledetails.edit',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="javascript:void()" onclick="$('#form{{$data->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$data->id}}" action="{{route(currentUser().'.productstyledetails.destroy',encryptor('encrypt',$data->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="7" class="text-center">No Data Found</th>
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

