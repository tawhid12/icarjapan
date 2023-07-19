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
                        <table class="table table-sm table-bordered mb-0">
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.clientTransfer')}}"><i class="bi bi-plus-square"></i> Add New</a>
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>From Executive Id</th>
                                    <th>to Executive Id</th>
                                    <th>Note</th>
                                    <th>Transferred By</th>
                                    <th>Created On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($client_transfers as $transfer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$transfer->user_id}}</td>
                                    <td>{{$transfer->uname}}</td>
                                    <td>{{\DB::table('users')->where('id',$transfer->curexId)->first()->name}}</td>
                                    <td>{{\DB::table('users')->where('id',$transfer->newexId)->first()->name}}</td>
                                    <td>{{$transfer->note}}</td>
                                    <td>{{$transfer->uname}}</td>
                                    <td>{{$transfer->created_at}}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>


</section>

@endsection