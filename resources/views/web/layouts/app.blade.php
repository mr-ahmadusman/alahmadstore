 <!DOCTYPE html>
 <html lang="en">


 <head>
     <meta charset="utf-8">
     <meta name="robots" content="@yield('meta_robots', 'index, follow')">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <!-- SEO Title -->
     <title>@yield('title', 'Al Ahmad Store | Watches, Headphones & Clothing in Pakistan')</title>

     <!-- SEO Description -->
     <meta name="description" content="@yield('meta_description', 'Al Ahmad Store - Buy quality watches, Bluetooth headphones, phone accessories, hair machines, men’s & women’s clothing online in Pakistan. Cash on Delivery available.')">

     <!-- SEO Keywords (optional but useful) -->
     <meta name="keywords" content="@yield('meta_keywords', 'watches pakistan, bluetooth headphones, hands free, phone accessories, hair machine, mens t shirts, women clothing, al ahmad store')">

     <!-- Author -->
     <meta name="author" content="Al Ahmad Store">

     <!-- Open Graph (Facebook / WhatsApp share ke liye) -->
     <meta property="og:title" content="@yield('title', 'Al Ahmad Store')">
     <meta property="og:description" content="@yield('meta_description', 'Quality products with Cash on Delivery across Pakistan')">
     <meta property="og:type" content="website">
     <meta property="og:url" content="{{ url()->current() }}">



     <!-- favicon -->
     <link rel="icon" type="image/x-icon" href="{{ asset('web/img/favicon/favicon-16x16.png') }}">
     <!-- bootstrap css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/bootstrap.min.css') }}">
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/bootstrap-icons.css') }}">
     <!-- magnific-popup css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/magnific-popup.css') }}">
     <!-- fontawesome css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/all.min.css') }}">
     <!--fether css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/feather.css') }}">
     <!-- animate css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/animate.min.css') }}">
     <!-- owl-carousel css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/owl.carousel.min.css') }}">
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/owl.theme.default.min.css') }}">
     <!-- swiper css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/swiper-bundle.min.css') }}">
     <!-- slick slider css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/slick.css') }}">
     <!-- plugin css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/plugin.html') }}">
     <!-- collection css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/collection.css') }}">
     <!-- blog css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/blog.css') }}">
     <!-- other-pages css -->
     <link rel="stylesheet" type="text/css" href= "{{ asset('web/css/other-pages.css') }}">
     <!-- product-page css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/product-page.css') }}">
     <!-- style css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/style.css') }}">
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/custom.css') }}">
     <link rel="stylesheet" type="text/css" href="{{ asset('web/css/reviews.css') }}">
 </head>

 <body>
     <!-- notification-bar start -->
     <div class="notification-bar">
         <div class="container-fluid">
             <div class="row">
                 <div class="col">
                     <ul class="notification-content">
                         <li class="noti-wrap noti-email-wrap">
                             <div class="noti-email">
                                 <div class="emailtext">
                                     <p>
                                         <a href="mailto:{{ optional($footerContact)->mail ?? 'alahmadstoree@gmail.com' }}"
                                             title="Email us">
                                             Email : {{ optional($footerContact)->mail ?? 'alahmadstoree@gmail.com' }}
                                         </a>
                                     </p>
                                 </div>
                             </div>
                         </li>
                         <li class="noti-wrap noti-text-wrap">
                             <p>
                                 <span>Free Pakistan & Free return for above Pakistan </span>
                                 <span class="code-text">Shop now!</span>
                             </p>
                         </li>
                         <li class="noti-wrap noti-social">
                             <ul class="social-icon">
                                 @if (optional($social)->facebook)
                                     <!-- facebook-icon start -->
                                     <li>
                                         <a href="{{ $social->facebook }}" target="_blank" rel="noopener">
                                             <span class="icon-social facebook"><svg xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 320 512">
                                                     <path
                                                         d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                                                     </path>
                                                 </svg></span>
                                             <span>Facebook</span>
                                         </a>
                                     </li>
                                     <!-- facebook-icon end -->
                                 @endif

                                 @if (optional($social)->instagram)
                                     <!-- instagram-icon start -->
                                     <li>
                                         <a href="{{ $social->instagram }}" target="_blank" rel="noopener">
                                             <span class="icon-social pinterest"><svg
                                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                     <path
                                                         d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                                     </path>
                                                 </svg></span>
                                             <span>Instagram</span>
                                         </a>
                                     </li>
                                     <!-- instagram-icon end -->
                                 @endif
                             </ul>
                         </li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
     <!-- Toast Notification Container -->
     <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 99999">
         <div id="liveToast" class="toast align-items-center border-0" role="alert" aria-live="assertive"
             aria-atomic="true">
             <div class="d-flex">
                 <div class="toast-body" id="toastMessage">
                     <!-- Message inject hoga JS se -->
                 </div>
                 <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                     aria-label="Close"></button>
             </div>
         </div>
     </div>
     <!-- /Toast Notification Container -->


     @include('web.includes.header')

     @yield('content')

     @include('web.includes.footer')



     <!-- vega-mobile start -->
     <div class="mobile-vega">
         <div class="vega-menu-area">
             <div class="mobile-vega-menu" id="mobile-vega-menu">

                 <!-- Close Button -->
                 <div class="vega-close">
                     <button type="button" class="vega-close-btn">
                         <span class="vega-close-icon">
                             <svg viewBox="0 0 24 24" width="22" height="22" stroke="currentColor"
                                 stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                 <line x1="18" y1="6" x2="6" y2="18"></line>
                                 <line x1="6" y1="6" x2="18" y2="18"></line>
                             </svg>
                         </span>
                     </button>
                 </div>

                 <!-- Categories -->
                 <ul class="vega-menu">
                     @foreach ($categories as $category)
                         <li class="menu-link">
                             <div class="link-title">
                                 @if ($category->subcategories->count())
                                     {{-- Category with subcategories --}}
                                     <a href="#mobile-vega-{{ $category->id }}" class="sp-link-title"
                                         data-bs-toggle="collapse" aria-expanded="false">
                                         <span class="menu-img-icon">
                                             <img src="{{ $category->image ? asset($category->image) : asset('web/img/menu/cate-menu1.jpg') }}"
                                                 class="img-fluid" alt="{{ $category->name }}">
                                             <span>{{ $category->name }}</span>
                                         </span>
                                         <span class="menu-arrow"><i class="feather-plus"></i></span>
                                     </a>
                                 @else
                                     {{-- Category without subcategories --}}
                                     <a href="{{ route('search', ['q' => $category->name]) }}" class="sp-link-title">
                                         <span class="menu-img-icon">
                                             <img src="{{ $category->image ? asset($category->image) : asset('web/img/menu/cate-menu1.jpg') }}"
                                                 class="img-fluid" alt="{{ $category->name }}">
                                             <span>{{ $category->name }}</span>
                                         </span>
                                     </a>
                                 @endif
                             </div>

                             {{-- Subcategories --}}
                             @if ($category->subcategories->count())
                                 <div class="menu-dropdown product-menu collapse"
                                     id="mobile-vega-{{ $category->id }}">
                                     <ul class="ul" style="padding-left: 15px; margin: 8px 0 12px;">
                                         @foreach ($category->subcategories as $subcategory)
                                             <li class="productsupmenu-li" style="margin-bottom: 6px;">
                                                 <a href="{{ route('search', ['q' => $subcategory->name]) }}"
                                                     class="productsuplink-title"
                                                     style="display: block; padding: 6px 12px; font-size: 14px; color: #555; border-radius: 6px;">
                                                     <span class="sp-link-title">{{ $subcategory->name }}</span>
                                                 </a>
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
     <!-- vega-mobile end -->
     <!-- mobile-menu start -->
     <div class="mobile-menu" id="mobile-menu">
         <div class="mobile-contents">
             <div class="menu-close">
                 <button type="button" class="menu-close-btn">
                     <span class="menu-close-icon">
                         <svg viewBox="0 0 24 24" width="22" height="22" stroke="currentColor"
                             stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <line x1="18" y1="6" x2="6" y2="18"></line>
                             <line x1="6" y1="6" x2="18" y2="18"></line>
                         </svg>
                     </span>
                 </button>
             </div>
             <div class="mobilemenu-content">
                 <div class="main-wrap">
                     <ul class="main-menu">
                         <li class="menu-link">
                             <a href="{{ url('/') }}" class="link-title">
                                 <span class="sp-link-title">Home</span>
                             </a>
                         </li>
                         <li class="menu-link">
                             <a href="{{ route('search') }}" class="link-title">
                                 <span class="sp-link-title">Shop</span>
                             </a>
                         </li>
                         <li class="menu-link">
                             <a href="/blogs" class="link-title">
                                 <span class="sp-link-title">Blogs</span>
                             </a>
                         </li>
                         <li class="menu-link">
                             <a href="/gallery" class="link-title">
                                 <span class="sp-link-title">Gallery</span>
                             </a>
                         </li>
                         <li class="menu-link">
                             <a href="#menu-sub" class="link-title" data-bs-toggle="collapse" aria-expanded="false">
                                 <span class="sp-link-title">Pages</span>
                                 <span class="menu-arrow"><i class="fa-solid fa-angle-down"></i></span>
                             </a>
                             <div class="menu-dropdown menu-sub collapse" id="menu-sub">
                                 <ul class="ul">
                                     <li class="menusub-li">
                                         <a href="{{ route('cart.view') }}" class="menusub-title">
                                             <span class="sp-link-title">Cart</span>
                                         </a>
                                     </li>
                                     <li class="menusub-li">
                                         <a href="{{ route('checkout.show') }}" class="menusub-title">
                                             <span class="sp-link-title">Checkout</span>
                                         </a>
                                     </li>
                                     <li class="menusub-li">
                                         <a href="{{ route('my.orders') }}" class="menusub-title">
                                             <span class="sp-link-title">Track My Order</span>
                                         </a>
                                     </li>
                                     <li class="menusub-li">
                                         <a href="{{ route('wishlist.view') }}" class="menusub-title">
                                             <span class="sp-link-title">Wishlist</span>
                                         </a>
                                     </li>
                                     <li class="menusub-li">
                                         <a href="/about" class="menusub-title">
                                             <span class="sp-link-title">About us</span>
                                         </a>
                                     </li>
                                     <li class="menusub-li">
                                         <a href="{{ route('contact') }}" class="menusub-title">
                                             <span class="sp-link-title">Contact us</span>
                                         </a>
                                     </li>
                                     <li class="menusub-li">
                                         <a href="{{ route('terms') }}" class="menusub-title">
                                             <span class="sp-link-title">Terms & Condition</span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>
                         <li class="menu-link">
                             @guest
                                 <a href="{{ route('login') }}" class="link-title">
                                     <span class="sp-link-title">Login / Register</span>
                                 </a>
                             @else
                                 <a href="{{ route('profile') }}" class="link-title">
                                     <span class="sp-link-title">My Profile</span>
                                 </a>
                             @endguest
                         </li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
     <!-- mobile-menu end -->
     <!-- search-modal start -->
     <div class="modal fade" id="searchmodal">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-body">
                     <div class="container">
                         <div class="row">
                             <div class="col">
                                 <div class="crap-search">
                                     <button type="button" class="pop-close" data-bs-dismiss="modal"
                                         aria-label="Close">
                                         <i class="feather-x"></i>
                                     </button>
                                     <form action="{{ route('search') }}" method="GET" class="search-bar"
                                         role="search">
                                         <div class="form-search">
                                             <input type="search" name="q" placeholder="Find our search"
                                                 class="input-text" value="{{ request('q') }}" required>
                                             <button class="search-btn" type="submit">
                                                 <i class="feather-search"></i>
                                             </button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- search-modal end -->

     <!-- cart-drawer start -->
     @include('web.includes.cart-drawer')
     <!-- cart-drawer end -->
     {{-- <!-- newsletter start -->
     <div id="newsletter" class="popup-wrapper">
         <div class="popup-wrapper">
             <div class="modal fade show" id="news-letter-modal" aria-modal="true" role="dialog">
                 <div class="newsletter-popup-inner modal-dialog modal-dialog-centered">
                     <div class="modal-content">
                         <div class="modal-body">
                             <form method="post" class="contact-form">
                                 <button type="button" class="close-btn" data-bs-dismiss="modal"><i
                                         class="feather-x"></i></button>
                                 <div class="newsletter-info">
                                     <div class="subscribe-area">
                                         <div class="subscribe-content">
                                             <h2>Newsletter</h2>
                                             <p>Subscribe with us to get special offers and other discount information
                                             </p>
                                         </div>
                                         <div class="popup-newsletter">
                                             <div class="subscribe-con">
                                                 <div class="subscribe-block">
                                                     <input type="email" name="q" class="email mail"
                                                         placeholder="Enter your mail">
                                                     <div class="email-submit">
                                                         <button type="submit"
                                                             class="news-btn btn btn-style">Subscribe</button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- newsletter end --> --}}
     <!-- quickview modal start -->
     <div class="productmodal">
         <div class="modal fade" id="quickview">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h6 class="modal-quickview">Quickview</h6>
                         <button type="button" class="close" data-bs-dismiss="modal"><i
                                 class="fa-solid fa-xmark"></i></button>
                     </div>
                     <div class="modal-body">
                         <!-- quickview-sliderstart -->
                         <div class="quickview-slider">
                             <div class="swiper gallery-top">
                                 <div class="swiper-wrapper" id="qv-gallery-top"></div>
                                 <div class="swiper-button">
                                     <button class="quick-prev"><i class="fas fa-chevron-left"></i></button>
                                     <button class="quick-next"><i class="fas fa-chevron-right"></i></button>
                                 </div>
                             </div>
                             <div class="swiper gallery-thumbs">
                                 <div class="swiper-wrapper" id="qv-gallery-thumbs"></div>
                             </div>
                         </div>
                         <!-- quickview-slider end -->

                         <!-- quick-view-content start -->
                         <div class="quick-view-content">
                             <div class="pro-nprist">
                                 <!-- product-title start -->
                                 <div class="product-title">
                                     <h2 id="qv-title">Loading...</h2>
                                 </div>
                                 <!-- product-rating start -->
                                 <div class="product-ratting">
                                     <span class="pro-ratting">
                                         <i class="fas fa-star"></i>
                                         <i class="fas fa-star"></i>
                                         <i class="fas fa-star"></i>
                                         <i class="fas fa-star"></i>
                                         <i class="fas fa-star-half-alt"></i>
                                     </span>
                                     <span class="spr-badge-caption">No reviews</span>
                                     <span class="slash">/</span>
                                     <div class="product-count-sale">
                                         <span class="count" id="qv-sold-count">0</span> sold so far
                                     </div>
                                 </div>
                                 <!-- product-rating end -->
                                 <div class="pro-prlb pro-sale">
                                     <div class="price-box">
                                         <span class="new-price" id="qv-new-price"></span>
                                         <span class="old-price" id="qv-old-price"></span>
                                         <span class="percent-count" id="qv-percent"></span>
                                     </div>
                                 </div>
                                 <div class="short-description">
                                     <p id="qv-description"></p>
                                 </div>
                                 <div class="product-variant">
                                     <h6>Availability:</h6>
                                     <span class="stock-qty in-stock text-success" id="qv-stock">
                                         <span>In stock<i class="bi bi-check2"></i></span>
                                     </span>
                                 </div>
                                 <!-- Color swatch section skip kar diya, jaisa aapne kaha tha -->
                                 <div class="product-button">
                                     <form method="POST" class="cart" id="qv-add-to-cart-form">
                                         @csrf
                                         <div class="pro-detail-button">
                                             <div class="product-quantity-button">
                                                 <div class="product-quantity-action">
                                                     <h6>Quantity:</h6>
                                                     <div class="product-quantity">
                                                         <div class="cart-plus-minus">
                                                             <button type="button" class="dec qtybutton minus"><i
                                                                     class="feather-minus"></i></button>
                                                             <input type="text" name="quantity" id="qv-quantity"
                                                                 value="1">
                                                             <button type="button" class="inc qtybutton plus"><i
                                                                     class="feather-plus"></i></button>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <button type="submit" class="btn add-to-cart ajax-spin-cart">
                                                     <span class="cart-title">Add to cart</span>
                                                 </button>
                                             </div>
                                             <a href="#" id="qv-buy-now" class="btn btn-cart btn-theme">
                                                 <span>Buy now</span>
                                             </a>
                                         </div>
                                     </form>
                                 </div>
                                 <div class="product-actions">
                                     <!-- pro-deatail wishlist start -->
                                     <div class="pro-aff-che">
                                         <a href="#" id="qv-wishlist-btn" class="wishlist">
                                             <span
                                                 class="wishlist-icon action-wishlist tile-actions--btn wishlist-btn">
                                                 <span class="add-wishlist"><i class="bi bi-heart"></i></span>
                                             </span>
                                             <span class="wishlist-text">Wishlist</span>
                                         </a>
                                         <form id="qv-wishlist-form" method="POST" class="d-none">
                                             @csrf
                                         </form>
                                     </div>
                                     <!-- pro-deatail wishlist end -->
                                 </div>
                             </div>
                         </div>
                         <!-- quick-view-content end -->
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- quickview modal end -->
     <!-- quickview modal end -->
     <!-- bg-scren start -->
     <div class="bg-screen"></div>
     <!-- bg-scren end -->
     <!-- bottom-menu start -->
     <div class="bottom-menu">
         <ul class="bottom-menu-element">
             <!-- Home -->
             <li class="bottom-menu-wrap">
                 <div class="bottom-menu-wrapper">
                     <a href="{{ url('/') }}" class="bottom-menu-home">
                         <span class="bottom-menu-icon">
                             <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                 stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 class="css-i6dzq1">
                                 <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                 <polyline points="9 22 9 12 15 12 15 22"></polyline>
                             </svg>
                         </span>
                         <span class="bottom-menu-title">Home</span>
                     </a>
                 </div>
             </li>

             <!-- Account -->
             <li class="bottom-menu-wrap">
                 <div class="bottom-menu-wrapper">
                     @guest
                         <a href="{{ route('login') }}" class="bottom-menu-user">
                             <span class="bottom-menu-icon">
                                 <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                     stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                     class="css-i6dzq1">
                                     <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                     <circle cx="12" cy="7" r="4"></circle>
                                 </svg>
                             </span>
                             <span class="bottom-menu-title">Account</span>
                         </a>
                     @else
                         <a href="{{ route('profile') }}" class="bottom-menu-user">
                             <span class="bottom-menu-icon">
                                 <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                     stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                     class="css-i6dzq1">
                                     <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                     <circle cx="12" cy="7" r="4"></circle>
                                 </svg>
                             </span>
                             <span class="bottom-menu-title">Account</span>
                         </a>
                     @endguest
                 </div>
             </li>

             <!-- Shop -->
             <li class="bottom-menu-wrap">
                 <div class="bottom-menu-wrapper">
                     <a href="{{ route('search') }}" class="bottom-menu-collection">
                         <span class="bottom-menu-icon">
                             <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                 stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 class="css-i6dzq1">
                                 <rect x="3" y="3" width="7" height="7"></rect>
                                 <rect x="14" y="3" width="7" height="7"></rect>
                                 <rect x="14" y="14" width="7" height="7"></rect>
                                 <rect x="3" y="14" width="7" height="7"></rect>
                             </svg>
                         </span>
                         <span class="bottom-menu-title">Shop</span>
                     </a>
                 </div>
             </li>

             <!-- Wishlist -->
             <li class="bottom-menu-wrap">
                 <div class="bottom-menu-wrapper">
                     <a href="{{ route('wishlist.view') }}" class="bottom-menu-wishlist">
                         <span class="bottom-menu-icon-wrap">
                             <span class="bottom-menu-icon">
                                 <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                     stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                     class="css-i6dzq1">
                                     <path
                                         d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                     </path>
                                 </svg>
                             </span>
                             <span class="bottom-menu-counter wishlist-counter">
                                 {{ isset($wishlistCount) ? $wishlistCount : 0 }}
                             </span>
                         </span>
                         <span class="bottom-menu-title">Wishlist</span>
                     </a>
                 </div>
             </li>

             <!-- Cart -->
             <li class="bottom-menu-wrap">
                 <div class="bottom-menu-wrapper">
                     <a href="javascript:void(0)" class="bottom-menu-cart js-cart-icon">
                         <span class="bottom-menu-icon-wrap">
                             <span class="bottom-menu-icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                     viewBox="0 0 24 24">
                                     <path fill="currentColor"
                                         d="M6.505 2h11a1 1 0 0 1 .8.4l2.7 3.6v15a1 1 0 0 1-1 1h-16a1 1 0 0 1-1-1V6l2.7-3.6a1 1 0 0 1 .8-.4m12.5 6h-14v12h14zm-.5-2l-1.5-2h-10l-1.5 2zm-9.5 4v2a3 3 0 1 0 6 0v-2h2v2a5 5 0 0 1-10 0v-2z">
                                     </path>
                                 </svg>
                             </span>
                             <span class="bottom-menu-counter cart-counter">
                                 {{ count($cartItems ?? []) }}
                             </span>
                         </span>
                         <span class="bottom-menu-title">Cart</span>
                     </a>
                 </div>
             </li>
         </ul>
     </div>
     <!-- bottom-menu end -->
     <!-- jquery js -->
     <script src="{{ asset('web/js/jquery-3.6.3.min.js') }}"></script>
     <!-- bootstrap js -->
     <script src="{{ asset('web/js/popper.min.js') }}"></script>
     <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
     <!-- magnific-popup js -->
     <script src="{{ asset('web/js/jquery.magnific-popup.min.js') }}"></script>
     <!-- owl-carousel js -->
     <script src="{{ asset('web/js/owl.carousel.min.js') }}"></script>
     <!-- swiper-slider js -->
     <script src="{{ asset('web/js/swiper-bundle.min.js') }}"></script>
     <!-- slick js -->
     <script src="{{ asset('web/js/slick.min.js') }}"></script>
     <!-- waypoints js -->
     <script src="{{ asset('web/js/waypoints.min.js') }}"></script>
     <!-- counter js -->
     <script src="{{ asset('web/js/counter.js') }}"></script>
     <!-- main js -->
     <script src="{{ asset('web/js/main.js') }}"></script>
     <script src="{{ asset('web/js/cart.js') }}"></script>

     <script src="{{ asset('web/js/wishlist.js') }}"></script>
     <script src="{{ asset('web/js/quickview.js') }}"></script>
     <script src="{{ asset('web/js/search.js') }}"></script>
     <!-- new JS file — is line ko hata do agar lightbox nahi chahiye -->
     <script src="{{ asset('web/js/gallery-lightbox.js') }}"></script>
     <script src="{{ asset('web/js/reviews.js') }}"></script>
     <script>
         $(document).ready(function() {
             $('#blog-slider').owlCarousel({
                 loop: true,
                 margin: 20,
                 nav: true,
                 dots: false,
                 responsive: {
                     0: {
                         items: 1
                     },
                     576: {
                         items: 2
                     },
                     992: {
                         items: 3
                     }
                 }
             });
         });
     </script>

     <script>
         // Sticky sidebar
         $('#sidebar_fixed').theiaStickySidebar({
             minWidth: 991,
             updateSidebarHeight: false,
             additionalMarginTop: 90
         });
     </script>

     @if (session('success'))
         <script>
             document.addEventListener('DOMContentLoaded', function() {
                 const toastEl = document.getElementById('liveToast');
                 const toastMessage = document.getElementById('toastMessage');
                 const toastBody = toastEl.querySelector('.toast');

                 toastMessage.textContent = @json(session('success'));
                 toastEl.classList.add('text-bg-success');

                 const toast = new bootstrap.Toast(toastEl, {
                     delay: 3000
                 });
                 toast.show();
             });
         </script>
     @endif

     <script>
         // AJAX success messages ke liye shared toast function — cart.js/wishlist.js/quickview.js sab isko use karte hain
         window.showToast = function(message) {
             const toastEl = document.getElementById('liveToast');
             const toastMessage = document.getElementById('toastMessage');

             toastMessage.textContent = message;
             toastEl.classList.remove('text-bg-danger');
             toastEl.classList.add('text-bg-success');

             const toast = new bootstrap.Toast(toastEl, {
                 delay: 3000
             });
             toast.show();
         };
     </script>

     <!-- WhatsApp Floating Chat Widget -->
     @php
         $waNumber = optional($footerContact)->phone ? preg_replace('/\D/', '', optional($footerContact)->phone) : '';
     @endphp

     @if ($waNumber)
         <div id="wa-widget">
             <div id="wa-chatbox" class="d-none">
                 <div id="wa-header">
                     <span>WhatsApp</span>
                     <button id="wa-close" type="button" aria-label="Close">&times;</button>
                 </div>
                 <div id="wa-body"></div>
                 <form id="wa-form">
                     <input type="text" id="wa-input" placeholder="Type a message..."
                         value="I want to order on whatsapp" autocomplete="off">
                     <button type="submit" id="wa-send" aria-label="Send">
                         <i class="fas fa-paper-plane"></i>
                     </button>
                 </form>
             </div>

             <button id="wa-fab" type="button" aria-label="Chat on WhatsApp">
                 <i class="bi bi-whatsapp"></i>
             </button>
         </div>

         <style>
             #wa-widget {
                 position: fixed;
                 bottom: 30px;
                 right: 25px;
                 /* Left se Right pe shift */
                 left: auto;
                 z-index: 999999;
                 font-family: inherit;
             }

             #wa-fab {
                 width: 58px;
                 height: 58px;
                 border-radius: 50%;
                 background-color: #25D366;
                 border: none;
                 color: #fff;
                 font-size: 1.75rem;
                 box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
                 display: flex;
                 align-items: center;
                 justify-content: center;
                 cursor: pointer;
                 transition: all 0.25s ease;
             }

             #wa-fab:hover {
                 transform: scale(1.1);
                 box-shadow: 0 6px 20px rgba(37, 211, 102, 0.55);
             }

             #wa-chatbox {
                 position: absolute;
                 bottom: 75px;
                 right: 0;
                 /* Right side se open hoga */
                 left: auto;
                 width: 320px;
                 max-width: 88vw;
                 height: 400px;
                 background: #fff;
                 border-radius: 16px;
                 box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
                 overflow: hidden;
                 display: flex;
                 flex-direction: column;
             }

             #wa-header {
                 background-color: #075E54;
                 color: #fff;
                 padding: 14px 16px;
                 font-weight: 600;
                 display: flex;
                 align-items: center;
                 justify-content: space-between;
             }

             #wa-close {
                 background: none;
                 border: none;
                 color: #fff;
                 font-size: 1.5rem;
                 line-height: 1;
                 cursor: pointer;
                 opacity: 0.9;
             }

             #wa-close:hover {
                 opacity: 1;
             }

             #wa-body {
                 flex: 1;
                 background-color: #e5ddd5;
                 background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" opacity="0.06"><text x="10" y="40" font-size="20">💬</text></svg>');
             }

             #wa-form {
                 display: flex;
                 align-items: center;
                 padding: 10px 12px;
                 background-color: #f0f0f0;
                 border-top: 1px solid #ddd;
             }

             #wa-input {
                 flex: 1;
                 border: none;
                 border-radius: 22px;
                 padding: 11px 16px;
                 font-size: 0.9rem;
                 outline: none;
                 background: #fff;
             }

             #wa-send {
                 width: 42px;
                 height: 42px;
                 border-radius: 50%;
                 background-color: #25D366;
                 border: none;
                 color: #fff;
                 margin-left: 8px;
                 display: flex;
                 align-items: center;
                 justify-content: center;
                 cursor: pointer;
                 flex-shrink: 0;
                 transition: background 0.2s;
             }

             #wa-send:hover {
                 background-color: #1da851;
             }

             /* ========== Mobile Fix ========== */
             @media (max-width: 991px) {
                 #wa-widget {
                     bottom: 80px;
                     /* Bottom menu se upar */
                     right: 18px;
                 }

                 #wa-fab {
                     width: 54px;
                     height: 54px;
                     font-size: 1.6rem;
                 }

                 #wa-chatbox {
                     width: 300px;
                     height: 380px;
                     bottom: 70px;
                     right: 0;
                 }
             }

             @media (max-width: 480px) {
                 #wa-widget {
                     bottom: 75px;
                     right: 15px;
                 }

                 #wa-chatbox {
                     width: 92vw;
                     height: 370px;
                     right: -5px;
                 }
             }
         </style>

         <script>
             (function() {
                 const fab = document.getElementById('wa-fab');
                 const box = document.getElementById('wa-chatbox');
                 const closeBtn = document.getElementById('wa-close');
                 const form = document.getElementById('wa-form');
                 const input = document.getElementById('wa-input');
                 const waNumber = "{{ $waNumber }}";

                 fab.addEventListener('click', function() {
                     box.classList.toggle('d-none');
                 });

                 closeBtn.addEventListener('click', function() {
                     box.classList.add('d-none');
                 });

                 form.addEventListener('submit', function(e) {
                     e.preventDefault();
                     const message = input.value.trim() || 'Hello';
                     const url = 'https://wa.me/' + waNumber + '?text=' + encodeURIComponent(message);
                     window.open(url, '_blank');
                 });
             })();
         </script>
     @endif

 </body>

 </html>
