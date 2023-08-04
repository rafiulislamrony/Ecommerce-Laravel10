@extends('admin.admin_layouts')

@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">StarBox</a>
        <span class="breadcrumb-item active">Product Section</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">New Product Add
                <a href="{{ route('all.product') }}" class="btn btn-sm btn-success" style="float: right"
                    data-toggle="modal" data-target="#modaldemo3" id="btnAllDelete">All Product</a>
            </h6>
            <p class="mg-b-20 mg-sm-b-30">New Product Add From</p>

            <form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_name"
                                    placeholder="Enter product name">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_code"
                                    placeholder="Enter Product Code">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Quantity: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_quantity"
                                    placeholder="Product Quantity">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Product Category: <span
                                        class="tx-danger">*</span></label>
                                <select name="category_id" class="form-control select2"
                                    data-placeholder="Choose Category">
                                    <option label="Choose Category"></option>
                                    @foreach ($category as $row)
                                    <option value="{{ $row->id }}"> {{ $row->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Product Sub-Category: <span
                                        class="tx-danger">*</span></label>
                                <select name="subcategory_id" class="form-control select2"
                                    data-placeholder="Choose Sub-Category">
                                    <option label="Choose  Sub-Category"></option>
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Product Brand: <span
                                        class="tx-danger">*</span></label>

                                <select name="brand_id" class="form-control select2" data-placeholder="Choose Brand">
                                    <option label="Choose Brand"></option>
                                    @foreach ($brand as $row)
                                    <option value="{{ $row->id }}"> {{ $row->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                                <input id="size" type="text" name="product_size" data-role="tagsinput"
                                    class="form-control" />
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Color: <span
                                        class="tx-danger">*</span></label>
                                <input id="color" type="text" name="product_color" data-role="tagsinput"
                                    class="form-control" />
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Selling Price: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="selling_price"
                                    placeholder="Product Selling Price">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Product Details: <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" id="summernote" name="product_details">

                                </textarea>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Video Link<span class="tx-danger">*</span></label>
                                <input class="form-control" name="video_link" placeholder="Video Link">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image One (Main Thumbnail): <span
                                        class="tx-danger">*</span></label> <br>
                                <label class="custom-file">
                                    <input class="d-block" type="file" id="file" class="custom-file-input"
                                        name="image_one" onchange="readURL(this);">
                                    <span class="custom-file-control"></span>
                                    <img class="mt-4" src="#" id="one" alt="">
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                                <br>
                                <label class="custom-file">
                                    <input onchange="readURL2(this);" class="d-block" type="file" id="file"
                                        class="custom-file-input" name="image_two">
                                    <span class="custom-file-control"></span>
                                    <img class="mt-4" src="#" id="two" alt="">
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
                                <br>
                                <label class="custom-file">
                                    <input class="d-block" onchange="readURL3(this);" type="file" id="file"
                                        class="custom-file-input" name="image_three">
                                    <span class="custom-file-control"></span>
                                    <img class="mt-4" src="#" id="three" alt="">
                                </label>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <br>
                    <hr> <br>
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="main_slider">
                                <span> Main Slider</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="hot_deal">
                                <span> Hot Deal</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="bast_rated">
                                <span> Bast Rated</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="trend">
                                <span> Tranding Products</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="mid_slider">
                                <span> Mid Slider</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="hot_new">
                                <span>Hot New</span>
                            </label>
                        </div>
                    </div> <!-- End ROw -->
                    <br><br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5">Submit Form</button>
                    </div>

                </div>

            </form>

        </div><!-- sl-mainpanel -->
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
           $('select[name="category_id"]').on('change',function(){
                var category_id = $(this).val();
                if (category_id) {
                  $.ajax({
                    url: "{{ url('/get/subcategory/') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                    var d =$('select[name="subcategory_id"]').empty();
                    $.each(data, function(key, value){

                    $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');

                    });
                    },
                  });

                }else{
                  alert('danger');
                }
            });
        });

</script>

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
<script type="text/javascript">
    function readURL2(input){
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#two')
              .attr('src', e.target.result)
              .width(80) ;
            };
            reader.readAsDataURL(input.files[0]);
          }
        }
</script>
<script type="text/javascript">
    function readURL3(input){
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#three')
              .attr('src', e.target.result)
              .width(80) ;
            };
            reader.readAsDataURL(input.files[0]);
          }
        }
</script>

@endsection
