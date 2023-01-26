@extends('layout.app')
@section('pageTitle','Create Indent Details')
@section('pageSubTitle','Create')
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.indentdetails.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="fs-4 text-center">
                                            {{$ps->productstyle?->style_code}} - {{$ps->productstyle?->name}}
                                            <b class="fs-5 text-center">
                                                ({{$ps->indent_no}})
                                            </b>
                                        </div>
                                        <input type="hidden" name="product_style_id" value="{{$ps->id}}">
                                    </div>
                                    <div class="col-8 offset-2 py-5">
                                        <div class="row">
                                            <div class="col-6 col-sm-4 offset-sm-2">
                                                <a class="btn btn-sm py-5 px-4 btn-primary fs-5" href="{{route(currentUser().'.ind.up_excel')}}?indent_id={{encryptor('encrypt',$ps->id)}}"><i class="bi bi-file-excel"></i> Upload Excel file</a>
                                            </div>
                                            <div class="col-6 col-sm-4">
                                                <a class="btn btn-sm py-5 px-4 btn-primary fs-5" href="{{route(currentUser().'.indentdetails.create')}}?indent_id={{encryptor('encrypt',$ps->id)}}"><i class="bi bi-plus-square"></i> Add Manually</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection