@extends('web.layouts.app')
@section('title', 'Blog | Al Ahmad Store')
@section('meta_description', 'Al Ahmad Store blog - watches, mobile accessories, earbuds, hair machine aur clothing collection ki latest updates, guides aur news.')

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
                                <a class="breadcrumb-link" href="{{ route('web.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-li">
                                <span class="breadcrumb-text">Blog</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- article-area start -->
    <section class="article-area section-ptb">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="blog-grid-wrapper without-wrap">
                        <div class="blog-grid-wrap blog-article">
                            <div class="blog-grid-view">

                                @if($keyword)
                                <p class="mb-3">Search results for: <strong>{{ $keyword }}</strong> — <a href="{{ route('web.blogs') }}">Clear</a></p>
                                @endif

                                <ul class="blog-area-wrap">
                                    @forelse($blogs as $blog)
                                    <li class="blog-slider" data-animate="animate__fadeInUp">
                                        <div class="blog-post">
                                            <div class="blog-img">
                                                <a href="{{ route('blog.detail', $blog->slug) }}" class="banner-img">
                                                    <img src="{{ asset($blog->image) }}" class="img-fluid" alt="{{ $blog->title }}">
                                                    <span class="blog-icon">
                                                        <i class="fas fa-paperclip"></i>
                                                    </span>
                                                    <span class="blog-date-time">
                                                        <span class="blog-date">{{ $blog->created_at->format('d') }}</span>
                                                        <span class="blog-month">{{ $blog->created_at->format('M') }}</span>
                                                        <span class="blog-year">{{ $blog->created_at->format('Y') }}</span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="blog-content">
                                                <div class="blog-tag">
                                                    <h2><a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a></h2>
                                                </div>
                                                <p class="blog-title">{{ Str::limit(strip_tags($blog->description), 100) }}</p>
                                                <a href="{{ route('blog.detail', $blog->slug) }}" class="blog-btn btn-style2">Read more</a>
                                            </div>
                                        </div>
                                    </li>
                                    @empty
                                    <li>
                                        <p>No blog posts available at the moment.</p>
                                    </li>
                                    @endforelse
                                </ul>

                                @if ($blogs->hasPages())
                                <div class="paginatoin-area">
                                    <ul class="pagination-page-box" data-animate="animate__fadeInUp">
                                        @if (!$blogs->onFirstPage())
                                            <li class="page-prev"><a href="{{ $blogs->previousPageUrl() }}" class="theme-glink"><i class="fa-solid fa-angle-left"></i></a></li>
                                        @endif

                                        @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                                            <li class="number {{ $blogs->currentPage() == $i ? 'active' : '' }}">
                                                <a href="{{ $blogs->url($i) }}" class="{{ $blogs->currentPage() == $i ? 'theme-glink' : 'gradient-text' }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        @if ($blogs->hasMorePages())
                                            <li class="page-next"><a href="{{ $blogs->nextPageUrl() }}" class="theme-glink"><i class="fa-solid fa-angle-right"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- article-area end -->
</main>
@endsection
