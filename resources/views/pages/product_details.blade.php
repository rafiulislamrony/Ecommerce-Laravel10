@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css') }}">

<div class="single_product">
    <div class="container">
        <div class="row">

            <!-- Images -->
            <div class="col-lg-2 order-lg-1 order-2">
                <ul class="image_list">
                    <li data-image="{{ asset($product->image_one) }}"><img src="{{ asset($product->image_one) }}"
                            alt=""></li>
                    <li data-image="{{ asset($product->image_two) }}"><img src="{{ asset($product->image_two) }}"
                            alt=""></li>
                    <li data-image="{{ asset($product->image_three) }}"><img src="{{ asset($product->image_three) }}"
                            alt=""></li>
                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-5 order-lg-2 order-1">
                <div class="image_selected"><img src="{{ asset($product->image_one) }}" alt=""></div>
            </div>

            <!-- Description -->
            <div class="col-lg-5 order-3">

                <div class="product_description">
                    <div class="product_category">{{ $product->category_name }} > {{ $product->subcategory_name }}
                    </div>
                    <div class="product_name">{{ $product->product_name }}</div>
                    <div class="rating_r rating_r_4 product_rating">
                        <i></i><i></i><i></i><i></i><i></i>
                    </div>
                    <div class="product_text">
                        <p>
                            {!! str_limit($product->product_details, $limit = 1200) !!}
                        </p>
                    </div>
                    <div class="order_info d-flex flex-row">
                        <form action="#">
                            <div class="clearfix" style="z-index: 1000;">

                                <!-- Product Quantity -->
                                <div class="product_quantity clearfix">
                                    <span>Quantity: </span>
                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i
                                                class="fas fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i
                                                class="fas fa-chevron-down"></i></div>
                                    </div>
                                </div>

                                <!-- Product Color -->
                                <ul class="product_color">
                                    <li>
                                        <span>Color: </span>
                                        <div class="color_mark_container">
                                            <div id="selected_color" class="color_mark"></div>
                                        </div>
                                        <div class="color_dropdown_button"><i class="fas fa-chevron-down"></i>
                                        </div>

                                        <ul class="color_list">
                                            <li>
                                                <div class="color_mark" style="background: #999999;"></div>
                                            </li>
                                            <li>
                                                <div class="color_mark" style="background: #b19c83;"></div>
                                            </li>
                                            <li>
                                                <div class="color_mark" style="background: #000000;"></div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                            </div>

                            <div class="product_price">
                                @if($product->discount_price == NULL)
                                <span>${{ $product->selling_price }}</span>
                                @else
                                ${{ $product->discount_price }}<span style="text-decoration: line-through;">${{
                                    $product->selling_price
                                    }}</span>
                                @endif

                            </div>


                            <div class="button_container">
                                <button type="button" class="button cart_button">Add to Cart</button>
                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Recently Viewed -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Product Details</h3>
                </div>

                <div class="viewed_slider_container">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Product Details</button>
                            <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                                type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Video Link</button>
                            <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact"
                                type="button" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Product Review</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <br>
                            {!! $product->product_details !!}
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <br>
                            {{ $product->video_link }}
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                          <br>
                          What is business insurance and how does it work?
There are lots of risks involved in running a business. To protect against this risk, business owners take out business insurance policies in the event that something happens.

There are many different types of business insurance policies, but depending on what policy you have, business insurance can cover your business for lost income, legal liability, damage to property, and more.

Some types of business insurance are compulsory, either by law (such as worker’s compensation insurance) or because those you deal with may require it.
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>


@endsection
