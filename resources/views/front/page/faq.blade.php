@extends('layout.landing')
@section('pageTitle','Faq')
@section('pageSubTitle','')
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
                {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">About Stock</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3" aria-selected="false">About Auction</button>
                </li>--}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button" role="tab" aria-controls="tab4" aria-selected="false">About Shipment</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab5-tab" data-bs-toggle="tab" data-bs-target="#tab5" type="button" role="tab" aria-controls="tab4" aria-selected="false">About Payment</button> 
                </li>
            </ul>

            <div class="tab-content p-3" id="myTabContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <div id="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header my-1" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa fa-plus me-4"></i>What types of vehicles does iCar Japan offer?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    iCar Japan offers a wide range of used vehicles, including sedans, SUVs, trucks, hatchbacks, and more. Our inventory includes vehicles from various manufacturers and in different price ranges to cater to diverse customer preferences.
                                </div>
                            </div>
                            <h2 class="accordion-header my-1" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-plus me-4"></i>Are the vehicles inspected and certified?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    Yes, all vehicles in our inventory undergo thorough inspection and certification processes to ensure they meet our high standards of quality and safety.
                                </div>
                            </div>
                            <h2 class="accordion-header my-1" id="headingThree">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-plus me-4"></i>Do you offer financing options?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    Yes, we work with reputable financial institutions to provide financing options for qualified customers. Our team can assist you in exploring financing options that suit your budget and needs.
                                </div>
                            </div>
                            <h2 class="accordion-header my-1" id="headingFour">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-plus me-4"></i>What is the process for purchasing a vehicle from iCar Japan?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    The purchasing process starts with selecting a vehicle from our inventory, arranging financing if needed, completing necessary paperwork, and taking delivery of your vehicle. Our team will guide you through each step of the process to ensure a smooth and hassle-free experience.
                                </div>
                            </div>
                            <h2 class="accordion-header my-1" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-plus me-4"></i>What is the process for purchasing a vehicle from iCar Japan?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    The purchasing process starts with selecting a vehicle from our inventory, arranging financing if needed, completing necessary paperwork, and taking delivery of your vehicle. Our team will guide you through each step of the process to ensure a smooth and hassle-free experience.
                                </div>
                            </div>
                            <h2 class="accordion-header my-1" id="headingSix">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-plus me-4"></i>Can you assist with shipping or delivery?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    Yes, we can assist with shipping or delivery of your vehicle to your desired location. Please contact us for more information and shipping options.
                                </div>
                            </div>
                            <h2 class="accordion-header my-1" id="headingSeven">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-plus me-4"></i>Are your vehicles covered by warranties?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    Many of our vehicles may come with warranties or service plans for added peace of mind. Please inquire about warranty options for specific vehicles.
                                </div>
                            </div>
                            <h2 class="accordion-header my-1" id="headingEight">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-plus me-4"></i>What do I have to do to buy a car?
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    Registration is required. After registration is completed, you can buy any car that you want.
                                </div>
                            </div>
                            <h2 class="accordion-header my-1" id="headingNine">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-plus me-4"></i>Do you offer post-purchase support or maintenance services?
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    Registration is required. After registration is completed, you can buy any car that you want.
                                </div>
                            </div>
                            <h2 class="accordion-header my-1" id="headingTen">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-plus me-4"></i>How can I contact iCar Japan for further assistance?
                                </button>
                            </h2>
                            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    You can contact us via phone, email, or through the contact form on our website. Our customer service team is available to assist you with any questions or inquiries you may have.
                                </div>
                            </div>
                            <h2 class="accordion-header my-1" id="headingEleven">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-plus me-4"></i>Do you have any criteria to become a registered member of iCar Japan?
                                </button>
                            </h2>
                            <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    Anyone who is an automobile dealer or an individual buyer can apply for the membership. However, for an individual car buyer, we encourage you to check your country's regulations before purchase. We are not familiar with the laws of your country. We are not able to offer you any advice, or to introduce you to any car importer or customs clearing agent in your country.
                                </div>
                            </div>
                        </div>

                        <!-- Add more accordion items as needed -->
                    </div>

                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <!-- Content for Tab 2 -->
                </div>
                <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab3-tab">
                    <!-- Content for Tab 3 -->
                    <h2 class="accordion-header my-1" id="heading13">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-plus me-4"></i>How long does it take me to receive my car?
                        </button>
                    </h2>
                    <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            We cannot tell you the exact time for your car to be delivered to you as it completely depends on the shipping schedule. However, your car will be shipped on the earliest available vessel. Usually, it takes 4 to 8 weeks.
                        </div>
                    </div>
                    <h2 class="accordion-header my-1" id="heading13">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-plus me-4"></i>How long does it take me to receive my car?
                        </button>
                    </h2>
                    <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            We cannot tell you the exact time for your car to be delivered to you as it completely depends on the shipping schedule. However, your car will be shipped on the earliest available vessel. Usually, it takes 4 to 8 weeks.
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab4-tab">
                    <!-- Content for Tab 3 -->
                    <h2 class="accordion-header my-1" id="headingTwelve">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-plus me-4"></i>What payment methods can be accepted by iCar Japan?
                        </button>
                    </h2>
                    <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            Because of the high frequency of credit card fraud, we don't accept payment by credit card. We only accept payment by telegraphic transfer to our designated bank account from your bank.
                        </div>
                    </div>
                    <h2 class="accordion-header my-1" id="heading14">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-plus me-4"></i>Is there any membership fee?
                        </button>
                    </h2>
                    <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading14" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            No. No fees or hidden charges are required. So don't hesitate and sign up now.
                        </div>
                    </div>
                    <h2 class="accordion-header my-1" id="heading15">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-plus me-4"></i>If I purchase a vehicle at $ 2,000, how much will I have to pay as extra charges?
                        </button>
                    </h2>
                    <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading15" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            If the price is in FOB, you will have to pay Freight charge, Clearance fee, Import duty, Registration fee, Compliance fee, and any other fee which may occur according to the import regulations of your country.
                            If the price is in C&F, you can omit Freight charge from the above charges.
                        </div>
                    </div>
                    <h2 class="accordion-header my-1" id="heading16">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse16" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-plus me-4"></i>Can I purchase LHD cars from iCar Japan?
                        </button>
                    </h2>
                    <div id="collapse16" class="accordion-collapse collapse" aria-labelledby="heading16" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            LHD cars are very rare in Japan. LHD cars are usually imported from countries like the US, Europe and Korea. However, you can search for an LHD car in a fair amount of Korean and American Inventory.
                        </div>
                    </div>
                    <h2 class="accordion-header my-1" id="heading17">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse17" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-plus me-4"></i>Can I cancel my purchase order?
                        </button>
                    </h2>
                    <div id="collapse17" class="accordion-collapse collapse" aria-labelledby="heading17" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            When you cancel an order, we may have to resell that car in an auction or in any other way. Therefore, if you cancel the order, you have to pay the balance in addition to the costs that may incur.
                        </div>
                    </div>
                    <h2 class="accordion-header my-1" id="heading18">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse18" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-plus me-4"></i>Do you inspect the cars before shipping?
                        </button>
                    </h2>
                    <div id="collapse18" class="accordion-collapse collapse" aria-labelledby="heading18" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            All the cars are thoroughly inspected to confirm that there is no difference between the actual specifications and those on the specification sheet.
                        </div>
                    </div>
                    <h2 class="accordion-header my-1" id="heading19">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse19" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-plus me-4"></i>For further questions, feel free to contact us
                        </button>
                    </h2>
                    <div id="collapse19" class="accordion-collapse collapse" aria-labelledby="heading19" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            Call:   +81 50 5539 4712 (Hotline)
                            Fax:  +81 90-8099-1615
                            Email:   csd@icarjapan.com
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection