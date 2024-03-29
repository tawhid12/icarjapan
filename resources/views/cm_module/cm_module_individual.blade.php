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
                            <th scope="col">{{__('CM ID')}} :- {{$client_data->id}}</th>
                            <th scope="col" colspan="2">{{__('CM Name')}} :- {{$client_data->name}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="container mt-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="basic-info-tab" data-bs-toggle="tab" href="#basic_info" role="tab" aria-controls="basic_info" aria-selected="true">Basic Info</a>
                    </li>
                    @if(!is_null($client_data->executiveId))
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
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="accounts-tab" data-bs-toggle="tab" href="#accounts" role="tab" aria-controls="accounts">Account</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="consignee-tab" data-bs-toggle="tab" href="#consignee" role="tab" aria-controls="consignee">Consignee</a>
                    </li>
                    @endif
                </ul>

                <div class="tab-content text-muted" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic_info" role="tabpanel" aria-labelledby="baisc-info-tab">
                        @include('cm_module.partial.basic_info')
                    </div>
                   
   
                    <div class="tab-pane fade" id="contact_history" role="tabpanel" aria-labelledby="contact-history-tab">
                        @include('cm_module.partial.contact_history')
                    </div>

                    <div class="tab-pane fade" id="purchase_history" role="tabpanel" aria-labelledby="purchase-history-tab">
                        @include('cm_module.partial.purchase_history')
                    </div>

                    <div class="tab-pane fade" id="courier" role="tabpanel" aria-labelledby="courier-tab">
                        @include('cm_module.partial.contact_info')
                    </div>

                    <div class="tab-pane fade" id="profoma_inovice" role="tabpanel" aria-labelledby="profoma-invoice-tab">
                        @include('cm_module.partial.proforma_invoice')
                    </div>

                    <div class="tab-pane fade" id="final_inovice" role="tabpanel" aria-labelledby="final-invoice-tab">
                        @include('cm_module.partial.final_invoice')
                    </div>

                    <div class="tab-pane fade" id="reserve_units" role="tabpanel" aria-labelledby="reserve-units-tab">
                        @include('cm_module.partial.reserve_units')
                    </div>
                    <div class="tab-pane fade" id="accounts" role="tabpanel" aria-labelledby="accounts-tab">
                        @include('cm_module.partial.accounts')
                    </div>
                    <div class="tab-pane fade" id="consignee" role="tabpanel" aria-labelledby="consignee-tab">
                        @include('cm_module.partial.consignee')
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