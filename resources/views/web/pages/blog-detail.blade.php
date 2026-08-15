@extends('web.layouts.app')
@section('title', $blog->title . ' | Al Ahmad Store')
@section('meta_description', Str::limit(strip_tags($blog->description), 160))

@section('content')
<main>
    <!-- breadcrumb -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="col">
                <div class="row">
                    <div class="breadcrumb-index">
                        <ul class="breadcrumb-ul">
                            <li class="breadcrumb-li"><a class="breadcrumb-link" href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-li"><a class="breadcrumb-link" href="{{ route('web.blogs') }}">Blog</a></li>
                            <li class="breadcrumb-li"><span class="breadcrumb-text">{{ $blog->title }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="article-area section-pt">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="blog-article-wrapper left-side">

                        <!-- sidebar start -->
                        <div class="blog-article-wrap blog-sidebar">
                            <div class="blog-sidebar-wrap">
                                <div class="blog-post-sidebar blog-search">
                                    <h6 class="blog-sidebar-title">Search</h6>
                                    <div class="search-post">
                                        <form method="GET" action="{{ route('web.blogs') }}">
                                            <input type="search" name="q" class="input-text" placeholder="Search blog" required autocomplete="off">
                                            <button type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </form>
                                    </div>
                                </div>

                                <div class="blog-post-sidebar blog-recent-post">
                                    <h6 class="blog-sidebar-title">Recent post</h6>
                                    @foreach($blogs as $recent)
                                    <div class="sidbar-inner sidbar-inner-wrap">
                                        <div class="post-image">
                                            <a href="{{ route('blog.detail', $recent->slug) }}" class="banner-img">
                                                <img src="{{ asset($recent->image) }}" class="img-fluid" alt="{{ $recent->title }}">
                                            </a>
                                        </div>
                                        <div class="recent-blog-content">
                                            <h6><a href="{{ route('blog.detail', $recent->slug) }}">{{ Str::limit($recent->title, 40) }}</a></h6>
                                            <span>{{ $recent->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- sidebar end -->

                        <div class="blog-article-wrap blog-article">
                            <div class="article-blog-post">
                                <div class="blog-post-opt blog-post-img">
                                    <div class="blog-image">
                                        <a href="{{ route('blog.detail', $blog->slug) }}" class="banner-img">
                                            <img src="{{ asset($blog->image) }}" class="img-fluid" alt="{{ $blog->title }}">
                                        </a>
                                        <ul>
                                            <li class="date-time"><span>{{ $blog->created_at->format('M d, Y') }}</span></li>
                                            <li class="blog-comment"><span class="comment-count">{{ $blog->comments->count() }} comments</span></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="blog-post-opt blog-post-title">
                                    <div class="blog-revert">
                                        <h1 class="post-title">{{ $blog->title }}</h1>
                                        <div class="post-info"><span>By Al Ahmad Store</span></div>
                                    </div>
                                </div>

                                <div class="blog-post-opt blog-post-content">
                                    <div class="blog-content">
                                        <div class="blog-wrap-desc">
                                            {!! nl2br(e($blog->description)) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="blog-post-opt blog-post-icon">
                                    <div class="blog-share">
                                        <ul class="social-icon">
                                            <li>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener">
                                                    <span class="icon-social facebook"><i class="fa-brands fa-facebook-f"></i></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}" target="_blank" rel="noopener">
                                                    <span class="icon-social twitter"><i class="fa-brands fa-x-twitter"></i></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ urlencode(asset($blog->image)) }}&description={{ urlencode($blog->title) }}" target="_blank" rel="noopener">
                                                    <span class="icon-social pinterest"><i class="fa-brands fa-pinterest-p"></i></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="blog-post-opt blog-post-arrow">
                                    <div class="blog-prev-next">
                                        <ul>
                                            <li>
                                                @if($prevBlog)
                                                <a href="{{ route('blog.detail', $prevBlog->slug) }}">
                                                    <i class="bi bi-chevron-double-left"></i>
                                                    <span>Prev post</span>
                                                </a>
                                                @endif
                                            </li>
                                            <li>
                                                @if($nextBlog)
                                                <a href="{{ route('blog.detail', $nextBlog->slug) }}">
                                                    <span>Next post</span>
                                                    <i class="bi bi-chevron-double-right"></i>
                                                </a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single post end -->

                            <!-- comments -->
                            <div class="blog-comments">
                                <div class="review-comment">
                                    <div class="cmt-tit-count">
                                        <h6 class="comment-title">
                                            <span class="cmt-title">Comment</span>
                                            <span class="cmt-count">({{ $blog->comments->count() }})</span>
                                        </h6>
                                    </div>

                                    @forelse($blog->comments as $comment)
                                    <div class="cmt-info-wrap">
                                        <div class="comment-info">
                                            <div class="comment-avtar">
                                                <div class="review-name">
                                                    <span class="avtar-cmt"><span class="cmt-auth">{{ Str::upper(Str::substr($comment->name, 0, 2)) }}</span></span>
                                                </div>
                                                <div class="review-info">
                                                    <span class="cmt-authr">{{ $comment->name }}</span>
                                                    <span class="time">{{ $comment->created_at->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="comment-content">
                                                <div class="comment-desc"><p>{{ $comment->comment }}</p></div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p> No Comment </p>
                                    @endforelse
                                </div>

                                <div class="blog-comment-form">
                                    @if(session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    <form method="POST" action="{{ route('comment.store', $blog->id) }}" class="comment-form">
                                        @csrf
                                        <div class="comments-reply-area">
                                            <h6 class="comment-title">Leave a comment</h6>
                                            <div class="form-wrap">
                                                <div class="form-filed">
                                                    <label>Name<span class="required">*</span></label>
                                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name">
                                                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                                </div>
                                                <div class="form-filed">
                                                    <label>Email address<span class="required">*</span></label>
                                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email address">
                                                    @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                                </div>
                                                <div class="form-filed">
                                                    <label>Message<span class="required">*</span></label>
                                                    <textarea rows="5" name="comment" class="comment-notes" placeholder="Message">{{ old('comment') }}</textarea>
                                                    @error('comment')<small class="text-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </div>
                                            <div class="comment-form-submit">
                                                <button type="submit" class="btn btn-style2">Post comment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- related blogs slider -->
    <div class="our-blog section-ptb">
        <div class="blog-category">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section-capture">
                            <div class="section-title">
                                <div class="section-cont-title"><h2><span>Blog &amp; events</span></h2></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="blog-wrap">
                            <div class="blog-slider owl-carousel owl-theme" id="blog-slider">
                                @foreach($blogs as $related)
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-img">
                                            <a href="{{ route('blog.detail', $related->slug) }}" class="banner-img">
                                                <img src="{{ asset($related->image) }}" class="img-fluid" alt="{{ $related->title }}">
                                                <span class="blog-date-time">
                                                    <span class="blog-date">{{ $related->created_at->format('d') }}</span>
                                                    <span class="blog-month">{{ $related->created_at->format('M') }}</span>
                                                    <span class="blog-year">{{ $related->created_at->format('Y') }}</span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-tag"><h2>{{ $related->title }}</h2></div>
                                            <p class="blog-title">{{ Str::limit(strip_tags($related->description), 70) }}</p>
                                            <a href="{{ route('blog.detail', $related->slug) }}" class="blog-btn btn-style2">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
