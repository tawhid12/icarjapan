@extends('layout.app')

@section('pageTitle',trans('Company Information'))
@section('pageSubTitle',trans('Update'))

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                @if(Session::has('response'))
                {!!Session::get('response')['message']!!}
                @endif
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6>My Company Information</h6>
                                <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.profile.store')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="c_name">Name <span class="text-danger">*</span></label>
                                                <input type="text" id="c_name" class="form-control" value="{{ old('userName',$com_acc_info->c_name)}}" name="c_name">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end mt-2">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Basic multiple Column Form section end -->
</div>
@endsection

@push('scripts')
<script>
    function showBranch(e) {
        $('#branch_id .branchs').hide();
        $('#branch_id .branchs' + e.value).show();
    }

    function hideCompany(e) {
        if (e == "1" || e == "2") {
            $('.company_row').hide();
        } else {
            $('.company_row').show();
        }
    }
    if ($('#role_id').val() == "1" || $('#role_id').val() == "2") {
        $('.company_row').hide();
    } else {
        $('.company_row').show();
    }
</script>
@endpush