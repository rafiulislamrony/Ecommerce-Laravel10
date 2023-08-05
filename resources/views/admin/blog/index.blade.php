@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Blog Table</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Blog List
                <a href="{{ route('add.blog') }}" class="btn btn-sm btn-primary" style="float: right">Add Blog</a>
            </h6>
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Id</th>
                            <th class="wd-15p">Blog Category </th>
                            <th class="wd-15p">Blog Image</th>
                            <th class="wd-15p">Blog Title En</th>
                            <th class="wd-15p">Blog Title Hin</th>
                            <th class="wd-15p">Blog Details En</th>
                            <th class="wd-15p">Blog Details Hin</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $key=>$row)

                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ $row->category_name_en }}</td>
                            <td>
                                <?php
                                if (!empty($row->post_image)) { ?>
                                    <img src="{{ asset($row->post_image) }}" width="80px" alt="">
                                    <?php
                                } else {
                                    echo "No image found";
                                } ?>
                            </td>
                            <td>{{ substr($row->post_title_en, 0, 30). '...' }}</td>
                            <td>{{ substr($row->post_title_hin, 0, 30). '...' }}</td>
                            <td>{{ substr($row->details_en, 0, 30). '...' }}</td>
                            <td>{{ substr($row->details_hin, 0, 30). '...' }}</td>
                            <td>
                                <a href="{{ route('edit.blog', $row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('delete.blog', $row->id) }}" class="btn btn-sm btn-danger"
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
</div>
</div>

@endsection
