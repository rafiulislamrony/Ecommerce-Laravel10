@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_responsive.css') }}">

@include('layouts.menubar');

<!-- Home -->


<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg">
    </div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h3 class="home_title">
            <a style="color:#000;" href="{{ url('/') }}">Home </a>
            <span style="color:#000;">Search Product</span>
        </h3>
    </div>
</div>

<!-- Shop -->

<div class="shop pb-3">
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
                    <div class="sidebar_section">
                        <div class="sidebar_subtitle brands_subtitle">Brands</div>
                        <ul class="brands_list">
                            @php
                            $brand = DB::table('brands')->get();
                            @endphp
                            @foreach ($brand as $row)
                            <li class="brand"><a href="{{ route('brand.product', $row->id ) }}">{{ $row->brand_name
                                    }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-lg-9">

                <!-- Shop Content -->

                <div class="shop_content">

                    <div class="shop_bar clearfix">
                        <div class="shop_sorting">
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated
                                        </li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name
                                        </li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "price" }'> price</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product_grid row">
                        <div class="product_grid_border"></div>

                        @foreach ($products as $row)
                        <!-- Product Item -->
                        <div class="product_item qproduct is_new" style="width:25%;">
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
                                <br>
                                <button class="btn btn-primary addcart" data-id="{{ $row->id }}"
                                    data-price="{{ $row->discount_price === NULL ? $row->selling_price : $row->discount_price }}"
                                    data-qty="1">
                                    Add To Cart
                                </button>
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

                    <div class="shop_page_nav  mt-4 d-flex flex-row">
                        {{ $products->links("pagination::bootstrap-4") }}
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
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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
