@extends('layout.app')
@section('pageTitle','Bulk Client Transfer')
@section('pageSubTitle','List')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<!-- Bordered table start -->
<section class="section">

    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <form action="{{ route(currentUser().'.clTransfer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-4 row">
                            <label for="student_id" class="col-sm-3 col-form-label">Select Client</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-multiple form-control" id="user_id" name="user_id[]" multiple="multiple">
                                    <option value="">Select</option>
                                    @if(count($allUser) > 0)
                                    @foreach($allUser as $u)
                                    <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? "selected" : "" }}>ID | Name:-{{$u->id}}-{{$u->name}} | Country:-{{$u->country?->name}} | Port:-{{$u->port?->name}} | Contact:-{{$u->contact_no}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if($errors->has('user_id'))
                                <small class="d-block text-danger mb-3">
                                    {{ $errors->first('user_id') }}
                                </small>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 row frombatch"></div>

                        <div class="col-lg-4 row tobatch"></div>
                    </div>


                    <div class="form-group text-right my-2">
                        <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    /*===Student Enroll Batch Data=====*/
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: 'Select Option',
            allowClear: true
        });
        $('#user_id').on('change', function() {
            var user_id = $.trim($("#user_id").children("option:selected").val());
            $.ajax({
                url: "{{route(currentUser().'.clientExecutive')}}",
                method: 'GET',
                dataType: 'json',
                data: {
                    id: user_id
                },
                success: function(res) {
                    console.log(res);
                    $('.frombatch').html(res.data);
                    $('.tobatch').html(res.data2);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

    });
</script>

@if(Session::has('response'))
@php print_r(Session::has('response')); @endphp
<script>
    Command: toastr["{{Session::get('response')['class']}}"]("{{Session::get('response')['message']}}")
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
@endif
@endpush
