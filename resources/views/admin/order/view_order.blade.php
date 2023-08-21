@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>View Order Details</h5>
        </div><!-- sl-page-title -->

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
                                        <td> <strong>{{ $order->name }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Email:</strong> </td>
                                        <td> <strong>{{ $order->email }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Payment_type:</strong> </td>
                                        <td> <strong>{{ $order->payment_type }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Payment Id:</strong> </td>
                                        <td> <strong>{{ $order->payment_id }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Total Amount:</strong> </td>
                                        <td> <strong>${{ number_format($order->total, 2) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Month:</strong> </td>
                                        <td> <strong>{{ $order->month }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Date:</strong> </td>
                                        <td> <strong>{{ $order->date }} </strong></td>
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
                                        <td> <strong>{{ $shipping->ship_name }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Phone:</strong> </td>
                                        <td> <strong>{{ $shipping->ship_phone }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Email:</strong> </td>
                                        <td> <strong>{{ $shipping->ship_email }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Address:</strong> </td>
                                        <td> <strong>{{ $shipping->ship_address }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>City:</strong> </td>
                                        <td> <strong>{{ $shipping->ship_city }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Zip Code:</strong> </td>
                                        <td> <strong>{{ $shipping->ship_zip }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Status:</strong> </td>
                                        <td> <strong>
                                                @if($order->status == 0)
                                                <span class="badge badge-warning">Pending</span>
                                                @elseif ($order->status == 1)
                                                <span class="badge badge-warning">Payment Accept</span>
                                                @elseif ($order->status == 2)
                                                <span class="badge badge-warning">Progress</span>
                                                @elseif ($order->status == 4)
                                                <span class="badge badge-success">Delivered</span>
                                                @else
                                                <span class="badge badge-danger">Cancle</span>
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
        </div>

    </div>
</div>
@endsection
