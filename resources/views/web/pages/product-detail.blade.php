@section('title', $product->name . ' | Buy Online at Al Ahmad Store Pakistan')
@section('meta_description',
    'Buy ' .
    $product->name .
    ' online at Al Ahmad Store. Best price in Pakistan with Cash on
    Delivery. ' .
    \Illuminate\Support\Str::limit(strip_tags($product->description ?? $product->name), 120))
@section('meta_keywords', $product->name . ', ' . ($product->subcategory->name ?? '') . ', ' . ($product->category->name
    ?? '') . ', buy online pakistan, al ahmad store, cash on delivery')

    @extends('web.layouts.app')
@section('content')
    @php
        // Gallery ke liye images: pehle main product image, phir gallery images.
        // Agar koi image hi nahi hai to ek default placeholder dikha do (quickview jaisa hi pattern)
        $images = collect();
        if ($product->image) {
            $images->push(asset($product->image));
        }
        foreach ($product->images as $img) {
            $images->push(asset($img->image_path));
        }
        if ($images->isEmpty()) {
            $images->push(asset('web/img/product/home1-pro-1.jpg'));
        }

        $discountPercent = $product->discount_price
            ? round((($product->price - $product->discount_price) / $product->price) * 100)
            : null;
    @endphp

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
                                @if ($product->category)
                                    <li class="breadcrumb-li">
                                        <a class="breadcrumb-link"
                                            href="{{ route('search', ['q' => $product->category->name]) }}">
                                            {{ $product->category->name }}
                                        </a>
                                    </li>
                                @endif
                                @if ($product->subcategory)
                                    <li class="breadcrumb-li">
                                        <a class="breadcrumb-link"
                                            href="{{ route('search', ['q' => $product->subcategory->name]) }}">
                                            {{ $product->subcategory->name }}
                                        </a>
                                    </li>
                                @endif
                                <li class="breadcrumb-li">
                                    <span class="breadcrumb-text">{{ $product->name }}</span>
                                </li>
                            </ul>
                            <!-- breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb end -->
        <!-- pro-detail-page start -->
        <section class="product-details-page pro-style1 section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="pro-details-pos pro-details-left-pos">
                            <!-- Product slider start -->
                            <div class="product-detail-slider product-details-tb product-details">
                                <!-- Product slider start -->
                                <div class="product-detail-img product-detail-img-bottom">
                                    <!-- top slick-slider start -->
                                    <div class="product-img-top">
                                        <button class="full-view"><i class="bi bi-arrows-fullscreen"></i></button>
                                        <div class="slider-big slick-slider">
                                            @foreach ($images as $img)
                                                <div class="slick-slide">
                                                    <a href="{{ $img }}" class="product-single">
                                                        <figure class="zoom" onmousemove="zoom(event)"
                                                            style="background-image: url('{{ $img }}');">
                                                            <img src="{{ $img }}" class="img-fluid"
                                                                alt="{{ $product->name }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- top slick-slider end -->
                                    <!-- small slick-slider start -->
                                    <div class="pro-slider">
                                        <div class="slider-small pro-detail-slider small-slider">
                                            @foreach ($images as $img)
                                                <div class="slick-slide">
                                                    <a href="javascript:void(0)" class="product-single--thumbnail">
                                                        <img src="{{ $img }}" class="img-fluid"
                                                            alt="{{ $product->name }}">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- small slick-slider end -->
                                </div>
                                <!-- Product slider end -->
                            </div>
                            <!-- peoduct detail start -->
                            <div class="product-details-wrap product-details-tb product-details">
                                <div class="product-details-info">
                                    <div class="pro-nprist">
                                        <div class="product-info">
                                            <!--  product-ratting start -->
                                            <div class="product-ratting">
                                                <span class="pro-ratting">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </span>
                                                <span class="spr-badge-caption">3 Reviews</span>
                                            </div>
                                            <!--  product-ratting end -->
                                        </div>
                                        <div class="product-info">
                                            <!-- product-title start -->
                                            <div class="product-title">
                                                <h2>{{ $product->name }}</h2>
                                            </div>
                                            <!-- product-title end -->
                                        </div>
                                        <div class="product-info">
                                            <div class="pro-prlb pro-sale">
                                                <div class="price-box">
                                                    @if ($product->discount_price)
                                                        <span class="new-price">Rs
                                                            {{ number_format($product->discount_price, 2) }}</span>
                                                        <span class="old-price">Rs
                                                            {{ number_format($product->price, 2) }}</span>
                                                        <span class="percent-count">{{ $discountPercent }}</span>
                                                    @else
                                                        <span class="new-price">Rs
                                                            {{ number_format($product->price, 2) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <div class="product-inventory">
                                                <div class="stock-inventory stock-more">
                                                    @if ($product->stock > 0)
                                                        <p class="text-success">Hurry up! only
                                                            <span
                                                                class="available-stock bg-success">{{ $product->stock }}</span>
                                                            <span>products left in stock!</span>
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="product-variant">
                                                    <h6>Availability:</h6>
                                                    @if ($product->stock > 0)
                                                        <span class="stock-qty in-stock text-success">
                                                            <span>In stock<i class="bi bi-check2"></i></span>
                                                        </span>
                                                    @else
                                                        <span class="stock-qty out-stock text-danger">
                                                            <span>Out of stock</span>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <div class="pro-detail-action">
                                                <form method="get" class="cart">
                                                    <div class="product-variant-option">
                                                        <div class="swatch-variant">
                                                            <div class="swatch clearfix Color">
                                                                <div class="header">
                                                                    <h6><span>Color</span></h6>
                                                                </div>
                                                                <div class="variant-wrap">
                                                                    <div class="variant-property">
                                                                        <div class="swatch-element Black first-variant">
                                                                            <input type="radio" name="option-0"
                                                                                value="Black" checked>
                                                                            <label>Black</label>
                                                                        </div>
                                                                        <div class="swatch-element Red">
                                                                            <input type="radio" name="option-0"
                                                                                value="Red">
                                                                            <label>Red</label>
                                                                        </div>
                                                                        <div class="swatch-element Green">
                                                                            <input type="radio" name="option-0"
                                                                                value="Green">
                                                                            <label>Green</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Quantity + Add to cart + Buy now: ek hi form, quantity value isi se cart ko jaati hai -->
                                        <form method="post" id="pd-add-to-cart-form"
                                            action="{{ route('cart.add', $product->id) }}">
                                            @csrf
                                            <input type="hidden" name="redirect_to_cart" value="1">
                                            <div class="product-info">
                                                <div class="product-quantity-action">
                                                    <h6>Quantity:</h6>
                                                    <div class="product-quantity">
                                                        <div class="cart-plus-minus">
                                                            <button type="button" class="dec qtybutton minus"><i
                                                                    class="fa-solid fa-minus"></i></button>
                                                            <input type="text" name="quantity" id="pd-quantity"
                                                                value="1">
                                                            <button type="button" class="inc qtybutton plus"><i
                                                                    class="fa-solid fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-actions">
                                                    <!-- pro-deatail button start -->
                                                    <div class="pro-detail-button" style="gap: 15px">
                                                        <button type="submit" class="btn add-to-cart ajax-spin-cart">
                                                            <span class="cart-title">Add to cart</span>
                                                        </button>
                                                    </div>
                                                    <!-- pro-deatail button start -->
                                                </div>
                                            </div>
                                        </form>

                                        <div class="product-info">
                                            <div class="product-actions">
                                                <!-- pro-deatail wishlist start -->
                                                <div class="pro-aff-che">
                                                    <form action="{{ route('wishlist.add', $product->id) }}"
                                                        method="POST" class="wishlist-inline-form">
                                                        @csrf
                                                        <button type="submit" class="wishlist"
                                                            style="background:none;border:none;padding:0;">
                                                            <span
                                                                class="wishlist-icon action-wishlist tile-actions--btn wishlist-btn">
                                                                <span class="add-wishlist"><i
                                                                        class="bi bi-heart"></i></span>
                                                            </span>
                                                            <span class="wishlist-text">Wishlist</span>
                                                        </button>
                                                    </form>
                                                </div>
                                                <!-- pro-deatail wishlist end -->
                                            </div>
                                        </div>

                                        <div class="product-info">
                                            <div class="form-group">
                                                <a href="#deliver-modal" data-bs-toggle="modal">Delivery &amp; return</a>
                                            </div>
                                        </div>
                                        <div class="modal fade deliver-modal" id="deliver-modal" tabindex="-1"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <button type="button" class="pop-close" data-bs-dismiss="modal"
                                                            aria-label="Close"><i class="feather-x"></i></button>
                                                        <div class="delivery-block">
                                                            <div class="space-block">
                                                                <h4>Delivery</h4>
                                                                <p>We deliver across Pakistan through reliable courier
                                                                    partners.</p>
                                                                <p>Estimated delivery time is 2–5 working days in major
                                                                    cities.</p>
                                                                <p>Cash on Delivery is available on most products.</p>
                                                            </div>
                                                            <div class="space-block">
                                                                <h4>Returns</h4>
                                                                <p>Items can be returned within 7 days of delivery if
                                                                    damaged or not as described.</p>
                                                                <p>Product must be in original condition with tags and
                                                                    packaging.</p>
                                                                <p>Contact our support team to raise a return request.</p>
                                                            </div>
                                                            <div class="space-block">
                                                                <h4>Help</h4>
                                                                <p>If you have any questions, feel free to contact us.</p>
                                                                <p>Email: <a
                                                                        href="mailto:{{ optional($footerContact)->email ?? 'info@alahmadstore.com' }}">{{ optional($footerContact)->email ?? 'info@alahmadstore.com' }}</a>
                                                                </p>
                                                                <p>Phone: <a
                                                                        href="tel:{{ optional($footerContact)->phone ?? '' }}">{{ optional($footerContact)->phone ?? '' }}</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <p><span>🚚</span> Item will be delivered on or before <span
                                                    id="ten-days-ahead">{{ now()->addDays(10)->format('M j Y') }}</span>
                                            </p>
                                        </div>
                                        <div class="product-info">
                                            <div class="product-sku">
                                                <h6>SKU:</h6>
                                                <span class="variant-sku">AAS-{{ $product->id }}</span>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <div class="share-icons">
                                                <h6>Share:</h6>
                                                <div class="pro-social">
                                                    <ul class="social-icon">
                                                        <li class="facebook">
                                                            <a href="{{ $social->facebook ?? '#' }}" target="_blank"
                                                                rel="noopener"><svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 320 512">
                                                                    <path
                                                                        d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z">
                                                                    </path>
                                                                </svg></a>
                                                        </li>
                                                        <li class="twitter">
                                                            <a href="https://twitter.com/"><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 512 512">
                                                                    <path
                                                                        d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z">
                                                                    </path>
                                                                </svg></a>
                                                        </li>
                                                        <li class="pinterest">
                                                            <a href="https://pinterest.com/"><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 384 512">
                                                                    <path
                                                                        d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z">
                                                                    </path>
                                                                </svg></a>
                                                        </li>
                                                        <li class="instagram">
                                                            <a href="{{ $social->instagram ?? '#' }}" target="_blank"
                                                                rel="noopener"><svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 448 512">
                                                                    <path
                                                                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                                                    </path>
                                                                </svg></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- peoduct detail end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- pro-detail-page end -->
        <!-- reviews-section start -->
        <section class="reviews-section section-ptb">
            <div class="container">
                <div class="section-capture">
                    <div class="section-title">
                        <h2 data-animate="animate__fadeInUp"><span>Customer Reviews</span></h2>
                    </div>
                    @php
                        $avgRating = $product->averageRating();
                        $totalReviews = $product->reviews->count();
                    @endphp
                    <div class="review-summary" data-animate="animate__fadeInUp">
                        <div class="review-summary-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= round($avgRating) ? 'fas' : 'far' }} fa-star"></i>
                            @endfor
                        </div>
                        <span class="review-summary-text">{{ $avgRating }} out of 5 ({{ $totalReviews }}
                            {{ Str::plural('review', $totalReviews) }})</span>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mb-4" data-animate="animate__fadeInUp">{{ session('success') }}</div>
                @endif

                <div class="row">
                    <!-- LEFT: Write a review form -->
                    <div class="col-lg-6" data-animate="animate__fadeInUp">
                        <div class="review-form-card">
                            <h4 class="review-form-title">Write a Review</h4>

                            <form method="POST" action="{{ route('review.store', $product->id) }}"
                                enctype="multipart/form-data" id="reviewForm">
                                @csrf

                                <div class="review-rating-input mb-3">
                                    <label class="review-label">Your Rating</label>
                                    <div class="star-rating-input" id="starRatingInput">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="far fa-star" data-value="{{ $i }}"></i>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" id="ratingValue" value="{{ old('rating') }}"
                                        required>
                                    @error('rating')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="review-label">Name</label>
                                        <input type="text" name="name" class="form-control review-input"
                                            placeholder="Your name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="review-label">Email</label>
                                        <input type="email" name="email" class="form-control review-input"
                                            placeholder="Your email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="review-label">Your Review</label>
                                    <textarea name="comment" rows="4" class="form-control review-input"
                                        placeholder="Share your experience with this product...">{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="review-label">Add Photo <small>(optional, max 20MB)</small></label>
                                        <input type="file" name="image" class="form-control review-input"
                                            accept="image/*">
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="review-label">Add Video <small>(optional, max 50MB)</small></label>
                                        <input type="file" name="video" class="form-control review-input"
                                            accept="video/*">
                                        @error('video')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-style2 review-submit-btn">Submit Review</button>
                            </form>
                        </div>
                    </div>

                    <!-- RIGHT: Reviews list -->
                    <div class="col-lg-6" data-animate="animate__fadeInUp">
                        <div class="review-list-wrap">
                            @forelse ($product->reviews as $review)
                                <div class="review-card">
                                    <div class="review-card-head">
                                        <div class="review-avatar">{{ Str::upper(Str::substr($review->name, 0, 1)) }}
                                        </div>
                                        <div class="review-head-info">
                                            <h6>{{ $review->name }}</h6>
                                            <span>{{ $review->created_at->format('d M, Y') }}</span>
                                        </div>
                                        <div class="review-card-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="review-card-comment">{{ $review->comment }}</p>

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
                                </div>
                            @empty
                                <div class="review-empty">
                                    <p>No reviews yet. Be the first to review this product!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- review lightbox/slider modal -->
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
                <!-- review lightbox/slider modal end -->
            </div>
        </section>
        <!-- reviews-section end -->

        <style>
            .reviews-section .review-summary {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 30px;
            }

            .review-summary-stars i {
                color: #f5a623;
                font-size: 18px;
                margin-right: 2px;
            }

            .review-summary-text {
                font-size: 14px;
                color: #666;
                font-weight: 500;
            }

            .review-form-card {
                background: #fff;
                border-radius: 16px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
                padding: 32px;
                border: 1px solid #f0f0f0;
                height: 100%;
            }

            .review-form-title {
                font-size: 20px;
                font-weight: 700;
                margin-bottom: 22px;
                color: #1a1a1a;
            }

            .review-label {
                display: block;
                font-size: 14px;
                font-weight: 600;
                color: #333;
                margin-bottom: 8px;
            }

            .review-label small {
                font-weight: 400;
                color: #999;
            }

            .review-input {
                border: 1.5px solid #e0e0e0;
                border-radius: 10px;
                background: #fafafa;
                padding: 10px 14px;
                transition: all 0.25s ease;
            }

            .review-input:focus {
                outline: none;
                border-color: #6c5ce7;
                background: #fff;
                box-shadow: 0 0 0 4px rgba(108, 92, 231, 0.12);
            }

            .star-rating-input {
                display: flex;
                gap: 6px;
                font-size: 26px;
                cursor: pointer;
            }

            .star-rating-input i {
                color: #ddd;
                transition: color 0.15s ease, transform 0.15s ease;
            }

            .star-rating-input i.active {
                color: #f5a623;
            }

            .star-rating-input i:hover {
                transform: scale(1.15);
            }

            .review-submit-btn {
                border: none;
                margin-top: 6px;
            }

            .review-list-wrap {
                max-height: 560px;
                overflow-y: auto;
                padding-right: 6px;
            }

            .review-card {
                background: #fff;
                border: 1px solid #f0f0f0;
                border-radius: 14px;
                padding: 20px;
                margin-bottom: 16px;
                animation: fadeInUp 0.4s ease;
            }

            .review-card-head {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 10px;
            }

            .review-avatar {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                background: linear-gradient(135deg, #6c5ce7, #a29bfe);
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                flex-shrink: 0;
            }

            .review-head-info {
                flex: 1;
            }

            .review-head-info h6 {
                margin: 0;
                font-size: 15px;
                font-weight: 600;
                color: #1a1a1a;
            }

            .review-head-info span {
                font-size: 12px;
                color: #999;
            }

            .review-card-stars i {
                color: #f5a623;
                font-size: 13px;
            }

            .review-card-comment {
                font-size: 14px;
                color: #444;
                line-height: 1.6;
                margin-bottom: 10px;
            }

            .review-card-media {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .review-media-thumb img {
                width: 90px;
                height: 90px;
                object-fit: cover;
                border-radius: 10px;
                border: 1px solid #eee;
            }

            .review-media-video {
                width: 200px;
                max-width: 100%;
                border-radius: 10px;
            }

            .review-empty {
                text-align: center;
                padding: 40px;
                color: #999;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(12px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 991px) {
                .review-list-wrap {
                    max-height: none;
                    margin-top: 24px;
                }
            }
        </style>

        <script>
            (function() {
                const stars = document.querySelectorAll('#starRatingInput i');
                const ratingInput = document.getElementById('ratingValue');

                stars.forEach(function(star) {
                    star.addEventListener('click', function() {
                        const value = parseInt(this.dataset.value);
                        ratingInput.value = value;
                        stars.forEach(function(s) {
                            const sVal = parseInt(s.dataset.value);
                            s.classList.toggle('active', sVal <= value);
                            s.classList.toggle('fas', sVal <= value);
                            s.classList.toggle('far', sVal > value);
                        });
                    });
                });
            })();
        </script>

        <!-- product-tranding start -->
        @if ($relatedProducts->isNotEmpty())
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
                                                                <a href="#0"
                                                                    class="wishlist js-add-to-wishlist-link">
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
                                                                <a href="#0"
                                                                    class="wishlist js-add-to-wishlist-link">
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
