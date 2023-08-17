@extends('layouts.app')

@section('content')
@include('layouts.menubar');
<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll"
        data-image-src="{{ asset('frontend/images/shop_background.jpg')}}"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">Technological Blog</h2>
    </div>
</div>

<!-- Blog -->

<div class="blog">
    <div class="container">
        <div class="row blog_posts">
            @foreach ($post as $row)
            <div class="col-lg-4">
                <!-- Blog post -->
                <div class="blog_post" style="width: unset; height: unset;">
                    <a href="{{ route('blog.single', $row->id) }}">
                        <div class="blog_image" style="background-image:url({{ asset($row->post_image)}}) "></div>
                    </a>
                    <div class="blog_text">
                        <a href="{{ route('blog.single', $row->id) }}" style="color: #000;" >
                            @if (Session::get('lang') == 'hindi')
                            {{ $row->post_title_hin }}
                            @else
                            {{ $row->post_title_en }}
                            @endif
                        </a>
                    </div>
                    <div class="blog_button">
                        <a href="{{ route('blog.single', $row->id) }}">
                            @if (Session::get('lang') == 'hindi')
                            जारी रखें पढ़ रहे हैं
                            @else
                            Continue Reading
                            @endif
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Newsletter -->
<div class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col">
                <div
                    class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                    <div class="newsletter_title_container">
                        <div class="newsletter_icon"><img src="{{ asset('frontend/images/send.png')}}" alt="">
                        </div>
                        <div class="newsletter_title">Sign up for Newsletter</div>
                        <div class="newsletter_text">
                            <p>...and receive %20 coupon for first shopping.</p>
                        </div>
                    </div>
                    <div class="newsletter_content clearfix">
                        <form action="{{ route('store.newslater') }}" method="post" class="newsletter_form">
                            @csrf
                            <input type="email" name="email" class="newsletter_input"
                                placeholder="Enter your email address">
                            <button class="newsletter_button" type="submit">Subscribe</button>
                        </form>
                        <div class="newsletter_unsubscribe_link"><a href="#">Unsubscribe</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
