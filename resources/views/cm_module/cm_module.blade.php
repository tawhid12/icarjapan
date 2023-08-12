@extends('layout.app')
@section('pageTitle',trans('CM MODULE'))
@section('pageSubTitle',trans('List'))
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                @include('layout.message')
                <div>
                    <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.client.create')}}"><i class="bi bi-pencil-square"></i></a>
                </div>
                <div class="col-md-12 text-center">
                    <h5>Client List</h5>
                </div>
                <form action="" method="" role="search">
                    @csrf
                    <div class="row my-2">
                        <div class="col-sm-2">
                            <label for="name" class="col-form-label"><strong>CM ID</strong></label>
                            <input type="text" class="form-control" name="userId" placeholder="Search By CM ID">
                        </div>
                        <div class="col-sm-2">
                            <label for="batch_id" class="col-form-label"><strong>Select Country</strong></label>
                            <select name="batch_id" class="js-example-basic-single form-control">
                                <option value="">Select</option>
                                @forelse($countries as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label for="sort_by" class="col-form-label"><strong>Sort By</strong></label>
                            <select class="js-example-basic-single form-control" id="sort_by" name="sort_by">
                                <option value="">Select</option>
                                <option value="1">ASC</option>
                                <option value="2">DESC</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="executiveId" class="col-form-label"><strong>Assigned Sales Executive</strong></label>
                            <select class="js-example-basic-single form-control" id="executiveId" name="executiveId">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label for="status" class="col-form-label"><strong>CM Status</strong></label>
                            <select class="js-example-basic-single form-control" id="status" name="status">
                                <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="2">Semi Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="name" class="col-form-label"><strong>CM ID Date</strong></label>
                            <div class="input-group">
                                <input type="text" name="created_at" class="form-control" placeholder="dd/mm/yyyy">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                </div>
                                <input type="text" name="created_at" class="form-control" placeholder="dd/mm/yyyy">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end my-1">
                            <button type="submit" class="btn btn-primary btn-sm me-1"><i class="bi bi-search"></i></button>
                            <a href="" class="reset-btn btn btn-warning btn-sm"><i class="bi bi-arrow-repeat"></i></a>
                        </div>
                    </div>

                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table text-center table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Stars')}}</th>
                                    <th scope="col">{{__('CM ID')}}</th>
                                    <th scope="col">{{__('CM Name')}}</th>
                                    <th scope="col">{{__('CM Country')}}</th>
                                    <th scope="col">{{__('Tlt Ship Ok')}}</th>
                                    <th scope="col">{{__('Tlt Release Ok')}}</th>
                                    <th scope="col">{{__('CM Status')}}</th>
                                    <th scope="col">{{__('Previsous Assigned Sales')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $cm)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>**</td>
                                    <td>{{$cm->id}}</td>
                                    <td>{{$cm->name}}</td>
                                    <td>{{$cm->country_id}}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>@if($cm->status ==1) <button class="btn btn-sm btn-primary">Active</button> @elseif($cm->status ==2) <button class="btn btn-sm btn-warning">In active</button> @else <button class="btn btn-sm btn-danger">Inactive</button> @endif</td>
                                    <td>
                                        @php $prev_assign = \DB::table('client_transfers')->where('user_id',$cm->id)->latest('id')->first(); @endphp
                                        @if($prev_assign)
                                        {{ \DB::table('users')->where('id',$prev_assign->curexId)->first()->name }}
                                        @else
                                        Free
                                        @endif
                                    </td>
                                    <td class="white-space-nowrap">
                                        <a target="blank" class="btn btn-sm btn-success"href="{{route(currentUser().'.client_individual',encryptor('encrypt',$cm->id))}}">
                                           CM Individual
                                        </a>
                                        <!-- <a href="{{route(currentUser().'.client.edit',encryptor('encrypt',$cm->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a> -->
                                        @if(currentUser() == 'superadmin')
                                        <a href="javascript:void()" onclick="$('#form{{$cm->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$cm->id}}" action="{{route(currentUser().'.client.destroy',encryptor('encrypt',$cm->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        @endif
                                    </td>

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
        $('.js-example-basic-single').select2();
        $("input[name='created_at']").daterangepicker({
            singleDatePicker: true,
            startDate: new Date(),
            showDropdowns: true,
            autoUpdateInput: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        }).on('apply.daterangepicker', function(e, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY'));
        });
    });
</script>
@endpush