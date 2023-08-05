@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Blog Category Table</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Blog Category List
                <a href="" class="btn btn-sm btn-primary" style="float: right" data-toggle="modal"
                    data-target="#modaldemo3">Add New Category</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Id</th>
                            <th class="wd-15p">Category Name Englidh</th>
                            <th class="wd-15p">Category Name Hindi</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogCat as $key=>$row)

                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ $row->category_name_en }}</td>
                            <td>{{ $row->category_name_hin }}</td>
                            <td>
                                <a href="{{ route('edit.blog.category', $row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('delete.blog.category', $row->id) }}" class="btn btn-sm btn-danger"
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
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Category Add</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store.blog.category') }}" method="post">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="text1">Category Name English</label>
                            <input type="text" class="form-control" id="text1" name="category_name_en"
                                placeholder="Category Name English ">

                            @if ($errors->any())
                            <ul class="text-danger">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="text1">Category Name Hindi</label>
                            <input type="text" class="form-control" id="text1" name="category_name_hin"
                                placeholder="Category Name Hindi">

                            @if ($errors->any())
                            <ul class="text-danger">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            @endif
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
</div>
</div>

@endsection
