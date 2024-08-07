@extends('layout.app')
@section('pageTitle','Vehicle List')
@section('pageSubTitle','List')
@section('content')
<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <ul class="pagination justify-content-end">
                    <form action="{{route(currentUser().'.vehicle.index')}}" role="search" class="d-flex">
                        @csrf
                        <input type="text" placeholder="Search Vehicle.." name="search" class="form-control">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </form>
                </ul>
                <!-- table bordered -->
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.vehicle.create')}}"><i class="bi bi-plus-square"></i> Add New</a>
                        <thead>
                            <tr>
                                <th scope="col">{{__('#SL')}}</th>
                                <th scope="col">{{__('Vehicle Short Name')}}</th>
                                <th scope="col">{{__('Year')}}</th>
                                <th scope="col">{{__('Chasis No')}}</th>
                                {{--<th scope="col">{{__('Vehicle Long Name')}}</th>--}}
                                <th scope="col">{{__('Stock Id')}}</th>
                                <th scope="col">{{__('Brand')}}</th>
                                {{--<th scope="col">{{__('Model')}}</th>--}}
                                <th scope="col">{{__('Inventory Location')}}</th>
                                <th scope="col">{{__('Posted By')}}</th>
                                <th scope="col">{{__('Changed By')}}</th>
                                <th class="white-space-nowrap">{{__('ACTION')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vehicles as $v)
                            <tr>
                                <th scope="row">{{ ++$loop->index }}</th>
                                <td>{{$v->name}}</td>
                                <td>{{$v->manu_year}}</td>
                                <td>{{$v->chassis_no}}</td>
                                {{--<td>{{$v->fullName}}</td>--}}
                                <td>{{$v->stock_id}}</td>
                                <td>{{$v->brand->name}}</td>
                                {{--<td>{{optional($v->vehicle_model)->name}}</td>--}}
                                <td>{{optional($v->inv_loc)->name}}</td>
                                <td>{{optional($v->create_info)->name}}</td>
                                <td>{{optional($v->update_info)->name}}</td>
                                <td class="white-space-nowrap">
                                    <a href="{{route(currentUser().'.vehicle.show',encryptor('encrypt',$v->id))}}">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    @if(currentUser() == 'salesexecutive' && currentUserId() == $v->created_by)
                                    <a href="{{route(currentUser().'.vehicle.edit',encryptor('encrypt',$v->id))}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a class="btn btn-sm btn-info" href="{{route(currentUser().'.pGallery.show',encryptor('encrypt',$v->id))}}">Photo</a>
                                    @endif
                                    @if(currentUser() != 'salesexecutive' && $v->r_status == null && $v->sold_status==0)
                                    <a href="javascript:void()" onclick="$('#form{{$v->id}}').submit()">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <form id="form{{$v->id}}" action="{{route(currentUser().'.vehicle.destroy',encryptor('encrypt',$v->id))}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    @endif
                                    @if(currentUser() == 'superadmin')
                                    <a href="{{route(currentUser().'.vehicle.edit',encryptor('encrypt',$v->id))}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a class="" href="{{route(currentUser().'.pGallery.show',encryptor('encrypt',$v->id))}}"><i class="bi bi-upload"></i></a>
                                    @endif
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
                        {{$vehicles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Bordered table end -->
</div>

@endsection