@extends('web.layouts.app')

@section('content')

<main class="bg_gray">

    <div class="container margin_30">

        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Reset Password</li>
                </ul>
            </div>

            <h1>Reset Password</h1>
        </div>

        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-7 col-md-9">

                <div class="box_account">

                    <h3 class="client">Reset Your Password</h3>

                    <div class="form_container">

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ $email ?? old('email') }}"
                                    placeholder="Email Address"
                                    required
                                    autofocus
                                >

                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="New Password"
                                    required
                                >

                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm Password"
                                    required
                                >
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn_1 full-width">
                                    Reset Password
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">
                        Back to Login
                    </a>
                </div>

            </div>

        </div>

    </div>

</main>

@endsection
