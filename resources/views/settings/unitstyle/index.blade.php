@extends('layout.app')
@section('pageTitle','Unit Style List')
@section('pageSubTitle','List')
@section('content')
    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div>
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.unitstyle.create')}}"><i class="bi bi-plus-square"></i> Add New</a>
                    </div>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                        
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($unitstyles as $data)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$data->name}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.unitstyle.edit',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$data->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a> -->
                                        <form id="form{{$data->id}}" action="{{route(currentUser().'.unitstyle.destroy',encryptor('encrypt',$data->id))}}" method="post">
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
                            {{$unitstyles->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

