@extends('layout.app')
@section('pageTitle',trans('Users List'))
@section('pageSubTitle',trans('List'))
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

<!-- Bordered table start -->
<section class="section">


    <div class="card">
        @include('layout.message')
        <div>
            @if(currentUser() != 'accountant')
            <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.admin.create')}}"><i class="bi bi-pencil-square"></i></a>
            @endif
        </div>

        <form action="{{route(currentUser().'.admin.index')}}" role="search" class="my-3">
            @csrf
            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="name">Search</label>
                        <input type="text" class="form-control" placeholder="Search User.." name="search">
                    </div>
                </div>
                <div class="col-md-2 col-12">
                    <div class="form-group">
                        <label for="role_id">Select Role</label>
                        <select name="role_id" class="js-example-basic-single form-control">
                            <option></option>
                            @forelse($roles as $role)
                            <option value="{{$role->id}}" @if(request()->get('role_id') == $role->id) selected @endif>{{$role->type}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-12">
                    <div class="form-group">
                        <label for="country_id">Select Country</label>
                        <select name="country_id" class="js-example-basic-single form-control">
                            <option></option>
                            @forelse($countries as $c)
                            <option value="{{$c->id}}" @if(request()->get('country_id') == $c->id) selected @endif>{{$c->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-12">
                    <div class="form-group">
                        <label for="order_by">Order By</label>
                        <select name="order_by" class="js-example-basic-single form-control">
                            <option></option>
                            <option value="asc" @if(request()->get('order_by') == 'asc') selected @endif>Ascending</option>
                            <option value="desc" @if(request()->get('order_by') == 'desc') selected @endif>Dscending</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 d-flex justify-content-end my-1">
                    <button type="submit" class="btn btn-sm btn-primary me-1"><i class="bi bi-search"></i></button>
                    <a href="{{route(currentUser().'.admin.index')}}" class="reset-btn btn btn-sm btn-warning"><i class="bi bi-arrow-repeat"></i></a>
                </div>
            </div>
        </form>
        <div class="row" id="table-bordered">
            <div class="col-md-12">
                <!-- table bordered -->
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col">{{__('#SL')}}</th>
                                <th scope="col">{{__('Name')}}</th>
                                <th scope="col">{{__('Country')}}</th>
                                <th scope="col">{{__('Email')}}</th>
                                <th scope="col">{{__('Contact')}}</th>
                                <th scope="col">{{__('Image')}}</th>
                                <th scope="col">{{__('Role')}}</th>
                                <th scope="col">{{__('Executive')}}</th>
                                <th scope="col">{{__('Status')}}</th>
                                <th class="white-space-nowrap">{{__('Action') }}</th>
                                @if(currentUser() == 'superadmin')
                                <th>Login As</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $p)
                            <tr>
                                <th scope="row">{{ ++$loop->index }}</th>
                                <td>{{$p->name}}</td>
                                <td>{{$p->country?->name}}</td>
                                <td>{{$p->email}}</td>
                                <td>{{$p->contact_no}}</td>
                                <td><img width="50px" src="{{asset('uploads/admin/'.$p->image)}}" alt=""></td>
                                <td>{{$p->role?->identity}}</td>
                                <td>{{$p->executive?->name}}</td>
                                <td>@if($p->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td>
                                <td class="white-space-nowrap">
                                    @if(currentUser() == 'superadmin')
                                    <a href="{{route(currentUser().'.admin.edit',encryptor('encrypt',$p->id))}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    @else
                                    @if(currentUser() != 'accountant')
                                    <a href="{{route(currentUser().'.admin.edit',encryptor('encrypt',$p->id))}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    @endif
                                    @endif
                                    @if(currentUser() == 'superadmin')
                                    <a href="javascript:void()" onclick="$('#form{{$p->id}}').submit()">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <form id="form{{$p->id}}" action="{{route(currentUser().'.admin.destroy',encryptor('encrypt',$p->id))}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    @endif
                                </td>
                                @if(currentUser() == 'superadmin')
                                <td>
                                    <a href="{{route(currentUser().'.secretLogin',$p->id)}}" class="btn btn-sm btn-success">Login As {{$p->name}}</a>
                                </td>
                                @endif

                            </tr>
                            @empty
                            <tr>
                                <th colspan="8" class="text-center">No Data Found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Bordered table end -->


@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: 'Select Option',
            allowClear: true
        });
        $('.reset-btn').on('click', function() {
            $('.js-example-basic-single').val(null).trigger('change');
        });
    });
</script>
@endpush