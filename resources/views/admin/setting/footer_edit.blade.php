@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Footer Links</h6>

            <form action="{{ route('update.flinks') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $flinks->id }}">

                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Footer Link Name: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name" required=""
                                    value="{{ $flinks->name }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Url: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="url" required=""
                                    value="{{ $flinks->url }}">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="text2">Footer Column</label>
                                <select id="text2" name="columns_no" class="form-select form-control"
                                    aria-label="Default select example">
                                    <option selected disabled="">Select Footer Column</option>
                                    <option value="1">Column One</option>
                                    <option value="2">Column Two</option>
                                    <option value="3">Column Three</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->

                    </div>

                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info mg-r-5">Submit</button>
                    </div>
                </div>
            </form>

        </div><!-- sl-mainpanel -->
    </div>
</div>

@endsection
