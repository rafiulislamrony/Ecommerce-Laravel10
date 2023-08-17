@extends('layouts.app')

@section('content')
@include('layouts.menubar');
<div class="cart_section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cart_container">
                    <div class="cart_title">Tour Wishlist Products</div>
                    <div class="mt-4">
                        <table class="table table-striped" style="border: 2px solid #ddd;">
                            <thead>
                                <tr>
                                    <th scope="col">Sl</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Add to Cart</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($product as $row)
                                <tr class="wishlistRowremove{{$row->id}}">
                                    <th scope="row">{{ $i++ }}</th>
                                    <td><img src="{{ asset($row->image_one) }}" alt="" style="max-width: 60px;"></td>
                                    <td>{{ $row->product_name }}</td>
                                    <td>
                                        @if($row->product_color == NULL)
                                        @else
                                        {{ $row->product_color }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->product_size == NULL)
                                        No Size Selected
                                        @else
                                        {{ $row->product_size }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->discount_price == NULL)
                                        {{ number_format($row->selling_price , 2, '.', ',') }}
                                        @else
                                        {{ number_format($row->discount_price , 2, '.', ',') }}
                                        @endif
                                    <td>
                                        <a href="" class="btn btn-sm btn-primary"> Add to Cart</a>
                                    </td>
                                    <td>
                                        <button class="removeWishlist text-danger" data-id="{{ $row->id }}"
                                            title="Remove Form Wishlist" style="border:0;cursor: pointer;">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @if(count($product) == 0)
                                <tr>
                                    <td class="bg-light py-5  text-center" colspan="100">
                                        <h3 class="text-uppercase">Wishlist is empty!</h3>
                                    </td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
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

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
     $('.removeWishlist').on('click', function(){
        var id = $(this).data('id');
        if (id) {
            $.ajax({
                url: " {{ url('wishlist/remove/') }}/"+id,
                type:"GET",
                datType:"json",
                success:function(data){

                let oldWish = parseInt($('#wishlist_count').text());
                let newWish = oldWish - 1;
                $('#wishlist_count').text(newWish);

                $('.wishlistRowremove'+id).remove();

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


@endsection
