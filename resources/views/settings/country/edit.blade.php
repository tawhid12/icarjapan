@extends('layout.app')

@section('pageTitle','Edit Country')
@section('pageSubTitle','Create')

@section('content')

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.country.update',encryptor('encrypt',$c->id))}}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$c->id)}}">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" value="{{ $c->name }}" class="form-control" placeholder="Country Name" name="name">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="name">Code</label>
                                        <input type="text" id="code" value="{{ $c->code }}" class="form-control" placeholder="Country Code" name="code">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="name">Affordable Range</label>
                                        <input type="text" id="afford_range" value="{{ $c->afford_range }}" class="form-control" placeholder="Affordable Range" name="afford_range">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="name">High Grade Range</label>
                                        <input type="text" id="high_grade_range" value="{{ $c->high_grade_range }}" class="form-control" placeholder="High Grade Range" name="high_grade_range">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="name">Inspection</label>
                                        <input type="text" id="inspection"  value="{{ $c->inspection }}" class="form-control" placeholder="Inspection" name="inspection">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="name">Insurance</label>
                                        <input type="text" id="insurance"  value="{{ $c->insurance }}" class="form-control" placeholder="Insurance" name="insurance">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" id="image" class="form-control" placeholder="Image" name="image">
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <img width="50px" height="30px" class="float-first m-2" src="{{asset('uploads/country/'.$c->image)}}" alt="">
                                    <button type="submit" class="btn btn-primary mb-1">Save</button>
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