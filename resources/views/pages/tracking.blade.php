@extends('layouts.app')

@section('content')
@include('layouts.menubar');

<!-- Blog -->

<div class="blog">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-3">
                    <h3>Track Your Order</h3>
                    <div class="card-body">
                        <form action=" " method="post">
                            @csrf
                            <div class="modal-body">
                                <label for="">Status Code</label>
                                <input type="text" name="code" required class="form-control"
                                    placeholder="Your Order Status Code">
                                <button type="submit" class="btn mt-3 btn-info">Track Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
