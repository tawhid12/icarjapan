@extends('layout.landing')
@section('pageTitle','Faq')
@section('pageSubTitle','Faq')
@push('styles')
<style>
    .nav-tabs .nav-link,
    .nav-tabs .nav-link.active {
        border-radius: 0;
        font-size: 14px;
        color: var(--brand-color);
        font-weight: 700;
    }

    .accordion-header {
        background: #EDEDED;
        padding: 12px;
        color: #000;
    }

    button.accordion-button {
        font-size: 14px;
        font-weight: 700;
    }

    .accordion-body {
        border: 1px solid #eee;
        padding: 10px;
        font-size: 14px;
    }

    .accordion-button i.fa {
        background-color: #000;
        color: #fff;
        padding: 6px;
        font-size: 14px;
        border-radius: 4px;
    }
</style>
@endpush
@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <h3>FAQ</h3>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">About | ICARJAPAN</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">About Stock</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3" aria-selected="false">About Auction</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button" role="tab" aria-controls="tab4" aria-selected="false">About Shipment</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab5" type="button" role="tab" aria-controls="tab4" aria-selected="false">About Payment</button>
                </li>
            </ul>

            <div class="tab-content p-3" id="myTabContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <div id="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header my-1" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa fa-plus me-4"></i> Where is the head office of I Carjapan located? What types of cars do you deal?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    Head Office of I Carjapan is located in Japan. You can <a href="">click here</a> to view our complete address.
                                </div>
                            </div>
                            <h2 class="accordion-header my-1" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-plus me-4"></i> Do you sell used vehicles through stock and auction?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    Sure, I Carjapan sells used vehicles by both stock and auction methods.
                                </div>
                            </div>
                        </div>

                        <!-- Add more accordion items as needed -->
                    </div>

                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <!-- Content for Tab 2 -->
                </div>
                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                    <!-- Content for Tab 3 -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection