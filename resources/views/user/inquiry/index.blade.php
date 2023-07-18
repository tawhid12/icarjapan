@extends('layout.landing')
@section('pageTitle',trans('Inquiry List'))
@section('pageSubTitle',trans('List'))

@section('content')
@include('layout.nav.user')
<!-- Bordered table start -->
<section class="section m-5">
    <div class="container">
        <div class="row" id="table-bordered" style="background-color: #eee">
            <div class="col-12">
                
                    @include('layout.message')
                    <!-- <div>
                    <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.inquiry.create')}}"><i class="bi bi-pencil-square"></i></a>
                </div> -->
                    <h4>All Inquiry</h4>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Inquiry')}}</th>
                                    <th scope="col">{{__('Country')}}</th>
                                    <th scope="col">{{__('City')}}</th>
                                    <th scope="col">{{__('email')}}</th>
                                    <th scope="col">{{__('Replied By')}}</th>
                                    <th scope="col">{{__('Reply')}}</th>
                                    <!-- <th scope="col">{{__('Status')}}</th> -->
                                    <!-- <th class="white-space-nowrap">{{__('Action') }}</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($all_in as $b)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$b->remarks}}</td>
                                    <td>{{optional($b->country)->name}}</td>
                                    <td>{{$b->city}}</td>
                                    <td>{{$b->email}}</td>
                                    <td>{{optional($b->user)->name}}</td>
                                    <td>{{$b->reply}}</td>
                                    <!-- <td>@if($b->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td> -->
                                    <!-- <td class="white-space-nowrap">
                                        @if(currentUser() == 'salesexecutive' || currentUser() == 'superadmin')
                                        <a href="{{route(currentUser().'.inquiry.edit',encryptor('encrypt',$b->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        @endif
                                    </td> -->
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="8" class="text-center">No Data Found</th>
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