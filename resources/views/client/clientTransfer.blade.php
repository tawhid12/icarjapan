@extends('layout.app')
@section('pageTitle','New Client Transfer')
@section('pageSubTitle','List')
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
                            <label for="student_id" class="col-sm-3 col-form-label">Select User</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="user_id">
                                    <option value="">Select</option>
                                    @if(count($allUser) > 0)
                                    @foreach($allUser as $u)
                                    <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? "selected" : "" }}>{{$u->id}}-{{$u->name}}</option>
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

                    <div class="col-lg-12">
                        <label for="note" class="col-sm-2 col-form-label">Note</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="operationNote" name="note" rows="5" placeholder="Note" style="
                                    resize:none;"></textarea>
                        </div>
                    </div>
                    <div class="form-group text-right mb-0">
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
<script src="{{asset('backend/libs/multiselect/jquery.multi-select.js')}}"></script>
<script src="{{asset('backend/libs/select2/select2.min.js')}}"></script>
<script>
    /*===Student Enroll Batch Data=====*/
    $(document).ready(function() {
        $('select[name=user_id]').on('change', function() {
            var user_id = $.trim($("select[name=user_id]").children("option:selected").val());
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