@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Blog category Update</h5>
        </div><!-- sl-page-title -->
        <div class="row">
            <div class="col-md-8">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                        <form action="{{ route('update.blog.category', $blogcatedit->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body pd-20">
                                <div class="form-group">
                                    <label for="text1">Category Name English</label>
                                    <input type="text" class="form-control" id="text1" name="category_name_en"
                                        value="{{ $blogcatedit->category_name_en }}">
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
                                        value="{{ $blogcatedit->category_name_hin }}">
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
                                <button type="submit" class="btn btn-info pd-x-20">Update</button>
                            </div>
                        </form>
                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div>
        </div>
    </div>
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
@endsection
