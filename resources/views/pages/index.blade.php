@extends('layouts.app')

@section('content')

@include('layouts.menubar');

@include('layouts.slider');


@php
$featured = DB::table('products')->where('status',1)->orderBy('id','desc')->limit(6)->get();
$trend = DB::table('products')->where('status',1)->where('trend',1)->orderBy('id','desc')->limit(6)->get();
$bestrat = DB::table('products')->where('status',1)->where('bast_rated',1)->orderBy('id','desc')->limit(6)->get();

$hot = DB::table('products')
->join('brands', 'products.brand_id', 'brands.id')
->select('products.*', 'brands.brand_name')
->where('products.status',1)->where('hot_deal',1)
->orderBy('id','desc')->limit(3)->get();

@endphp


<div class="characteristics">
    <div class="container">
        <div class="row">

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">

                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{ asset('frontend/images/char_1.png')}}" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">

                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{ asset('frontend/images/char_2.png')}}" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">

                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{ asset('frontend/images/char_3.png')}}" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">

                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="{{ asset('frontend/images/char_4.png')}}" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Deals of the week -->

<div class="deals_featured">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

                <!-- Deals -->

                <div class="deals">
                    <div class="deals_title">Deals of the Week</div>
                    <div class="deals_slider_container">
                        <!-- Deals Slider -->
                        <div class="owl-carousel owl-theme deals_slider">
                            <!-- Deals Item -->
                            @foreach ($hot as $row)
                            <div class="owl-item deals_item">
                                <div class="deals_image">
                                    <a href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">
                                        <img src="{{ asset( $row->image_one )}}" alt="">
                                    </a>
                                </div>
                                <div class="deals_content">
                                    <div class="deals_info_line d-flex flex-row justify-content-start">
                                        <div class="deals_item_category">{{ $row->brand_name }}</div>
                                        <div class="deals_item_price_a ml-auto">
                                            {{ $row->selling_price }}
                                        </div>
                                    </div>
                                    <div class="deals_info_line d-flex flex-row justify-content-start">
                                        <div class="deals_item_name">
                                            <a href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">
                                                {{ $row->product_name }}
                                            </a>
                                        </div>
                                        @if($row->discount_price !== NULL)
                                        <div class="deals_item_price ml-auto">${{ $row->discount_price }}</div>
                                        @else
                                        @endif
                                    </div>
                                    <div class="available">
                                        <div class="available_line d-flex flex-row justify-content-start">
                                            <div class="available_title">Available: <span>{{ $row->product_quantity
                                                    }}</span></div>
                                            <div class="sold_title ml-auto">Already sold: <span>28</span></div>
                                        </div>
                                        <div class="available_bar"><span style="width:17%"></span></div>
                                    </div>
                                    <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                        <div class="deals_timer_title_container">
                                            <div class="deals_timer_title">Hurry Up</div>
                                            <div class="deals_timer_subtitle">Offer ends in:</div>
                                        </div>
                                        <div class="deals_timer_content ml-auto">
                                            <div class="deals_timer_box clearfix" data-target-time="">
                                                <div class="deals_timer_unit">
                                                    <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                                                    <span>hours</span>
                                                </div>
                                                <div class="deals_timer_unit">
                                                    <div id="deals_timer1_min" class="deals_timer_min"></div>
                                                    <span>mins</span>
                                                </div>
                                                <div class="deals_timer_unit">
                                                    <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                                                    <span>secs</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="deals_slider_nav_container">
                        <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i>
                        </div>
                        <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i>
                        </div>
                    </div>
                </div>

                <div class="featured">
                    <div class="tabbed_container">
                        <div class="tabs">
                            <ul class="clearfix">
                                <li class="active">Featured</li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>
                        <!-- Product Panel -->
                        <div class="product_panel panel active">
                            <div class="featured_slider sider">
                                @foreach ($featured as $row)

                                <div class="featured_slider_item">
                                    <div class="border_active"></div>
                                    <div
                                        class="product_item qproduct discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div
                                            class="product_image d-flex flex-column align-items-center justify-content-center">
                                            <a href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">
                                                <img src="{{ asset( $row->image_one )}}" style=" height:180px;" alt="">
                                            </a>
                                        </div>
                                        <div class="product_content"><br>
                                            <div class="product_price discount">
                                                @if($row->discount_price == NULL)
                                                <span>${{ $row->selling_price }}</span>
                                                @else
                                                ${{ $row->discount_price }}<span
                                                    style="text-decoration: line-through;">${{ $row->selling_price
                                                    }}</span>
                                                @endif
                                            </div>
                                            <div class="product_name">
                                                <div><a href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">{{
                                                        $row->product_name }}</a> </div>
                                            </div>

                                            <div class="product_extras">
                                                <button class="product_cart_button addcart" data-id="{{ $row->id }}"
                                                    data-price="{{ $row->discount_price === NULL ? $row->selling_price : $row->discount_price }}"
                                                    data-qty="1">
                                                    Add To Cart
                                                </button>
                                            </div>

                                        </div>

                                        <button class="addwishlist product_fav" data-id="{{ $row->id }}" style="cursor: pointer;">
                                            <i class="fas fa-heart"></i>
                                        </button>


                                        <button id="{{ $row->id }}" data-toggle="modal" data-target="#cartmodel"
                                            onclick="productView(this.id)" class="quickview" style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <ul class="product_marks">
                                            @if ($row->discount_price == NULL)
                                            <li class="product_mark product_new"
                                                style="opacity: 1; visibility:visible; display:block;">new</li>
                                            @else
                                            <li class="product_mark product_discount">
                                                @php
                                                $amount = $row->selling_price - $row->discount_price;
                                                $discount = $amount/$row->selling_price*100;
                                                @endphp
                                                {{ intval($discount) }}%
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="featured_slider_dots_cover"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Categories -->

<div class="popular_categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="popular_categories_content">
                    <div class="popular_categories_title">Popular Categories</div>
                    <div class="popular_categories_slider_nav">
                        <div class="popular_categories_prev popular_categories_nav"><i
                                class="fas fa-angle-left ml-auto"></i></div>
                        <div class="popular_categories_next popular_categories_nav"><i
                                class="fas fa-angle-right ml-auto"></i></div>
                    </div>
                </div>
            </div>

            <!-- Popular Categories Slider -->
            @php
            $category = DB::table('categories')->get();
            @endphp
            <div class="col-lg-9">
                <div class="popular_categories_slider_container">
                    <div class="owl-carousel owl-theme popular_categories_slider">

                        <!-- Popular Categories Item -->
                        @foreach ($category as $row)

                        <div class="owl-item">
                            <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                <div class="popular_category_image">
                                    <a href="{{ route('allcategory', $row->id ) }}">
                                        <img src="{{ asset('frontend/images/popular_1.png')}}" alt="">
                                    </a>
                                </div>
                                <div class="popular_category_text">
                                    <a href="{{ route('allcategory', $row->id ) }}">
                                        {{ $row->category_name }}
                                    </a>

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

<!-- Banner -->
@php
$mid = DB::table('products')
->join('categories', 'products.category_id', 'categories.id')
->join('brands', 'products.brand_id', 'brands.id')
->select('products.*', 'brands.brand_name', 'categories.category_name')
->where('products.mid_slider',1)
->orderBy('id','desc')->limit(3)->get();
@endphp

<div class="banner_2">
    <div class="banner_2_background"
        style="background-image:url({{ asset('frontend/images/banner_2_background.jpg')}})"></div>
    <div class="banner_2_container">
        <div class="banner_2_dots"></div>
        <!-- Banner 2 Slider -->

        <div class="owl-carousel owl-theme banner_2_slider">

            <!-- Banner 2 Slider Item -->
            @foreach ($mid as $row)
            <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-6 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">
                                        <h4>{{ $row->category_name }}</h4>
                                    </div>
                                    <div class="banner_2_title">{{ $row->product_name }}</div>
                                    <div class="banner_2_text">
                                        <h3>{{ $row->brand_name }}</h3>
                                    </div>
                                    <div class="rating_r rating_r_4 product_rating">
                                        <i></i><i></i><i></i><i></i><i></i>
                                    </div>
                                    <div class="button banner_2_button">
                                        <a href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">
                                            Explore</a>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-8 col-md-6  ">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image d-flex justify-content-end"><img style="max-width: 500px"
                                            src="{{ asset($row->image_one)}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Category  One  -->
@php
$cats = DB::table('categories')->skip(1)->first();
$catid = $cats->id;
$product = DB::table('products')->where('category_id',$catid)->where('status',1)->limit(10)
->orderBy('id', 'DESC')->get();
@endphp

<div class="new_arrivals">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">{{ $cats->category_name }}</div>
                        <ul class="clearfix">
                            <li class="active"></li>
                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="z-index:1;">

                            <!-- Product Panel -->
                            <div class="product_panel panel active">
                                <div class="arrivals_slider slider">
                                    <!-- Slider Item -->
                                    @foreach ($product as $row)

                                    <div class="arrivals_slider_item">
                                        <div class="border_active"></div>
                                        <div
                                            class="product_item qproduct is_new d-flex flex-column align-items-center justify-content-center text-center">
                                            <div
                                                class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <a
                                                    href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">
                                                    <img src="{{ asset( $row->image_one )}}" style=" height:180px;"
                                                        alt="">
                                                </a>
                                            </div>
                                            <div class="product_content"> <br>
                                                <div class="product_price">
                                                    @if($row->discount_price == NULL)
                                                    <span>${{ $row->selling_price }}</span>
                                                    @else
                                                    ${{ $row->discount_price }}<span
                                                        style="text-decoration: line-through;">${{ $row->selling_price
                                                        }}</span>
                                                    @endif
                                                </div>
                                                <div class="product_name">
                                                    <div><a
                                                            href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">{{
                                                            $row->product_name }}</a> </div>
                                                </div>
                                                <div class="product_extras">
                                                    <button class="product_cart_button addcart" data-id="{{ $row->id }}"
                                                        data-price="{{ $row->discount_price === NULL ? $row->selling_price : $row->discount_price }}"
                                                        data-qty="1">
                                                        Add To Cart
                                                    </button>
                                                </div>
                                            </div>
                                            <button class="addwishlist product_fav" data-id="{{ $row->id }}"
                                                style="cursor: pointer;">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                            <button id="{{ $row->id }}" data-toggle="modal" data-target="#cartmodel"
                                                onclick="productView(this.id)" class="quickview"
                                                style="cursor: pointer;">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <ul class="product_marks">
                                                @if ($row->discount_price == NULL)
                                                <li class="product_mark product_new"
                                                    style="opacity: 1; visibility:visible; display:block;">new</li>
                                                @else
                                                <li class="product_mark product_discount">
                                                    @php
                                                    $amount = $row->selling_price - $row->discount_price;
                                                    $discount = $amount/$row->selling_price*100;
                                                    @endphp
                                                    {{ intval($discount) }}%
                                                </li>
                                                @endif
                                            </ul>
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
    </div>
</div>


<!-- Category Two -->
@php
$cats = DB::table('categories')->skip(3)->first();
$catid = $cats->id;
$product = DB::table('products')->where('category_id',$catid)->where('status',1)->limit(10)
->orderBy('id', 'DESC')->get();
@endphp

<div class="new_arrivals pt-0">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">{{ $cats->category_name }}</div>
                        <ul class="clearfix">
                            <li class="active"></li>
                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="z-index:1;">

                            <!-- Product Panel -->
                            <div class="product_panel panel active">
                                <div class="arrivals_slider slider">
                                    <!-- Slider Item -->
                                    @foreach ($product as $row)

                                    <div class="arrivals_slider_item">
                                        <div class="border_active"></div>
                                        <div
                                            class="product_item qproduct is_new d-flex flex-column align-items-center justify-content-center text-center">
                                            <div
                                                class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <a
                                                    href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">
                                                    <img src="{{ asset( $row->image_one )}}" style=" height:180px;"
                                                        alt="">
                                                </a>
                                            </div>
                                            <div class="product_content"> <br>
                                                <div class="product_price">
                                                    @if($row->discount_price == NULL)
                                                    <span>${{ $row->selling_price }}</span>
                                                    @else
                                                    ${{ $row->discount_price }}<span
                                                        style="text-decoration: line-through;">${{ $row->selling_price
                                                        }}</span>
                                                    @endif
                                                </div>
                                                <div class="product_name">
                                                    <div><a
                                                            href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">{{
                                                            $row->product_name }}</a> </div>
                                                </div>
                                                <div class="product_extras">
                                                    <button class="product_cart_button addcart" data-id="{{ $row->id }}"
                                                        data-price="{{ $row->discount_price === NULL ? $row->selling_price : $row->discount_price }}"
                                                        data-qty="1">
                                                        Add To Cart
                                                    </button>
                                                </div>
                                            </div>
                                            <button class="addwishlist product_fav" data-id="{{ $row->id }}"
                                                style="cursor: pointer;">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                            <button id="{{ $row->id }}" data-toggle="modal" data-target="#cartmodel"
                                                onclick="productView(this.id)" class="quickview"
                                                style="cursor: pointer;">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <ul class="product_marks">
                                                @if ($row->discount_price == NULL)
                                                <li class="product_mark product_new"
                                                    style="opacity: 1; visibility:visible; display:block;">new</li>
                                                @else
                                                <li class="product_mark product_discount">
                                                    @php
                                                    $amount = $row->selling_price - $row->discount_price;
                                                    $discount = $amount/$row->selling_price*100;
                                                    @endphp
                                                    {{ intval($discount) }}%
                                                </li>
                                                @endif
                                            </ul>
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
    </div>
</div>



@php
$hotBest = DB::table('products')
->join('brands','products.brand_id', 'brands.id')
->select('products.*', 'brands.brand_name')
->where('bast_rated',1)->where('hot_new',1)->where('status',1)->limit(8)->orderBy('id', 'DESC')->get();

@endphp
<!-- Best Sellers -->
<div class="best_sellers">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">Hot Best Sellers</div>
                        <ul class="clearfix">
                            <li class="active"></li>
                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>

                    <div class="bestsellers_panel panel active">

                        <!-- Best Sellers Slider -->

                        <div class="bestsellers_slider slider">

                            @foreach ($hotBest as $row)
                            <!-- Best Sellers Item -->
                            <div class="bestsellers_item qproduct discount">
                                <div
                                    class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                    <div class="bestsellers_image">
                                        <a href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">
                                            <img src="{{ asset( $row->image_one )}}"
                                                style="min-width:100px; max-width:100px;" alt="">
                                        </a>
                                    </div>
                                    <div class="bestsellers_content">
                                        <div class="bestsellers_category">
                                            {{ $row->brand_name }}
                                        </div>
                                        <div class="bestsellers_name"><a
                                                href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">
                                                {{
                                                $row->product_name }}</a> </div>
                                        <div class="rating_r rating_r_4 bestsellers_rating">
                                            <i></i><i></i><i></i><i></i><i></i>
                                        </div>
                                        <div class="product_price">
                                            @if($row->discount_price == NULL)
                                            <span>${{ $row->selling_price }}</span>
                                            @else
                                            ${{ $row->discount_price }}<span style="text-decoration: line-through;">${{
                                                $row->selling_price
                                                }}</span>
                                            @endif
                                        </div>

                                        <button class="btn btn-primary mt-2 addcart" data-id="{{ $row->id }}"
                                            data-price="{{ $row->discount_price === NULL ? $row->selling_price : $row->discount_price }}"
                                            data-qty="1">
                                            Add To Cart
                                        </button>
                                    </div>
                                </div>
                                <button class="addwishlist bestsellers_fav active" data-id="{{ $row->id }}"
                                    style="cursor: pointer; border:0px;">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button id="{{ $row->id }}" data-toggle="modal" data-target="#cartmodel"
                                    onclick="productView(this.id)" class="quickview"
                                    style="right: unset; left: 20px; opacity: 1; visibility: visible; top: 67px;">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <ul class="bestsellers_marks">
                                    @if ($row->discount_price == NULL)
                                    <li class="bestsellers_mark bestsellers_new"
                                        style="opacity: 1; visibility:visible; display:block;">New</li>
                                    @else
                                    <li class="bestsellers_mark bestsellers_discount">
                                        @php
                                        $amount = $row->selling_price - $row->discount_price;
                                        $discount = $amount/$row->selling_price*100;
                                        @endphp
                                        {{ intval($discount) }}%
                                    </li>
                                    @endif
                                </ul>

                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@php
$buyGet = DB::table('products')
->join('brands','products.brand_id', 'brands.id')
->select('products.*', 'brands.brand_name')
->where('buyone_getone',1)->where('status',1)->limit(6)->orderBy('id', 'DESC')->get();

@endphp

<!-- Buy One Get One -->
<div class="trends">
    <div class="trends_background" style="background-image:url({{ asset('frontend/images/trends_background.jpg')}})">
    </div>
    <div class="trends_overlay"></div>
    <div class="container">
        <div class="row">

            <!-- Trends Content -->
            <div class="col-lg-3">
                <div class="trends_container">
                    <h2 class="trends_title">Buy One Get One</h2>
                    <div class="trends_text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</p>
                    </div>
                    <div class="trends_slider_nav">
                        <div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                        <div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                    </div>
                </div>
            </div>

            <!-- Trends Slider -->
            <div class="col-lg-9">
                <div class="trends_slider_container">
                    <!-- Trends Slider -->
                    <div class="owl-carousel owl-theme trends_slider">
                        <!-- Trends Slider Item -->
                        @foreach ($buyGet as $row)
                        <div class="owl-item">
                            <div class="trends_item qproduct is_new">
                                <div class="trends_image d-flex flex-column align-items-center justify-content-center">

                                    <a href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">
                                        <img src="{{ asset( $row->image_one )}}" style=" height:180px;" alt="">
                                    </a>
                                </div>
                                <div class="trends_content">
                                    <div class="trends_category">{{ $row->brand_name }}</div>
                                    <div class="trends_info clearfix">
                                        <div class="trends_name mb-2">
                                            <a href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">{{
                                                $row->product_name }}</a>
                                        </div>
                                        <div class="product_price mb-2">
                                            @if($row->discount_price == NULL)
                                            <span>${{ $row->selling_price }}</span>
                                            @else
                                            ${{ $row->discount_price }}<span style="text-decoration: line-through;">${{
                                                $row->selling_price
                                                }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <ul class="product_marks d-block">
                                    @if ($row->discount_price == NULL)
                                    <li class="product_mark product_new"
                                        style="opacity: 1; visibility:visible; display:block;">new</li>
                                    @else
                                    <li class="product_mark d-block product_discount"
                                        style="visibility: visible; opacity:1;">
                                        @php
                                        $amount = $row->selling_price - $row->discount_price;
                                        $discount = $amount/$row->selling_price*100;
                                        @endphp
                                        {{ intval($discount) }}%
                                    </li>
                                    @endif
                                </ul>
                                <button class="btn btn-primary addcart" data-id="{{ $row->id }}"
                                    data-price="{{ $row->discount_price === NULL ? $row->selling_price : $row->discount_price }}"
                                    data-qty="1">
                                    Add To Cart
                                </button>
                                <button class="addwishlist" data-id="{{ $row->id }}" style="cursor: pointer;">
                                    <div class="product_fav trends_fav"><i class="fas fa-heart"></i></div>
                                </button>
                                <button id="{{ $row->id }}" data-toggle="modal" data-target="#cartmodel"
                                    onclick="productView(this.id)" class="quickview" style="cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@php
$brand = DB::table('brands')->get();
@endphp
<!-- Brands -->
<div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">

                    <!-- Brands Slider -->

                    <div class="owl-carousel owl-theme brands_slider">

                        @foreach ($brand as $row)
                        <div class="owl-item">
                            <div class="brands_item d-flex flex-column justify-content-center">
                                <a href="{{ route('brand.product', $row->id ) }}">
                                    <img src="{{ asset($row->brand_logo)}}" style="width:100px;" alt="">
                                </a>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <!-- Brands Slider Navigation -->
                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

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
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cartmodel" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Label">Product Quick View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="" id="pimg" alt="" style="width: 80%; height:80%; margin: 0 auto;">
                            <div class="card-body">
                                <h5 class="cart-title" id="pname"> </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group">
                            <li class="list-group-item"> Product Code: <span id="pcode"> </span> </li>
                            <li class="list-group-item">Category: <span id="pcat"> </span> </li>
                            <li class="list-group-item">Subategory: <span id="psub"> </span></li>
                            <li class="list-group-item">Brand: <span id="pbrand"> </span></li>
                            <li class="list-group-item">Stock: <span id="pstock"> </span>
                            <li class="list-group-item">Price: <span id="pprice"> </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <form method="post" action="{{ route('insert.into.cart') }}">
                            <input type="hidden" name="product_id" id="product_id" value="">
                            @csrf
                            <div class="form-group">
                                <label for="color">Color</label>
                                <select name="color" class="form-control w-100 ml-0" id="color">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="size">Size</label>
                                <select name="size" class="form-control ml-0 w-100" id="size">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input id="qty" name="qty" type="number" min="1" value="1" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary"> Add to Cart</button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>

<script type="text/javascript">
    $(document).ready(function(){
     $('.addwishlist').on('click', function(){
        var id = $(this).data('id');
        if (id) {
            $.ajax({
                url: " {{ url('wishlist/add/') }}/"+id,
                type:"GET",
                datType:"json",
                success:function(data){

                let oldWish = parseInt($('#wishlist_count').text());
                let newWish = oldWish + 1;
                $('#wishlist_count').text(newWish);

                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })

                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                        icon: 'success',
                        title: data.success
                        })
                    }else{
                        Toast.fire({
                        icon: 'error',
                        title: data.error
                        })
                    }
                },

            });

        }else{
            alert('danger');
        }
     });
   });

</script>

<script type="text/javascript">
    function productView(id) {
        $.ajax({
            url: "{{ url('product/quick/view/') }}/" + id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#pname').text(data.product.product_name);
                $('#pimg').attr('src',data.product.image_one);
                $('#pcode').text(data.product.product_code);
                $('#pcat').text(data.product.category_name);
                $('#psub').text(data.product.subcategory_name);
                $('#pbrand').text(data.product.brand_name);
                $('#product_id').val(data.product.id);

                if(data.product.product_quantity < 1){
                    $('#pstock').html('<span class="badge" style="background: red; color:white;"> Unavailable</span>');
                }else{
                    $('#pstock').html('<span class="badge" style="background: green; color:white;"> Available</span>');
                }
                if(data.product.discount_price === null){
                    $('#pprice').text(data.product.selling_price);
                }else{
                    $('#pprice').text(data.product.discount_price);
                }

                var d = $('select[name="color"]').empty();
                $.each(data.color, function(key, value){
                    $('select[name="color"]').append('<option value="'+value+'">'+value+'</option>');
                });

                var d = $('select[name="size"]').empty();
                $.each(data.size, function(key, value){
                    $('select[name="size"]').append('<option value="'+value+'">'+value+'</option>');
                });

            }
        })
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
     $('.addcart').on('click', function(){
        var id = $(this).data('id');
        var price = parseFloat($(this).data('price'));
        var qty = parseInt($(this).data('qty'));
        if (id) {
            $.ajax({
                url: "{{ url('/add/to/cart/') }}/"+id,
                type:"GET",
                datType:"json",
                success:function(data){

                    if(data.success){
                        let oldCart = parseInt($('#cart_count').text());
                         let newCart = oldCart + 1;
                        $('#cart_count').text(newCart);

                        let oldPrice = parseFloat($('#cart_price').text());
                        let newPrice = oldPrice + (price * qty);
                        $('#cart_price').text(newPrice.toFixed(2));
                    }

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                        icon: 'success',
                        title: data.success
                        })
                    }else{
                        Toast.fire({
                        icon: 'error',
                        title: data.error
                        })
                    }

                }
            });
        }else{
            alert('danger');
        }
     });
   });
</script>


@endsection
