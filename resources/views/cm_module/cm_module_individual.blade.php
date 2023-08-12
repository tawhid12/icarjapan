@extends('layout.app')
@section('pageTitle',trans('Cm Module'))
@section('pageSubTitle',trans('Cm Module'))
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<!-- Bordered table start -->
<section class="section">
    <div class="col-12">
        <div class="card">
            @include('layout.message')
            <div class="table-responsive">
                <table class="table text-center table-bordered mb-0">
                    <thead>
                        <tr>
                            <th scope="col">{{__('Customer Module')}}</th>
                            <th scope="col">{{__('Stock Rate')}}</th>
                            <th scope="col">{{__('$')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">{{__('CM ID')}} :- 1</th>
                            <th scope="col" colspan="2">{{__('CM Name')}} :- Md Tawhidul Alam</th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="container mt-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="basic-info-tab" data-bs-toggle="tab" href="#basic_info" role="tab" aria-controls="basic_info" aria-selected="true">Basic Info</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-history-tab" data-bs-toggle="tab" href="#contact_history" role="tab" aria-controls="contact_history">Contact History</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="purchase-history-tab" data-bs-toggle="tab" href="#purchase_history" role="tab" aria-controls="purchase_history">Purchase History</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="courier-tab" data-bs-toggle="tab" href="#courier" role="tab" aria-controls="courier">C'nee & courier</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profoma-invoice-tab" data-bs-toggle="tab" href="#profoma_inovice" role="tab" aria-controls="profoma_inovice">Profoma Invoice</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="final-invoice-tab" data-bs-toggle="tab" href="#final_inovice" role="tab" aria-controls="final_inovice">Final Invoice</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="reserve-units-tab" data-bs-toggle="tab" href="#reserve_units" role="tab" aria-controls="reserve_units">Reserved Units</a>
                    </li>
                </ul>

                <div class="tab-content text-muted" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic_info" role="tabpanel" aria-labelledby="baisc-info-tab">
                        <div class="table-responsive my-3">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">{{__('Customer Type')}}</th>
                                        <td>Individual</td>
                                        <th rowspan="2" scope="col">{{__('Sales Rank')}}</th>
                                        <td rowspan="2">N</td>
                                        <th scope="col">{{__('ShipOK cars')}}</th>
                                        <td>0</td>
                                        <th scope="col">{{__('Catagory')}}</th>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">{{__('Customer Name')}}</th>
                                        <td>Md . Tawhidul Alam</td>
                                        <th scope="col">{{__('ReleaseOK Cars')}}</th>
                                        <td>0</td>
                                        <th rowspan="3" scope="col">{{__('Sales Note')}}</th>
                                        <td rowspan="3">-</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">{{__('Country')}}</th>
                                        <td>Bangladesh</td>
                                        <th rowspan="2" scope="col">{{__('Port')}}</th>
                                        <td rowspan="2">Nakulfa</td>
                                        <th scope="col">{{__('CM Reserve Cras')}}</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">{{__('Division')}}</th>
                                        <td>Chittagong</td>
                                        <th scope="col">{{__('Cancel Cars')}}</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th rowspan="4" scope="col">{{__('Address')}}</th>
                                        <td rowspan="4" colspan="3">Bahadarhat</td>
                                        <th rowspan="3" scope="col">{{__('Delay Payment Cars')}}</th>
                                        <td rowspan="3">0</td>
                                        <th rowspan="3" scope="col">{{__('Why not buy')}}</th>
                                        <td rowspan="3">-</td>
                                    </tr>
                                    <tr height="50px"></tr>
                                    <tr height="50px"></tr>
                                    <tr>
                                        <th scope="col">{{__('Deal Status')}}</th>
                                        <td>-</td>
                                        <th rowspan="3" scope="col">{{__('How can he buy again')}}</th>
                                        <td rowspan="3">-</td>
                                    </tr>
                                    <tr>
                                        <th rowspan="4" scope="col">{{__('Language')}}</th>
                                        <td rowspan="4">English</td>
                                        <th scope="col">{{__('Currency')}}</th>
                                        <td>$</td>
                                        <th scope="col">{{__('Watch CM')}}</th>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <th rowspan="3" scope="col">{{__('Deposit Radio')}}</th>
                                        <td rowspan="3">%</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">SP *</td>
                                        <td rowspan="2">CM **</td>
                                        <td colspan="2">Update User</td>
                                    </tr>
                                    <tr>
                                        <td>Md Tawhidul Alam</td>
                                        <td>Update Date</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="contact_history" role="tabpanel" aria-labelledby="contact-history-tab">
                        <p><strong>Contact History</strong></p>
                    </div>

                    <div class="tab-pane fade" id="purchase_history" role="tabpanel" aria-labelledby="purchase-history-tab">
                        <p><strong>Purchase History</strong></p>
                    </div>

                    <div class="tab-pane fade" id="courier" role="tabpanel" aria-labelledby="courier-tab">
                        <p><strong>C'nee & courier</strong></p>
                    </div>

                    <div class="tab-pane fade" id="profoma_inovice" role="tabpanel" aria-labelledby="profoma-invoice-tab">
                        <p><strong>Profoma Invoice</strong></p>
                    </div>

                    <div class="tab-pane fade" id="final_inovice" role="tabpanel" aria-labelledby="final-invoice-tab">
                        <p><strong>Final Invoice</strong></p>
                    </div>

                    <div class="tab-pane fade" id="reserve_units" role="tabpanel" aria-labelledby="reserve-units-tab">
                        <p><strong>Reserved Units</strong></p>
                    </div>

                </div>

            </div>
</section>
<!-- Bordered table end -->


@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $("input[name='created_at']").daterangepicker({
            singleDatePicker: true,
            startDate: new Date(),
            showDropdowns: true,
            autoUpdateInput: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        }).on('apply.daterangepicker', function(e, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY'));
        });
    });
</script>
@endpush