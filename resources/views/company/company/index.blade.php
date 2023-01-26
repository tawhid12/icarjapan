@extends('layout.app')
@section('pageTitle','Company List')
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
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.company.create')}}"><i class="bi bi-plus-square"></i> Add New</a>
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Contact')}}</th>
                                    <th scope="col">{{__('Email')}}</th>
                                    <th scope="col">{{__('Address')}}</th>
                                    <th scope="col">{{__('Location')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companies as $com)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$com->name}}</td>
                                    <td>{{$com->contact}}</td>
                                    <td>{{$com->email}}</td>
                                    <td>{{$com->address}}</td>
                                    <td>{{$com->location}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.company.edit',encryptor('encrypt',$com->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$com->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a> -->
                                        <form id="form{{$com->id}}" action="{{route(currentUser().'.company.destroy',encryptor('encrypt',$com->id))}}" method="post">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

