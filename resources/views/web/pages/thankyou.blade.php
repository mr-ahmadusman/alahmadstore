@section('title', 'Thank You | Order Confirmed | Al Ahmad Store')
@section('meta_description', 'Your order has been placed successfully at Al Ahmad Store.')
@section('meta_robots', 'noindex, follow')

@extends('web.layouts.app')
@section('content')
<!-- main section start-->
<main>
    <!-- breadcrumb start -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-index">
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-ul">
                            <li class="breadcrumb-li">
                                <a class="breadcrumb-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-li">
                                <span class="breadcrumb-text">Order complete</span>
                            </li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    @if(session('success'))
        <div class="container">
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        </div>
    @endif

    @if($order)
        <!-- order-complete start -->
        <section class="order-complete section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="order-area">
                            <!-- order-price start -->
                            <div class="order-price">
                                <ul class="total-order" data-animate="animate__fadeInUp">
                                    <li>
                                        <span class="order-no">Order no. {{ $order->id }}</span>
                                        <span class="order-date">{{ $order->created_at->format('jS M Y g:i A') }}</span>
                                    </li>
                                    <li>
                                        <span class="total-price">Order total</span>
                                        <span class="amount">Rs {{ number_format($order->total_amount, 2) }}</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- order-price end -->

                            <!-- order-details start -->
                            <div class="order-details">
                                <span class="text-success order-i" data-animate="animate__fadeInUp"><i class="fa fa-check-circle"></i></span>
                                <h6 data-animate="animate__fadeInUp">Thank you{{ $order->name ? ', ' . $order->name : '' }} for your order</h6>
                                <span class="order-s" data-animate="animate__fadeInUp">Your order will ship within few hours</span>
                                <a href="{{ route('my.orders') }}" class="tracking-link btn btn-style2" data-animate="animate__fadeInUp">View My Orders</a>
                            </div>
                            <!-- order-details end -->

                            <!-- order-delivery start -->
                            <div class="order-delivery">
                                <ul class="delivery-payment">
                                    <li class="delivery" data-animate="animate__fadeInUp">
                                        <h6>Delivery address</h6>
                                        <p>{{ $order->address }}</p>
                                        @if($order->city)
                                            <span class="order-span">{{ $order->city }}</span>
                                        @endif
                                        @if($order->postal_code)
                                            <span class="order-span">{{ $order->postal_code }}</span>
                                        @endif
                                        <span class="order-span">Pakistan</span>
                                        <span class="order-span">Mobile No : {{ $order->phone }}</span>
                                        @if($order->email)
                                            <span class="order-span">Email : {{ $order->email }}</span>
                                        @endif
                                    </li>
                                    <li class="pay" data-animate="animate__fadeInUp">
                                        <h6>Payment summary</h6>
                                        <p class="transition">Payment Method : {{ $order->payment_method }}</p>
                                        @foreach($order->items as $it)
                                            <span class="order-span p-label">
                                                <span class="n-price">{{ $it->qty }} x {{ $it->product_name }}</span>
                                                <span class="o-price">Rs {{ number_format($it->subtotal, 2) }}</span>
                                            </span>
                                        @endforeach
                                        <span class="order-span p-label">
                                            <span class="n-price">Order Total</span>
                                            <span class="o-price">Rs {{ number_format($order->total_amount, 2) }}</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <!-- order-delivery end -->

                            <div class="text-center mt-4">
                                <a href="{{ url('/') }}" class="btn btn-style">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- order-complete end -->
    @else
        <section class="order-complete section-ptb">
            <div class="container text-center">
                <p>No order details found.</p>
                <a href="{{ url('/') }}" class="btn btn-style mt-3">Continue Shopping</a>
            </div>
        </section>
    @endif
</main>
<!-- main section end-->

@endsection
