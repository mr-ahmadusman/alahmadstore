@section('title', 'My Profile | Al Ahmad Store')
@section('meta_description', 'Manage your profile at Al Ahmad Store.')
@section('meta_robots', 'noindex, follow')

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
                                <span class="breadcrumb-text">Profile</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- profile start -->
    <section class="pro-address-area section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="password-block">

                        <!-- left sidebar start -->
                        <div class="profile-info">
                            <div class="account-profile">
                                <div class="pro-img">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('web/img/testi/profile.png') }}" class="img-fluid" alt="profile">
                                    </a>
                                </div>
                                <div class="profile-text">
                                    <h6>{{ Auth::user()->name }}</h6>
                                    <span>Joined {{ Auth::user()->created_at->format('F d, Y') }}</span>
                                </div>
                            </div>

                            <div class="account-detail">
                                <ul class="profile-ul">
                                    <li class="profile-li">
                                        <a href="{{ route('my.orders') }}">
                                            <span>Orders</span>
                                        </a>
                                    </li>
                                    <li class="profile-li">
                                        <a href="{{ route('profile') }}" class="active">Profile</a>
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
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- left sidebar end -->

                        <!-- right content start -->
                        <div class="profile-form profile-address">
                            <div class="billing-area">

                                <div class="pro-add-title">
                                    <h6>My Profile</h6>
                                </div>

                                {{-- My Details --}}
                                <div class="box_profile_details mb-4">
                                    <h6 class="mb-3">My Details</h6>
                                    <div class="data_profile">
                                        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                    </div>
                                </div>

                                {{-- Login Details --}}
                                <div class="box_profile_details mb-4">
                                    <h6 class="mb-3">Login Details</h6>
                                    <div class="data_profile">
                                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                        <p><strong>Password:</strong> ********</p>
                                    </div>
                                </div>

                                {{-- Billing Address --}}
                                <div class="box_profile_details mb-4">
                                    <h6 class="mb-3">Billing Address</h6>
                                    <div class="data_profile">
                                        <p>Not Available</p>
                                    </div>
                                </div>

                                {{-- Shipping Address --}}
                                <div class="box_profile_details">
                                    <h6 class="mb-3">Shipping Address</h6>
                                    <div class="data_profile">
                                        <p>Not Available</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- right content end -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- profile end -->
</main>
@endsection
