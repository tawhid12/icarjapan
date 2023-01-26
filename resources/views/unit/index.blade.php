@extends('layout.app')
@section('pageTitle','Unit List')
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
                            <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.unit.create')}}"><i class="bi bi-pencil-square"></i></a>
                            <thead>
                                <tr>
                                    <th scope="col">#SL</th>
                                    <th scope="col">Name</th>
                                    <th class="white-space-nowrap">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($units as $u)
                                <tr>
                                <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$u->name}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.unit.edit',encryptor('encrypt',$u->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$u->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$u->id}}" action="{{route('unit.destroy',$u->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            
                                        </form> --}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="3" class="text-center">No Pruduct Found</th>
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


@endsection