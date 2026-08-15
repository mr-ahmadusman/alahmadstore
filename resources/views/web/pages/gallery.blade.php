@section('title', ($gallery->title ?? 'Gallery') . ' | Al Ahmad Store')
@section('meta_description', 'Explore the photo gallery of Al Ahmad Store. See our watches, headphones, clothing and more quality products available online in Pakistan with Cash on Delivery.')
@section('meta_keywords', 'al ahmad store gallery, product photos, watches gallery, headphones, clothing pakistan')

@extends('web.layouts.app')
@section('content')
<main>
    <!-- breadcrumb start -->
    <section class="breadcrumb-area"
        style="background-image:url('{{ asset($gallery->background_image) }}'); background-size:cover; background-position:center; background-repeat:no-repeat; position:relative;">
        <!-- dark overlay (koi CSS file nahi, sirf inline style) -->
        <div style="position:absolute; inset:0; background:rgba(0,0,0,0.45);"></div>
        <div class="container" style="position:relative; z-index:2;">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-index">
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-ul">
                            <li class="breadcrumb-li">
                                <a class="breadcrumb-link" href="{{ url('/') }}" style="color:#fff;">Home</a>
                            </li>
                            <li class="breadcrumb-li">
                                <span class="breadcrumb-text" style="color:#fff;">{{ $gallery->title }}</span>
                            </li>
                        </ul>
                        <!-- breadcrumb-list end -->
                        <h1 class="mt-2" style="color:#fff;" data-animate="animate__fadeInUp">{{ $gallery->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- gallery-grid start -->
    <section class="gallery-area section-ptb">
        <div class="container">
            <div class="row gallery-lightbox g-3 g-md-4">
                @forelse($galleries as $photo)
                    <div class="col-6 col-md-4 col-lg-3" data-animate="animate__fadeInUp">
                        <a href="{{ asset($photo->photo) }}"
   class="gallery-item d-block position-relative overflow-hidden rounded"
   title="{{ $gallery->title }} - Al Ahmad Store">
                            <img src="{{ asset($photo->photo) }}"
     class="img-fluid w-100 rounded"
     alt="{{ $gallery->title }} - Al Ahmad Store">
                            <span class="pro-action-icon"
                                style="position:absolute; top:10px; right:10px; width:36px; height:36px;
                                       background:#fff; border-radius:50%; display:flex; align-items:center;
                                       justify-content:center;">
                                <i class="bi bi-arrows-fullscreen"></i>
                            </span>
                        </a>
                    </div>
                @empty
                    <div class="col">
                        <p class="text-center">No photos found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- gallery-grid end -->
</main>



@endsection
