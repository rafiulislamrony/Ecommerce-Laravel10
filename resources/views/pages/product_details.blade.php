@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css') }}">

@include('layouts.menubar');

<div class="single_product pt-4">
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
                        <form action="{{ route('cart.product.add',$product->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Select Color</label>
                                        <select class="form-control" name="color" id="color"
                                            style="min-width:100%; width:100%;">
                                            @foreach ($product_color as $color)
                                            <option value="{{ $color }}">{{ $color }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if($product->product_size == NULL)

                                @else
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Select Size</label>
                                        <select class="form-control" name="size" id="size"
                                            style="min-width:100%; width:100%;">
                                            @foreach ($product_size as $size)
                                            <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Select Quantity</label>
                                        <input type="number" name="qty" class="form-control" min="1" value="1">
                                    </div>
                                </div>
                            </div>

                            <div class="product_price mt-3">
                                @if($product->discount_price == NULL)
                                <span style="font-size:16px;">${{ $product->selling_price }}</span>
                                @else
                                ${{ $product->discount_price }}<span
                                    style="font-size:16px; text-decoration: line-through;">${{
                                    $product->selling_price
                                    }}</span>
                                @endif
                            </div>

                            <div class="button_container">
                                <button type="submit" class="button cart_button">Add to Cart</button>
                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                            </div>

                            <br><br>


                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox"></div>

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
                                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Product
                                Details</button>
                            <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Video
                                Link</button>
                            <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact"
                                type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Product
                                Review</button>
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
                            <div class="fb-comments"
                                data-href="{{ Request::url() }}"
                                data-width="" data-numposts="5"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
 {{-- https://developers.facebook.com/docs/plugins/comments/ --}}
    {{-- Add facebook comments go this link --}}

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v17.0"
    nonce="BdMUzHcX"></script>


<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e4b85f98de5201f"></script>



@endsection
