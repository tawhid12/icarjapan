@extends('layout.app')

@section('pageTitle','Sub Brand List')
@section('pageSubTitle','List')

@section('content')


<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <ul class="pagination justify-content-end">
                    <form action="{{route(currentUser().'.subBrand.index')}}" role="search" class="d-flex">
                        @csrf
                        <input type="text" placeholder="Search Sub Brand.." name="search" class="form-control">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </form>
                </ul>
                <!-- table bordered -->
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.subBrand.create')}}"><i class="bi bi-pencil-square"></i></a>
                        <thead>
                            <tr>
                                <th scope="col">{{__('#SL')}}</th>
                                <th scope="col">{{__('Name')}}</th>
                                <th scope="col">{{__('Image')}}</th>
                                <th scope="col">{{__('Brand')}}</th>
                                <th scope="col">{{__('Status')}}</th>
                                <th class="white-space-nowrap">{{__('ACTION')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sub_brands as $sb)
                            <tr>
                                <th scope="row">{{ ++$loop->index }}</th>
                                <td>{{$sb->name}}</td>
                                <td><img src="{{asset('uploads/sub_brands/'.$sb->image)}}" alt="no-image" width="40px" height="40px"></td>
                                <td>{{optional($sb->brand)->name}}</td>
                                <td>@if($sb->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td>
                                <td class="white-space-nowrap">
                                    <a href="{{route(currentUser().'.subBrand.edit',encryptor('encrypt',$sb->id))}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!-- <a href="javascript:void()" onclick="$('#form{{$sb->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                    <form id="form{{$sb->id}}" action="{{route(currentUser().'.subBrand.destroy',encryptor('encrypt',$sb->id))}}" method="post">
                                        @csrf
                                        @method('delete')

                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="4" class="text-center">No Sub Brand Found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {{ $sub_brands->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Bordered table end -->
</div>

@endsection