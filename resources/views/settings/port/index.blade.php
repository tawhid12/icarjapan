@extends('layout.app')

@section('pageTitle','Port List')
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
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.port.create')}}"><i class="bi bi-pencil-square"></i></a>
                        <thead>
                            <tr>
                                <th scope="col">{{__('#SL')}}</th>
                                <th scope="col">{{__('Name')}}</th>
                                <th scope="col">{{__('Inventor Location')}}</th>
                                <th scope="col">{{__('Status')}}</th>
                                <th class="white-space-nowrap">{{__('ACTION')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ports as $p)
                            <tr>
                                <th scope="row">{{ ++$loop->index }}</th>
                                <td>{{$p->name}}</td>
                                <td>{{$p->inv_loc->name}}</td>
                                <td>@if($p->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td>
                                <td class="white-space-nowrap">
                                    <a href="{{route(currentUser().'.country.edit',encryptor('encrypt',$p->id))}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!-- <a href="javascript:void()" onclick="$('#form{{$p->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                    <form id="form{{$p->id}}" action="{{route(currentUser().'.country.destroy',encryptor('encrypt',$p->id))}}" method="post">
                                        @csrf
                                        @method('delete')

                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="4" class="text-center">No Port Found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {{ $ports->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Bordered table end -->
</div>

@endsection