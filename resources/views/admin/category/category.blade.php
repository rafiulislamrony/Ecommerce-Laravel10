@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">StarBox</a>
        <span class="breadcrumb-item active">Categories</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Category Table</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Category List

                <a href="" class="btn btn-sm btn-primary" style="float: right">Add New</a>
            </h6>

            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Category Id</th>
                            <th class="wd-15p">Category Name</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger</td>
                            <td>Nixon</td>
                            <td>
                                <a href="" class="btn btn-sm btn-info">Edit</a>
                                <a href="" class="btn btn-sm btn-danger" id="delete">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- table-wrapper -->
        </div><!-- card -->

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

@endsection
