@extends('web.layouts.app')

@section('title', 'Return Policy | Al Ahmad Store - Easy Returns in Pakistan')
@section('meta_description', 'Read Al Ahmad Store return policy. Easy 7-day return for damaged or wrong products. We accept returns for watches, headphones, Bluetooth hands-free, clothing, phone accessories and more across Pakistan.')

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
                                <span class="breadcrumb-text">Return Policy</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- return policy start -->
    <section class="shipping-page section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Title -->
                    <div class="section-capture">
                        <div class="section-title">
                            <h2>
                                <span class="wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                                    Return Policy – Al Ahmad Store
                                </span>
                            </h2>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.1</span>
                        <h6 class="shipping-title">What is Al Ahmad Store return policy?</h6>
                        <div class="shipping-content">
                            <p>
                                At <strong>Al Ahmad Store</strong>, customer satisfaction is our priority.
                                We offer an easy return policy for products that are damaged, defective,
                                or not as described on the website.
                            </p>
                            <p>
                                This policy applies to all products including
                                <strong>watches</strong> (men’s, women’s & sports),
                                <strong>Bluetooth headphones</strong>, neck hands-free,
                                phone accessories, hair machines, men’s graphic t-shirts,
                                baggy pants, and women’s clothing.
                            </p>
                            <p>
                                All products must be returned in their original condition
                                with tags, packaging and invoice.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.2</span>
                        <h6 class="shipping-title">How many days do I have to return a product?</h6>
                        <div class="shipping-content">
                            <p>
                                You can request a return within <strong>7 days</strong> of receiving the product.
                                After 7 days of delivery, return requests will not be accepted.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.3</span>
                        <h6 class="shipping-title">How can I raise a return request?</h6>
                        <div class="shipping-content">
                            <p>
                                To raise a return request, please contact us through the phone number
                                or email mentioned in the Contact section of our website.
                                Kindly mention your <strong>Order Number</strong> and share clear
                                photos of the damaged or incorrect product.
                            </p>
                            <p>
                                Our support team will guide you with the next steps.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.4</span>
                        <h6 class="shipping-title">When will I get my refund?</h6>
                        <div class="shipping-content">
                            <p>
                                Once we receive and inspect the returned product,
                                the refund process will be initiated.
                            </p>
                            <p>
                                For Cash on Delivery orders, refund will be processed
                                through bank transfer or JazzCash/EasyPaisa (as per your preference)
                                within <strong>3 to 5 working days</strong> after the product is received at our warehouse.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.5</span>
                        <h6 class="shipping-title">Which products are not eligible for return?</h6>
                        <div class="shipping-content">
                            <p>
                                Products that are used, washed, damaged by the customer,
                                or returned without original packaging and tags
                                will not be accepted for return.
                            </p>
                            <p>
                                Items returned after 7 days of delivery are also not eligible.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.6</span>
                        <h6 class="shipping-title">Can I exchange a product?</h6>
                        <div class="shipping-content">
                            <p>
                                Currently we offer returns and refunds.
                                For size or product exchange, please contact our support team.
                                We will try our best to assist you based on stock availability.
                            </p>
                        </div>
                    </div>

                    <!-- Extra SEO paragraph -->
                    <div class="shipping" data-animate="animate__fadeInUp" style="margin-top: 30px;">
                        <div class="shipping-content">
                            <p>
                                <strong>Al Ahmad Store</strong> is committed to providing a smooth and
                                trustworthy shopping experience in Pakistan. Whether you buy
                                watches, Bluetooth headphones, phone accessories, hair machines
                                or trendy clothing — our return policy ensures your peace of mind.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- return policy end -->
</main>

@endsection
