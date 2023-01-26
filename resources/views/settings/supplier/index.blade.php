@extends('layout.app')
@section('pageTitle','Supplier List')
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
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.supplier.create')}}"><i class="bi bi-plus-square"></i> Add New</a>
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Code')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Contact')}}</th>
                                    <th scope="col">{{__('Email')}}</th>
                                    <th scope="col">{{__('Country')}}</th>
                                    <th scope="col">{{__('City')}}</th>
                                    <th scope="col">{{__('Address')}}</th>
                                    <th scope="col">{{__('Location')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $location=Config::get('storedata.location'); @endphp
                                @forelse($suppliers as $data)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$data->sup_code}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->contact}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->country}}</td>
                                    <td>{{$data->city}}</td>
                                    <td>{{$data->address}}</td>
                                    <td>{{$location[$data->location]}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.supplier.edit',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$data->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a> -->
                                        <form id="form{{$data->id}}" action="{{route(currentUser().'.supplier.destroy',encryptor('encrypt',$data->id))}}" method="post">
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
                            {{$suppliers->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

