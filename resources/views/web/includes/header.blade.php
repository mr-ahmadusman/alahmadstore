<!-- header start -->
<header class="main-header" id="stickyheader">
    <div class="header-top-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="header-area">
                        <div class="header-element header-toggle">
                            <div class="header-icon-block">
                                <ul class="shop-element">
                                    <li class="side-wrap toggler-wrap">
                                        <div class="toggler-wrapper">
                                            <button class="toggler-btn">
                                                <span class="toggler-icon"><svg viewBox="0 0 24 24" width="24"
                                                        height="24" stroke="currentColor" stroke-width="2"
                                                        fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                        class="css-i6dzq1">
                                                        <line x1="3" y1="12" x2="21"
                                                            y2="12"></line>
                                                        <line x1="3" y1="6" x2="21"
                                                            y2="6"></line>
                                                        <line x1="3" y1="18" x2="21"
                                                            y2="18"></line>
                                                    </svg></span>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="header-element header-logo">
                            <div class="header-theme-logo">
                                <a href="/" class="theme-logo">
                                    <img src="{{ $logo && $logo->image ? asset($logo->image) : asset('web/img/logo/logo-removebg-preview.png') }}"
                                        class="img-fluid" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="header-element header-search">
                            <div class="search-crap">
                                <div class="search-content">
                                    <div class="search-box">
                                        <form action="{{ route('search') }}" method="GET" class="search-bar"
                                            autocomplete="off">
                                            <div class="form-search">
                                                <input type="search" id="search-box" name="q"
                                                    placeholder="Find our search" class="search-input"
                                                    value="{{ request('q') }}">
                                                <button type="submit" class="search-btn"><i
                                                        class="feather-search"></i></button>
                                            </div>
                                            <div id="search-suggestions"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-element header-icon">
                            <div class="header-icon-block">
                                <ul class="shop-element">
                                    <li class="side-wrap search-wrap">
                                        <div class="search-wrapper">
                                            <a href="#searchmodal" data-bs-toggle="modal">
                                                <span class="search-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M11 2c4.968 0 9 4.032 9 9s-4.032 9-9 9s-9-4.032-9-9s4.032-9 9-9m0 16c3.867 0 7-3.133 7-7s-3.133-7-7-7s-7 3.133-7 7s3.133 7 7 7m8.485.071l2.829 2.828l-1.415 1.415l-2.828-2.829z">
                                                        </path>
                                                    </svg></span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="header-element header-details">
                            <div class="header-icon-details">
                                <ul class="details-ul">
                                    <li class="info-wrap info-headphones">
                                        <div class="info-wrapper">
                                            <a href="tel://{{ optional($footerContact)->phone }}" class="icon"><i
                                                    class="feather-headphones"></i></a>
                                            <div class="info-text">
                                                <span class="label">Need Help?</span>
                                                <a href="tel://{{ optional($footerContact)->phone }}"
                                                    class="info-link">{{ optional($footerContact)->phone }}</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="info-wrap info-Login">
                                        <div class="info-wrapper">
                                            <a href="index.html" class="icon"><i class="feather-user"></i></a>
                                            <div class="info-text">
                                                @guest
                                                    <span class="label">My account</span>
                                                    <a href="{{ route('login') }}" class="info-link">Login &amp;
                                                        Register</a>
                                                @endguest

                                                @auth
                                                    <span class="label">{{ Auth::user()->name }}</span>
                                                    <a href="{{ route('profile') }}" class="info-link">My Profile</a>
                                                @endauth
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-bottam start -->
    <div class="header-bottom-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="main-block">
                        <div class="side-wrap header-support">
                            <div class="vega-menu-area">
                                <a href="#vega-collapse" class="browse-cat" data-bs-toggle="collapse"
                                    aria-expanded="false">
                                    <span class="menu-icon"><i class="feather-menu"></i></span>
                                    <span class="menu-title">Trending category</span>
                                    <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <a href="#vega-collapse" class="browse-cat browse-cat-lg" data-bs-toggle="collapse"
                                    aria-expanded="false">
                                    <span class="menu-icon"><i class="feather-menu"></i></span>
                                    <span class="menu-title">Trending category</span>
                                    <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <div class="vegawrap collapse" id="vega-collapse">
                                    <ul class="vega-menu">
                                        @foreach ($categories as $category)
                                            <li class="menu-link">
                                                <a href="{{ route('search', ['q' => $category->name]) }}"
                                                    class="link-title">
                                                    <span class="menu-img-icon">
                                                        <img src="{{ $category->image ? asset($category->image) : asset('web/img/menu/cate-menu1.jpg') }}"
                                                            class="img-fluid" alt="{{ $category->name }}">
                                                    </span>
                                                    <span class="sp-link-title">{{ $category->name }}</span>
                                                    @if ($category->subcategories->count())
                                                        <span class="menu-arrow"><i
                                                                class="fa fa-angle-down"></i></span>
                                                    @endif
                                                </a>

                                                @if ($category->subcategories->count())
                                                    <div class="menu-dropdown product-menu collapse"
                                                        id="vega-cat-{{ $category->id }}">
                                                        <ul class="ul">
                                                            <li class="productlink-li">
                                                                <a href="{{ route('search', ['q' => $category->name]) }}"
                                                                    class="productlink-title">
                                                                    <span
                                                                        class="sp-link-title">{{ $category->name }}</span>
                                                                </a>
                                                                <ul class="productsupmenu-dropdown">
                                                                    @foreach ($category->subcategories as $subcategory)
                                                                        <li class="productsupmenu-li">
                                                                            <a href="{{ route('search', ['q' => $subcategory->name]) }}"
                                                                                class="productsuplink-title">
                                                                                <span
                                                                                    class="sp-link-title">{{ $subcategory->name }}</span>
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                           @foreach($discounts->take(2) as $discount)
<li class="productlink-li shoplink-br">
    <div class="shop-banner banner-hover">
        <a href="#" class="banner-img">
            <img src="{{ $discount->image ? asset($discount->image) : asset('web/img/menu/vega-banner1.jpg') }}"
                class="img-fluid" alt="{{ $discount->name }}">
        </a>
    </div>
</li>
@endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="side-wrap header-menu">
                            <div class="mainmenu-content">
                                <div class="main-wrap">
                                    <ul class="main-menu">
                                        <li class="menu-link">
                                            <a href="/" class="link-title">
                                                <span class="sp-link-title">Home</span>
                                            </a>
                                        </li>
                                        <li class="menu-link">
                                            <a href="collection.html" class="link-title">
                                                <span class="sp-link-title">Shop</span>
                                                <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                            <div class="menu-dropdown menu-banner collapse" id="collapse-shop">
                                                <ul class="container ul">
                                                    @forelse($discounts as $discount)
                                                        <li class="menubanner-li">
                                                            <div class="menubanner-img">
                                                                <a href="{{ route('search', ['q' => $discount->name]) }}"
                                                                    class="banner-hover">
                                                                    <img src="{{ $discount->image ? asset($discount->image) : asset('web/img/menu/home1-menu-banner1.jpg') }}"
                                                                        class="img-fluid"
                                                                        alt="{{ $discount->name }}">
                                                                </a>
                                                                <a href="{{ route('search', ['q' => $discount->name]) }}"
                                                                    class="collection-title">
                                                                    <span>{{ $discount->name }}</span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    @empty
                                                        {{-- Koi discount na ho to yahan kuch nahi dikhega --}}
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="menu-link">
                                            <a href="/blogs" class="link-title">
                                                <span class="sp-link-title">Blogs</span>
                                                <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                        </li>
                                        <li class="menu-link">
                                            <a href="/gallery" class="link-title">
                                                <span class="sp-link-title"> Gallery </span>
                                                <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                        </li>
                                        <li class="menu-link">
                                            <a href="collection.html" class="link-title">
                                                <span class="sp-link-title">Pages<span
                                                        class="header-sale-lable">Sale</span></span>
                                                <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                            <div class="menu-dropdown menu-mega collapse" id="colection">
                                                <ul class="ul container p-0">
                                                    <li class="menumega-li">
                                                        <a href="javascript:void(0)" class="menumega-title">
                                                            <span class="sp-link-title">Shop page</span>
                                                            <span class="menu-arrow"><i
                                                                    class="fa-solid fa-angle-down"></i></span>
                                                        </a>
                                                        <div class="menumegasup-dropdown collapse">
                                                            <ul class="menumegasup-ul">
                                                                <li class="menumegasup-li">
                                                                    <a href="{{ route('cart.view') }}"
                                                                        class="menumegasup-title">
                                                                        <span class="sp-link-title">Cart Page</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menumegasup-li">
                                                                    <a href="{{ route('checkout.show') }}"
                                                                        class="menumegasup-title">
                                                                        <span class="sp-link-title">Check Out
                                                                            Page</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="menumega-li">
                                                        <a href="javascript:void(0)" class="menumega-title">
                                                            <span class="sp-link-title">Page</span>
                                                            <span class="menu-arrow"><i
                                                                    class="fa-solid fa-angle-down"></i></span>
                                                        </a>
                                                        <div class="menumegasup-dropdown collapse">
                                                            <ul class="menumegasup-ul">
                                                                <li class="menumegasup-li">
                                                                    <a href="{{ route('my.orders') }}"
                                                                        class="menumegasup-title">
                                                                        <span class="sp-link-title">Track My Order
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="menumega-li">
                                                        <div class="menu-product">
                                                            <ul class="menumegasup-ul">
                                                                <li class="menumegasup-li">
                                                                    <div class="product-menu-list">
                                                                        <div class="single-product-wrap">
                                                                            <div class="product-image">
                                                                                <a href="product-template.html"
                                                                                    class="pro-img">
                                                                                    <img class="img-fluid img1"
                                                                                        src="{{ asset('web/img/menu/home-pro-banner1.jpg') }}"
                                                                                        alt="menupro-1">
                                                                                    <img class="img-fluid img2"
                                                                                        src="{{ asset('web/img/menu/home-pro-banner2.jpg') }}"
                                                                                        alt="menupro-2">
                                                                                </a>
                                                                            </div>
                                                                            <div class="product-content">
                                                                                <h6><a href="product-template.html">Bluetooth
                                                                                        earbuds</a></h6>
                                                                                <div class="price-box">
                                                                                    <span
                                                                                        class="new-price">$25.00</span>
                                                                                    <span
                                                                                        class="old-price">$45.00</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="menumegasup-li">
                                                                    <div class="product-menu-list">
                                                                        <div class="single-product-wrap">
                                                                            <div class="product-image">
                                                                                <a href="product-template.html"
                                                                                    class="pro-img">
                                                                                    <img class="img-fluid img1"
                                                                                        src="{{ asset('web/img/menu/home-pro-banner3.jpg') }}"
                                                                                        alt="menupro-1">
                                                                                    <img class="img-fluid img2"
                                                                                        src="{{ asset('web/img/menu/home-pro-banner4.jpg') }}"
                                                                                        alt="menupro-2">
                                                                                </a>
                                                                            </div>
                                                                            <div class="product-content">
                                                                                <h6><a href="product-template.html">Portable
                                                                                        speaker</a></h6>
                                                                                <div class="price-box">
                                                                                    <span
                                                                                        class="new-price">$11.00</span>
                                                                                    <span
                                                                                        class="old-price">$19.00</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="menu-product-btn">
                                                                <a href="collection.html" class="menu-pro-link">See
                                                                    more<i class="bi bi-chevron-right"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="menumega-li">
                                                        <div class="menu-product">
                                                            <ul class="menumegasup-ul">
                                                                <li class="menumegasup-li">
                                                                    <div class="product-menu-list">
                                                                        <div class="single-product-wrap">
                                                                            <div class="product-image">
                                                                                <a href="product-template.html"
                                                                                    class="pro-img">
                                                                                    <img class="img-fluid img1"
                                                                                        src="{{ asset('web/img/menu/home-pro-banner5.jpg') }}"
                                                                                        alt="menupro-1">
                                                                                    <img class="img-fluid img2"
                                                                                        src="{{ asset('web/img/menu/home-pro-banner6.jpg') }}"
                                                                                        alt="menupro-2">
                                                                                </a>
                                                                            </div>
                                                                            <div class="product-content">
                                                                                <h6><a
                                                                                        href="product-template.html">Headphones</a>
                                                                                </h6>
                                                                                <div class="price-box">
                                                                                    <span
                                                                                        class="new-price">$21.00</span>
                                                                                    <span
                                                                                        class="old-price">$25.00</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="menumegasup-li">
                                                                    <div class="product-menu-list">
                                                                        <div class="single-product-wrap">
                                                                            <div class="product-image">
                                                                                <a href="product-template.html"
                                                                                    class="pro-img">
                                                                                    <img class="img-fluid img1"
                                                                                        src="{{ asset('web/img/menu/home-pro-banner7.jpg') }}"
                                                                                        alt="menupro-1">
                                                                                    <img class="img-fluid img2"
                                                                                        src="{{ asset('web/img/menu/home-pro-banner8.jpg') }}"
                                                                                        alt="menupro-2">
                                                                                </a>
                                                                            </div>
                                                                            <div class="product-content">
                                                                                <h6><a href="product-template.html">Shoot
                                                                                        drone</a></h6>
                                                                                <div class="price-box">
                                                                                    <span
                                                                                        class="new-price">$69.00</span>
                                                                                    <span
                                                                                        class="old-price">$89.00</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="menu-product-btn">
                                                                <a href="collection.html" class="menu-pro-link">See
                                                                    more<i class="bi bi-chevron-right"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-link">
                                            <a href="/about" class="link-title">
                                                <span class="sp-link-title">About us</span>
                                                <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                        </li>
                                        <li class="menu-link">
                                            <a href="{{ route('contact') }}" class="link-title">
                                                <span class="sp-link-title">Contact us</span>
                                            </a>
                                        </li>
                                        <li class="menu-link">
                                            <a href="{{ route('terms') }}" class="link-title">
                                                <span class="sp-link-title"> Terms </span>
                                                <span class="menu-arrow"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="side-wrap header-icon">
                            <div class="header-icon-block">
                                <ul class="shop-element">
                                    <li class="side-wrap toggler-wrap">
                                        <div class="toggler-wrapper">
                                            <button class="toggler-btn">
                                                <span class="toggler-icon"><svg viewBox="0 0 24 24" width="24"
                                                        height="24" stroke="currentColor" stroke-width="2"
                                                        fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                        class="css-i6dzq1">
                                                        <line x1="3" y1="12" x2="21"
                                                            y2="12"></line>
                                                        <line x1="3" y1="6" x2="21"
                                                            y2="6"></line>
                                                        <line x1="3" y1="18" x2="21"
                                                            y2="18"></line>
                                                    </svg></span>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="side-wrap search-wrap">
                                        <div class="search-wrapper">
                                            <a href="#searchmodal" data-bs-toggle="modal">
                                                <span class="search-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M11 2c4.968 0 9 4.032 9 9s-4.032 9-9 9s-9-4.032-9-9s4.032-9 9-9m0 16c3.867 0 7-3.133 7-7s-3.133-7-7-7s-7 3.133-7 7s3.133 7 7 7m8.485.071l2.829 2.828l-1.415 1.415l-2.828-2.829z">
                                                        </path>
                                                    </svg></span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="side-wrap user-wrap">
                                        <div class="user-wrapper">
                                            <a href="#store-account" class="collapsed" data-bs-toggle="collapse"
                                                aria-expanded="false">
                                                <span class="user-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M20 22h-2v-2a3 3 0 0 0-3-3H9a3 3 0 0 0-3 3v2H4v-2a5 5 0 0 1 5-5h6a5 5 0 0 1 5 5zm-8-9a6 6 0 1 1 0-12a6 6 0 0 1 0 12m0-2a4 4 0 1 0 0-8a4 4 0 0 0 0 8">
                                                        </path>
                                                    </svg></span>
                                                <span class="user-title">Login</span>
                                            </a>
                                            <div class="user-drower collapse" id="store-account">
                                                <a href="login-account.html">Login</a>
                                                <a href="create-account.html">Register</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="side-wrap wishlist-wrap">
                                        <div class="wishlist-wrapper">
                                            <a href="{{ route('wishlist.view') }}">
                                                <span class="wishlist-icon-count">
                                                    <span class="wishlist-icon"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M12.001 4.529a5.998 5.998 0 0 1 8.242.228a6 6 0 0 1 .236 8.236l-8.48 8.492l-8.478-8.492a6 6 0 0 1 8.48-8.464m6.826 1.641a3.998 3.998 0 0 0-5.49-.153l-1.335 1.198l-1.336-1.197a4 4 0 0 0-5.686 5.605L12 18.654l7.02-7.03a4 4 0 0 0-.193-5.454">
                                                            </path>
                                                        </svg></span>
                                                </span>
                                                <span class="wishlist-title">My wishlist</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="side-wrap cart-wrap">
                                        <div class="cart-wrapper">
                                            <div class="shopping-cart">
                                                <a class="add-to-cart js-cart-icon" href="javascript:void(0)">
                                                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M6.505 2h11a1 1 0 0 1 .8.4l2.7 3.6v15a1 1 0 0 1-1 1h-16a1 1 0 0 1-1-1V6l2.7-3.6a1 1 0 0 1 .8-.4m12.5 6h-14v12h14zm-.5-2l-1.5-2h-10l-1.5 2zm-9.5 4v2a3 3 0 1 0 6 0v-2h2v2a5 5 0 0 1-10 0v-2z">
                                                            </path>
                                                        </svg></span>
                                                    <span class="cart-title text">My cart</span>
                                                    <span class="bigcounter">{{ count($cartItems) }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
