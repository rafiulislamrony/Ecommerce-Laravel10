@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Pendiung Orders Table</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Orders List</h6>
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
                                <span class="badge badge-warning"> Pending</span>
                            </td> 
                            <td>
                                <a href="{{ route('coupon.edit', $row->id) }}" class="btn btn-sm btn-info">View</a>
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
