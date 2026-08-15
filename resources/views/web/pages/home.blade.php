@section('title', 'Al Ahmad Store | Watches, Headphones, Clothing & Accessories in Pakistan')
@section('meta_description', 'Shop quality watches, Bluetooth headphones, neck hands-free, phone accessories, hair
    machines, men’s graphic t-shirts & women’s clothing at Al Ahmad Store. Cash on Delivery across Pakistan.')
@section('meta_keywords', 'watches pakistan, bluetooth headphones, hands free, phone accessories, hair machine, mens t
    shirts, women clothing, online shopping pakistan, al ahmad store, cash on delivery')

    @extends('web.layouts.app')

@section('content')
    <!-- main start -->
    <main id="main-content">
        <!-- slider-area start-->
        <section class="slider-content">
            <div class="home-slider owl-carousel owl-theme" id="home-slider">
                @foreach ($carousels as $carousel)
                    <div class="item">
                        <div class="slider-image-info">
                            <!-- slider-text start -->
                            <div class="slider-image">
                                <img src="{{ $carousel->image ? asset($carousel->image) : asset('web/img/slider/home1-slider1.jpg') }}"
                                    class="img-fluid desk-img" alt="{{ $carousel->title }}">
                                <img src="{{ $carousel->mobile_image ? asset($carousel->mobile_image) : asset('web/img/slider/home1-mobile-slider1.jpg') }}"
                                    class="img-fluid mobile-img" alt="{{ $carousel->title }} mobile">
                            </div>
                            <!-- slider-img end -->
                            <div class="container slider-info-content">
                                <div class="row">
                                    <div class="col">
                                        <div class="slider-info-wrap slider-content-left slider-text-left">
                                            <!-- slider-text start -->
                                            <div class="slider-info-text">
                                                <div class="slider-text-info">
                                                    <span class="sub-title">Get up to discount 80% off</span>
                                                    <h2><span>{{ $carousel->title }}</span></h2>
                                                    <div class="slider-text">
                                                        <span>100% trusted</span>
                                                        <span> electronics gadget</span>
                                                    </div>
                                                    <a href="{{ route('search') }}" class="btn btn-style">ONLINE
                                                        COLLECTION</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- slider-text end -->
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- slider-area end -->
        <!-- category start -->
        <section class="slider-category section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <ul class="cat-wrap">
                            <li class="cat-wrapper heading">
                                <div class="section-capture">
                                    <div class="section-title">
                                        <span class="sub-title">Favorites item</span>
                                        <h2><span>Popular category</span></h2>
                                    </div>
                                </div>
                                <a href="{{ route('search') }}" class="btn btn-style2">View all</a>
                            </li>
                            <li class="cat-wrapper">
                                <div class="swiper" id="slider-category">
                                    <div class="swiper-wrapper">
                                        @foreach ($subcategories as $subcategory)
                                            <div class="swiper-slide" data-animate="animate__fadeInUp">
                                                <div class="cate-info">
                                                    <div class="category-block">
                                                        <a href="{{ route('search', ['q' => $subcategory->category->name]) }}"
                                                            class="cat-img banner-hover">
                                                            <img src="{{ $subcategory->image ? asset($subcategory->image) : asset('web/img/cat/home-1-cate1.jpg') }}"
                                                                class="img-fluid" alt="{{ $subcategory->name }}">
                                                        </a>
                                                    </div>
                                                    <span
                                                        class="text-content">+{{ $subcategory->products->count() }}</span>
                                                    <h6 class="cat-title">{{ $subcategory->name }}</h6>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper-arrow">
                                    <button class="swiper-button swiper-category-prev"><i
                                            class=" feather-arrow-left"></i></button>
                                    <button class="swiper-button swiper-category-next"><i
                                            class=" feather-arrow-right"></i></button>
                                </div>
                                <div class="swiper-dots">
                                    <div class="swiper-pagination swiper-pagination-category"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- category end -->
        <!-- banner-grid start -->
        <section class="home-banner-grid section-pt">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="banner-grid-block">
                            <ul class="banner-grid-ul">
                                @foreach ($famous as $item)
                                    <li class="banner-grid-li big-banner">
                                        <div class="banner-block">
                                            <a href="{{ route('search', ['q' => $item->title]) }}">
                                                <span class="image-block">
                                                    <img src="{{ $item->image ? asset($item->image) : asset('web/img/banner/home-banner-1.jpg') }}"
                                                        class="img-fluid" alt="{{ $item->title }}">
                                                </span>
                                                <div class="banner-content banner-text-left banner-content-right">
                                                    <span class="subtitle"
                                                        data-animate="animate__fadeInUp">{{ $item->percentage }}</span>
                                                    <h2 class="title" data-animate="animate__fadeInUp">{{ $item->title }}
                                                    </h2>
                                                    <span class="banner-button btn-style"
                                                        data-animate="animate__fadeInUp">Shop now</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner-grid end -->

        <!-- product-tranding start -->
        @foreach ($categories as $category)
            @foreach ($category->subcategories as $subcategory)
                @continue ($subcategory->products->isEmpty())

                <!-- product-tranding start -->
                <section class="Trending-product bg-color section-ptb">
                    <div class="collection-category">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="section-capture">
                                        <div class="section-title">
                                            <span class="sub-title"
                                                data-animate="animate__fadeInUp">{{ $category->name }}</span>
                                            <h2><span data-animate="animate__fadeInUp">{{ $subcategory->name }}</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="collection-wrap">
                                        <div class="collection-slider swiper" id="trending-{{ $subcategory->id }}">
                                            <div class="swiper-wrapper">
                                                @foreach ($subcategory->products as $product)
                                                    @php
                                                        $hoverImage = $product->images->first()
                                                            ? asset($product->images->first()->image_path)
                                                            : ($product->image
                                                                ? asset($product->image)
                                                                : asset('web/img/product/home1-pro-2.jpg'));

                                                        $discountPercent = $product->discount_price
                                                            ? round(
                                                                (($product->price - $product->discount_price) /
                                                                    $product->price) *
                                                                    100,
                                                            )
                                                            : null;
                                                    @endphp
                                                    <div class="swiper-slide" data-animate="animate__fadeInUp">
                                                        <div class="single-product-wrap">
                                                            <div class="product-image">
                                                                <a href="{{ route('product.detail', $product->slug) }}"
                                                                    class="pro-img">
                                                                    <img src="{{ $product->image ? asset($product->image) : asset('web/img/product/home1-pro-1.jpg') }}"
                                                                        class="img-fluid img1 mobile-img1"
                                                                        alt="{{ $product->name }}">
                                                                    <img src="{{ $hoverImage }}"
                                                                        class="img-fluid img2 mobile-img2"
                                                                        alt="{{ $product->name }}">
                                                                </a>
                                                                <div class="product-action">
                                                                    <a href="#quickview" class="quickview"
                                                                        data-bs-toggle="modal" data-bs-target="#quickview"
                                                                        data-product-id="{{ $product->id }}">
                                                                        <span class="tooltip-text">Quickview</span>
                                                                        <span class="pro-action-icon"><i
                                                                                class="feather-eye"></i></span>
                                                                    </a>
                                                                    <a href="#0"
                                                                        class="add-to-cart js-add-to-cart-link">
                                                                        <span class="tooltip-text">Add to cart</span>
                                                                        <span class="pro-action-icon"><i
                                                                                class="feather-shopping-bag"></i></span>
                                                                    </a>
                                                                    <form action="{{ route('cart.add', $product->id) }}"
                                                                        method="POST" class="d-none js-add-to-cart-form">
                                                                        @csrf
                                                                    </form>
                                                                    <a href="#0"
                                                                        class="wishlist js-add-to-wishlist-link">
                                                                        <span class="tooltip-text">Wishlist</span>
                                                                        <span class="pro-action-icon"><i
                                                                                class="feather-heart"></i></span>
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('wishlist.add', $product->id) }}"
                                                                        method="POST"
                                                                        class="d-none add-to-wishlist-form">
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="product-content">
                                                                <div class="product-title">
                                                                    <h6><a
                                                                            href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                                                    </h6>
                                                                </div>
                                                                <div class="product-price">
                                                                    <div class="pro-price-box">
                                                                        <span class="new-price">Rs
                                                                            {{ number_format($product->discount_price ?? $product->price, 2) }}</span>
                                                                        @if ($product->discount_price)
                                                                            <span class="old-price">Rs
                                                                                {{ number_format($product->price, 2) }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="product-action">
                                                                    <a href="#quickview" class="quickview"
                                                                        data-bs-toggle="modal" data-bs-target="#quickview"
                                                                        data-product-id="{{ $product->id }}">
                                                                        <span class="tooltip-text">Quickview</span>
                                                                        <span class="pro-action-icon"><i
                                                                                class="feather-eye"></i></span>
                                                                    </a>
                                                                    <a href="#0"
                                                                        class="add-to-cart js-add-to-cart-link">
                                                                        <span class="tooltip-text">Add to cart</span>
                                                                        <span class="pro-action-icon"><i
                                                                                class="feather-shopping-bag"></i></span>
                                                                    </a>
                                                                    <form action="{{ route('cart.add', $product->id) }}"
                                                                        method="POST" class="d-none js-add-to-cart-form">
                                                                        @csrf
                                                                    </form>
                                                                    <a href="#0"
                                                                        class="wishlist js-add-to-wishlist-link">
                                                                        <span class="tooltip-text">Wishlist</span>
                                                                        <span class="pro-action-icon"><i
                                                                                class="feather-heart"></i></span>
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('wishlist.add', $product->id) }}"
                                                                        method="POST"
                                                                        class="d-none add-to-wishlist-form">
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="pro-label-retting">
                                                                <div class="product-ratting">
                                                                    <span class="pro-ratting">
                                                                        <i class="fa-solid fa-star"></i>
                                                                        <i class="fa-solid fa-star"></i>
                                                                        <i class="fa-solid fa-star"></i>
                                                                        <i class="fa-solid fa-star"></i>
                                                                        <i class="fa-solid fa-star"></i>
                                                                    </span>
                                                                </div>
                                                                @if ($discountPercent)
                                                                    <div class="product-label pro-new-sale">
                                                                        <span
                                                                            class="product-label-title">Sale<span>{{ $discountPercent }}%</span></span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="collection-button" data-animate="animate__fadeInUp">
                                                <a href="{{ route('search', ['q' => $subcategory->name]) }}"
                                                    class="btn btn-style2" data-animate="animate__fadeInUp">View all
                                                    item</a>
                                            </div>
                                        </div>
                                        <div class="swiper-buttons" data-animate="animate__fadeInUp">
                                            <div class="swiper-buttons-wrap">
                                                <button class="swiper-prev swiper-prev-{{ $subcategory->id }}"><span><i
                                                            class="feather-arrow-left"></i></span></button>
                                                <button class="swiper-next swiper-next-{{ $subcategory->id }}"><span><i
                                                            class="feather-arrow-right"></i></span></button>
                                            </div>
                                        </div>
                                        <div class="swiper-dots" data-animate="animate__fadeInUp">
                                            <div class="swiper-pagination swiper-pagination-{{ $subcategory->id }}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- product-tranding end -->
            @endforeach
        @endforeach
        <!-- product-tranding end -->
        <!-- our-service start -->
        <section class="our-service-area section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <ul class="grid-wrap">
                            <li class="grid-wrapper" data-animate="animate__fadeInUp">
                                <div class="ser-block">
                                    <a href="javascript:void(0)">
                                        <span class="ser-icon">
                                            <img src="{{ asset('web/img/service/home-ser1.png') }}" class="img-fluid"
                                                alt="Fast delivery Pakistan">
                                            <span></span>
                                        </span>
                                        <div class="service-text">
                                            <h6>Fast Delivery</h6>
                                            <p>Quick delivery across Pakistan</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="grid-wrapper" data-animate="animate__fadeInUp">
                                <div class="ser-block">
                                    <a href="javascript:void(0)">
                                        <span class="ser-icon">
                                            <img src="{{ asset('web/img/service/home-ser2.png') }}" class="img-fluid"
                                                alt="Secure payment COD">
                                            <span></span>
                                        </span>
                                        <div class="service-text">
                                            <h6>Cash on Delivery</h6>
                                            <p>Pay when you receive your order</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="grid-wrapper" data-animate="animate__fadeInUp">
                                <div class="ser-block">
                                    <a href="javascript:void(0)">
                                        <span class="ser-icon">
                                            <img src="{{ asset('web/img/service/home-ser3.png') }}" class="img-fluid"
                                                alt="Easy return policy">
                                            <span></span>
                                        </span>
                                        <div class="service-text">
                                            <h6>Easy Returns</h6>
                                            <p>7 days easy return policy</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="grid-wrapper" data-animate="animate__fadeInUp">
                                <div class="ser-block">
                                    <a href="javascript:void(0)">
                                        <span class="ser-icon">
                                            <img src="{{ asset('web/img/service/home-ser4.png') }}" class="img-fluid"
                                                alt="Quality products">
                                            <span></span>
                                        </span>
                                        <div class="service-text">
                                            <h6>Quality Products</h6>
                                            <p>Trusted watches, headphones & more</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- our-service end -->
        <!-- deal-day start -->
        <section class="deal-day section-pt">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="deal-day-wrap">
                            <div class="deal-day-block deal-wrap">
                                <div class="deal-block"
                                    style="background-image: url('{{ asset('web/img/deal/deal-bg.jpg') }}');">
                                    <div class="section-capture">
                                        <div class="section-title">
                                            <span data-animate="animate__fadeInUp" class="sub-title">Every day
                                                shopping</span>
                                            <h2 data-animate="animate__fadeInUp"><span>Deal of the days</span></h2>
                                        </div>
                                    </div>
                                    <div class="timer-section1" id="the-24h-countdown" data-animate="animate__fadeInUp">
                                        <ul class="clock"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- deal-day end -->
        < <!-- home-reviews-section start -->
@if($reviews->count())
<section class="reviews-section home-reviews section-ptb bg-color">
    <div class="container">
        <div class="section-capture">
            <div class="section-title">
                <span class="sub-title" data-animate="animate__fadeInUp">Verified customer feedback</span>
                <h2 data-animate="animate__fadeInUp"><span>What Our Customers Say</span></h2>
            </div>
        </div>

        <div class="home-review-slider owl-carousel owl-theme" id="home-review-slider">
            @foreach($reviews as $review)
                <div class="item">
                    <div class="review-card home-review-card">
                        <div class="review-card-head">
                            <div class="review-head-info">
                                <h6>{{ $review->name }}</h6>
                                <span>{{ optional($review->product)->name }}</span>
                            </div>
                            <div class="review-card-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                @endfor
                            </div>
                        </div>

                        <p class="review-card-comment">{{ Str::limit($review->comment, 110) }}</p>

                        @if ($review->image || $review->video)
                            <div class="review-card-media">
                                @if ($review->image)
                                    <div class="review-media-item" data-type="image"
                                        data-src="{{ asset($review->image) }}">
                                        <img src="{{ asset($review->image) }}" alt="Review photo">
                                    </div>
                                @endif
                                @if ($review->video)
                                    <div class="review-media-item" data-type="video"
                                        data-src="{{ asset($review->video) }}">
                                        <video muted preload="metadata" playsinline>
                                            <source src="{{ asset($review->video) }}#t=0.1">
                                        </video>
                                        <span class="review-media-play"><i class="fas fa-play"></i></span>
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if($review->product)
                            <a href="{{ route('product.detail', $review->product->slug) }}" class="review-product-link">View Product →</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="swiper-buttons home-review-nav">
            <div class="swiper-buttons-wrap">
                <button class="swiper-prev swiper-prev-home-review"><span><i class="feather-arrow-left"></i></span></button>
                <button class="swiper-next swiper-next-home-review"><span><i class="feather-arrow-right"></i></span></button>
            </div>
        </div>
    </div>

    <!-- reuse the same lightbox modal (only rendered once per page) -->
    <div class="review-lightbox" id="reviewLightbox">
        <button type="button" class="review-lightbox-close" aria-label="Close">&times;</button>
        <button type="button" class="review-lightbox-nav review-lightbox-prev" aria-label="Previous">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="review-lightbox-stage">
            <img class="review-lightbox-img" src="" alt="Review media">
            <video class="review-lightbox-video" controls playsinline></video>
        </div>
        <button type="button" class="review-lightbox-nav review-lightbox-next" aria-label="Next">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</section>
@endif
<!-- home-reviews-section end -->
        <!-- instagram-area start -->
        <section class="instagram section-ptb">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="section-capture">
                            <div class="section-title">
                                <span class="sub-title" data-animate="animate__fadeInUp">Our instagram shop</span>
                                <h2 data-animate="animate__fadeInUp"><span>Follow on instagram</span></h2>
                            </div>
                        </div>
                        <div class="insta-slider">
                            <div class="instagram-slider owl-carousel owl-theme" id="instagram-slider">
                                @foreach($galleryPhotos as $photo)
<div class="item" data-animate="animate__fadeInUp">
    <div class="insta-content banner-hover">
        <a href="{{ url('/') }}" class="insta-img">
            <img src="{{ asset($photo->photo) }}" class="img-fluid"
                alt="{{ $photo->title ?? 'Al Ahmad Store' }}">
        </a>
    </div>
</div>
@endforeach

                            </div>
                            <div class="insta-button" data-animate="animate__fadeInUp">
                                <a href="{{ route('search') }}" class="btn btn-style2"> Shop Know </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- instagram-area end -->
        <!-- brand-logo start -->
        <div class="brand-logo">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="brand-logo-wrap">
                            <div class="brand-logo-slider owl-carousel owl-theme" id="home1-brand-logo">
                                <div class="item">
                                    <a href="{{ url('/') }}">
                                        <span class="brand-img" data-animate="animate__fadeInUp">
                                            <img src="{{ asset('web/img/brand-logo/home1-brand-logo1.png') }}"
                                                class="img-fluid" alt="brand-logo1">
                                        </span>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ url('/') }}">
                                        <span class="brand-img" data-animate="animate__fadeInUp">
                                            <img src="{{ asset('web/img/brand-logo/home1-brand-logo2.png') }}"
                                                class="img-fluid" alt="brand-logo2">
                                        </span>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ url('/') }}">
                                        <span class="brand-img" data-animate="animate__fadeInUp">
                                            <img src="{{ asset('web/img/brand-logo/home1-brand-logo3.png') }}"
                                                class="img-fluid" alt="brand-logo3">
                                        </span>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ url('/') }}">
                                        <span class="brand-img" data-animate="animate__fadeInUp">
                                            <img src="{{ asset('web/img/brand-logo/home1-brand-logo4.png') }}"
                                                class="img-fluid" alt="brand-logo4">
                                        </span>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ url('/') }}">
                                        <span class="brand-img" data-animate="animate__fadeInUp">
                                            <img src="{{ asset('web/img/brand-logo/home1-brand-logo5.png') }}"
                                                class="img-fluid" alt="brand-logo5">
                                        </span>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ url('/') }}">
                                        <span class="brand-img" data-animate="animate__fadeInUp">
                                            <img src="{{ asset('web/img/brand-logo/home1-brand-logo6.png') }}"
                                                class="img-fluid" alt="brand-logo6">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand-logo end -->


    </main>
    <!-- main end -->


@endsection
