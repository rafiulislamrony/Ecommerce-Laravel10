@extends('layouts.app')

@section('content')
@include('layouts.menubar');

@php
$orders = DB::table('orders')->where('user_id', Auth::id())->orderBy('id','DESC')->limit(10)->get();
@endphp

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-8 card">
                <table class="table table-response">
                    <thead>
                        <tr>
                            <th scope="col">Payment Type</th>
                            <th scope="col">Return</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $row)
                        <tr>
                            <td scope="col">{{ $row->payment_type }} </td>
                            <td scope="col">
                                @if($row->return_order == 0)
                                <span class="badge badge-primary">No Request</span>
                                @elseif ($row->return_order == 1)
                                <span class="badge badge-info">Pending</span>
                                @elseif ($row->return_order == 2)
                                <span class="badge badge-success">Success</span>
                                @endif
                            </td>
                            <td scope="col">${{ $row->total }}</td>
                            <td scope="col">{{ $row->date }}</td>
                            <td scope="col">
                                @if($row->status == 0)
                                <span class="badge badge-warning">Pending</span>
                                @elseif ($row->status == 1)
                                <span class="badge badge-primary">Payment Accept</span>
                                @elseif ($row->status == 2)
                                <span class="badge badge-info">Processing</span>
                                @elseif ($row->status == 3)
                                <span class="badge badge-success">Delivered</span>
                                @else
                                <span class="badge badge-danger"> Cancled</span>
                                @endif
                            </td>
                            <td scope="col">
                                @if($row->return_order == 0)
                                <a href="{{ route('return.request', $row->id) }}" id="return"
                                    class="btn btn-sm btn-danger">
                                    Return
                                </a>
                                @elseif ($row->return_order == 1)
                                <span class="badge badge-info">Pending</span>
                                @elseif ($row->return_order == 2)
                                <span class="badge badge-info">Success</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <div class="card">
                    <img src="{{ asset('frontend/images/kaziariyan.png') }}" class="card-img-top"
                        style="width: 90px; margin:0 auto;" alt="">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ Auth::user()->name }} </h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{ route('password.change') }}">
                                Change Password
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('password.request') }}">
                                Forget Password
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('success.orderlist') }}">
                                Return Order
                            </a>
                        </li>
                    </ul>
                    <div class="card-body">
                        <a class="btn btn-danger btn-sm btn-block" href="{{ route('user.logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter -->
<div class="newsletter mt-5">
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


@endsection
