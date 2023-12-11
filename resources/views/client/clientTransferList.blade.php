@extends('layout.app')
@section('pageTitle','Client Transfer List')
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
                        <a class="btn btn-sm btn-primary float-end my-2" href="{{route(currentUser().'.clientTransfer')}}"><i class="bi bi-plus-square"></i> Add New</a>
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>CM Detail</th>
                                <th>From Executive Id</th>
                                <th>To Executive Id</th>
                                <th>Transferred By</th>
                                <th>Note</th>
                                <th>Created On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($client_transfers as $transfer)
                            <tr>
                                <td scope="row">{{ (($client_transfers->currentPage() - 1) * $client_transfers->perPage()) + $loop->iteration }}</td>
                                <td>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th><td>{{$transfer->user?->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th><td>{{$transfer->user?->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact</th><td>{{$transfer->user?->contact_no}}</td>
                                        </tr>
                                        <tr>
                                            <th>Country</th><td>{{$transfer->user?->country?->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Port</th><td>{{$transfer->user?->port?->name}}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td>{{$transfer->prevExeutive?->name}}</td>
                                <td>{{$transfer->newexecutiveId?->name}}</td>
                                <td>{{$transfer->posted_by?->name}}</td>

                                <td>-</td>
                                <td>{{$transfer->created_at}}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {{$client_transfers->links()}}
                    </div>
                </div>
            </div>


        </div>

    </div>


</section>

@endsection
