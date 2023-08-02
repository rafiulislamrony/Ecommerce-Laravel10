@extends('admin.admin_layouts')
<link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>

@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">StarBox</a>
        <span class="breadcrumb-item active">Product Section</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">New Product Add</h6>
            <p class="mg-b-20 mg-sm-b-30">New Product Add From</p>

            <form action="" method="POST" action="" enctype="multipart/form-data">
                @csrf

                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_name" placeholder="Enter product name">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_code" placeholder="Enter Product Code">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Quantity: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_quantity" placeholder="Product Quantity">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Product Category: <span class="tx-danger">*</span></label>
                                <select name="category_id" class="form-control select2" data-placeholder="Choose country">
                                    <option label="Choose country"></option>
                                    <option value="USA">United States of America</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Product Sub-Category: <span class="tx-danger">*</span></label>
                                <select name="subcategory_id" class="form-control select2" data-placeholder="Choose country">
                                    <option label="Choose country"></option>
                                    <option value="USA">United States of America</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Product Brand: <span class="tx-danger">*</span></label>
                                <select name="brand_id" class="form-control select2" data-placeholder="Choose country">
                                    <option label="Choose country"></option>
                                    <option value="USA">United States of America</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                                <input id="size" type="text" name="product_size" data-role="tagsinput" class="form-control"/>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                                <input id="color" type="text" name="product_color" data-role="tagsinput" class="form-control"/>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Selling Price: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="selling_price" placeholder="Product Selling Price">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Product Details: <span class="tx-danger">*</span></label>
                                <input class="form-control" id="summernote" name="product_details" >
                            </div>
                        </div><!-- col-4 -->



                    </div><!-- row -->
                </div>

            </form>

        </div><!-- sl-mainpanel -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
        @endsection
