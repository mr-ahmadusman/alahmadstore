@extends('web.layouts.app')
@section('title', 'Contact Us | Al Ahmad Store')
@section('meta_description', 'Get in touch with Al Ahmad Store for questions about watches, headphones, mobile accessories and clothing.')
@section('content')
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
                                <span class="breadcrumb-text">Contact us</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- get-info-area start -->
    <section class="get-info-area section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about-content">
                        <div class="section-capture">
                            <div class="section-title">
                                <h2><span>Get in touch</span></h2>
                            </div>
                        </div>

                        <div class="get-info contact-detail">
                            <ul class="get-info-ul">
                                <li class="get-info-li">
                                    <span class="get-icon"><i class="bi bi-geo"></i></span>
                                    <span class="get-add contact-block">
                                        <span>{{ optional($footerContact)->address ?? 'Address not set' }}</span>
                                    </span>
                                </li>
                                <li class="get-info-li">
                                    <span class="get-icon"><i class="bi bi-telephone"></i></span>
                                    <div class="contact-block">
                                        <a href="tel:{{ optional($footerContact)->phone }}" class="get-add">{{ optional($footerContact)->phone ?? 'N/A' }}</a>
                                    </div>
                                </li>
                                <li class="get-info-li">
                                    <span class="get-icon"><i class="bi bi-envelope"></i></span>
                                    <div class="contact-block">
                                        <a href="mailto:{{ optional($footerContact)->mail }}" class="get-add">{{ optional($footerContact)->mail ?? 'N/A' }}</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- get-info-area end -->

    <!-- google-map start -->
    <section class="google-map section-pb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="map-wrap">
                        <div class="map-wrapper">
                            <div class="map-info" id="map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3178.943120902953!2d-7.963813984699448!3d37.177822679872456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1ab161c81fb0ff%3A0x867380c80c46b1d!2sAmendoeira%20Organics!5e0!3m2!1sen!2spt!4v1631184615272!5m2!1sen!2spt" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- google-map end -->

    <!-- drop-detail start -->
    <section class="drop-detail section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-capture">
                        <div class="section-title">
                            <h2><span>Drop us message</span></h2>
                        </div>
                    </div>

                    <div class="form-warp contact-detail">
                        <div class="contact-form-list">
                            <form method="POST" action="{{ route('contact.store') }}">
                                @csrf
                                <ul class="form-fill">
                                    <li class="form-fill-li Name">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Name">
                                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                    </li>
                                    <li class="form-fill-li Email">
                                        <label>Email address</label>
                                        <input type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email address">
                                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                    </li>
                                    <li class="form-fill-li Phone number">
                                        <label>Phone number</label>
                                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone number">
                                        @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                                    </li>
                                    <li class="form-fill-li Message">
                                        <label>Message</label>
                                        <textarea rows="10" name="message" placeholder="Message" class="custom-textarea">{{ old('message') }}</textarea>
                                        @error('message')<small class="text-danger">{{ $message }}</small>@enderror
                                    </li>
                                </ul>
                                <div class="contact-submit">
                                    <button type="submit" class="btn btn-style2">
                                        <span>Send</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- drop-detail end -->
</main>
@endsection
