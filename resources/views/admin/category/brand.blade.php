@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Brand Table</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Brand List
                <a href="" class="btn btn-sm btn-primary" style="float: right" data-toggle="modal"
                    data-target="#modaldemo3">Add New</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p"> Id</th>
                            <th class="wd-15p">Brand Logo</th>
                            <th class="wd-15p">Brand Name</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brand as $key=>$row)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ $row->brand_name }}</td>
                            <td>
                                <img src="{{ asset($row->brand_logo) }}" height="70px" width="80px" alt="">
                            </td>
                            <td>
                                <a href="{{ route('brand.edit', $row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('brand.delete', $row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Brand Add</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store.brand') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="text1">Brand Name</label>
                            <input type="text" class="form-control" id="text1" name="brand_name" placeholder="Brand Name">

                            @if ($errors->any())
                                <ul class="text-danger" >
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                           @endif
                        </div>
                        <div class="form-group">
                            <label for="text2">Brand Logo</label>
                            <input type="file" class="form-control" id="text2" name="brand_logo" placeholder="Brand Logo">

                            @if ($errors->any())
                                <ul class="text-danger" >
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



    @endsection
