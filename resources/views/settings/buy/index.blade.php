@extends('layout.app')
@section('pageTitle',trans('Buy List'))
@section('pageSubTitle',trans('List'))

@section('content')

<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                @include('layout.message')
                <div>
                    <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.admin.create')}}"><i class="bi bi-pencil-square"></i></a>
                </div>
                <!-- table bordered -->
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col">{{__('#SL')}}</th>
                                <th scope="col">{{__('Vehicle')}}</th>
                                <th scope="col">{{__('Executive')}}</th>
                                <th scope="col">{{__('Note')}}</th>
                                <th scope="col">{{__('Image')}}</th>
                                <th scope="col">{{__('Status')}}</th>
                                <th class="white-space-nowrap">{{__('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($all_buy as $b)
                            <tr>
                                <th scope="row">{{ ++$loop->index }}</th>
                                <td>{{$b->vehicle_id}}</td>
                                <td>{{$b->executive_id}}</td>
                                <td>{{$b->note}}</td>
                                <td>@if($b->status == 1) {{__('Active') }} @else {{__('Inactive') }} @endif</td>
                                <td class="white-space-nowrap">

                                </td>
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