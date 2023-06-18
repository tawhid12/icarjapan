@extends('layout.app')

@section('pageTitle','Country List')
@section('pageSubTitle','List')

@section('content')


    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                        <ul class="pagination justify-content-end">
                            <form action="{{route(currentUser().'.country.index')}}" role="search" class="d-flex">
                                @csrf
                                <input type="text" placeholder="Search Country.." name="search" class="form-control">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                            </form>
                        </ul>
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                            <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.country.create')}}"><i class="bi bi-pencil-square"></i></a>
                                <thead>
                                    <tr>
                                        <th scope="col">{{__('#SL')}}</th>
                                        <th scope="col">{{__('Name')}}</th>
                                        <th scope="col">{{__('Code')}}</th>
                                        <th scope="col">{{__('Affordable Range')}}</th>
                                        <th scope="col">{{__('High Grade Range')}}</th>
                                        <th scope="col">{{__('Inspection')}}</th>
                                        <th scope="col">{{__('Insurance')}}</th>
                                        <th scope="col">{{__('Image')}}</th>
                                        <th scope="col">{{__('Status')}}</th>
                                        <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($countries as $c)
                                    <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                        <td>{{$c->name}}</td>
                                        <td>{{$c->code}}</td>
                                        <td>{{$c->afford_range}}</td>
                                        <td>{{$c->high_grade_range}}</td>
                                        <td>{{$c->inspection}}</td>
                                        <td>{{$c->insurance}}</td>
                                        <td><img src="{{asset('uploads/country/'.$c->image)}}" alt="no-image"></td>
                                        <td>@if($c->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td>
                                        <td class="white-space-nowrap">
                                            <a href="{{route(currentUser().'.country.edit',encryptor('encrypt',$c->id))}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <!-- <a href="javascript:void()" onclick="$('#form{{$c->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                            <form id="form{{$c->id}}" action="{{route(currentUser().'.country.destroy',encryptor('encrypt',$c->id))}}" method="post">
                                                @csrf
                                                @method('delete')
                                                
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No Country Found</th>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="pt-2">
                            {{ $countries->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

