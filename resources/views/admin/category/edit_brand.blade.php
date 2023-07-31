@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Brand Update</h5>
        </div><!-- sl-page-title -->
        <div class="row">
            <div class="col-md-8">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                        <form action="{{ route('brand.update', $brand->id) }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="modal-body pd-20">
                                <div class="form-group">
                                    <label for="text1">Brand Name</label>
                                    <input type="text" class="form-control" id="text1" name="brand_name"
                                        value="{{ $brand->brand_name }}">
                                    @if ($errors->any())
                                        <ul class="text-danger">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="text1">Brand Logo</label>
                                    <input type="file" class="form-control" id="text1" name="brand_logo"
                                        value="{{ $brand->brand_logo }}">
                                    @if ($errors->any())
                                        <ul class="text-danger">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="text1">Old Brand Logo</label> <br>
                                    <img src="{{ asset($brand->brand_logo) }}" width="90px" alt="">
                                    <input type="hidden" name="old_logo" value="{{ $brand->brand_logo }}">
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
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
