@section('title', 'Terms & Conditions | Al Ahmad Store')
@section('meta_description', 'Read the Terms & Conditions of Al Ahmad Store. Rules for shopping watches, headphones, clothing and more online in Pakistan with Cash on Delivery.')
@section('meta_keywords', 'terms and conditions, al ahmad store, online shopping terms pakistan')

@extends('web.layouts.app')
@section('content')
<!-- main section start-->
        <main>
            <!-- breadcrumb start -->
            <section class="breadcrumb-area">
                <div class="container">
                    <div class="col">
                        <div class="row">
                            <div class="breadcrumb-index">
                                <!-- breadcrumb-list start -->
                                <ul class="breadcrumb-ul">
                                    <li class="breadcrumb-li">
                                        <a class="breadcrumb-link" href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-li">
                                        <span class="breadcrumb-text">Terms & condition</span>
                                    </li>
                                </ul>
                                <!-- breadcrumb-list end -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb end -->
            <!-- terms-rules start -->
            <section class="terms-rules section-ptb ">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <!-- section title start -->
                            <div class="section-capture">
                                <div class="section-title">
                                    <h2 data-animate="animate__fadeInUp"><span>Terms & conditions</span></h2>
                                </div>
                            </div>
                            <!-- section title end -->
                            <!-- Terms-banner-rules start -->
                            <div class="terms-banner-rules">
                                <div class="banner-wrap" data-animate="animate__fadeInUp">
                                    <div class="banner-bgimg"
     style="background-image: url('{{ asset('web/img/team/terms.jpg') }}');">
</div>

<div class="banner-img">
    <img src="{{ asset('web/img/team/terms.jpg') }}"
         class="img-fluid"
         alt="Terms & Conditions">
</div>
                                </div>
                               <div class="rules-wrap">
    <h6 data-animate="animate__fadeInUp">Restriction</h6>
    <ul class="terms-ul">
        <li class="terms-li" data-animate="animate__fadeInUp">
            <p>By using Al Ahmad Store website and placing an order, you agree to these Terms & Conditions. These terms apply to all products including watches, headphones, phone accessories, hair machines and clothing.</p>
        </li>
        <li class="terms-li" data-animate="animate__fadeInUp">
            <p>You must provide accurate information (name, address, phone) when placing an order. False or incomplete details may result in order cancellation.</p>
        </li>
        <li class="terms-li" data-animate="animate__fadeInUp">
            <p>We reserve the right to refuse or cancel any order in case of pricing errors, stock unavailability, or suspected fraud.</p>
        </li>
    </ul>
</div>
                            </div>
                            <!-- Terms-banner-rules end -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- terms-rules end -->
            <!-- temrs-condition start -->
            <section class="temrs-condition section-ptb bg-color">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="t-condition-block">
                               <ul class="condition-ul">
    <li data-animate="animate__fadeInUp">
        <h6>Introduction</h6>
        <p>Welcome to Al Ahmad Store. These Terms & Conditions govern your use of our website and the purchase of products from us.</p>
    </li>
    <li data-animate="animate__fadeInUp">
        <h6>Products & Pricing</h6>
        <p>All prices are in Pakistani Rupees (PKR). We try to keep prices accurate, but errors may occur. In case of a pricing error, we may cancel the order and notify you.</p>
    </li>
    <li data-animate="animate__fadeInUp">
        <h6>Orders & Payment</h6>
        <p>Currently we accept Cash on Delivery (COD). JazzCash and EasyPaisa will be added soon. Order confirmation will be sent via phone or email.</p>
    </li>
    <li data-animate="animate__fadeInUp">
        <h6>Shipping</h6>
        <p>We deliver across Pakistan. Delivery time is usually 2–5 working days in major cities. Remote areas may take longer.</p>
    </li>
    <li data-animate="animate__fadeInUp">
        <h6>Returns</h6>
        <p>Returns are accepted within 7 days of delivery for damaged or incorrect products. Items must be in original condition with packaging.</p>
    </li>
    <li data-animate="animate__fadeInUp">
        <h6>Intellectual property</h6>
        <p>All content on this website (logo, images, text) belongs to Al Ahmad Store and may not be copied without permission.</p>
    </li>
    <li data-animate="animate__fadeInUp">
        <h6>Limitation of liability</h6>
        <p>Al Ahmad Store is not responsible for delays caused by courier partners or circumstances beyond our control.</p>
    </li>
    <li data-animate="animate__fadeInUp">
        <h6>Changes to terms</h6>
        <p>We may update these Terms & Conditions at any time. Continued use of the website means you accept the updated terms.</p>
    </li>
</ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- temrs-condition end -->
            <!-- need-help start -->
            <section class="need-help section-ptb">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <!-- section title start -->
                            <div class="section-capture">
                                <div class="section-title">
                                    <h2 data-animate="animate__fadeInUp"><span>Need help</span></h2>
                                </div>
                            </div>
                            <!-- section title end -->
                            <!-- need-help grid start -->
                            <div class="need-wrap">
                                <ul class="need-ul">
                                    <li class="need-li" data-animate="animate__fadeInUp">
                                        <div class="need-img">
                                            <img src="{{ asset('web/img/team/mail.jpg') }}" class="img-fluid" alt="mail">
                                        </div>
                                        <div class="need-block">
                                            <span class="need-help-icon"><i class="bi bi-envelope"></i></span>
                                            <div class="need-help-text">
                                                <h6>Chat with us</h6>
                                                <p class="title">Send us an email</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="need-li" data-animate="animate__fadeInUp">
                                        <div class="need-img">
                                            <img src="{{ asset('web/img/team/call.jpg') }}" class="img-fluid" alt="call">
                                        </div>
                                        <div class="need-block">
                                            <span class="need-help-icon"><i class="bi bi-telephone"></i></span>
                                            <div class="need-help-text">
                                                <h6>Speak with us</h6>
                                                <p class="title">Give us a call toady</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="need-li" data-animate="animate__fadeInUp">
                                        <div class="need-img">
                                            <img src="{{ asset('web/img/team/location.jpg') }}" class="img-fluid" alt="location">
                                        </div>
                                        <div class="need-block">
                                            <span class="need-help-icon"><i class="bi bi-geo"></i></span>
                                            <div class="need-help-text">
                                                <h6>Locate a store</h6>
                                                <p class="title">Describe your project</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- need-help grid end -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- need-help end -->
        </main>
        <!-- main section end-->

@endsection
