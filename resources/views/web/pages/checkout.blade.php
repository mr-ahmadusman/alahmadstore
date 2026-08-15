@section('title', 'Checkout | Al Ahmad Store')
@section('meta_description', 'Complete your order at Al Ahmad Store. Secure checkout with Cash on Delivery available across Pakistan.')
@section('meta_keywords', 'checkout, place order, cash on delivery, al ahmad store')
@section('meta_robots', 'noindex, follow')

@extends('web.layouts.app')
@section('content')

<style>
    .checkout-modern {
        padding: 40px 0 80px;
    }
    .checkout-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
        padding: 32px;
        margin-bottom: 30px;
        border: 1px solid #f0f0f0;
    }
    .checkout-card h2 {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 28px;
        color: #1a1a1a;
        position: relative;
        padding-bottom: 12px;
    }
    .checkout-card h2::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background: #6c5ce7;
        border-radius: 3px;
    }
    .form-group-modern {
        margin-bottom: 22px;
    }
    .form-group-modern label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    .form-group-modern input {
        width: 100%;
        height: 50px;
        padding: 0 16px;
        border: 1.5px solid #e0e0e0;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.25s ease;
        background: #fafafa;
    }
    .form-group-modern input:focus {
        outline: none;
        border-color: #6c5ce7;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(108, 92, 231, 0.12);
    }
    .row-2 {
        display: flex;
        gap: 20px;
    }
    .row-2 .form-group-modern {
        flex: 1;
    }
    .cart-item-modern {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .cart-item-modern:last-child {
        border-bottom: none;
    }
    .cart-item-modern img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #eee;
    }
    .cart-item-info h4 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 6px;
        color: #222;
    }
    .cart-item-info .qty-price {
        font-size: 14px;
        color: #666;
    }
    .order-summary-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        font-size: 15px;
        border-bottom: 1px dashed #eee;
    }
    .order-summary-row.total {
        border-bottom: none;
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin-top: 8px;
        padding-top: 16px;
        border-top: 2px solid #eee;
    }
    .payment-option {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border: 1.5px solid #e8e8e8;
        border-radius: 12px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.2s;
        background: #fafafa;
    }
    .payment-option:hover {
        border-color: #6c5ce7;
        background: #f8f7ff;
    }
    .payment-option input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: #6c5ce7;
    }
    .payment-option.disabled {
        opacity: 0.55;
        cursor: not-allowed;
    }
    .payment-option span {
        font-size: 15px;
        font-weight: 500;
        color: #333;
    }
    .payment-option small {
        color: #888;
        font-size: 12px;
        margin-left: 6px;
    }
    .btn-place-order {
        width: 100%;
        height: 54px;
        background: linear-gradient(135deg, #6c5ce7, #a29bfe);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
        box-shadow: 0 8px 20px rgba(108, 92, 231, 0.3);
    }
    .btn-place-order:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(108, 92, 231, 0.4);
    }
    .btn-place-order:disabled {
        background: #ccc;
        cursor: not-allowed;
        box-shadow: none;
    }
    .empty-cart-msg {
        text-align: center;
        padding: 30px;
        color: #888;
        font-size: 15px;
    }
    @media (max-width: 768px) {
        .row-2 {
            flex-direction: column;
            gap: 0;
        }
        .checkout-card {
            padding: 24px 18px;
        }
    }
</style>

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
                                <span class="breadcrumb-text">Checkout</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- checkout-area start -->
    <section class="section-ptb checkout-modern">
        <div class="container">

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <div class="row">
                    <!-- LEFT SIDE - Billing Form -->
                    <div class="col-lg-7 col-md-12">
                        <div class="checkout-card">
                            <h2>Billing details</h2>

                            <div class="form-group-modern">
                                <label>Full Name </label>
                                <input type="text" name="name" placeholder="Enter your full name" required
                                       value="{{ old('name', optional($user)->name) }}">
                            </div>

                            <div class="form-group-modern">
                                <label>Full Address </label>
                                <input type="text" name="address" placeholder="House no, street name" required
                                       value="{{ old('address') }}">
                            </div>

                            <div class="row-2">
                                <div class="form-group-modern">
                                    <label>Town / City</label>
                                    <input type="text" name="city" placeholder="City"
                                           value="{{ old('city') }}">
                                </div>
                                <div class="form-group-modern">
                                    <label>Postcode / Zip</label>
                                    <input type="text" name="postal_code" placeholder="Postal code"
                                           value="{{ old('postal_code') }}">
                                </div>
                            </div>

                            <div class="row-2">
                                <div class="form-group-modern">
                                    <label>Email address</label>
                                    <input type="email" name="email" placeholder="you@example.com"
                                           value="{{ old('email', optional($user)->email) }}">
                                </div>
                                <div class="form-group-modern">
                                    <label>Phone number *</label>
                                    <input type="text" name="phone" placeholder="03XX-XXXXXXX" required
                                           value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE - Order Summary -->
                    <div class="col-lg-5 col-md-12">
                        <div class="checkout-card">
                            <h2>In your cart ({{ count($cartItems) }})</h2>

                            @if (empty($cartItems))
                                <div class="empty-cart-msg">
                                    Your cart is empty.
                                </div>
                            @else
                                @foreach ($cartItems as $ci)
                                    @php
                                        $q = $ci['qty'] ?? ($ci['quantity'] ?? 1);
                                        $price = (float) ($ci['price'] ?? 0);
                                        $sub = $ci['subtotal'] ?? ($price * $q);
                                    @endphp
                                    <div class="cart-item-modern">
                                        <div>
                                            @if (!empty($ci['slug']))
                                                <a href="{{ route('product.detail', $ci['slug']) }}">
                                                    <img src="{{ !empty($ci['image']) ? asset($ci['image']) : asset('web/img/product/home1-pro-1.jpg') }}"
                                                         alt="{{ $ci['name'] ?? 'Item' }}">
                                                </a>
                                            @else
                                                <img src="{{ !empty($ci['image']) ? asset($ci['image']) : asset('web/img/product/home1-pro-1.jpg') }}"
                                                     alt="{{ $ci['name'] ?? 'Item' }}">
                                            @endif
                                        </div>
                                        <div class="cart-item-info">
                                            <h4>
                                                @if (!empty($ci['slug']))
                                                    <a href="{{ route('product.detail', $ci['slug']) }}" style="color:inherit;text-decoration:none;">
                                                        {{ $ci['name'] ?? 'Item' }}
                                                    </a>
                                                @else
                                                    {{ $ci['name'] ?? 'Item' }}
                                                @endif
                                            </h4>
                                            <div class="qty-price">
                                                {{ $q }} × Rs {{ number_format($price, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        @if (!empty($cartItems))
                            <div class="checkout-card">
                                <h2>Your order</h2>

                                @foreach ($cartItems as $ci)
                                    @php
                                        $q = $ci['qty'] ?? ($ci['quantity'] ?? 1);
                                        $price = (float) ($ci['price'] ?? 0);
                                        $sub = $ci['subtotal'] ?? ($price * $q);
                                    @endphp
                                    <div class="order-summary-row">
                                        <span>{{ $q }}x {{ $ci['name'] ?? 'Item' }}</span>
                                        <span>Rs {{ number_format($sub, 2) }}</span>
                                    </div>
                                @endforeach

                                <div class="order-summary-row">
                                    <span>Subtotal</span>
                                    <span>Rs {{ number_format($cartTotal, 2) }}</span>
                                </div>
                                <div class="order-summary-row">
                                    <span>Shipping</span>
                                    <span style="color:#27ae60;font-weight:600;">Free</span>
                                </div>
                                <div class="order-summary-row total">
                                    <span>Total</span>
                                    <span>Rs {{ number_format($cartTotal, 2) }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="checkout-card">
                            <h2>Payment Method</h2>

                            <label class="payment-option disabled">
                                <input type="radio" name="payment_method" value="JazzCash" disabled>
                                <span>JazzCash <small>(coming soon)</small></span>
                            </label>

                            <label class="payment-option disabled">
                                <input type="radio" name="payment_method" value="EasyPaisa" disabled>
                                <span>EasyPaisa <small>(coming soon)</small></span>
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="COD" checked>
                                <span>Cash on Delivery</span>
                            </label>

                            <button type="submit" class="btn-place-order"
                                    {{ empty($cartItems) ? 'disabled' : '' }}>
                                PLACE ORDER
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- checkout-area end -->
</main>

@endsection
