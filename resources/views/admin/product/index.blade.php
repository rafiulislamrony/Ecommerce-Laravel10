@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Product Table</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Product List
                <a href="{{ route('add.product') }}" class="btn btn-sm btn-primary" style="float: right" >Add New</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th>Se. No.</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Sub-Category</th>
                            <th>Brand</th>
                            <th>Code</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $key=>$row)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ substr($row->product_name, 0, 20) . '...' }}</td>
                            <td>
                                <img src="{{ asset($row->image_one) }}" width="50px" alt="">
                            </td>
                            <td>{{ $row->category_name }}</td>
                            <td>{{ $row->subcategory_name }}</td>
                            <td>{{ $row->brand_name }}</td>
                            <td>{{ $row->product_code }}</td>
                            <td>{{ $row->product_color }}</td>
                            <td>{{ $row->product_size }}</td>
                            <td>{{ $row->selling_price }}</td>
                            <td>{{ $row->product_quantity }}</td>
                            <td>
                                @if($row->status == 1)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('edit.product', $row->id) }}" class="btn btn-sm btn-info"  title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('delete.product', $row->id) }}" class="btn btn-sm btn-danger"  title="Delete"
                                    id="delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a href="{{ route('view.product', $row->id) }}" class="btn btn-sm btn-warning"  title="View">
                                    <i class="fa fa-eye"></i>
                                </a>

                                @if ($row->status == 1)
                                <a href="{{ route('inactive.product', $row->id) }}" class="btn btn-sm btn-danger" title="Inactive" >
                                    <i class="fa fa-thumbs-down"></i>
                                </a>
                                @else
                                <a href="{{ route('active.product', $row->id) }}" class="btn btn-sm btn-info" title="Active">
                                    <i class="fa fa-thumbs-up"></i>
                                </a>
                                @endif


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- table-wrapper -->
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
</div>
</div>

@endsection
