@extends('layouts.app')

@section('content')
@php
$countitem = 0;
$cartTotal = 0;
if(Session::has('cart')){
$cart = Session::get('cart');
//Session::forget('cart');
if($cart){
foreach ($cart as $product) {
$cartTotal += (double)$product['price'] * (int)$product['qty'];
$countitem += (int)$product['qty'];
}
}
}else{
$cart =[];
}

$settings = DB::table('settings')->first();

$charge = $settings->shipping_charge;
$vat = $settings->vat;

@endphp

<div class="cart_section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h4>Billing Address</h4>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('payment.process') }}" method="POST">
                            @csrf
                            <input type="hidden" name=" " value=" ">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-fn">Full Name</label>
                                        <input class="form-control" name="name" type="text"
                                            placeholder="Enter Your Full Name" required="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-fn">Phone</label>
                                        <input class="form-control" name="phone" type="text"
                                            placeholder="Enter Phone Number" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout_email_billing">E-mail Address</label>
                                        <input class="form-control" name="email" type="email" required=""
                                            placeholder="Enter Your Email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-address1">Address 1</label>
                                        <input class="form-control" name="address" required="" type="text"
                                            placeholder="Enter Your Address">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-company">Zip Code</label>
                                        <input class="form-control" name="zip" type="text"
                                            placeholder="Zip Code">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-company">City</label>
                                        <input class="form-control" name="city" type="text"
                                            placeholder="Enter Your City">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4>Payment By</h4>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <ul class="logos_list">
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" id="radios1"
                                                        name="payment" value="stripe">
                                                    <label class="form-check-label pl-1" for="radios1">
                                                        <img src="{{ asset('frontend/images/mastercard.png') }}"
                                                            style="width:80px" alt="">
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" id="radios2"
                                                        name="payment" value="paypal">
                                                    <label class="form-check-label pl-1" for="radios2">
                                                        <img src="{{ asset('frontend/images/paypal.png') }}"
                                                            style="width:100px" alt="">
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" id="radios3"
                                                        name="payment" value="ideal">
                                                    <label class="form-check-label pl-1" for="radios3">
                                                        <img src="{{ asset('frontend/images/mollie.png') }}"
                                                            style="width:100px" alt="">
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" id="radios4"
                                                        name="payment" value="cash">
                                                    <label class="form-check-label pl-1" for="radios4">
                                                        <img src="{{ asset('frontend/images/cash.png') }}"
                                                            style="width:100px" alt="">
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between paddin-top-1x mt-4">
                                <a class="btn btn-primary" href=""> Back To Cart</a>
                                <button class="btn btn-primary" type="submit">Continue </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar">
                    <div class="padding-top-2x hidden-lg-up"></div>
                    <!-- Order Summary Widget-->
                    <section class="card widget widget-featured-posts widget-order-summary p-4">
                        <h4 class="widget-title">Order Summary</h4>
                        <ul class="list-group">

                            @if( Session::has('coupon'))
                            <li class="list-group-item">Subtotal:- <span style="float: right;">${{$cartTotal -
                                    Session::get('coupon')['discount'] }} </span></li>
                            <li class="list-group-item">Coupons:-
                                {{ Session::get('coupon')['name'] }}
                                <span style="float: right;">${{ Session::get('coupon')['discount'] }} </span>
                                <a href="{{ route('coupon.remove') }}" class="btn btn-danger btn-sm"
                                    title="Remove Coupon">
                                    X
                                </a>
                            </li>
                            @else
                            <li class="list-group-item">Subtotal:- <span style="float: right;">${{
                                    number_format($cartTotal, 2, '.', ',') }} </span></li>
                            @endif


                            <li class="list-group-item">Shiping Charge:- <span style="float: right;"> ${{ $charge }}
                                </span></li>
                            <li class="list-group-item">Vat/Taxs:- <span style="float: right;">${{ $vat }} </span></li>
                            @if( Session::has('coupon'))
                            <li class="list-group-item">Order Total:-
                                <span style="float: right;">
                                    ${{$cartTotal - Session::get('coupon')['discount'] + $charge + $vat }}
                                </span>
                            </li>
                            @else
                            <li class="list-group-item">Order Total:-
                                <span style="float: right;">
                                    ${{ number_format($cartTotal + $charge + $vat, 2, '.', ',') }}
                                </span>
                            </li>
                            @endif
                        </ul>
                    </section>
                    <!-- Items in Cart Widget-->

                    <section class="card widget widget-featured-posts widget-featured-products mt-4 p-4">
                        <h4 class="widget-title">Items In Your Cart</h4>
                        <hr>
                        @foreach ($cart as $row)
                        <div class="entry d-flex">
                            <div class="entry-thumb"><a
                                    href="{{ url('product/details/'.$row['id'].'/'. $row['name'] ) }}">
                                    <img src="{{ asset($row['image']) }}" alt="Product"
                                        style="max-width: 60px; min-width:60px; margin-right:15px;"></a></div>
                            <div class="entry-content">
                                <h6 class="entry-title" style="font-size: 14px;"><a style="color: #000" href=" ">
                                        {{ $row['name'] }}
                                    </a></h6>
                                <span class="entry-meta">
                                    {{ $row['qty'] }} * {{ $row['price'] }} =
                                    {{ number_format($row['qty'] * $row['price'], 2, '.', ',') }}
                                </span>

                                @if($row['color'] == NULL)
                                @else
                                <p class="mb-0">
                                    Color : {{ $row['color'] }}
                                </p>
                                @endif

                                @if($row['size'] == NULL)
                                @else
                                <p class="mb-0">
                                    Size : {{ $row['size'] }}
                                </p>
                                @endif

                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </section>
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
