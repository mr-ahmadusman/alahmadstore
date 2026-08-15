@extends('web.layouts.app')

@section('title', 'Payment Policy | Al Ahmad Store - Secure Online Shopping in Pakistan')
@section('meta_description', 'Read Al Ahmad Store payment policy. We accept Cash on Delivery (COD), JazzCash & EasyPaisa. Safe and secure payments for watches, headphones, clothing, phone accessories and more across Pakistan.')

@section('content')

<main>
    <!-- breadcrumb start -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-index">
                        <ul class="breadcrumb-ul">
                            <li class="breadcrumb-li">
                                <a class="breadcrumb-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-li">
                                <span class="breadcrumb-text">Payment Policy</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- payment policy start -->
    <section class="shipping-page section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Title -->
                    <div class="section-capture">
                        <div class="section-title">
                            <h2>
                                <span class="wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                                    Payment Policy – Al Ahmad Store
                                </span>
                            </h2>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.1</span>
                        <h6 class="shipping-title">What payment methods does Al Ahmad Store accept?</h6>
                        <div class="shipping-content">
                            <p>
                                At <strong>Al Ahmad Store</strong>, we currently offer <strong>Cash on Delivery (COD)</strong>
                                as our primary payment method across Pakistan. This allows you to pay for your order
                                (watches, headphones, Bluetooth hands-free, phone accessories, men’s & women’s clothing,
                                hair machines and more) only when the product is delivered to your doorstep.
                            </p>
                            <p>
                                We are also working on adding <strong>JazzCash</strong> and <strong>EasyPaisa</strong>
                                payment options very soon for even more convenience.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.2</span>
                        <h6 class="shipping-title">Is Cash on Delivery available all over Pakistan?</h6>
                        <div class="shipping-content">
                            <p>
                                Yes. Cash on Delivery is available in major cities and most areas of Pakistan.
                                When you place an order for products like smart watches, sports watches, Bluetooth
                                headphones, neck hands-free, graphic t-shirts, baggy pants or women’s clothing,
                                our delivery partner will collect the payment at the time of delivery.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.3</span>
                        <h6 class="shipping-title">Is it safe to shop at Al Ahmad Store?</h6>
                        <div class="shipping-content">
                            <p>
                                Absolutely. Your security is our top priority. Since we primarily use Cash on Delivery,
                                you don’t need to share any bank or card details online. When we launch JazzCash and
                                EasyPaisa, all transactions will be processed through secure and trusted payment gateways
                                with industry-standard encryption.
                            </p>
                            <p>
                                Al Ahmad Store never stores your bank account, JazzCash or EasyPaisa credentials.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.4</span>
                        <h6 class="shipping-title">Do you store my payment information?</h6>
                        <div class="shipping-content">
                            <p>
                                No. Al Ahmad Store does not collect or store any credit/debit card, bank account,
                                JazzCash or EasyPaisa information. All future digital payments will be handled
                                directly by the respective payment providers.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.5</span>
                        <h6 class="shipping-title">What if I face any payment related issue?</h6>
                        <div class="shipping-content">
                            <p>
                                If you face any problem related to payment or delivery, please contact our support team
                                immediately through the phone number or email given in the Contact section of our website.
                                Our team will resolve your query as quickly as possible.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.6</span>
                        <h6 class="shipping-title">Can I cancel my order before delivery?</h6>
                        <div class="shipping-content">
                            <p>
                                Yes, you can cancel your order before it is shipped. Once the order is out for delivery,
                                cancellation may not be possible. For COD orders, you can also refuse the parcel at the
                                time of delivery if needed.
                            </p>
                        </div>
                    </div>

                    <!-- Extra SEO paragraph -->
                    <div class="shipping" data-animate="animate__fadeInUp" style="margin-top: 30px;">
                        <div class="shipping-content">
                            <p>
                                <strong>Al Ahmad Store</strong> is your trusted online shopping destination in Pakistan
                                for premium quality <strong>watches</strong> (men’s, women’s & sports),
                                <strong>Bluetooth headphones</strong>, neck hands-free, phone accessories,
                                hair machines, men’s graphic t-shirts, baggy pants and stylish women’s clothing.
                                We are committed to providing a safe, transparent and customer-friendly payment experience.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- payment policy end -->
</main>

@endsection
