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
            <h6 class="card-body-title">Product Details Page </h6>

            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>

                            <br> <strong> {{ $product->product_name }}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                            <br> <strong> {{ $product->product_code }}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Quantity: <span class="tx-danger">*</span></label>
                            <br> <strong> {{ $product->product_quantity }}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Product Category: <span class="tx-danger">*</span></label>
                            <br> <strong> {{ $product->category_name }}</strong>

                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Product Sub-Category:
                                <span class="tx-danger">*</span></label>
                            <br> <strong> {{ $product->subcategory_name }}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Product Brand: <span class="tx-danger">*</span></label>
                            <br> <strong> {{ $product->brand_name }}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                            <br> <strong> {{ $product->product_size }}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>

                            <br> <strong> {{ $product->product_color }}</strong>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Selling Price: <span
                                    class="tx-danger">*</span></label>
                            <br> <strong> {{ $product->selling_price }}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Product Details: <span class="tx-danger">*</span></label>
                            <strong> {!! $product->product_details !!}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Video Link<span class="tx-danger">*</span></label>
                            <br> <strong> {{ $product->video_link }}</strong>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image One (Main Thumbnail): <span
                                    class="tx-danger">*</span></label> <br>
                            <img class="mt-4" src="{{  asset($product->image_one) }}" style="height:60px; width: 60px;"
                                alt="">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                            <br>
                            <img class="mt-4" src="{{ asset($product->image_two) }}" style="height:60px; width:60px;"
                                alt="">

                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
                            <br>
                            <img class="mt-4" src="{{ asset( $product->image_three ) }}"
                                style="height:60px; width: 60px;" alt="">
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
                <br>
                <hr> <br>
                <div class="row">
                    <div class="col-lg-4">
                        <label class="ckbox">
                            @if($product->main_slider == 1)
                            <input type="checkbox" checked name="main_slider">
                            @else
                            <input type="checkbox" checked name="main_slider">
                            @endif
                            <span> Main Slider</span>
                        </label>
                    </div>

                    <div class="col-lg-4">
                        <label class="ckbox">
                            @if($product->hot_deal == 1)
                            <input type="checkbox" checked name="hot_deal">
                            @else
                            <input type="checkbox" checked name="hot_deal">
                            @endif
                            <span> Hot Deal</span>
                        </label>
                    </div>

                    <div class="col-lg-4">
                        <label class="ckbox">
                            @if($product->bast_rated == 1)
                            <input type="checkbox" checked name="bast_rated">
                            @else
                            <input type="checkbox" checked name="bast_rated">
                            @endif
                            <span> Bast Rated</span>
                        </label>
                    </div>

                    <div class="col-lg-4">
                        <label class="ckbox">
                            @if($product->trend == 1)
                            <input type="checkbox" checked name="trend">
                            @else
                            <input type="checkbox" checked name="trend">
                            @endif
                            <span> Tranding Products</span>
                        </label>
                    </div>

                    <div class="col-lg-4">
                        <label class="ckbox">
                            @if($product->mid_slider == 1)
                            <input type="checkbox" checked name="mid_slider">
                            @else
                            <input type="checkbox" checked name="mid_slider">
                            @endif
                            <span> Mid Slider</span>
                        </label>
                    </div>

                    <div class="col-lg-4">
                        <label class="ckbox">
                            @if($product->hot_new == 1)
                            <input type="checkbox" checked name="hot_new">
                            @else
                            <input type="checkbox" checked name="hot_new">
                            @endif
                            <span>Hot New</span>
                        </label>
                    </div>
                </div> <!-- End ROw -->

            </div>

        </div><!-- sl-mainpanel -->
    </div>
</div>

@endsection
