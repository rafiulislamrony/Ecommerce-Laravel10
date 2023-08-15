@extends('layouts.app')

@section('content')
<!-- Cart -->


<div class="cart_section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cart_container">
                    <div class="cart_title">Checkout</div>
                    <div class="mt-4">
                        <table class="table table-striped" style="border: 2px solid #ddd;">
                            <thead>
                                <tr>
                                    <th scope="col">Sl</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($cart as $row)
                                <tr class="cartRowremove{{$row['id']}}">
                                    <th scope="row">{{ $i++ }}</th>
                                    <td><img src="{{ asset($row['image']) }}" alt="" style="max-width: 60px;"></td>
                                    <td>{{ $row['name'] }}</td>
                                    <td>
                                        @if($row['color'] == NULL)
                                        No Color Selected
                                        @else
                                        {{ $row['color'] }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($row['size'] == NULL)
                                        No Size Selected
                                        @else
                                        {{ $row['size'] }}
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('update.cartqty') }}" method="post"
                                            class="d-flex align-items-center">
                                            @csrf
                                            <input type="hidden" name="productId" value="{{  $row['id'] }}">
                                            <input type="number" name="qty" min="1" value="{{ $row['qty'] }}"
                                                class="form-control" style="width:60px">
                                            <button class="btn btn-success btn-sm" type="submit"><i
                                                    class="fas fa-check-square"></i> </button>
                                        </form>
                                    </td>
                                    <td> {{ number_format($row['price'], 2, '.', ',') }} </td>
                                    <td>
                                        {{ number_format($row['qty'] * $row['price'], 2, '.', ',') }}

                                    </td>
                                    <td>
                                        <span data-id="{{ $row['id'] }}" class="cartRemove text-danger"
                                            style="cursor: pointer;">
                                            <i class="far fa-trash-alt"></i> </span>
                                    </td>
                                </tr>
                                @endforeach
                                @if(count($cart) == 0)
                                <tr>
                                    <td class="bg-light py-5  text-center" colspan="100">
                                        <h3 class="text-uppercase">Cart is empty!</h3>
                                    </td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="row justify-content-between">
                        <div class="order-total-content  col-lg-4" style="padding: 15px;">
                            <h5>Apply Coupon</h5>
                            <form action="">
                                <div class="form-grop">
                                    <input type="text" name="" class="form-control" placeholder="Enter Your Coupon">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <ul class="list-group col-lg-4">
                            <li class="list-group-item">Subtotal:- <span style="float: right;"> 111 </span></li>
                            <li class="list-group-item">Coupons:- <span style="float: right;"> 111 </span></li>
                            <li class="list-group-item">Shiping Charge:- <span style="float: right;"> 111 </span></li>
                            <li class="list-group-item">Vats:- <span style="float: right;"> 111 </span></li>
                        </ul>
                    </div>

                    <div class="cart_buttons">
                        <button type="button" class="button cart_button_clear">All Cancle</button>
                        <a href="{{ route('user.checkout') }}" class="button cart_button_checkout">Checkout</a>
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
<!-- Footer -->



@endsection
