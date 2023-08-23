@extends('layouts.app')

@section('content')
@include('layouts.menubar');

<!-- Blog -->

<div class="blog">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-3">
                    <div class="card-body">
                        <form action="{{ route('order.tracking') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <label for="">Status Code</label>
                                <input type="text" name="code" required class="form-control"
                                    placeholder="Your Order Status Code">
                                <button type="submit" class="btn mt-3 btn-info">Track Now</button>
                            </div>
                        </form>
                        <div class="mt-4">
                            @if(session('track'))
                            <h3>Your Order Status</h3>
                            <div class="progress">
                                @if(session('track')->status == 0)
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"
                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                @elseif (session('track')->status == 1)
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"
                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"> </div>
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 25%"
                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                @elseif (session('track')->status == 2)
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"
                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"> </div>
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 25%"
                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-info" role="progressbar" style="width: 25%"
                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                @elseif (session('track')->status == 3)
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"
                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"> </div>
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 25%"
                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-info" role="progressbar" style="width: 25%"
                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                @else
                                <span class="badge badge-danger">Order Cancled</span>
                                @endif
                            </div>

                            <div class="mt-4">
                                @if(session('track')->status == 0)
                                <h4>Note: Your Order is under Review.</h4>
                                @elseif (session('track')->status == 1)
                                <h4>Note: Your Order is under Process.</h4>
                                @elseif (session('track')->status == 2)
                                <h4>Note: Your Order is on the Way.</h4>
                                @elseif (session('track')->status == 3)
                                <h4>Note: Your Order is Delivered.</h4>
                                @else
                                <h4>Note: Your Order is Cancle.</h4>
                                @endif
                            </div>


                            @endif
                        </div>

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
