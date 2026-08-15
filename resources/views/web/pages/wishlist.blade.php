@section('title', 'My Wishlist | Al Ahmad Store')
@section('meta_description', 'Your saved wishlist items at Al Ahmad Store.')
@section('meta_robots', 'noindex, follow')

@extends('web.layouts.app')
@section('content')

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
                            <span class="breadcrumb-text">wishlist</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb end -->

<!-- wishlist-product start -->
<section class="wishlist-product section-ptb">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="wishlist-page" id="wishlist-page-content">
                    @forelse ($wishlistItems as $item)
                        <div class="wishlist-area" data-wishlist-row="{{ $item['id'] }}">
                            <div class="wishlist-details">
                                @if ($loop->first)
                                    <div class="wishlist-item" data-animate="animate__fadeInUp">
                                        <span class="wishlist-head">My wishlist:</span>
                                        <span class="sp-link-title">{{ count($wishlistItems) }} Item</span>
                                    </div>
                                @endif
                                <div class="wishlist-all-pro">
                                    <div class="wishlist-pro">
                                        <div class="wishlist-pro-image">
                                            <a href="{{ route('product.detail', $item['slug']) }}" data-animate="animate__fadeInUp">
                                                <img src="{{ $item['image'] ? asset($item['image']) : asset('web/img/menu/home-pro-banner1.jpg') }}"
                                                    class="img-fluid" alt="{{ $item['name'] }}">
                                            </a>
                                        </div>
                                        <div class="pro-details">
                                            <h6>
                                                <a href="{{ route('product.detail', $item['slug']) }}" data-animate="animate__fadeInUp">{{ $item['name'] }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="qty-item">
                                        <a href="#0" class="add-wishlist js-add-to-cart-link" data-animate="animate__fadeInUp">Add to cart</a>
                                        <form action="{{ route('cart.add', $item['id']) }}" method="POST" class="d-none js-add-to-cart-form">
                                            @csrf
                                        </form>
                                        <a href="{{ route('product.detail', $item['slug']) }}" class="add-wishlist" data-animate="animate__fadeInUp">Buy now</a>
                                    </div>
                                    <div class="all-pro-price">
                                        <div class="price-box" data-animate="animate__fadeInUp">
                                            <span class="new-price">Rs {{ number_format($item['price'], 2) }}</span>
                                        </div>
                                        <a href="{{ route('wishlist.remove', $item['id']) }}" class="wishalist-icon js-wishlist-remove" data-animate="animate__fadeInUp">
                                            <i class="fa fa-heart text-danger"></i>
                                        </a>
                                    </div>
                                </div>

                                @if ($loop->last)
    <div class="other-link">
        <ul class="other-ul d-flex justify-content-between flex-wrap gap-2">
            <li class="wishlist-other-link" data-animate="animate__fadeInUp">
                <a href="{{ route('search') }}" class="btn btn-style2">Continue shopping</a>
            </li>
            <li class="wishlist-other-link" data-animate="animate__fadeInUp">
                <a href="{{ route('wishlist.clear') }}" class="btn btn-style2 js-wishlist-clear">Clear wishlist</a>
            </li>
        </ul>
    </div>
@endif
                            </div>
                        </div>
                    @empty
                        <div class="wishlist-area">
                            <div class="wishlist-details text-center py-5">
                                <h4>Your wishlist is currently empty</h4>
                                <a href="{{ route('search') }}" class="btn btn-style2 mt-3">Continue shopping</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- wishlist-product end -->

@endsection
