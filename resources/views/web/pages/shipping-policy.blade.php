@extends('web.layouts.app')

@section('title', 'Shipping Policy | Al Ahmad Store - Fast Delivery Across Pakistan')
@section('meta_description', 'Al Ahmad Store shipping policy. Fast and reliable delivery of watches, headphones, Bluetooth hands-free, phone accessories, clothing and more across Pakistan. Cash on Delivery available.')

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
                                <span class="breadcrumb-text">Shipping Policy</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- Shipping policy start -->
    <section class="shipping-page section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Title -->
                    <div class="section-capture">
                        <div class="section-title">
                            <h2>
                                <span class="wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                                    Shipping Policy – Al Ahmad Store
                                </span>
                            </h2>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.1</span>
                        <h6 class="shipping-title">What are the shipping charges?</h6>
                        <div class="shipping-content">
                            <p>
                                At <strong>Al Ahmad Store</strong>, shipping charges may vary depending on the product
                                and delivery location. Many products qualify for free or low-cost delivery within Pakistan.
                            </p>
                            <p>
                                The exact shipping charge (if any) will be clearly shown at checkout before you place the order.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.2</span>
                        <h6 class="shipping-title">What is the estimated delivery time?</h6>
                        <div class="shipping-content">
                            <p>
                                Orders are usually delivered within <strong>2 to 5 working days</strong>
                                in major cities of Pakistan.
                            </p>
                            <p>
                                For remote areas, delivery may take <strong>5 to 7 working days</strong>.
                                All orders are processed and shipped from our warehouse within 1–2 working days.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.3</span>
                        <h6 class="shipping-title">How will the delivery be done?</h6>
                        <div class="shipping-content">
                            <p>
                                We deliver through reliable courier partners across Pakistan.
                                Once your order is shipped, you will receive tracking details
                                (where available) so you can track your parcel.
                            </p>
                            <p>
                                We deliver watches, Bluetooth headphones, neck hands-free,
                                phone accessories, hair machines, men’s & women’s clothing and more
                                safely to your doorstep.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.4</span>
                        <h6 class="shipping-title">How are items packaged?</h6>
                        <div class="shipping-content">
                            <p>
                                All products are carefully packed with proper protection
                                to avoid any damage during transit.
                                Fragile items like watches and headphones are packed with extra care.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.5</span>
                        <h6 class="shipping-title">Do you offer Cash on Delivery (COD)?</h6>
                        <div class="shipping-content">
                            <p>
                                Yes. <strong>Cash on Delivery</strong> is available across most areas of Pakistan.
                                You can pay for your order when the product is delivered to you.
                            </p>
                        </div>
                    </div>

                    <div class="shipping" data-animate="animate__fadeInUp">
                        <span>Q.6</span>
                        <h6 class="shipping-title">What if my area is not serviceable?</h6>
                        <div class="shipping-content">
                            <p>
                                If your area is not serviceable by our courier partners,
                                our team will contact you to arrange an alternative delivery solution
                                or nearby pickup point.
                            </p>
                        </div>
                    </div>

                    <!-- Extra SEO paragraph -->
                    <div class="shipping" data-animate="animate__fadeInUp" style="margin-top: 30px;">
                        <div class="shipping-content">
                            <p>
                                <strong>Al Ahmad Store</strong> is dedicated to providing fast and reliable
                                delivery of quality products across Pakistan — including
                                <strong>watches</strong>, <strong>Bluetooth headphones</strong>,
                                phone accessories, hair machines, graphic t-shirts, baggy pants
                                and stylish women’s clothing. Shop with confidence and get your order delivered safely.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Shipping policy end -->
</main>

@endsection
