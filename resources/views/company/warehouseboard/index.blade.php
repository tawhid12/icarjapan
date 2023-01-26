@extends('layout.app')
@section('pageTitle','Warehouse Board List')
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
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.warehouseboard.create')}}"><i class="bi bi-plus-square"></i> Add New</a>
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Company')}}</th>
                                    <th scope="col">{{__('Warehouse')}}</th>
                                    <th scope="col">{{__('Board Type')}}</th>
                                    <th scope="col">{{__('Board No')}}</th>
                                    <th scope="col">{{__('Capacity')}}</th>
                                    <th scope="col">{{__('Location')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($warehouseboards as $whb)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$whb->warehouse->company?->name}}</td>
                                    <td>{{$whb->warehouse?->name}}</td>
                                    <td>{{$whb->board_type}}</td>
                                    <td>{{$whb->board_no}}</td>
                                    <td>{{$whb->capacity}}</td>
                                    <td>{{$whb->location}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.warehouseboard.edit',encryptor('encrypt',$whb->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$whb->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a> -->
                                        <form id="form{{$whb->id}}" action="{{route(currentUser().'.warehouseboard.destroy',encryptor('encrypt',$whb->id))}}" method="post">
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
                            {{$warehouseboards->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

