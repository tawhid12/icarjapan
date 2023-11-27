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
                    @if(currentUser() != 'accountant')
                    <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.admin.create')}}"><i class="bi bi-pencil-square"></i></a>
                    @endif
                </div>
                <div class="col-md-12 text-center">
                    <h5>Client List</h5>
                </div>
                <form action="{{route(currentUser().'.all_client_list')}}" role="search" class="my-3">
                    @csrf
                    <div class="row my-2">
                        <div class="col-sm-2">
                            <label for="name" class="col-form-label"><strong>CM ID</strong></label>
                            <input type="text" class="form-control" name="userId" placeholder="Search By CM ID">
                        </div>
                        <div class="col-sm-2">
                            <label for="country_id" class="col-form-label"><strong>Select Country</strong></label>
                            <select name="country_id" class="js-example-basic-single form-control">
                                <option></option>
                                @forelse($countries as $c)
                                <option value="{{$c->id}}" @if(request()->get('country_id') == $c->id) selected @endif>{{$c->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label for="order_by" class="col-form-label"><strong>Order By</strong></label>
                            <select class="js-example-basic-single form-control" id="order_by" name="order_by">
                                <option></option>
                                <option value="asc" @if(request()->get('order_by') == 'asc') selected @endif>ASC</option>
                                <option value="desc" @if(request()->get('order_by') == 'desc') selected @endif>DESC</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label for="executiveId" class="col-form-label"><strong>Status</strong></label>
                            <select class="js-example-basic-single form-control" id="executiveId" name="executiveId">
                                <option></option>
                                <option value="1" @if(request()->get('executiveId') == 1) selected @endif>Free CM</option>
                                <option value="2" @if(request()->get('executiveId') == 2) selected @endif>Assigned CM</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label for="type" class="col-form-label"><strong>CM Status</strong></label>
                            <select class="js-example-basic-single form-control" id="type" name="type">
                                <option></option>
                                <option value="1" @if(request()->get('type') == 1) selected @endif>Active</option>
                                <option value="2" @if(request()->get('type') == 2) selected @endif>Semi Active</option>
                                <option value="3" @if(request()->get('type') == 3) selected @endif>Inactive</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label for="star" class="col-form-label"><strong>Stars **</strong></label>
                            <select class="js-example-basic-single form-control" id="star" name="star">
                                <option></option>
                                <option value="1" @if(request()->get('star') == 1) selected @endif>SP *</option>
                                <option value="2" @if(request()->get('star') == 2) selected @endif>Extra SP *</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="name" class="col-form-label"><strong>CM ID Date</strong></label>
                            <div class="input-group">
                                <input type="text" name="created_at" class="form-control" placeholder="dd/mm/yyyy">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <label for="perPage" class="col-form-label"><strong>Per Page</strong></label>
                            <select class="js-example-basic-single form-control" id="perPage" name="perPage">
                                <option></option>
                                <option value="50" @if(request()->get('perPage') == 50) selected @endif>50</option>
                                <option value="100" @if(request()->get('perPage') == 100) selected @endif>100</option>
                                <option value="200" @if(request()->get('perPage') == 200) selected @endif>200</option>
                                <option value="500" @if(request()->get('perPage') == 500) selected @endif>500</option>
                            </select>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end my-1">
                            <button type="submit" class="btn btn-primary btn-sm me-1"><i class="bi bi-search"></i></button>
                            <a href="{{route(currentUser().'.all_client_list')}}" class="reset-btn btn btn-warning btn-sm"><i class="bi bi-arrow-repeat"></i></a>
                        </div>
                    </div>
                </form>
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
                                <!-- <th scope="col">{{__('CM Status')}}</th> -->
                                <th scope="col">{{__('Previsous Assigned Sales')}}</th>
                                <th scope="col">{{__('Current Executive')}}</th>
                                <!-- <th class="white-space-nowrap">{{__('Action') }}</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $cm)
                            <tr>
                                <td scope="row">{{ (($users->currentPage() - 1) * $users->perPage()) + $loop->iteration }}</td>
                                <td>
                                    @if(currentUser() == 'salesexecutive')
                                    <form class="d-flex" action="{{route(currentUser().'.cm_type',encryptor('encrypt',$cm->id))}}" method="post">
                                        @csrf
                                        @method('patch')
                                        @endif
                                        <select class="form-control" name="cm_type">
                                            <option value="">Select</option>
                                            <option value="1" @if($cm->cmType == 1) selected @endif>SP(*)</option>
                                            <option value="2" @if($cm->cmType == 2) selected @endif>Extra Special(**)</option>
                                        </select>
                                        @if(currentUser() == 'salesexecutive')
                                        <button type="submit" class="ms-2 btn btn-sm btn-primary">Submit</button>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-success" href="{{route(currentUser().'.client_individual',encryptor('encrypt',$cm->id))}}">
                                        {{$cm->id}}<span class="mx-2 fs-4"><i class="bi bi-skip-forward-btn-fill"></i></span>
                                    </a>
                                </td>
                                <td class="bg-secondary">
                                    @if($cm->cm_category == 1)
                                    <span class="text-white fw-bold m-0 p-0">{{$cm->name}} | (Dealer)</span>
                                    @elseif($cm->cm_category == 2)
                                    <span class="text-white fw-bold m-0 p-0">{{$cm->name}} | (Individual)</span>
                                    @else
                                    <span class="text-white fw-bold m-0 p-0">{{$cm->name}} | (Broker)</span>
                                    @endif
                                </td>
                                <td>{{$cm->country?->name}}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <!-- 1 => Active Running Reserve 2 => Before active Order But Now no reserve 0 => for inactive no reserve -->
                                    @if($cm->type ==1)
                                    <button class="btn btn-sm btn-primary">Active</button>
                                    @elseif($cm->type ==2)
                                    <button class="btn btn-sm btn-warning">Semi Active</button>
                                    @elseif($cm->type ==3)
                                    <button class="btn btn-sm btn-danger">Inactive</button>
                                    @else
                                    <button class="btn btn-sm btn-secondary">Free</button>
                                    @endif
                                </td>
                                <!-- <td>
                                    @if($cm->status ==1)
                                    <button class="btn btn-sm btn-primary">Active</button>
                                    @else
                                    <button class="btn btn-sm btn-warning">Inactive</button>
                                    @endif
                                </td> -->
                                <td>
                                    @if ($cm->clientTransfers->isNotEmpty())
                                    @php $prev = $cm->clientTransfers->first(); @endphp
                                    {{$prev->prevExeutive?->name}}
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @if($cm->executiveId)
                                    {{$cm->executive?->name}}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="white-space-nowrap">
                                    {{--<a target="blank" class="btn btn-sm btn-success" href="{{route(currentUser().'.client_individual',encryptor('encrypt',$cm->id))}}">
                                    CM Individual
                                    </a>--}}
                                    @if(currentUser() != 'accountant')
                                    <!-- <a href="{{route(currentUser().'.admin.edit',encryptor('encrypt',$cm->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a> -->
                                    @endif
                                    @if(currentUser() == 'superadmin')
                                    {{--<a href="javascript:void()" onclick="$('#form{{$cm->id}}').submit()">
                                    <i class="bi bi-trash"></i>
                                    </a>
                                    <form id="form{{$cm->id}}" action="{{route(currentUser().'.admin.destroy',encryptor('encrypt',$cm->id))}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>--}}
                                    @endif
                                    @if(currentUser() == 'accountant')
                                    {{--<a target="blank" class="btn btn-sm btn-primary" href="{{route(currentUser().'.deposit.show',encryptor('encrypt',$cm->id))}}">
                                    Deposit
                                    </a>--}}
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
        $('.js-example-basic-single').select2({
            placeholder: 'Select Option',
            allowClear: true
        });

        $("input[name='created_at']").daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            autoUpdateInput: true,
            format: 'dd/mm/yyyy',
        }).on('changeDate', function(e) {
            var date = moment(e.date).format('YYYY/MM/DD');
            $(this).val(date);
        });
        // Set the input value to an empty string after initialization
        $("input[name='created_at']").val('');
    });
</script>


@endpush