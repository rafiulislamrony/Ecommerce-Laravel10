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
                <h4>Billing Address</h4>
                <div class="card">
                    <div class="card-body">

                        <form role="form" action="{{ route('payment.process') }}" method="post"
                            class="require-validation" data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf

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
                                        <input class="form-control" name="zip" type="text" placeholder="Zip Code">
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

                                                <div class="form-check gateway_check" id="stripe">
                                                    <input type="radio" id="stripe1" name="payment" value="stripe" class="payment-option">
                                                    <label class="form-check-label pl-1" for="stripe1">
                                                        <img src="{{ asset('frontend/images/mastercard.png') }}"
                                                            style="width:80px" alt="">
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check cashondelivery">
                                                    <input type="radio" id="cash" name="payment" value="oncash">
                                                    <label class="form-check-label pl-1" for="cash">
                                                        <img src="{{ asset('frontend/images/cash.png') }}"
                                                            style="width:100px" alt="">
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="stripeform d-none">
                                <div class='form-row row'>
                                    <div class='col-12 form-group required'>
                                        <label class='control-label'>Name on Card</label>
                                        <input class='form-control ' size='4' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-12 form-group required'>
                                        <label class='control-label'>Card Number</label> <input autocomplete='off'
                                            class='form-control card-number' size='20' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                                        <label class='control-label'>CVC</label> <input autocomplete='off'
                                            class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Month</label> <input
                                            class='form-control card-expiry-month' placeholder='MM' size='2'
                                            type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Year</label> <input
                                            class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                            type='text'>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between paddin-top-1x mt-4">
                                <a class="btn btn-primary" href="#"> Back To Cart</a>
                                <button class="btn btn-primary btn-lg" type="submit">Pay Now </button>
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
                            @php
                            $amount = $cartTotal - Session::get('coupon')['discount'] + $charge + $vat;
                            $formattedAmount = number_format($amount, 2, '.', ',');
                            @endphp
                            <li class="list-group-item">Order Total:-
                                <span style="float: right;">
                                    ${{ $formattedAmount }}
                                </span>
                            </li>
                            @else
                            @php
                            $amount = $cartTotal + $charge + $vat;
                            $formattedAmount = number_format($amount, 2, '.', ',');
                            @endphp
                            <li class="list-group-item">Order Total:-
                                <span style="float: right;">
                                    ${{ $formattedAmount }}
                                </span>
                            </li>
                            @endif

                            @php
                            Session::put('totalamount', ['amount' => $amount]);
                            @endphp
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script>
    $(document).on('click','.gateway_check',function(){
        $(".stripeform").removeClass("d-none");
    })
    $(document).on('click','.cashondelivery',function(){
        $(".stripeform").addClass("d-none");
    })
</script>

<script type="text/javascript">
    $(function() {

    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/

    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });

        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }

    });

    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];

            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>

@endsection
