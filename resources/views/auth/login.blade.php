@section('title', 'Login | Al Ahmad Store')
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
                                <span class="breadcrumb-text">Account</span>
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

                    <!-- ================= LOGIN FORM ================= -->
                    <div class="log-acc" id="CustomerLoginForm">
                        <div class="section-capture">
                            <div class="section-title">
                                <h2 data-animate="animate__fadeInUp">
                                    <span>Login account</span>
                                </h2>
                            </div>
                        </div>

                        <div class="log-acc-page">
                            <div class="contact-form-list">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <ul class="form-fill">
                                        <!-- Email -->
                                        <li class="form-fill-li Email" data-animate="animate__fadeInUp">
                                            <label>Email address</label>
                                            <input type="email"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                   autocomplete="email"
                                                   placeholder="Email address"
                                                   required
                                                   autofocus
                                                   class="@error('email') is-invalid @enderror">

                                            @error('email')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                            @enderror
                                        </li>

                                        <!-- Password -->
                                        <li class="form-fill-li Password" data-animate="animate__fadeInUp">
                                            <label>Password</label>
                                            <input type="password"
                                                   name="password"
                                                   placeholder="Password"
                                                   required
                                                   class="@error('password') is-invalid @enderror">

                                            @error('password')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                            @enderror
                                        </li>

                                        <!-- Remember me -->
                                        <li class="form-fill-li" data-animate="animate__fadeInUp" style="margin-top: 10px; margin-bottom: 15px;">
    <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px; font-weight: 400;">
        <input type="checkbox"
               name="remember"
               {{ old('remember') ? 'checked' : '' }}
               style="width: 16px; height: 16px; margin: 0; accent-color: #6c5ce7; cursor: pointer;">
        <span>Remember me</span>
    </label>
</li>
                                    </ul>

                                    <div class="form-action-button" data-animate="animate__fadeInUp">
                                        <div class="button-forget">
                                            <button type="submit" class="btn btn-style2">Sign in</button>

                                            @if (Route::has('password.request'))
                                                <a href="javascript:void(0)" onclick="myFunction()">
                                                    Forgot your password?
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="acc-wrapper" data-animate="animate__fadeInUp">
                                <h6>Don't have an account?</h6>
                                <div class="account-optional">
                                    <a href="{{ route('register') }}">Create a account</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================= FORGOT PASSWORD FORM ================= -->
                    <div class="log-acc" id="RecoverPasswordForm" style="display: none;">
                        <div class="content-main-title">
                            <div class="section-capture">
                                <div class="section-title">
                                    <h2><span>Reset password</span></h2>
                                </div>
                            </div>
                        </div>

                        <div class="log-acc-page">
                            <div class="contact-form-list">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <ul class="form-fill">
                                        <li class="form-fill-li Email">
                                            <label>Email address</label>
                                            <input type="email"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                   autocomplete="email"
                                                   placeholder="Email address"
                                                   required>
                                        </li>
                                    </ul>

                                    <div class="form-action-button">
                                        <div class="button-forget">
                                            <button type="submit" class="btn btn-style2">Send Reset Link</button>
                                            <a href="javascript:void(0)" onclick="myFunction()">Back to Login</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script>
            function myFunction() {
                var x = document.getElementById("RecoverPasswordForm");
                var y = document.getElementById("CustomerLoginForm");

                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.display = "none";
                } else {
                    x.style.display = "none";
                    y.style.display = "block";
                }
            }
        </script>
    </section>
    <!-- customer-page end -->
</main>

@endsection
