@section('title', 'Privacy Policy | Al Ahmad Store - Watches, Accessories & Fashion Pakistan')
@section('meta_description', 'Read how Al Ahmad Store protects your personal data. We collect only what is needed for orders of watches, headphones, clothing & more. Cash on Delivery. No selling of your data.')
@section('meta_keywords', 'privacy policy, al ahmad store, data protection pakistan, online shopping privacy')

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
                        <ul class="breadcrumb-ul">
                            <li class="breadcrumb-li">
                                <a class="breadcrumb-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-li">
                                <span class="breadcrumb-text">Privacy policy</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- privacy-policy start -->
    <section class="privacy-policy section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- faq title start -->
                    <div class="section-capture">
                        <div class="section-title">
                            <h2 data-animate="animate__fadeInUp"><span>Privacy policy</span></h2>
                        </div>
                        <p class="text-muted" data-animate="animate__fadeInUp">Last updated: {{ now()->format('F d, Y') }}</p>
                    </div>
                    <!-- faq title end -->
                    <!-- policy content start -->
                    <div class="terms-banner-rules">
                        <div class="banner-wrap">
                            <div class="banner-bgimg"
                                style="background-image: url('{{ optional($about)->banner_image ? asset($about->banner_image) : asset('web/img/policy/Privacy-policy.jpg') }}');">
                            </div>
                            <div class="banner-img" data-animate="animate__fadeInUp">
                                <img src="{{ optional($about)->banner_image ? asset($about->banner_image) : asset('web/img/policy/Privacy-policy.jpg') }}"
                                    class="img-fluid" alt="Al Ahmad Store Privacy Policy">
                            </div>
                        </div>
                        <div class="rules-wrap">
                            <ul class="terms-ul">
                                <li class="terms-li" data-animate="animate__fadeInUp">
                                    <p>Al Ahmad Store is a multi-category online store in Pakistan offering men's and women's watches, sports watches, hair trimmers and grooming machines, phone accessories, wireless handsfree, Bluetooth neckbands and headphones, along with men's and women's clothing including t-shirts, baggy and graphic pants.</p>
                                </li>
                                <li class="terms-li" data-animate="animate__fadeInUp">
                                    <p>This Privacy Policy explains what personal information we collect when you browse, shop, or place an order on our website, how we use it, and the choices you have regarding your data.</p>
                                </li>
                                <li class="terms-li" data-animate="animate__fadeInUp">
                                    <p>We collect only the information necessary to process your orders, deliver your products safely, and improve your shopping experience with us.</p>
                                </li>
                                <li class="terms-li" data-animate="animate__fadeInUp">
                                    <p>We never sell your personal information to third parties, and we take reasonable technical and organizational measures to keep your data secure.</p>
                                </li>
                                <li class="terms-li" data-animate="animate__fadeInUp">
                                    <p>By using Al Ahmad Store's website, browsing our product catalog, or placing an order, you agree to the collection and use of information as described in this policy.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- policy content end -->

                    <!-- detailed policy content start -->
                    <div class="privacy-detailed-content mt-5" data-animate="animate__fadeInUp">

                        <h3>1. Information We Collect</h3>
                        <p>When you shop with Al Ahmad Store for watches, hair machines, phone accessories, earbuds, handsfree, neckbands, or clothing items, we may collect the following types of information:</p>
                        <ul>
                            <li><strong>Contact and delivery details</strong> — your full name, phone number, email address, shipping address, city, and postal code, used to process and deliver your order.</li>
                            <li><strong>Order and transaction information</strong> — the products you view, add to cart, add to your wishlist, or purchase, including order history, order status, and payment method (Cash on Delivery, and JazzCash/EasyPaisa as they become available).</li>
                            <li><strong>Account information</strong> — if you create an account, we store your name, email, and encrypted password to let you track orders and manage your wishlist.</li>
                            <li><strong>Device and usage information</strong> — your IP address, browser type, device type, and how you interact with our website, collected automatically to help us improve site performance and security.</li>
                            <li><strong>Communication data</strong> — any messages you send us via WhatsApp, contact forms, or email regarding your order, product questions, or support requests.</li>
                        </ul>

                        <h3>2. How We Use Your Information</h3>
                        <p>We use the information we collect for legitimate business purposes, including:</p>
                        <ul>
                            <li>Processing and fulfilling your orders for watches, grooming machines, mobile accessories, and apparel.</li>
                            <li>Communicating with you about order confirmations, shipping updates, and delivery status via phone, SMS, email, or WhatsApp.</li>
                            <li>Managing your account, order history, and wishlist so you can easily reorder your favorite products.</li>
                            <li>Improving our product catalog, website performance, and overall shopping experience based on browsing and purchase patterns.</li>
                            <li>Preventing fraudulent orders and protecting the security of our website and customers.</li>
                            <li>Sending you promotional offers, new arrivals, and discounts, where you have not opted out of marketing communication.</li>
                        </ul>

                        <h3>3. Payment Information</h3>
                        <p>Al Ahmad Store currently processes orders via Cash on Delivery (COD). We do not store your credit or debit card details on our servers. When digital wallet options such as JazzCash and EasyPaisa become available, payments will be processed securely through their respective platforms, and Al Ahmad Store does not have access to your mobile wallet PIN or full account credentials.</p>

                        <h3>4. How We Share Your Information</h3>
                        <p>We do not sell or rent your personal information to third parties. We may share limited information only in the following circumstances:</p>
                        <ul>
                            <li>With our courier and delivery partners, to ensure your watches, accessories, or clothing items reach your doorstep.</li>
                            <li>With payment processors (such as JazzCash or EasyPaisa, when enabled) solely to complete your transaction.</li>
                            <li>When required by law, legal process, or to protect the rights, property, or safety of Al Ahmad Store, our customers, or others.</li>
                        </ul>

                        <h3>5. Cookies and Tracking</h3>
                        <p>Our website uses cookies and similar technologies to remember items in your cart and wishlist, keep you logged in, and understand how customers browse our watches, grooming, accessories, and clothing categories. You can disable cookies through your browser settings, though some features of the website, such as the shopping cart, may not function properly without them.</p>

                        <h3>6. Data Security</h3>
                        <p>We take reasonable technical and organizational precautions to protect your personal information from unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is completely secure, and we cannot guarantee absolute security of information you provide to us.</p>

                        <h3>7. Your Rights and Choices</h3>
                        <p>You have the right to:</p>
                        <ul>
                            <li>Access the personal information we hold about you, including your order history.</li>
                            <li>Request correction of inaccurate contact or delivery details in your account.</li>
                            <li>Request deletion of your account and associated personal data, subject to legal and accounting obligations.</li>
                            <li>Opt out of promotional emails, SMS, or WhatsApp marketing messages at any time.</li>
                        </ul>
                        <p>To exercise any of these rights, please contact us using the details below.</p>

                        <h3>8. Children's Privacy</h3>
                        <p>Al Ahmad Store's products and services are intended for use by adults and are not directed at children. We do not knowingly collect personal information from children under the age of 18. If you believe a minor has provided us with personal information, please contact us so we can remove it.</p>

                        <h3>9. Changes to This Privacy Policy</h3>
                        <p>We may update this Privacy Policy from time to time to reflect changes in our practices, new product categories, or legal requirements. Any changes will be posted on this page with an updated "Last updated" date.</p>

                    </div>
                    <!-- detailed policy content end -->
                </div>
            </div>
        </div>
    </section>
    <!-- privacy-policy end -->

    <!-- pay policy start -->
    <section class="pay-policy bg-color section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="paymen-policy-wrap">
                        <div class="pay-icon">
                            <ul class="pay-policy-ul">
                                <li data-animate="animate__fadeInUp">
                                    <span><i class="bi bi-shield-check"></i></span>
                                    <h6>Secure data</h6>
                                </li>
                                <li data-animate="animate__fadeInUp">
                                    <span><i class="bi bi-arrow-repeat"></i></span>
                                    <h6>Easy returns</h6>
                                </li>
                                <li data-animate="animate__fadeInUp">
                                    <span><i class="bi bi-eye-slash"></i></span>
                                    <h6>No hidden sharing</h6>
                                </li>
                                <li data-animate="animate__fadeInUp">
                                    <span><i class="bi bi-person-check"></i></span>
                                    <h6>Customer support</h6>
                                </li>
                                <li data-animate="animate__fadeInUp">
                                    <span><i class="bi bi-graph-up"></i></span>
                                    <h6>Purpose limited use</h6>
                                </li>
                            </ul>
                        </div>
                        <div class="pay-text">
                            <h6 data-animate="animate__fadeInUp">Our Commitment to You</h6>
                            <ul class="pay-text-ul">
                                <li data-animate="animate__fadeInUp">
                                    <p>Whether you're shopping for a premium men's or women's watch, a sports watch for daily wear, a hair trimming machine, wireless earbuds and Bluetooth neckbands, or the latest men's t-shirts and graphic baggy pants, your personal information is handled with care at every step of your order.</p>
                                </li>
                                <li data-animate="animate__fadeInUp">
                                    <p>We only use your data for the purposes explained in this policy — to process your order, keep you updated on delivery, and improve the products and categories we offer. We do not sell your information to advertisers or unrelated third parties.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pay policy end -->

    <!-- payment-method start -->
    <section class="payment-method section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-capture">
                        <div class="section-title">
                            <h2 data-animate="animate__fadeInUp"><span>Information we collect, by category</span></h2>
                        </div>
                    </div>
                    <div class="method-wrap">
                        <ul class="method-ul">
                            <li class="method-li" data-animate="animate__fadeInUp">
                                <span class="fs-1"><i class="bi bi-person-lines-fill"></i></span>
                                <h6>Contact details</h6>
                                <p>Name, phone number, email, and delivery address used to process and ship your order.</p>
                            </li>
                            <li class="method-li" data-animate="animate__fadeInUp">
                                <span class="fs-1"><i class="bi bi-bag-check"></i></span>
                                <h6>Order history</h6>
                                <p>Products purchased, order status, and quantities across watches, accessories, and clothing.</p>
                            </li>
                            <li class="method-li" data-animate="animate__fadeInUp">
                                <span class="fs-1"><i class="bi bi-heart"></i></span>
                                <h6>Wishlist &amp; cart</h6>
                                <p>Items you save or add to cart, such as neckbands, earbuds, watches, or apparel.</p>
                            </li>
                            <li class="method-li" data-animate="animate__fadeInUp">
                                <span class="fs-1"><i class="bi bi-credit-card-2-front"></i></span>
                                <h6>Payment method</h6>
                                <p>Your chosen payment option (Cash on Delivery, or JazzCash/EasyPaisa when enabled).</p>
                            </li>
                            <li class="method-li" data-animate="animate__fadeInUp">
                                <span class="fs-1"><i class="bi bi-laptop"></i></span>
                                <h6>Device &amp; browser data</h6>
                                <p>IP address and browser type, used to keep our website secure and running smoothly.</p>
                            </li>
                            <li class="method-li" data-animate="animate__fadeInUp">
                                <span class="fs-1"><i class="bi bi-whatsapp"></i></span>
                                <h6>Support messages</h6>
                                <p>Details you share with us over WhatsApp or contact forms regarding your order.</p>
                            </li>
                            <li class="method-li" data-animate="animate__fadeInUp">
                                <span class="fs-1"><i class="bi bi-megaphone"></i></span>
                                <h6>Marketing preferences</h6>
                                <p>Whether you've opted in to receive offers on new watches, accessories, and fashion drops.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- payment-method section end -->

    <!-- contact info start -->
    <section class="section-ptb pt-0">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-capture">
                        <div class="section-title">
                            <h2 data-animate="animate__fadeInUp"><span>Questions about your privacy?</span></h2>
                        </div>
                    </div>
                    <p data-animate="animate__fadeInUp">If you have any questions about this Privacy Policy, or would like to access, correct, or delete your personal information, please reach out to Al Ahmad Store using the details below:</p>
                    <ul class="list-unstyled" data-animate="animate__fadeInUp">
                        <li><i class="ti-mobile"></i> {{ optional($footerContact)->phone }}</li>
                        <li><i class="ti-email"></i> <a href="mailto:{{ optional($footerContact)->mail }}">{{ optional($footerContact)->mail }}</a></li>
                        <li><i class="ti-location-pin"></i> {{ optional($footerContact)->address }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- contact info end -->
</main>
<!-- main section end-->

@endsection
