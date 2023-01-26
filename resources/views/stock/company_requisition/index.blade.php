@extends('layout.app')
@section('pageTitle','C2C Requisition List')
@section('pageSubTitle','C2C Requisition List')
@section('content')
    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="float-end">
                        <a class="btn btn-sm btn-primary float-end ms-3" href="{{route(currentUser().'.c_to_c_transfer.create')}}"><i class="bi bi-plus-square"></i> Add New</a>
                    </div>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Company (From)')}}</th>
                                    <th scope="col">{{__('Company (To)')}}</th>
                                    <th scope="col">{{__('Quantity')}}</th>
                                    <th scope="col">{{__('Requisition Date')}}</th>
                                    <th scope="col">{{__('Slip No')}}</th>
                                    <th scope="col">{{__('Issue By')}}</th>
                                    <th scope="col">{{__('Received By')}}</th>
                                    <th scope="col">{{__('Delivary By')}}</th>
                                    <th scope="col">{{__('Remarks')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($requisitions as $data)
                                <tr>
                                    <td>{{$data->company?->name}}</td>
                                    <td>{{$data->companyTo?->name}}</td>
                                    <td>{{(float)$data->qty}}</td>
                                    <td>{{$data->creq_date?\Carbon\Carbon::parse($data->creq_date)->format('d-M-y'):""}}</td>
                                    <td>{{$data->slip_no}}</td>
                                    <td>{{$data->issue_by}}</td>
                                    <td>{{$data->received_by}}</td>
                                    <td>{{$data->delivary_by}}</td>
                                    <td>{{$data->remarks}}</td>
                                    <td>@if($data->status==2) Finish @elseif($data->status==1) Partial Accepted @else Pending @endif</td>
                                    <td class="white-space-nowrap">
                                        @if($data->status!=2)
                                        <a href="{{route(currentUser().'.c_to_c_transfer.edit',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="{{route(currentUser().'.req.accept_product',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-cart"></i>
                                        </a>--}}
                                        @endif
                                        <a href="{{route(currentUser().'.c_to_c_transfer.show',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$data->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$data->id}}" action="{{route(currentUser().'.product.destroy',encryptor('encrypt',$data->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>--}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="12" class="text-center">No Data Found</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pt-2">
                            {{$requisitions->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

