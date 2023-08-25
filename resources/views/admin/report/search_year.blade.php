@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>This Year Reports</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">This Year Total Sell<h5 class="d-inline text-danger">${{ $total }}</h5></h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Id</th>
                            <th class="wd-15p">Payment Type</th>
                            <th class="wd-15p">Transction Id</th>
                            <th class="wd-15p">Subtotal</th>
                            <th class="wd-15p">Shipping Chirge + Vat </th>
                            <th class="wd-15p">Total</th>
                            <th class="wd-15p">Date</th>
                            <th class="wd-15p">Status </th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key=>$row)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ $row->payment_type }}</td>
                            <td>{{ $row->blnc_transection }}</td>
                            <td>${{ $row->subtotal }}</td>
                            <td>${{ $row->shipping }} + ${{ $row->vat }} </td>
                            <td>${{ $row->total }}</td>
                            <td>{{ $row->date }}</td>
                            <td>
                                <strong>
                                    @if($row->status == 0)
                                    <span class="badge badge-warning">Pending</span>
                                    @elseif ($row->status == 1)
                                    <span class="badge badge-primary">Payment Accept</span>
                                    @elseif ($row->status == 2)
                                    <span class="badge badge-info">Progress</span>
                                    @elseif ($row->status == 3)
                                    <span class="badge badge-success">Delivered</span>
                                    @else
                                    <span class="badge badge-danger">Order Cancled</span>
                                    @endif
                                </strong>
                            </td>
                            <td>
                                <a href="{{ route('admin.view.order', $row->id) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
