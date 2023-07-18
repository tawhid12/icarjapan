@extends('layout.app')

@section('pageTitle','Edit Reserved Vehicle')
@section('pageSubTitle','Create')

@section('content')

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.reservevehicle.update',encryptor('encrypt',$resv->id))}}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$resv->id)}}">
                            <div class="row">
                                @if(currentUser() == 'superadmin')
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        
                                        <label for="name">Assign Sales Executive </label>
                                        <select class="form-control" name="assign_user_id">
                                            <option value="">Select Sales Executive</option>
                                            @if(count($users) > 0)
                                            @forelse($users as $u)
                                            <option value="{{$u->id}}">{{$u->name}}</option>
                                            @empty
                                            @endforelse
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                @endif
                                @if(currentUser() == 'salesexecutive')
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="name">Confirmed On</label>
                                        <input type="date" class="form-control" name="confirm_on" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Actual Price</label>
                                        <input type="text" class="form-control" value="{{optional($resv->vehicle)->price}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="name">Settle Price</label>
                                        <input type="text" class="form-control" name="settle_price" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="name">Satus</label>
                                        <select class="form-control" name="status" reuired>
                                            <option value="">Select Status</option>
                                            @if(currentUser() == 'superadmin')
                                            <option value="1" @if($resv->status == 1) selected @endif>Reserved</option>
                                            @endif
                                            <option value="2" @if($resv->status == 2) selected @endif>Confirmed</option>
                                            @if(currentUser() == 'superadmin')
                                            <option value="3" @if($resv->status == 3) selected @endif>Cencelled</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="name">Confirmation Note</label>
                                        <textarea class="form-control" name="note" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Basic multiple Column Form section end -->
</div>
@endsection