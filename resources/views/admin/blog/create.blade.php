@extends('admin.admin_layouts')

@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Blog Add
                <a href="{{ route('all.blog') }}" class="btn btn-sm btn-success" style="float: right"
                    data-toggle="modal" data-target="#modaldemo3" id="btnAllDelete">All Product</a>
            </h6>
            <p class="mg-b-20 mg-sm-b-30">Blog Add From</p>

            <form action="{{ route('store.blog') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Blog Category: <span
                                        class="tx-danger">*</span></label>
                                <select name="category_id" class="form-control select2"
                                    data-placeholder="Choose Category">
                                    <option label="Choose Category"></option>
                                    @foreach ($blogCategory as $row)
                                    <option value="{{ $row->id }}"> {{ $row->category_name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Blog Title English: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="post_title_en"
                                    placeholder="Blog Title English ">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Blog Title Hindi: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="post_title_hin"
                                    placeholder="Blog Title Hindi">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Blog Details English: <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" id="summernote" name="details_en">

                                </textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Blog Details Hindi: <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" id="summernote2" name="details_hin">

                                </textarea>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Blog Image: <span class="tx-danger">*</span></label>
                                <br>
                                <label class="custom-file">
                                    <input class="d-block" type="file" id="file" class="custom-file-input"
                                        name="post_image" onchange="readURL(this);" required="">
                                    <span class="custom-file-control"></span>
                                    <img class="mt-4" src="#" id="one" alt="">
                                </label>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info mg-r-5">Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- sl-mainpanel -->
    </div>
</div>

<script type="text/javascript">
    function readURL(input){
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#one')
              .attr('src', e.target.result)
              .width(80) ;
            };
            reader.readAsDataURL(input.files[0]);
          }
        }
</script>

@endsection
