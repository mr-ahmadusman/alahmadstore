@section('title', !empty($keyword)
    ? 'Buy ' . $keyword . ' Online in Pakistan | Al Ahmad Store'
    : 'Shop All Products | Al Ahmad Store Pakistan')

@section('meta_description', !empty($keyword)
    ? 'Shop ' . $keyword . ' at Al Ahmad Store. Best price in Pakistan with Cash on Delivery. Quality watches, headphones, clothing & more.'
    : 'Browse all products at Al Ahmad Store – watches, Bluetooth headphones, phone accessories, hair machines, men’s & women’s clothing. COD available.')

@section('meta_keywords', !empty($keyword)
    ? $keyword . ', buy ' . $keyword . ' pakistan, al ahmad store, cash on delivery'
    : 'shop online pakistan, watches, headphones, clothing, al ahmad store')

@extends('web.layouts.app')
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
                                <span class="breadcrumb-text">
                                    @if(!empty($keyword))
                                        "{{ $keyword }}"
                                    @else
                                        Search
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- search section start -->
    <section class="search-page bg-color section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Title -->
                    <div class="section-capture">
                        <div class="section-title">
                            <h2 data-animate="animate__fadeInUp">
                                <span>
                                    @if(!empty($keyword))
                                        Your search for "{{ $keyword }}" revealed the following:
                                    @else
                                        Search our store
                                    @endif
                                </span>
                            </h2>
                        </div>
                    </div>

                    <!-- Search Form -->
                    <div class="saerch-input" data-animate="animate__fadeInUp">
    <form action="{{ route('search') }}" method="GET">
        <input type="text"
               name="q"
               value="{{ $keyword ?? request('q') }}"
               placeholder="Search our store"
               required>
        <a href="javascript:void(0)"
           class="search-btn"
           onclick="this.closest('form').submit();">
            <i class="fa-solid fa-magnifying-glass"></i>
        </a>
    </form>
</div>

                    @if($products->count())

                        <!-- Products -->
                        <div class="special-product grid-3">
                            <div class="collection-category">
                                <div class="row">
                                    <div class="col">
                                        <div class="collection-wrap">
                                            <ul class="product-view-ul">

                                                @foreach($products as $product)
                                                    @php
                                                        $hoverImage = $product->images->first()
                                                            ? asset($product->images->first()->image_path ?? $product->images->first()->image)
                                                            : ($product->image
                                                                ? asset($product->image)
                                                                : asset('web/img/product/home1-pro-2.jpg'));

                                                        $discountPercent = $product->discount_price
                                                            ? round((($product->price - $product->discount_price) / $product->price) * 100)
                                                            : null;
                                                    @endphp

                                                    <li class="pro-item-li" data-animate="animate__fadeInUp">
                                                        <div class="single-product-wrap">

                                                            <!-- Product Image -->
                                                            <div class="product-image">
                                                                <a href="{{ route('product.detail', $product->slug) }}" class="pro-img">
                                                                    <img src="{{ $product->image ? asset($product->image) : asset('web/img/product/home1-pro-1.jpg') }}"
                                                                         class="img-fluid img1 mobile-img1"
                                                                         alt="{{ $product->name }}">
                                                                    <img src="{{ $hoverImage }}"
                                                                         class="img-fluid img2 mobile-img2"
                                                                         alt="{{ $product->name }}">
                                                                </a>

                                                                <div class="product-action">
                                                                    <a href="#quickview"
                                                                       class="quickview"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#quickview"
                                                                       data-product-id="{{ $product->id }}">
                                                                        <span class="tooltip-text">Quickview</span>
                                                                        <span class="pro-action-icon"><i class="feather-eye"></i></span>
                                                                    </a>

                                                                    <a href="#0" class="add-to-cart js-add-to-cart-link">
                                                                        <span class="tooltip-text">Add to cart</span>
                                                                        <span class="pro-action-icon"><i class="feather-shopping-bag"></i></span>
                                                                    </a>
                                                                    <form action="{{ route('cart.add', $product->id) }}"
                                                                          method="POST"
                                                                          class="d-none js-add-to-cart-form">
                                                                        @csrf
                                                                    </form>

                                                                    <a href="#0" class="wishlist js-add-to-wishlist-link">
                                                                        <span class="tooltip-text">Wishlist</span>
                                                                        <span class="pro-action-icon"><i class="feather-heart"></i></span>
                                                                    </a>
                                                                    <form action="{{ route('wishlist.add', $product->id) }}"
                                                                          method="POST"
                                                                          class="d-none add-to-wishlist-form">
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                            </div>

                                                            <!-- Product Content -->
                                                            <div class="product-content">
                                                                <div class="product-sub-title">
                                                                    <span>{{ $product->subcategory->name ?? ($product->category->name ?? '') }}</span>
                                                                </div>

                                                                <div class="product-title">
                                                                    <h6>
                                                                        <a href="{{ route('product.detail', $product->slug) }}">
                                                                            {{ $product->name }}
                                                                        </a>
                                                                    </h6>
                                                                </div>

                                                                <div class="product-price">
                                                                    <div class="pro-price-box">
                                                                        <span class="new-price">
                                                                            Rs {{ number_format($product->discount_price ?? $product->price, 2) }}
                                                                        </span>
                                                                        @if($product->discount_price)
                                                                            <span class="old-price">
                                                                                Rs {{ number_format($product->price, 2) }}
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="product-action">
                                                                    <a href="#quickview"
                                                                       class="quickview"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#quickview"
                                                                       data-product-id="{{ $product->id }}">
                                                                        <span class="tooltip-text">Quickview</span>
                                                                        <span class="pro-action-icon"><i class="feather-eye"></i></span>
                                                                    </a>

                                                                    <a href="#0" class="add-to-cart js-add-to-cart-link">
                                                                        <span class="tooltip-text">Add to cart</span>
                                                                        <span class="pro-action-icon"><i class="feather-shopping-bag"></i></span>
                                                                    </a>
                                                                    <form action="{{ route('cart.add', $product->id) }}"
                                                                          method="POST"
                                                                          class="d-none js-add-to-cart-form">
                                                                        @csrf
                                                                    </form>

                                                                    <a href="#0" class="wishlist js-add-to-wishlist-link">
                                                                        <span class="tooltip-text">Wishlist</span>
                                                                        <span class="pro-action-icon"><i class="feather-heart"></i></span>
                                                                    </a>
                                                                    <form action="{{ route('wishlist.add', $product->id) }}"
                                                                          method="POST"
                                                                          class="d-none add-to-wishlist-form">
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                            </div>

                                                            <!-- Rating + Sale -->
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

                                                                @if($discountPercent)
                                                                    <div class="product-label pro-new-sale">
                                                                        <span class="product-label-title">
                                                                            Sale<span>{{ $discountPercent }}%</span>
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>

                                        <!-- Pagination -->
                                        <div class="paginatoin-area mt-4">
                                            {{ $products->links() }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <!-- No Results -->
                        <div class="text-center py-5" data-animate="animate__fadeInUp">
                            <h3 class="mb-3">No Products Found</h3>
                            <p class="mb-4">
                                No products matched <strong>"{{ $keyword }}"</strong>
                            </p>
                            <a href="{{ url('/') }}" class="btn btn-style2">
                                Back to Home
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- search section end -->
</main>

@endsection
