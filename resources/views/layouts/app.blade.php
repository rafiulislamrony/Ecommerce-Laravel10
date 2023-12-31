<?php
$setting = DB::table('sitesetting')->first();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>BlackStart Ecommerce</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet"
        type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }} ">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/slick-1.8.0/slick.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="sweetalert2.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_single_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_single_responsive.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/responsive.css') }}">

</head>

<body>
    <div class="super_container">
        <header class="header">
            <div class="top_bar">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex flex-row">
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon"><img src="{{ asset('frontend/images/phone.png')}}" alt="">
                                </div>{{$setting->phone_one}}
                            </div>
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon"><img src="{{ asset('frontend/images/mail.png')}}" alt="">
                                </div><a href="mailto:{{$setting->email}}">{{$setting->email}} </a>
                            </div>
                            <div class="top_bar_content ml-auto">
                                @guest

                                @else
                                <div class="top_bar_menu">
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        <li>
                                            <a href="{{ route('tracking') }}">Order Tracking </a>
                                        </li>
                                    </ul>
                                </div>
                                @endguest


                                <div class="top_bar_menu">
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        @php
                                        $language = Session::get('lang');
                                        @endphp
                                        <li>
                                            @if(Session::get('lang') == 'hindi')
                                            <a href="{{ route('language.english') }}">English<i
                                                    class="fas fa-chevron-down"></i></a>
                                            @else
                                            <a href="{{ route('language.hindi') }}">Hindi<i
                                                    class="fas fa-chevron-down"></i></a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <div class="top_bar_user ml-0">
                                    @guest
                                    <div><a href="{{ route('login') }}">
                                            <div class="user_icon"><img src="{{ asset('frontend/images/user.svg')}}"
                                                    alt=""> </div>
                                            Register/Login
                                        </a>
                                    </div>
                                    @else
                                    <ul class="standard_dropdown top_bar_dropdown ">
                                        <li>
                                            <a href="{{ route('dashboard') }}">
                                                <div class="user_icon"><img src="{{ asset('frontend/images/user.svg')}}"
                                                        alt=""> </div>
                                                Profile<i class="fas fa-chevron-down"></i>
                                            </a>
                                            <ul>
                                                <li><a href="{{ route('dashboard') }}">Profile</a></li>
                                                <li><a href="{{  route('user.wishlist') }}">Wishlist</a></li>
                                                <li><a href="{{  route('user.checkout') }}">Checkout </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Main -->

            <div class="header_main">
                <div class="container">
                    <div class="row">
                        @php
                        $siteSetting = DB::table('sitesetting')->first();
                        @endphp
                        <!-- Logo -->
                        <div class="col-lg-2 col-sm-3 col-3 order-1">
                            <div class="logo_container">
                                <div class="logo">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ asset($siteSetting->sitelogo)}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>

                        @php
                        $category = DB::table('categories')->get();
                        @endphp
                        <!-- Search -->
                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                            <div class="header_search">
                                <div class="header_search_content">
                                    <div class="header_search_form_container">
                                        <form action="{{ route('product.search') }}" method="post" class="header_search_form clearfix">
                                            @csrf
                                            <input type="search" name="search" required="required" class="header_search_input" placeholder="Search for products...">

                                            <div class="custom_dropdown">
                                                <div class="custom_dropdown_list">
                                                    <span class="custom_dropdown_placeholder clc" id="catall">
                                                        All Categories
                                                    </span>
                                                    <i class="fas fa-chevron-down"></i>
                                                    <ul class="custom_list clc" id="catlist">
                                                        @foreach ($category as $cat)
                                                        <li><a class="clc" href="#">{{ $cat->category_name }} </a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>

                                            <button type="submit" class="header_search_button trans_300" value="Submit">
                                                <img src="{{ asset('frontend/images/search.png')}}" alt="">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist -->
                        <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                            <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                                @guest

                                @else
                                <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                    @php
                                    $wishlist = DB::table('wishlists')->where('user_id', Auth::id())->get();

                                    @endphp
                                    <div class="wishlist_icon"><img src="{{ asset('frontend/images/heart.png')}}"
                                            alt=""></div>
                                    <div class="wishlist_content">
                                        <div class="wishlist_text"><a href="{{  route('user.wishlist') }}">Wishlist</a></div>
                                        <div class="wishlist_count" id="wishlist_count"> {{ count($wishlist) }} </div>
                                    </div>

                                </div>
                                @endguest

                                <!-- Cart -->
                                <div class="cart">
                                    <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                        @php
                                        $cartTotal = 0;
                                        if(Session::has('cart')){
                                        $cart = Session::get('cart');
                                        //Session::forget('cart');
                                        if($cart){
                                        foreach ($cart as $product) {
                                        $cartTotal += (double)$product['price'] * (int)$product['qty'];
                                        }
                                        }
                                        }else{
                                        $cart =[];
                                        }
                                        @endphp

                                        <div class="cart_icon">
                                            <img src="{{ asset('frontend/images/cart.png')}}" alt="">
                                            <div class="cart_count"><span class="cartQTY" id="cart_count">{{
                                                    count($cart) }}</span>
                                            </div>
                                        </div>

                                        <div class="cart_content">
                                            <div class="cart_text"><a href="{{ route('show.cart') }}">Cart</a></div>
                                            <div class="cart_price"> $<span class="cartTotal" id="cart_price">{{
                                                    $cartTotal }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @yield('content')

            <!-- Footer -->

            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 footer_col">
                            <div class="footer_column footer_contact">
                                <div class="logo_container">
                                    <div class="logo">
                                        <a href="{{ url('/') }}">
                                            <h2>{{$setting->company_name}} </h2>
                                        </a>
                                    </div>
                                </div>
                                <div class="footer_title">Got Question? Call Us 24/7 </div>
                                <div class="footer_phone">{{$setting->phone_two}} </div>
                                <div class="footer_contact_text">
                                    <p>{{$setting->company_address}} </p>
                                </div>
                                <div class="footer_social">
                                    <ul>
                                        <li><a href="{{$setting->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="{{$setting->youtube}}"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="{{$setting->instagram}}"><i class="fab fa-youtube"></i></a></li>
                                        <li><a href="{{$setting->twitter}}"><i class="fab fa-google"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @php
                           $column1 = DB::table('flinks')->where('columns_no', 1)->get();
                           $column2 = DB::table('flinks')->where('columns_no', 2)->get();
                           $column3 = DB::table('flinks')->where('columns_no', 3)->get();
                        @endphp
                        <div class="col-lg-2 offset-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">Usefull Links</div>
                                <ul class="footer_list">
                                    @foreach ($column1 as $row)
                                    <li><a href="{{ $row->url }}">{{ $row->name }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">Usefull Links</div>
                                <ul class="footer_list">
                                    @foreach ($column2 as $row)
                                    <li><a href="{{ $row->url }}">{{ $row->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">Usefull Links</div>
                                <ul class="footer_list">
                                    @foreach ($column3 as $row)
                                    <li><a href="{{ $row->url }}">{{ $row->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </footer>

            <!-- Copyright -->

            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div
                                class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                               <div class="copyright_content">
                                    {{ $siteSetting->copyright }}
                                </div>
                                <div class="logos ml-sm-auto">
                                    <ul class="logos_list">
                                        <li><a href="#"><img src="{{ asset('frontend/images/logos_1.png')}}" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{ asset('frontend/images/logos_2.png')}}" alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{ asset('frontend/images/logos_4.png')}}" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>


    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('frontend/styles/bootstrap4/popper.js')}}"></script>
    <script src="{{ asset('frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/plugins/greensock/TweenMax.min.js')}}"></script>
    <script src="{{ asset('frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
    <script src="{{ asset('frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
    <script src="{{ asset('frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
    <script src="{{ asset('frontend/plugins/greensock/ScrollToPlugin.min.jsplugins/greensock/ScrollToPlugin.min.js')}}">
    </script>
    <script src="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
    <script src="{{ asset('frontend/plugins/slick-1.8.0/slick.js')}}"></script>
    <script src="{{ asset('frontend/plugins/easing/easing.js')}}"></script>

    <script src="{{ asset('frontend/js/cart_custom.js')}}"></script>
    <script src="{{ asset('frontend/plugins/parallax-js-master/parallax.min.js')}}"></script>
    <script src="{{ asset('frontend/js/blog_custom.js')}}"></script>
    <script src="{{ asset('frontend/js/blog_single_custom.js')}}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>

    <script src="{{ asset('frontend/js/custom.js')}}"></script>
    <script src="{{ asset('frontend/js/product_custom.js')}}"></script>


    <!-- toastr script --->
    <script>
        @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        var message = "{{ Session::get('message') }}"; // Wrap in double curly braces
        switch (type) {
            case 'info':
                toastr.info(message);
                break;
            case 'success':
                toastr.success(message);
                break;
            case 'warning':
                toastr.warning(message);
                break;
            case 'error':
                toastr.error(message);
                break;
            default:
                toastr.info(message);
                break;
        }
        @endif
    </script>

    <!-- Sweet Alert Script --->
    <script>
        $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
           swal({
             title: "Are you Want to delete?",
             text: "Once Delete, This will be Permanently Delete!",
             icon: "warning",
             buttons: true,
             dangerMode: true,
           })
           .then((willDelete) => {
             if (willDelete) {
                  window.location.href = link;
             } else {
               swal("Safe Data!");
             }
           });
       });
    </script>

    <script>
        $(document).ready(function() {
            $('#catall').on('click', function() {
                $('#catlist').toggleClass('active');
            });
        });
    </script>

    <script>
        $(document).on("click", "#return", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
           swal({
             title: "Are you Want to Return?",
             text: "Once Return, This will return your money!",
             icon: "warning",
             buttons: true,
             dangerMode: true,
           })
           .then((willDelete) => {
             if (willDelete) {
                  window.location.href = link;
             } else {
               swal("Cancel!");
             }
           });
       });
    </script>


</body>

</html>
