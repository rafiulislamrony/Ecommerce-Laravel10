@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_responsive.css') }}">
<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg">
    </div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">Category</h2>
    </div>
</div>

<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">Categories</div>
                        <ul class="sidebar_categories">
                            @php
                            $category = DB::table('categories')->get();
                            @endphp
                            @foreach ($category as $row)
                            <li><a href="{{ route('allcategory', $row->id ) }}"> {{ $row->category_name }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar_section filter_by_section">
                        <div class="sidebar_title">Filter By</div>
                        <div class="sidebar_subtitle">Price</div>
                        <div class="filter_price">
                            <div id="slider-range" class="slider_range"></div>
                            <p>Range: </p>
                            <p><input type="text" id="amount" class="amount" readonly
                                    style="border:0; font-weight:bold;"></p>
                        </div>
                    </div>
                    <div class="sidebar_section">
                        <div class="sidebar_subtitle brands_subtitle">Brands</div>
                        <ul class="brands_list">
                            @php
                            $brand = DB::table('brands')->get();
                            @endphp
                            @foreach ($brand as $row)
                            <li class="brand"><a href="#">{{ $row->brand_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-lg-9">

                <!-- Shop Content -->

                <div class="shop_content">

                    <div class="shop_bar clearfix">
                        <div class="shop_product_count"><span>  {{ $totalCount }}  </span>Products found</div>
                        <div class="shop_sorting">
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button"
                                            data-isotope-option='{ "sortBy": "original-order" }'>highest rated
                                        </li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name
                                        </li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "price" }'>
                                            price</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product_grid row">
                        <div class="product_grid_border"></div>

                        @foreach ($allcategory as $row)
                        <!-- Product Item -->
                        <div class="product_item is_new" style="width:25%;" >
                            <div class="product_border" style="top: 40px;"></div>
                            <div class="product_image d-flex flex-column align-items-center justify-content-center"
                                style="height: unset">
                                <a href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}">
                                    <img src="{{ asset( $row->image_one )}}" style="height: 130px; object-fit:cover;"
                                        alt="">
                                </a>
                            </div>
                            <div class="product_content">
                                <div class="product_price discount mt-3">
                                    @if($row->discount_price == NULL)
                                    ${{ $row->selling_price }}
                                    @else
                                    ${{ $row->discount_price }}<span style="text-decoration: line-through;">${{
                                        $row->selling_price
                                        }}</span>
                                    @endif
                                </div>
                                <div class="product_name">
                                    <div>
                                        <a href="{{ url('product/details/'.$row->id.'/'. $row->product_name ) }}"
                                            style="white-space: wrap;">{{
                                            $row->product_name }}</a>
                                    </div>
                                </div>
                            </div>
                            <button class="addwishlist product_fav" data-id="{{ $row->id }}" style="cursor: pointer;">
                                <i class="fas fa-heart"></i>
                            </button>
                            <ul class="product_marks">
                                @if ($row->discount_price == NULL)
                                <li class="product_mark product_new"
                                    style="opacity: 1; visibility:visible; display:block;">New</li>
                                @else
                                <li class="product_mark product_new" style="background: red;">
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

                    <!-- Shop Page Navigation -->

                    <div class="shop_page_nav d-flex flex-row">
                        {{ $allcategory->links("pagination::bootstrap-4") }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> --}}
{{-- <script src="{{ asset('frontend/js/shop_custom.js')}}"></script> --}}

@endsection
