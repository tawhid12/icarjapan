@extends('layout.app')
@section('pageTitle','Vehicle Model List')
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
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.vehicle_model.create')}}"><i class="bi bi-plus-square"></i> Add New</a>
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vehiclemodels as $vm)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$vm->name}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.vehicle_model.edit',encryptor('encrypt',$vm->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$vm->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a> -->
                                        <form id="form{{$vm->id}}" action="{{route(currentUser().'.vehicle_model.destroy',encryptor('encrypt',$vm->id))}}" method="post">
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
                            {{ $vehiclemodels->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

