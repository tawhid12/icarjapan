@extends('layout.app')
@section('pageTitle','Vehicle Show')
@section('pageSubTitle','Show')
@section('content')
<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <!-- table bordered -->
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <a class="btn btn-sm btn-primary float-end" href="{{route(currentUser().'.vehicle.index')}}"><i class="bi bi-plus-square"></i> All Vehicle</a>
                        <tbody>
                            <th scope="col">{{__('Vehicle Name')}}</th>
                            <th>{{$v->name}}</th>
                        </tbody>
                    </table>
                </div>
            </div>
            <h5 class="mt-5">Vehicle Images</h5>
            <div class="row">
                @forelse($v_images as $v_img)
                <div class="col col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{asset('uploads/vehicle_images/'.$v_img->image)}}" alt="Card image cap">
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</section>
<!-- Bordered table end -->
</div>

@endsection