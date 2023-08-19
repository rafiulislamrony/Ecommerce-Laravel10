@extends('layouts.app')

@section('content')
@include('layouts.menubar');
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
                <h4>Stripe Billing Address</h4>
                <div class="card">
                    <div class="card-body">

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
