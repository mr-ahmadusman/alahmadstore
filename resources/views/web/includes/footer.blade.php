<!-- footer start -->
<section class="footer-area section-ptb">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="footer-list">
                    <ul class="footer-ul">
                        <li class="footer-li footer-logo" data-animate="animate__fadeInUp">
                            <div class="footer-content">
                                <a href="{{ url('/') }}" class="theme-logo">
                                    <img src="{{ $logo && $logo->image ? asset($logo->image) : asset('web/img/logo/logo-removebg-preview.png') }}"
                                        class="img-fluid" alt="footer-logo">
                                </a>
                                <ul class="ftcontact-ul">
                                    <li class="ftcontact-li">
                                        <div class="footer-desc">
                                            <p class="desc">There are many variations of passages of lorem Ipsum available, but the majority ..</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="app-code">
                                    <h6 class="ftlist-title">Download for app</h6>
                                    <div class="code-1">
                                        <a href="#" class="image">
                                            <img src="{{ asset('web/img/footer/home-footer1.jpg') }}" class="img-fluid desk-img" alt="gp-icon-01">
                                        </a>
                                        <a href="#" class="image">
                                            <img src="{{ asset('web/img/footer/home-footer2.jpg') }}" class="img-fluid desk-img" alt="as-icon-02">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="footer-li" data-animate="animate__fadeInUp">
                            <ul class="ftlist-ul">
                                <li class="ftlist-li">
                                    <h6 class="ftlist-title">Help with</h6>
                                    <a href="#footer-help" class="ftlist-title" data-bs-toggle="collapse" aria-expanded="false">
                                        <span>Help with</span>
                                        <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                    <ul class="ftlink-ul collapse" id="footer-help">
                                        <li class="ftlink-li">
                                            <a href="{{ route('contact') }}">Contact us</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="{{ route('terms') }}">Terms &amp; conditions</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="{{ route('my.orders') }}">Track your order</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="{{ route('shipping.policy') }}">Our guarantee</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="{{ url('/gallery') }}">Guide des tailles</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="footer-li" data-animate="animate__fadeInUp">
                            <ul class="ftlist-ul">
                                <li class="ftlist-li">
                                    <h6 class="ftlist-title">Information</h6>
                                    <a href="#footer-information" class="ftlist-title" data-bs-toggle="collapse" aria-expanded="false">
                                        <span>Information</span>
                                        <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                    <ul class="ftlink-ul collapse" id="footer-information">
                                        <li class="ftlink-li">
                                            <a href="{{ url('/about') }}">About story</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="{{ route('privacy') }}">Privacy policy</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="{{ route('return.policy') }}">Return policy</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="{{ route('payment.policy') }}">Payment policy</a>
                                        </li>
                                        <li class="ftlink-li">
                                            <a href="{{ url('/about') }}">We our brand</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="footer-li" data-animate="animate__fadeInUp">
                            <ul class="ftlist-ul">
                                <li class="ftlist-li">
                                    <h6 class="ftlist-title">Top category</h6>
                                    <a href="#footer-category" class="ftlist-title" data-bs-toggle="collapse" aria-expanded="false">
                                        <span>Top category</span>
                                        <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                    <ul class="ftlink-ul collapse" id="footer-category">
                                        @foreach ($categories->take(5) as $category)
                                            <li class="ftlink-li">
                                                <a href="{{ route('search', ['q' => $category->name]) }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="footer-li footer-contact" data-animate="animate__fadeInUp">
                            <ul class="ftlist-ul">
                                <li class="ftlist-li">
                                    <h6 class="ftlist-title">Contact info</h6>
                                    <a href="" class="ftlist-title" data-bs-toggle="collapse" aria-expanded="false">
                                        <span>Contact info</span>
                                        <span><i class="fa-solid fa-plus"></i></span>
                                    </a>
                                    <ul class="ftcontact-ul collapse" id="footer-Contact">
                                        <li class="ftcontact-li">
                                            <div class="ft-contact-add">
                                                <a href="tel://{{ optional($footerContact)->phone }}" class="ft-contact-address">Phone: {{ optional($footerContact)->phone }}</a>
                                            </div>
                                        </li>
                                        <li class="ftcontact-li">
                                            <div class="ft-contact-add">
                                                <a href="mailto:{{ optional($footerContact)->mail }}" class="ft-contact-address">Email: {{ optional($footerContact)->mail }}</a>
                                            </div>
                                        </li>
                                        <li class="ftcontact-li">
                                            <div class="ft-contact-add">
                                                <p class="ft-contact-text">{{ optional($footerContact)->address }}</p>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer end -->
  <!-- footer-copyright start -->
        <footer class="ft-copyright-area bt">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="ft-copyright">
                            <ul class="ft-copryright-ul">
                                <li class="ft-copryright-li ft-payment">
                                    <ul class="payment-icon">
                                        <li>
                                            <a href="/">
                                                <img src="{{ asset('web/img/payment/pay-1.jpg') }}" class="img-fluid" alt="pay-1">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/">
                                                <img src="{{ asset('web/img/payment/pay-2.jpg') }}" class="img-fluid" alt="pay-2">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/">
                                                <img src="{{ asset('web/img/payment/pay-3.jpg') }}" class="img-fluid" alt="pay-3">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/">
                                                <img src="{{ asset('web/img/payment/pay-4.jpg') }}" class="img-fluid" alt="pay-4">
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="ft-copryright-li ft-copyright-text">
                                    <p>
                                                                        <span>&copy; {{ date('Y') }} AL AHMAD STORE. All rights reserved.</span>

                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer-copyright end -->
