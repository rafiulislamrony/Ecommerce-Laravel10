@extends('layouts.app')

@section('content')
@include('layouts.menubar');


<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title">Order Details</h5>
                        <div class="table-wrapper">
                            <table class="table responsive nowrap">
                                <tbody>
                                    <tr>
                                        <td> <strong>Name:</strong> </td>
                                        <td> <strong>{{ $userOrder->name }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Email:</strong> </td>
                                        <td> <strong>{{ $userOrder->email }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Payment_type:</strong> </td>
                                        <td> <strong>{{ $userOrder->payment_type }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Payment Id:</strong> </td>
                                        <td> <strong>{{ $userOrder->payment_id }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Total Amount:</strong> </td>
                                        <td> <strong>${{ number_format($userOrder->total, 2) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Month:</strong> </td>
                                        <td> <strong>{{ $userOrder->month }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Date:</strong> </td>
                                        <td> <strong>{{ $userOrder->date }} </strong></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title">Shipping Details</h5>
                        <div class="table-wrapper">
                            <table class="table display responsive nowrap">
                                <tbody>
                                    <tr>
                                        <td> <strong>Name:</strong> </td>
                                        <td> <strong>{{ $userShipping->ship_name }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Phone:</strong> </td>
                                        <td> <strong>{{ $userShipping->ship_phone }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Email:</strong> </td>
                                        <td> <strong>{{ $userShipping->ship_email }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Address:</strong> </td>
                                        <td> <strong>{{ $userShipping->ship_address }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>City:</strong> </td>
                                        <td> <strong>{{ $userShipping->ship_city }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Zip Code:</strong> </td>
                                        <td> <strong>{{ $userShipping->ship_zip }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Status:</strong> </td>
                                        <td> <strong>
                                                @if($userOrder->status == 0)
                                                <span class="badge badge-warning">Pending</span>
                                                @elseif ($userOrder->status == 1)
                                                <span class="badge badge-primary">Payment Accept</span>
                                                @elseif ($userOrder->status == 2)
                                                <span class="badge badge-info">Processing</span>
                                                @elseif ($userOrder->status == 3)
                                                <span class="badge badge-success">Delivered</span>
                                                @else
                                                <span class="badge badge-danger">Order Cancled</span>
                                                @endif
                                            </strong>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title">Order Products</h5>
                        <div class="table-wrapper">
                            <table class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Se. No.</th>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userOrderDetails as $key=>$row)
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{ $row->product_code }}</td>
                                        <td>{{ $row->product_name }}</td>
                                        <td>
                                            <img src="{{ asset($row->image_one) }}" width="50px" alt="">
                                        </td>
                                        <td>{{ $row->color }}</td>
                                        <td>{{ $row->size }}</td>
                                        <td>{{ $row->quantity }}</td>
                                        <td>{{ $row->singpleprice }}</td>
                                        <td>{{ $row->totalprice }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

@endsection
