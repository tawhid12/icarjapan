@extends('layout.app')

@section('pageTitle','Brand List')
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
                            <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.brand.create')}}"><i class="bi bi-pencil-square"></i></a>
                                <thead>
                                    <tr>
                                        <th scope="col">{{__('#SL')}}</th>
                                        <th scope="col">{{__('Name')}}</th>
                                        <th scope="col">{{__('Image')}}</th>
                                        <th scope="col">{{__('Status')}}</th>
                                        <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($brands as $b)
                                    <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                        <td>{{$b->name}}</td>
                                        <td><img src="{{asset('uploads/brands/'.$b->image)}}" alt="no-image"></td>
                                        <td>@if($b->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td>
                                        <td class="white-space-nowrap">
                                            <a href="{{route(currentUser().'.brand.edit',encryptor('encrypt',$b->id))}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <!-- <a href="javascript:void()" onclick="$('#form{{$b->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                            <form id="form{{$b->id}}" action="{{route(currentUser().'.brand.destroy',encryptor('encrypt',$b->id))}}" method="post">
                                                @csrf
                                                @method('delete')
                                                
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No Brand Found</th>
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

