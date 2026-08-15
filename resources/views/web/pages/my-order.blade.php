@section('title', 'My Orders | Al Ahmad Store')
@section('meta_description', 'View and track your orders at Al Ahmad Store.')
@section('meta_robots', 'noindex, follow')

@extends('web.layouts.app')

@section('content')
    <!-- main section start -->
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
                                    <span class="breadcrumb-text">My Orders</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb end -->

        <!-- order history start -->
        <section class="order-histry-area section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="password-block">
                            <!-- left sidebar start -->
                            <div class="profile-info">
                                <div class="account-profile">
                                    <div class="pro-img">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('web/img/testi/profile.png') }}" class="img-fluid"
                                                alt="profile">
                                        </a>
                                    </div>
                                    <div class="profile-text">

                                        <h6>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</h6>
<span>
    @if(Auth::check())
        Joined {{ Auth::user()->created_at->format('F d, Y') }}
    @endif
</span>
                                    </div>
                                </div>

                                <div class="account-detail">
                                    <ul class="profile-ul">
                                        <li class="profile-li">
                                            <a href="{{ route('my.orders') }}" class="active">
                                                <span>Orders</span>
                                            </a>
                                        </li>
                                        <li class="profile-li">
                                            <a href="{{ route('profile') }}">Profile</a>
                                        </li>
                                        <li class="profile-li">
                                            <a href="{{ route('wishlist.view') }}">
                                                <span>Wishlist</span>
                                            </a>
                                        </li>
                                        <li class="profile-li">
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <span>Sign out</span>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- left sidebar end -->
                            <!-- order info start -->
                            <div class="profile-form order-info" data-animate="animate__fadeInUp">
                                <div class="pro-add-title mb-4">
                                    <h6>My Orders</h6>
                                </div>

                                @forelse($orders as $order)
                                    <div class="order-box mb-4 border rounded-3 overflow-hidden bg-white shadow-sm">

                                        {{-- Order Header --}}
                                        <div
                                            class="d-flex flex-wrap justify-content-between align-items-center p-3 border-bottom bg-light">
                                            <div class="mb-2 mb-sm-0">
                                                <strong class="d-block">Order #{{ $order->id }}</strong>
                                                <small class="text-muted">
                                                    {{ $order->created_at->format('d M, Y') }}
                                                    &nbsp;•&nbsp;
                                                    {{ $order->created_at->format('h:i A') }}
                                                </small>
                                            </div>
                                            <div>
                                                @if ($order->order_status == 'pending')
                                                    <span
                                                        class="badge rounded-pill bg-warning text-dark px-3 py-2">Pending</span>
                                                @elseif($order->order_status == 'processing')
                                                    <span
                                                        class="badge rounded-pill bg-info text-white px-3 py-2">Processing</span>
                                                @elseif($order->order_status == 'shipped')
                                                    <span class="badge rounded-pill bg-primary px-3 py-2">Shipped</span>
                                                @elseif($order->order_status == 'delivered')
                                                    <span class="badge rounded-pill bg-success px-3 py-2">Delivered</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger px-3 py-2">Cancelled</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Products Table --}}
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0 align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="ps-3">Product</th>
                                                        <th class="text-center d-none d-md-table-cell">Price</th>
                                                        <th class="text-center">Qty</th>
                                                        <th class="text-end pe-3">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->items as $item)
                                                        <tr>
                                                            <td class="ps-3">
                                                                <div class="d-flex align-items-center gap-3">
                                                                    <div class="flex-shrink-0">
                                                                        <img src="{{ asset($item->product->image ?? 'img/product/home1-pro-1.jpg') }}"
                                                                            width="60" height="60"
                                                                            class="img-fluid rounded border"
                                                                            style="object-fit: cover;"
                                                                            alt="{{ $item->product_name }}">
                                                                    </div>
                                                                    <div>
                                                                        <span
                                                                            class="fw-medium d-block">{{ $item->product_name }}</span>
                                                                        {{-- Mobile pe price yahan dikhao --}}
                                                                        <small class="text-muted d-md-none">
                                                                            Rs {{ number_format($item->price) }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center d-none d-md-table-cell">
                                                                Rs {{ number_format($item->price) }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $item->quantity ?? 1 }}
                                                            </td>
                                                            <td class="text-end pe-3">
                                                                <strong>Rs
                                                                    {{ number_format($item->price * ($item->quantity ?? 1)) }}</strong>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        {{-- Footer --}}
                                        <div
                                            class="d-flex flex-wrap justify-content-between align-items-center p-3 border-top bg-light">
                                            <div class="mb-2 mb-sm-0">
                                                <a href="javascript:void(0)" class="btn btn-style2 btn-sm">
                                                    Track Order
                                                </a>
                                            </div>
                                            <div class="text-end">
                                                <span class="text-muted me-2">Order Total:</span>
                                                <strong class="fs-5 text-dark">
                                                    Rs
                                                    {{ number_format($order->total_amount ?? $order->items->sum(fn($i) => $i->price * ($i->quantity ?? 1))) }}
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <div class="mb-3">
                                            <i class="feather-shopping-bag" style="font-size: 48px; opacity: 0.3;"></i>
                                        </div>
                                        <h5 class="mb-2">No Orders Found</h5>
                                        <p class="text-muted mb-4">You haven’t placed any orders yet.</p>
                                        <a href="{{ url('/') }}" class="btn btn-style">Continue Shopping</a>
                                    </div>
                                @endforelse

                            </div>
                            <!-- order info end -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- order history end -->
    </main>
    <!-- main section end -->
@endsection
