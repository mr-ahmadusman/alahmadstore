@section('title', 'Shopping Cart | Al Ahmad Store')
@section('meta_description', 'View your shopping cart at Al Ahmad Store. Review items and proceed to checkout with Cash on Delivery across Pakistan.')
@section('meta_keywords', 'shopping cart, al ahmad store, checkout pakistan')

{{-- Cart page ko Google index na kare --}}
@section('meta_robots', 'noindex, follow')

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
                                    <span class="breadcrumb-text">Your shopping cart</span>
                                </li>
                            </ul>
                            <!-- breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb end -->
        <!-- cart-page start -->
        <section class="cart-page section-ptb">
            @if (count($cartItems) === 0)
                <div class="container">
                    <div class="row">
                        <div class="col text-center" style="padding: 60px 0;">
                            <h4>Your cart is currently empty</h4>
                            <p><a href="{{ route('search') }}" class="btn-style2">Continue shopping</a></p>
                        </div>
                    </div>
                </div>
            @else
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="cart-page-wrap">
                                <div class="cart-wrap-info">
                                    <div class="cart-item-wrap">
                                        <div class="cart-title">
                                            <h6 data-animate="animate__fadeInUp">My cart:</h6>
                                            <span class="cart-count" data-animate="animate__fadeInUp">
                                                <span class="cart-counter">{{ count($cartItems) }}</span>
                                                <span class="cart-item-title">Items</span>
                                            </span>
                                        </div>
                                        <div class="item-wrap">
                                            @foreach ($cartItems as $item)
                                                <ul class="cart-wrap">
                                                    <!-- cart-info start -->
                                                    <li class="item-info">
                                                        <!-- cart-img start -->
                                                        <div class="item-img">
                                                            <a href="{{ route('product.detail', $item['id']) }}"
                                                                data-animate="animate__fadeInUp">
                                                                <img src="{{ asset($item['image']) }}" class="img-fluid"
                                                                    alt="{{ $item['name'] }}">
                                                            </a>
                                                        </div>
                                                        <!-- cart-img end -->
                                                        <!-- cart-title start -->
                                                        <div class="item-text">
                                                            <a href="{{ route('product.detail', $item['id']) }}"
                                                                data-animate="animate__fadeInUp">{{ $item['name'] }}</a>
                                                            <span class="item-option" data-animate="animate__fadeInUp">
                                                                <span class="item-price">Rs
                                                                    {{ number_format($item['price'], 2) }}</span>
                                                            </span>
                                                        </div>
                                                        <!-- cart-title send -->
                                                    </li>
                                                    <!-- cart-info end -->
                                                    <!-- cart-qty start -->
                                                    <li class="item-qty">
                                                        <form action="{{ route('cart.update', $item['id']) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="product-quantity-action">
                                                                <div class="product-quantity"
                                                                    data-animate="animate__fadeInUp">
                                                                    <div class="cart-plus-minus">
                                                                        <button type="submit" name="action"
                                                                            value="decrease"
                                                                            class="qtybutton minus"><i
                                                                                class="fa-solid fa-minus"></i></button>
                                                                        <input type="text" value="{{ $item['quantity'] }}"
                                                                            class="cart-qty-input" readonly>
                                                                        <button type="submit" name="action"
                                                                            value="increase"
                                                                            class="qtybutton plus"><i
                                                                                class="fa-solid fa-plus"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="item-remove">
                                                            <span class="remove-wrap" data-animate="animate__fadeInUp">
                                                                <form action="{{ route('cart.remove', $item['id']) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="text-danger"
                                                                        style="background:none;border:none;padding:0;">Remove</button>
                                                                </form>
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <!-- cart-qty end -->
                                                    <!-- cart-price start -->
                                                    <li class="item-price" data-animate="animate__fadeInUp">
                                                        @php
                                                            $itemSubtotal = $item['subtotal'] ?? ($item['price'] * $item['quantity']);
                                                        @endphp
                                                        <span class="amount full-price">Rs
                                                            {{ number_format($itemSubtotal, 2) }}</span>
                                                    </li>
                                                    <!-- cart-price end -->
                                                </ul>
                                            @endforeach
                                        </div>
                                        <div class="cart-buttons" style="gap: 10px" data-animate="animate__fadeInUp">
                                            <a href="{{ route('search') }}" class="btn-style2">Continue shopping</a>
                                            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn-style2">Clear cart</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-info-wrap">
                                    <div class="cart-total-wrap cart-info">
                                        <div class="cart-total">
                                            <div class="total-amount" data-animate="animate__fadeInUp">
                                                <h6 class="total-title">Free home delivery</h6>
                                                <span class="amount total-price">Rs 0.00</span>
                                            </div>
                                            <div class="total-amount" data-animate="animate__fadeInUp">
                                                <h6 class="total-title">Total</h6>
                                                <span class="amount total-price">Rs
                                                    {{ number_format($total, 2) }}</span>
                                            </div>
                                            <div class="proceed-to-checkout" data-animate="animate__fadeInUp">
                                                <a href="{{ route('checkout.show') }}" class="btn btn-style2">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
        <!-- cart-page end -->

        <!-- product-tranding start -->
        @if (isset($relatedProducts) && $relatedProducts->isNotEmpty())
            <section class="Trending-product bg-color section-ptb">
                <div class="collection-category">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="section-capture">
                                    <div class="section-title">
                                        <span class="sub-title" data-animate="animate__fadeInUp">Browse collection</span>
                                        <h2><span data-animate="animate__fadeInUp">Related products</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="collection-wrap">
                                    <div class="collection-slider swiper" id="trending-related">
                                        <div class="swiper-wrapper">
                                            @foreach ($relatedProducts as $rp)
                                                @php
                                                    $rpHover = $rp->images->first()
                                                        ? asset($rp->images->first()->image_path)
                                                        : ($rp->image
                                                            ? asset($rp->image)
                                                            : asset('web/img/product/home1-pro-2.jpg'));

                                                    $rpDiscountPercent = $rp->discount_price
                                                        ? round((($rp->price - $rp->discount_price) / $rp->price) * 100)
                                                        : null;
                                                @endphp
                                                <div class="swiper-slide" data-animate="animate__fadeInUp">
                                                    <div class="single-product-wrap">
                                                        <div class="product-image">
                                                            <a href="{{ route('product.detail', $rp->slug) }}"
                                                                class="pro-img">
                                                                <img src="{{ $rp->image ? asset($rp->image) : asset('web/img/product/home1-pro-1.jpg') }}"
                                                                    class="img-fluid img1 mobile-img1"
                                                                    alt="{{ $rp->name }}">
                                                                <img src="{{ $rpHover }}"
                                                                    class="img-fluid img2 mobile-img2"
                                                                    alt="{{ $rp->name }}">
                                                            </a>
                                                            <div class="product-action">
                                                                <a href="#quickview" class="quickview"
                                                                    data-bs-toggle="modal" data-bs-target="#quickview"
                                                                    data-product-id="{{ $rp->id }}">
                                                                    <span class="tooltip-text">Quickview</span>
                                                                    <span class="pro-action-icon"><i
                                                                            class="feather-eye"></i></span>
                                                                </a>
                                                                <a href="#0" class="add-to-cart js-add-to-cart-link">
                                                                    <span class="tooltip-text">Add to cart</span>
                                                                    <span class="pro-action-icon"><i
                                                                            class="feather-shopping-bag"></i></span>
                                                                </a>
                                                                <form action="{{ route('cart.add', $rp->id) }}"
                                                                    method="POST" class="d-none js-add-to-cart-form">
                                                                    @csrf
                                                                </form>
                                                                <a href="#0" class="wishlist js-add-to-wishlist-link">
                                                                    <span class="tooltip-text">Wishlist</span>
                                                                    <span class="pro-action-icon"><i
                                                                            class="feather-heart"></i></span>
                                                                </a>
                                                                <form action="{{ route('wishlist.add', $rp->id) }}"
                                                                    method="POST" class="d-none add-to-wishlist-form">
                                                                    @csrf
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            <div class="product-sub-title">
                                                                <span>{{ $rp->name }}</span>
                                                            </div>
                                                            <div class="product-title">
                                                                <h6><a
                                                                        href="{{ route('product.detail', $rp->slug) }}">{{ $rp->name }}</a>
                                                                </h6>
                                                            </div>
                                                            <div class="product-price">
                                                                <div class="pro-price-box">
                                                                    <span class="new-price">Rs
                                                                        {{ number_format($rp->discount_price ?? $rp->price, 2) }}</span>
                                                                    @if ($rp->discount_price)
                                                                        <span class="old-price">Rs
                                                                            {{ number_format($rp->price, 2) }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="product-action">
                                                                <a href="#quickview" class="quickview"
                                                                    data-bs-toggle="modal" data-bs-target="#quickview"
                                                                    data-product-id="{{ $rp->id }}">
                                                                    <span class="tooltip-text">Quickview</span>
                                                                    <span class="pro-action-icon"><i
                                                                            class="feather-eye"></i></span>
                                                                </a>
                                                                <a href="#0" class="add-to-cart js-add-to-cart-link">
                                                                    <span class="tooltip-text">Add to cart</span>
                                                                    <span class="pro-action-icon"><i
                                                                            class="feather-shopping-bag"></i></span>
                                                                </a>
                                                                <form action="{{ route('cart.add', $rp->id) }}"
                                                                    method="POST" class="d-none js-add-to-cart-form">
                                                                    @csrf
                                                                </form>
                                                                <a href="#0" class="wishlist js-add-to-wishlist-link">
                                                                    <span class="tooltip-text">Wishlist</span>
                                                                    <span class="pro-action-icon"><i
                                                                            class="feather-heart"></i></span>
                                                                </a>
                                                                <form action="{{ route('wishlist.add', $rp->id) }}"
                                                                    method="POST" class="d-none add-to-wishlist-form">
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
                                                            @if ($rpDiscountPercent)
                                                                <div class="product-label pro-new-sale">
                                                                    <span
                                                                        class="product-label-title">Sale<span>{{ $rpDiscountPercent }}%</span></span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-buttons">
                        <div class="swiper-buttons-wrap">
                            <button class="swiper-prev swiper-prev-related"><span><i
                                        class="feather-arrow-left"></i></span></button>
                            <button class="swiper-next swiper-next-related"><span><i
                                        class="feather-arrow-right"></i></span></button>
                        </div>
                    </div>
                    <div class="swiper-dots">
                        <div class="swiper-pagination swiper-pagination-related"></div>
                    </div>
                </div>
            </section>
        @endif
        <!-- product-tranding end -->
    </main>
    <!-- main section end-->

@endsection
