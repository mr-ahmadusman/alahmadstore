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
                                <span class="breadcrumb-text">Create Account</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- customer-page start -->
    <section class="customer-page section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- account title start -->
                    <div class="section-capture">
                        <div class="section-title">
                            <h2 data-animate="animate__fadeInUp"><span>Create account</span></h2>
                        </div>
                    </div>
                    <!-- account title end -->

                    <!-- account form start -->
                    <div class="log-acc-page">
                        <div class="contact-form-list">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <ul class="form-fill">
                                    {{-- Name --}}
                                    <li class="form-fill-li Name" data-animate="animate__fadeInUp">
                                        <label>Name</label>
                                        <input type="text"
                                               name="name"
                                               value="{{ old('name') }}"
                                               class="@error('name') is-invalid @enderror"
                                               autocomplete="name"
                                               placeholder="Name"
                                               required>
                                        @error('name')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </li>

                                    {{-- Email --}}
                                    <li class="form-fill-li Email" data-animate="animate__fadeInUp">
                                        <label>Email address</label>
                                        <input type="email"
                                               name="email"
                                               value="{{ old('email') }}"
                                               class="@error('email') is-invalid @enderror"
                                               autocomplete="email"
                                               placeholder="Email address"
                                               required>
                                        @error('email')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </li>

                                    {{-- Password --}}
                                    <li class="form-fill-li Password" data-animate="animate__fadeInUp">
                                        <label>Password</label>
                                        <input type="password"
                                               name="password"
                                               class="@error('password') is-invalid @enderror"
                                               placeholder="Password"
                                               required>
                                        @error('password')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </li>

                                    {{-- Confirm Password --}}
                                    <li class="form-fill-li Password" data-animate="animate__fadeInUp">
                                        <label>Confirm Password</label>
                                        <input type="password"
                                               name="password_confirmation"
                                               placeholder="Confirm Password"
                                               required>
                                    </li>
                                </ul>

                                <div class="form-action-button">
                                    <div class="read-agree">
                                        <label data-animate="animate__fadeInUp">
                                            <span class="agree-text">
                                                I have read and agree with the
                                                <a href="{{ url('/terms-condition') }}">terms & condition.</a>
                                            </span>
                                            <input type="checkbox" name="terms" class="cust-checkbox create-checkbox" required>
                                            <span class="cust-check"></span>
                                        </label>

                                        <button type="submit" class="btn btn-style2 create" data-animate="animate__fadeInUp">
                                            CREATE
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="acc-wrapper" data-animate="animate__fadeInUp">
                            <h6>Already have account?</h6>
                            <div class="account-optional">
                                <a href="{{ route('login') }}">Log in</a>
                            </div>
                        </div>
                    </div>
                    <!-- account form end -->
                </div>
            </div>
        </div>
    </section>
    <!-- customer-page end -->
</main>
@endsection
