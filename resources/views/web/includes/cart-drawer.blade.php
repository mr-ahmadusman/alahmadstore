<div class="cart-drawer" id="cart-drawer">
    <form action="{{ route('cart.view') }}" method="get" class="drawer-contents">
        <div class="drawer-fixed-header">
            <div class="drawer-header">
                <h6 class="drawer-header-title">Cart</h6>
                <div class="drawer-close">
                    <button type="button" class="drawer-close-btn"><span class="drawer-close-icon"><svg
                                viewBox="0 0 24 24" width="16" height="16" stroke="currentColor"
                                stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                class="css-i6dzq1">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg></span></button>
                </div>
            </div>
        </div>

        {{-- Cart empty state --}}
        @if (count($cartItems) === 0)
            <div class="drawer-cart-empty d-flex flex-column align-items-center justify-content-center text-center"
                style="min-height: 300px; padding: 20px;">
                <div class="drawer-scrollable">
                    <h2>Your cart is currently empty</h2>
                    <a href="{{ route('search') }}" class="btn btn-style2">Continue shopping</a>
                </div>
            </div>
        @else
            <div class="drawer-inner">
                <div class="drawer-scrollable">
                    <ul class="cart-items">
                        @php $miniTotal = 0; @endphp

                        @foreach ($cartItems as $item)
                            @php
                                $subtotal = $item['price'] * $item['quantity'];
                                $miniTotal += $subtotal;
                            @endphp
                            <li class="cart-item">
                                <div class="cart-item-info">
                                    <div class="cart-item-image">
                                        <a href="{{ route('product.detail', $item['id']) }}">
                                            <img src="{{ asset($item['image']) }}" class="img-fluid"
                                                alt="{{ $item['name'] }}">
                                        </a>
                                    </div>
                                    <div class="cart-item-details">
                                        <div class="cart-item-name">
                                            <a href="{{ route('product.detail', $item['id']) }}">{{ $item['name'] }}</a>
                                        </div>
                                        <div class="cart-pro-info">
                                            <div class="cart-qty-price">
                                                <span>{{ $item['quantity'] }}</span>
                                                <span>×</span>
                                                <span class="price">Rs
                                                    {{ number_format($item['price'], 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="cart-item-sub">
                                            <div class="cart-qty-price-remove">
                                                <div class="cart-item-qty">
                                                    <div class="js-qty-wrapper">
                                                        <div class="js-qty-wrap">
                                                            <button type="button"
                                                                class="js-qty-adjust ju-qty-adjust-minus"><span><svg
                                                                        viewBox="0 0 24 24" width="16"
                                                                        height="16" stroke="currentColor"
                                                                        stroke-width="2" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        class="css-i6dzq1">
                                                                        <line x1="5" y1="12"
                                                                            x2="19" y2="12"></line>
                                                                    </svg></span></button>
                                                            <input type="text" class="js-qty-num"
                                                                name="quantity" value="{{ $item['quantity'] }}"
                                                                pattern="[0-9]*">
                                                            <button type="button"
                                                                class="js-qty-adjust ju-qty-adjust-plus"><span><svg
                                                                        viewBox="0 0 24 24" width="16"
                                                                        height="16" stroke="currentColor"
                                                                        stroke-width="2" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        class="css-i6dzq1">
                                                                        <line x1="12" y1="5"
                                                                            x2="12" y2="19"></line>
                                                                        <line x1="5" y1="12"
                                                                            x2="19" y2="12"></line>
                                                                    </svg></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cart-item-price">
                                                    <span class="cart-price">Rs
                                                        {{ number_format($subtotal, 2) }}</span>
                                                </div>
                                                <div class="cart-item-remove">
                                                    <a href="{{ route('cart.remove', $item['id']) }}"
                                                        class="cart-remove"><span><svg viewBox="0 0 24 24"
                                                                width="16" height="16"
                                                                stroke="currentColor" stroke-width="2"
                                                                fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round" class="css-i6dzq1">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11"
                                                                    x2="10" y2="17"></line>
                                                                <line x1="14" y1="11"
                                                                    x2="14" y2="17"></line>
                                                            </svg></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="drawer-footer">
                    <div class="drawer-block drawer-total">
                        <span class="drawer-subtotal">Subtotal</span>
                        <span class="drawer-totalprice">Rs {{ number_format($miniTotal, 2) }}</span>
                    </div>
                    <div class="drawer-block drawer-ship-text">
                            <label class="box-area">
                                <span class="text">I have read and agree with the <a href="/terms">terms &amp; condition.</a></span>
                                <input type="checkbox" class="cust-checkbox">
                                <span class="cust-check"></span>
                            </label>
                        </div>
                    <div class="drawer-block drawer-cart-checkout">
                        <div class="cart-checkout-btn">
                            <button type="button" onclick="location.href='{{ route('cart.view') }}'"
                                class="btn btn-style2">View cart</button>
                            <button type="button" onclick="location.href='{{ route('checkout.show') }}'"
                                class="checkout btn btn-style2">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
