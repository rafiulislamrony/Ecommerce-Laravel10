@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Admin Table </h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Admin List
                <a href="{{ route('create.admin') }}" class="btn btn-sm btn-primary" style="float: right">Add New</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Sl.</th>
                            <th class="wd-15p">Name</th>
                            <th class="wd-15p">Phone</th>
                            <th class="wd-15p">Access</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $key=>$row)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->phone }}</td>
                            <td> <span class="badge badge-danger">Setting</span> </td>
                            {{-- <td>
                                <a href="{{ route('edit.admin', $row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('delete.admin', $row->id) }}" class="btn btn-sm btn-danger"
                                    id="delete">Delete</a>
                            </td> --}}
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

@endsection
