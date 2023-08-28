@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Footer Links </h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Footer Links
                <a href="" class="btn btn-sm btn-primary" style="float: right" data-toggle="modal" data-target="#modaldemo3">Add New</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Sl.</th>
                            <th class="wd-15p">Name</th>
                            <th class="wd-15p">Url</th>
                            <th class="wd-15p">Column No.</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flinks as $key=>$row)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->url }}</td>
                            <td>{{ $row->columns_no }}</td>
                            <td>
                                <a href="{{ route('links.edit', $row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('links.delete', $row->id) }}" class="btn btn-sm btn-danger"
                                    id="delete">Delete</a>
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


    <!--  MODAL -->
    <div id="modaldemo3" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm" style="min-width: 350px;">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Footer Link Add</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('footer.links.store') }}" method="post">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="text1">Link Name</label>
                            <input type="text" class="form-control" id="text1" name="name" placeholder="Enter Link Name">
                        </div>
                        <div class="form-group">
                            <label for="text12">Url</label>
                            <input type="text" class="form-control" id="text12" name="url" placeholder="Enter Url">
                        </div>
                        <div class="form-group">
                            <label for="text2">Select Footer Column</label>
                            <select id="text2" name="columns_no" class="form-select form-control" aria-label="Default select example">
                                <option selected disabled="">Select Footer Column</option>
                                <option value="1">Column One</option>
                                <option value="2">Column Two</option>
                                <option value="3">Column Three</option>
                            </select>
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->

    @endsection
