@extends('admin.admin_layouts')

@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Admin Section</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Add New Admin</h6>

            <form action="{{ route('store.product') }}" method="POST">
                @csrf

                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name"  required="" placeholder="Enter Name">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="phone"  required="" placeholder="Enter Phone">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="email" required="" name="email" placeholder="Enter Email">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="password" name="password"  required="" placeholder="Enter Password">
                            </div>
                        </div><!-- col-4 -->

                    </div><!-- row -->
                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="category">
                                <span> Category</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="coupon">
                                <span> Coupon</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="products">
                                <span>Products</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="blog">
                                <span>Blog</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="orders">
                                <span>Orders</span>
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="other">
                                <span>Other</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="report">
                                <span>Report</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="role">
                                <span>Role</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="returns">
                                <span>Returns</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="contact">
                                <span>Contact</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="comment">
                                <span>Comment</span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" value="1" name="setting">
                                <span>Setting</span>
                            </label>
                        </div>
                    </div> <!-- End ROw -->
                    <br><br>
                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info mg-r-5">Submit</button>
                    </div>
                </div>
            </form>

        </div><!-- sl-mainpanel -->
    </div>
</div>

@endsection
