@extends('layout.app')
@section('pageTitle','Warehouse List')
@section('pageSubTitle','List')
@section('content')
    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.warehouse.create')}}"><i class="bi bi-plus-square"></i> Add New</a>
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Company')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Contact')}}</th>
                                    <th scope="col">{{__('Email')}}</th>
                                    <th scope="col">{{__('Address')}}</th>
                                    <th scope="col">{{__('Location')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($warehouses as $whouse)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$whouse->company?->name}}</td>
                                    <td>{{$whouse->name}}</td>
                                    <td>{{$whouse->contact}}</td>
                                    <td>{{$whouse->email}}</td>
                                    <td>{{$whouse->address}}</td>
                                    <td>{{$whouse->location}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.warehouse.edit',encryptor('encrypt',$whouse->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$whouse->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a> -->
                                        <form id="form{{$whouse->id}}" action="{{route(currentUser().'.warehouse.destroy',encryptor('encrypt',$whouse->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>--}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="4" class="text-center">No Data Found</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pt-2">
                            {{$warehouses->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

