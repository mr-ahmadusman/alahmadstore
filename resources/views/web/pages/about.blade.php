@section('title', 'About Us | Al Ahmad Store - Quality Products in Pakistan')
@section('meta_description', 'Learn about Al Ahmad Store – your trusted online shop in Pakistan for watches, Bluetooth headphones, phone accessories, hair machines, men’s & women’s clothing. Quality products with Cash on Delivery.')
@section('meta_keywords', 'about al ahmad store, online shopping pakistan, watches store, bluetooth headphones, clothing store pakistan')

@extends('web.layouts.app')

@section('content')
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
                                <span class="breadcrumb-text">About us</span>
                            </li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- about-banner-img start (naya section — breadcrumb ke turant baad, height 900px width 100%) -->
    <section class="about-banner-img"
        style="width:100%; height:900px; background-image:url('{{ asset($about->banner_image) }}');
               background-size:cover; background-position:center; background-repeat:no-repeat; position:relative;">
        {{-- Image ke upar title chahiye to ye overlay rehne do, na chahiye to pura @if block hata dena --}}
        @if($about->banner_title)
            <div style="position:absolute; inset:0; background:rgba(0,0,0,0.35); display:flex; align-items:center; justify-content:center;">
                <h1 class="text-center" style="color:#fff;" data-animate="animate__fadeInUp">{{ $about->banner_title }}</h1>
            </div>
        @endif
    </section>
    <!-- about-banner-img end -->

    <!-- about-area start -->
    <section class="about-area section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about-content">
                        <!-- about title start -->
                        <div class="section-capture">
                            <div class="section-title">
                                <h2 data-animate="animate__fadeInUp"><span>About us</span></h2>
                            </div>
                        </div>
                        <!-- about title end -->
                        <!-- about banner start -->
                        <div class="about-banner">
                            <div class="about-banner-area section-pt">
                                <ul class="about-ul">
                                    <!-- about img start -->
                                    <li class="about-li about-company" data-animate="animate__fadeInUp">
                                        <img src="{{ asset('web/img/about/our-company.png') }}" class="img-fluid" alt="our-company">
                                    </li>
                                    <!-- about img end -->
                                    <!-- about desc start: yahan backend ka feature_description use kiya hai -->
                                    <li class="about-li abt-desc">
                                        <h6 data-animate="animate__fadeInUp">Our company</h6>
                                        <p data-animate="animate__fadeInUp">{{ $about->feature_description }}</p>
                                    </li>
                                    <!-- about desc end -->
                                </ul>
                            </div>
                            <!-- is niche wala block abhi bhi static hai — About model mein iske liye alag field nahi hai -->
                            <div class="about-banner-area section-pt">
                                <ul class="about-ul">
                                    <li class="about-li about-company" data-animate="animate__fadeInUp">
                                        <img src="{{ asset('web/img/about/team-work.png') }}" class="img-fluid" alt="team-work">
                                    </li>
                                    <li class="about-li abt-desc">
                                        <h6 data-animate="animate__fadeInUp">Team work</h6>
                                        <p data-animate="animate__fadeInUp">Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- about banner end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-area end -->

    <!-- about-vision start: static hai, koi backend field nahi diya gaya isliye -->
    <section class="about-vision bg-color section-pt">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="abt-vision">
                        <ul class="abt-vision-ul">
                            <li class="abt-vision-li">
    <div class="abt-vision-content">
        <img src="{{ asset('web/img/about/our-mission.png') }}" data-animate="animate__fadeInUp" class="img-fluid" alt="Al Ahmad Store mission">
        <h6 data-animate="animate__fadeInUp">Our mission</h6>
        <p data-animate="animate__fadeInUp">
            To provide quality products at fair prices with fast delivery and honest service across Pakistan.
        </p>
    </div>
</li>
<li class="abt-vision-li">
    <div class="abt-vision-content">
        <img src="{{ asset('web/img/about/our-vision.png') }}" class="img-fluid" data-animate="animate__fadeInUp" alt="Al Ahmad Store vision">
        <h6 data-animate="animate__fadeInUp">Our vision</h6>
        <p data-animate="animate__fadeInUp">
            To become a trusted online store for watches, headphones, accessories and clothing in every city of Pakistan.
        </p>
    </div>
</li>
<li class="abt-vision-li">
    <div class="abt-vision-content">
        <img src="{{ asset('web/img/about/our-idea.png') }}" class="img-fluid" data-animate="animate__fadeInUp" alt="Al Ahmad Store idea">
        <h6 data-animate="animate__fadeInUp">Our idea</h6>
        <p data-animate="animate__fadeInUp">
            Simple shopping, secure Cash on Delivery, and products that customers actually love and trust.
        </p>
    </div>
</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-vision end -->

    <!-- project-count start: static rakha hai (koi counters table backend mein nahi hai) -->
    <section class="project-count bg-color section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="single-count">
                        <ul>
                            <li class="count-wrap" data-animate="animate__fadeInUp">
                                <div class="count-info">
                                    <div class="count"><span class="count-number">10</span><span>+</span></div>
                                    <h6>Years</h6>
                                </div>
                                <div class="counter-icon"><a href="javascript:void(0)"><i class="bi bi-briefcase"></i></a></div>
                            </li>
                            <li class="count-wrap" data-animate="animate__fadeInUp">
                                <div class="count-info">
                                    <div class="count"><span class="count-number">100</span><span>+</span></div>
                                    <h6>Clients</h6>
                                </div>
                                <div class="counter-icon"><a href="javascript:void(0)"><i class="bi bi-people"></i></a></div>
                            </li>
                            <li class="count-wrap" data-animate="animate__fadeInUp">
                                <div class="count-info">
                                    <div class="count"><span class="count-number">50</span><span>+</span></div>
                                    <h6>Shops</h6>
                                </div>
                                <div class="counter-icon"><a href="javascript:void(0)"><i class="bi bi-shop"></i></a></div>
                            </li>
                            <li class="count-wrap" data-animate="animate__fadeInUp">
                                <div class="count-info">
                                    <div class="count"><span class="count-number">17</span><span>M+</span></div>
                                    <h6>Sales</h6>
                                </div>
                                <div class="counter-icon"><a href="javascript:void(0)"><i class="bi bi-tags"></i></a></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- project-count end -->

    <!-- about-team start: yahan $abouts loop use kiya hai (t_image, t_name, t_title) -->
    <section class="about-team section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="our-team">
                        <div class="section-capture">
                            <div class="section-title">
                                <h2><span class="title-main" data-animate="animate__fadeInUp">Our team</span></h2>
                            </div>
                        </div>
                        <div class="team-wrap">
                            <ul class="team-ul">
                                @foreach($abouts as $member)
                                    <li class="team-li" data-animate="animate__fadeInUp">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset($member->t_image) }}" class="img-fluid" alt="{{ $member->t_name }}">
                                        </a>
                                        <div class="team-info">
                                            <h6>{{ $member->t_name }}</h6>
                                            <span>{{ $member->t_title }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-team end -->
</main>
@endsection
